<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Meeting;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MeetingController extends Controller
{
    const PDF_MAX  = 2000; // most rows put in one PDF
    const PER_PAGE = 10;
    const MAX_KB   = 2048; // 2 MB

    /** Categories a meeting can be recorded against */
    const CATEGORIES = ['ministry', 'autonomous', 'ngo', 'other'];

    /** Categories where a new name can be typed on the form (it is added to the saved list) */
    const OPEN_CATEGORIES = ['autonomous', 'ngo', 'other'];

    /* =========================================================
       Dashboard
       ========================================================= */
    /** User end: meeting entry form + list (the admin dashboard is on the institutes page). */
    public function index(Request $request)
    {
        $data = $this->dashboardData($request);
        $data['stats'] = $data['meetingStats'];   // the user-end view reads $stats

        return view('institutes.meeting', $data);
    }

    /**
     * Everything the meetings tab needs: the filtered + paginated meeting list,
     * the stats, and the institute lists used by the form and the filters.
     * Called by InstituteController@index.
     */
    public function dashboardData(Request $request): array
    {
        $query = Meeting::query()
            ->with(['institute:id,name', 'directorate:id,name', 'section:id,name']);

        $this->applyFilters($query, $request);

        $meetings = $query->orderByDesc('meeting_at')
                          ->orderByDesc('id')
                          ->paginate(self::PER_PAGE)
                          ->withQueryString();

        // ministries -> directorates -> sections, for the form and the filters
        $tree = Institute::ministries()
            ->with(['directorates' => function ($q) {
                $q->select('id', 'name', 'parent_id')
                  ->orderBy('name')
                  ->with(['sections' => function ($s) {
                      $s->select('id', 'name', 'parent_id')->orderBy('name');
                  }]);
            }])
            ->orderBy('name')
            ->get(['id', 'name'])
            ->map(function ($m) {
                return [
                    'id'           => $m->id,
                    'name'         => $m->name,
                    'directorates' => $m->directorates->map(function ($d) {
                        return [
                            'id'       => $d->id,
                            'name'     => $d->name,
                            'sections' => $d->sections->map(function ($s) {
                                return ['id' => $s->id, 'name' => $s->name];
                            })->values(),
                        ];
                    })->values(),
                ];
            })
            ->values();

        return [
            'meetings'       => $meetings,
            'meetingStats'   => $this->stats(),
            'tree'           => $tree,
            'autonomous'     => Institute::autonomous()->orderBy('name')->get(['id', 'name']),
            'ngos'           => Institute::ngos()->orderBy('name')->get(['id', 'name']),
            'others'         => Institute::others()->orderBy('name')->get(['id', 'name']),
            'categoryLabels' => $this->categoryLabels(),
        ];
    }

    /* =========================================================
       Save a meeting (AJAX, multipart)
       ========================================================= */
    public function store(Request $request): JsonResponse
    {
        $cat    = (string) $request->input('category');
        $type   = $this->instituteType($cat);                       // value stored in institutes.type
        $isOpen = in_array($cat, self::OPEN_CATEGORIES, true);      // may type a new name

        $pickMsg = $isOpen
            ? 'তালিকা থেকে নির্বাচন করুন অথবা নতুন নাম লিখুন।'
            : 'অনুগ্রহ করে তালিকা থেকে নির্বাচন করুন।';

        $data = $request->validate([
            'category'     => ['required', Rule::in(self::CATEGORIES)],

            // an existing ministry / autonomous body / NGO / other of the chosen category ...
            'institute_id' => [
                Rule::requiredIf(function () use ($isOpen, $request) {
                    return !$isOpen || !$request->filled('institute_name');
                }),
                'nullable', 'integer',
                Rule::exists('institutes', 'id')->where(function ($q) use ($type) {
                    $q->where('type', $type);
                }),
            ],
            // ... or (autonomous / NGO / others only) a new name that is not in the list yet
            'institute_name' => ['nullable', 'string', 'max:255'],

            // existing directorate of the chosen ministry ...
            'directorate_id' => ['nullable', 'integer',
                Rule::exists('institutes', 'id')->where(function ($q) use ($request) {
                    $q->where('type', Institute::DIRECTORATE)
                      ->where('parent_id', (int) $request->input('institute_id'));
                }),
            ],
            // ... or a new directorate name that is not in the list yet
            'directorate_name' => ['nullable', 'string', 'max:255'],

            // existing section of the chosen (existing) directorate ...
            'section_id' => ['nullable', 'integer',
                Rule::exists('institutes', 'id')->where(function ($q) use ($request) {
                    $q->where('type', Institute::SECTION)
                      ->where('parent_id', (int) $request->input('directorate_id'));
                }),
            ],
            // ... or a new section name; needs a directorate (existing or new)
            'section_name' => ['nullable', 'string', 'max:255',
                function ($attribute, $value, $fail) use ($request) {
                    if (trim((string) $value) !== ''
                        && !$request->filled('directorate_id')
                        && !$request->filled('directorate_name')) {
                        $fail('শাখা যোগ করার আগে অধিদপ্তর/দপ্তর/সংস্থা নির্বাচন করুন।');
                    }
                },
            ],

            'participant_name'        => ['required', 'string', 'max:255'],
            'participant_email'       => ['required', 'email', 'max:255'],
            'participant_mobile'      => ['required', 'regex:/^\+?[0-9][0-9\s\-]{6,18}$/'],
            'participant_designation' => ['required', 'string', 'max:255'],

            'meeting_type'     => ['required', Rule::in(array_keys(Meeting::TYPES))],
            'meeting_name'     => ['required', 'string', 'max:255'],
            'meeting_keyword'  => ['nullable', 'string', 'max:255'],
            'meeting_contents' => ['nullable', 'string', 'max:100000'],
            'attended'         => ['required', Rule::in(['yes', 'no'])],
            'meeting_at'       => ['required', 'date'],

            'attachment' => ['nullable', 'file', 'max:' . self::MAX_KB, 'mimes:pdf', 'mimetypes:application/pdf',
                function ($attribute, $value, $fail) {
                    if ($value instanceof UploadedFile && !$this->isGenuinePdf($value)) {
                        $fail('ফাইলটি আসল পিডিএফ নয়, অথবা এতে স্ক্রিপ্ট বা এমবেডেড ফাইল আছে।');
                    }
                },
            ],
        ], [
            'category.required'        => 'অনুগ্রহ করে একটি ক্যাটাগরি নির্বাচন করুন।',
            'category.in'              => 'অনুগ্রহ করে একটি ক্যাটাগরি নির্বাচন করুন।',
            'institute_id.required'    => $pickMsg,
            'institute_id.exists'      => 'অনুগ্রহ করে তালিকা থেকে নির্বাচন করুন।',
            'directorate_id.exists'    => 'এই অধিদপ্তর/দপ্তর/সংস্থা নির্বাচিত মন্ত্রণালয়/বিভাগের অধীনে নয়।',
            'section_id.exists'        => 'এই শাখা নির্বাচিত অধিদপ্তর/দপ্তর/সংস্থার অধীনে নয়।',
            'participant_name.required'        => 'অংশগ্রহণকারীর নাম দিন।',
            'participant_email.required'       => 'ইমেইল দিন।',
            'participant_email.email'          => 'সঠিক ইমেইল দিন।',
            'participant_mobile.required'      => 'মোবাইল নম্বর দিন।',
            'participant_mobile.regex'         => 'সঠিক মোবাইল নম্বর দিন।',
            'participant_designation.required' => 'পদবি দিন।',
            'meeting_type.required'    => 'সভা, সেমিনার বা ওয়ার্কশপ নির্বাচন করুন।',
            'meeting_type.in'          => 'সভা, সেমিনার বা ওয়ার্কশপ নির্বাচন করুন।',
            'meeting_name.required'    => 'মিটিংয়ের নাম দিন।',
            'meeting_at.required'      => 'মিটিংয়ের তারিখ ও সময় দিন।',
            'meeting_at.date'          => 'সঠিক তারিখ ও সময় দিন।',
            'attended.required'        => 'হাজিরা নির্বাচন করুন।',
            'attachment.max'           => 'পিডিএফ ফাইল ২ এমবির বেশি হতে পারবে না।',
            'attachment.mimes'         => 'শুধু পিডিএফ ফাইল গ্রহণযোগ্য।',
            'attachment.mimetypes'     => 'শুধু পিডিএফ ফাইল গ্রহণযোগ্য।',
        ]);

        $path = null;

        try {
            // 1) store the PDF privately (random name, never the uploaded name)
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $path = $file->storeAs('meetings/' . date('Y/m'), Str::uuid() . '.pdf', 'local');
            }

            // 2) save everything together
            $meeting = DB::transaction(function () use ($data, $cat, $type, $isOpen, $request, $path) {
                $instituteId   = (int) ($data['institute_id'] ?? 0);
                $directorateId = null;
                $sectionId     = null;

                // autonomous / NGO / others typed as a new name -> add it to the saved list
                if (!$instituteId && $isOpen && !empty($data['institute_name'])) {
                    $institute = Institute::firstOrCreate(
                        [
                            'type'      => $type,
                            'parent_id' => null,
                            'name'      => $this->clean($data['institute_name']),
                        ],
                        ['created_by' => Auth::id()]
                    );
                    $instituteId = $institute->id;
                }

                if ($cat === Institute::MINISTRY) {
                    if (!empty($data['directorate_id'])) {
                        $directorateId = (int) $data['directorate_id'];
                    } elseif (!empty($data['directorate_name'])) {
                        // not in the list yet -> add it under the chosen ministry
                        $directorate = Institute::firstOrCreate(
                            [
                                'type'      => Institute::DIRECTORATE,
                                'parent_id' => $instituteId,
                                'name'      => $this->clean($data['directorate_name']),
                            ],
                            ['created_by' => Auth::id()]
                        );
                        $directorateId = $directorate->id;
                    }

                    // a section only exists under a directorate
                    if ($directorateId) {
                        if (!empty($data['section_id'])) {
                            $sectionId = (int) $data['section_id'];
                        } elseif (!empty($data['section_name'])) {
                            $section = Institute::firstOrCreate(
                                [
                                    'type'      => Institute::SECTION,
                                    'parent_id' => $directorateId,
                                    'name'      => $this->clean($data['section_name']),
                                ],
                                ['created_by' => Auth::id()]
                            );
                            $sectionId = $section->id;
                        }
                    }
                }

                $upload = $request->file('attachment');

                return Meeting::create([
                    'user_id'        => Auth::user()->userid,
                    'category'       => $cat,
                    'institute_id'   => $instituteId,
                    'directorate_id' => $directorateId,
                    'section_id'     => $sectionId,

                    'participant_name'        => $this->clean($data['participant_name']),
                    'participant_email'       => trim($data['participant_email']),
                    'participant_mobile'      => trim($data['participant_mobile']),
                    'participant_designation' => $this->clean($data['participant_designation']),

                    'meeting_type'     => $data['meeting_type'],
                    'meeting_name'     => $this->clean($data['meeting_name']),
                    'meeting_keyword'  => isset($data['meeting_keyword']) ? $this->clean($data['meeting_keyword']) : null,
                    'meeting_contents' => $data['meeting_contents'] ?? null,
                    'attended'         => $data['attended'] === 'yes',
                    'meeting_at'       => Carbon::parse($data['meeting_at']),

                    'attachment_path' => $path,
                    'attachment_name' => $upload ? Str::limit(basename($upload->getClientOriginalName()), 200, '') : null,
                    'attachment_size' => $upload ? $upload->getSize() : null,
                ]);
            });
        } catch (\Throwable $e) {
            if ($path) {
                Storage::disk('local')->delete($path);
            }
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'মিটিং সংরক্ষণ করা যায়নি। আবার চেষ্টা করুন।',
            ], 500);
        }

        return response()->json([
            'success'      => true,
            'message'      => 'মিটিং সংরক্ষণ করা হয়েছে। আইডি: ' . $meeting->meeting_code,
            'meeting_code' => $meeting->meeting_code,
        ]);
    }

    /* =========================================================
       Printable page of ALL meetings matching the current search
       (use Print > Save as PDF)
       ========================================================= */
    public function report(Request $request)
    {
        $query = Meeting::query()
            ->with(['institute:id,name', 'directorate:id,name', 'section:id,name']);

        $this->applyFilters($query, $request);

        $total = (clone $query)->count();

        $meetings = $query->orderByDesc('meeting_at')
                          ->orderByDesc('id')
                          ->limit(self::PDF_MAX)
                          ->get();

        return view('institutes.meeting-report', [
            'meetings'       => $meetings,
            'total'          => $total,
            'capped'         => $total > self::PDF_MAX,
            'max'            => self::PDF_MAX,
            'filterSummary'  => $this->filterSummary($request),
            'generatedAt'    => now(),
            'categoryLabels' => $this->categoryLabels(),
        ]);
    }

    /* =========================================================
       Private PDF download
       ========================================================= */
    public function file(Meeting $meeting)
    {
        abort_unless($meeting->attachment_path && Storage::disk('local')->exists($meeting->attachment_path), 404);

        $name = preg_replace('/[^\w.\- ]+/u', '_', $meeting->attachment_name ?: 'meeting.pdf');

        return Storage::disk('local')->download($meeting->attachment_path, $name, [
            'Content-Type'           => 'application/pdf',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    /* =========================================================
       Helpers
       ========================================================= */

    /** meeting category -> the value stored in institutes.type */
    private function instituteType(string $category): string
    {
        $map = [
            'ministry'   => Institute::MINISTRY,
            'autonomous' => Institute::AUTONOMOUS,
            'ngo'        => Institute::NGO,
            'other'      => Institute::OTHER,
        ];

        return $map[$category] ?? $category;
    }

    private function categoryLabels(): array
    {
        $L = Institute::LABELS;

        return [
            'ministry'   => $L[Institute::MINISTRY],
            'autonomous' => $L[Institute::AUTONOMOUS],
            'ngo'        => $L[Institute::NGO],
            'other'      => $L[Institute::OTHER],
        ];
    }

    private function applyFilters($query, Request $request): void
    {
        // same cascade as the entry form:
        // category -> institute -> directorate -> section (শাখা)
        $cat  = (string) $request->query('category', '');
        $inst = (int) $request->query('institute_id', 0);
        $dir  = (int) $request->query('directorate_id', 0);
        $sec  = (int) $request->query('section_id', 0);

        if (in_array($cat, self::CATEGORIES, true)) {
            $query->where('category', $cat);
        }
        if ($inst) {
            $query->where('institute_id', $inst);
        }
        if ($dir) {
            $query->where('directorate_id', $dir);
        }
        if ($sec) {
            $query->where('section_id', $sec);
        }

        // সভা / সেমিনার / ওয়ার্কশপ
        $mt = (string) $request->query('meeting_type', '');
        if (isset(Meeting::TYPES[$mt])) {
            $query->where('meeting_type', $mt);
        }

        $from = $this->parseDate($request->query('date_from'));
        $to   = $this->parseDate($request->query('date_to'));
        if ($from) {
            $query->where('meeting_at', '>=', $from->copy()->startOfDay());
        }
        if ($to) {
            $query->where('meeting_at', '<=', $to->copy()->endOfDay());
        }

        $field = (string) $request->query('person_field', 'name');
        $pq    = trim((string) $request->query('person_q', ''));
        if ($pq !== '' && in_array($field, ['name', 'email', 'mobile'], true)) {
            $query->where('participant_' . $field, 'like', $this->like($pq));
        }

        $topic = trim((string) $request->query('topic', ''));
        if ($topic !== '') {
            $like = $this->like($topic);
            $query->where(function ($q) use ($like) {
                $q->where('meeting_name', 'like', $like)
                  ->orWhere('meeting_keyword', 'like', $like)
                  ->orWhere('meeting_contents', 'like', $like);
            });
        }
    }

    private function stats(): array
    {
        $base = function () {
            return Meeting::query();
        };

        return [
            'total'       => $base()->count(),
            'ministry'    => $this->topInstitute($base()->where('category', 'ministry'), 'institute_id'),
            'directorate' => $this->topInstitute($base(), 'directorate_id'),
            'section'     => $this->topInstitute($base(), 'section_id'),
            'autonomous'  => $this->topInstitute($base()->where('category', 'autonomous'), 'institute_id'),
            'org'         => $this->topInstitute($base()->whereIn('category', ['ngo', 'other']), 'institute_id'),
            'name'        => $this->topMeetingName($base()),
        ];
    }

    private function topInstitute($query, string $column): array
    {
        $row = $query->whereNotNull($column)
            ->select($column, DB::raw('COUNT(*) as total'))
            ->groupBy($column)
            ->orderByDesc('total')
            ->orderBy($column)
            ->first();

        if (!$row) {
            return ['name' => '—', 'count' => 0];
        }

        $institute = Institute::find($row->{$column});

        return [
            'name'  => $institute ? $institute->name : '—',
            'count' => (int) $row->total,
        ];
    }

    private function topMeetingName($query): array
    {
        $row = $query->select('meeting_name', DB::raw('COUNT(*) as total'))
            ->groupBy('meeting_name')
            ->orderByDesc('total')
            ->orderBy('meeting_name')
            ->first();

        return $row
            ? ['name' => $row->meeting_name, 'count' => (int) $row->total]
            : ['name' => '—', 'count' => 0];
    }

    private function filterSummary(Request $request): array
    {
        $lines  = [];
        $L      = Institute::LABELS;
        $labels = $this->categoryLabels();

        $cat = (string) $request->query('category', '');
        if (isset($labels[$cat])) {
            $lines[] = 'ক্যাটাগরি: ' . $labels[$cat];
        }

        $names = [
            'institute_id'   => $labels[$cat] ?? 'প্রতিষ্ঠান',
            'directorate_id' => $L[Institute::DIRECTORATE],
            'section_id'     => $L[Institute::SECTION],
        ];
        foreach ($names as $key => $title) {
            $id = (int) $request->query($key, 0);
            if ($id && ($institute = Institute::find($id))) {
                $lines[] = $title . ': ' . $institute->name;
            }
        }

        $mt = (string) $request->query('meeting_type', '');
        if (isset(Meeting::TYPES[$mt])) {
            $lines[] = 'ধরন: ' . Meeting::TYPES[$mt];
        }

        $from = $this->parseDate($request->query('date_from'));
        $to   = $this->parseDate($request->query('date_to'));
        if ($from || $to) {
            $lines[] = 'তারিখ: ' . ($from ? $from->format('d M Y') : '...') . ' থেকে ' . ($to ? $to->format('d M Y') : '...');
        }

        $field  = (string) $request->query('person_field', 'name');
        $pq     = trim((string) $request->query('person_q', ''));
        $fields = ['name' => 'নাম', 'email' => 'ইমেইল', 'mobile' => 'মোবাইল'];
        if ($pq !== '' && isset($fields[$field])) {
            $lines[] = 'অংশগ্রহণকারী (' . $fields[$field] . '): ' . $pq;
        }

        $topic = trim((string) $request->query('topic', ''));
        if ($topic !== '') {
            $lines[] = 'বিষয়: ' . $topic;
        }

        return $lines;
    }

    /**
     * "Check file origin": the file must really be a PDF, not just named .pdf.
     *  - starts with the %PDF- signature and ends with %%EOF
     *  - no script / launch / embedded-file markers
     * (the 'mimetypes' rule has already checked the real type with finfo)
     * Note: a heuristic, it cannot see inside compressed object streams.
     */
    private function isGenuinePdf(UploadedFile $file): bool
    {
        $path = $file->getRealPath();
        if (!$path || !is_file($path)) {
            return false;
        }

        $size = filesize($path);
        if ($size === false || $size < 20 || $size > self::MAX_KB * 1024) {
            return false;
        }

        $head = file_get_contents($path, false, null, 0, 8);
        if ($head === false || strncmp($head, '%PDF-', 5) !== 0) {
            return false;
        }

        $tail = file_get_contents($path, false, null, max(0, $size - 2048));
        if ($tail === false || strpos($tail, '%%EOF') === false) {
            return false;
        }

        $content = file_get_contents($path);
        if ($content === false) {
            return false;
        }

        return !preg_match('#/(JavaScript|JS|Launch|EmbeddedFile|RichMedia)\b#', $content);
    }

    private function parseDate($value): ?Carbon
    {
        if (!$value) {
            return null;
        }
        try {
            return Carbon::parse($value);
        } catch (\Exception $e) {
            return null;
        }
    }

    private function like(string $value): string
    {
        return '%' . addcslashes($value, '%_\\') . '%';
    }

    private function clean(string $value): string
    {
        return trim(preg_replace('/\s+/u', ' ', $value));
    }
}