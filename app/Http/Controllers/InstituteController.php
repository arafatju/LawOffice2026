<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class InstituteController extends Controller
{
    const PER_PAGE = 10;               // ministries / autonomous / NGOs / Others per page
    const DIRECTORATES_PER_PAGE = 10;  // directorates per page inside each ministry card

    public function index()
    {
        return view('institutes.index', [
            'ministries' => $this->ministryList(),
            'stats'      => $this->stats(),
        ]);
    }

    /** Admin: meeting dashboard only (stats, search, list). Meetings are entered on the user end. */
    public function meetings(Request $request)
    {
        return view('institutes.meetings', app(MeetingController::class)->dashboardData($request));
    }

    public function store(Request $request): JsonResponse
    {
        // Sections are NOT created on this page, so only FORM_TYPES are accepted
        $data = $request->validate([
            'draft'              => ['required', 'array', 'min:1', 'max:200'],
            'draft.*.type'       => ['required', Rule::in(Institute::FORM_TYPES)],
            'draft.*.name'       => ['required', 'string', 'max:255'],
            'draft.*.ministry'   => ['required_if:draft.*.type,directorate', 'nullable', 'string', 'max:255'],
        ], [
            'draft.required'               => 'কোনো তথ্য পাওয়া যায়নি।',
            'draft.*.type.in'              => 'এই ধরনের প্রতিষ্ঠান এখানে যোগ করা যাবে না।',
            'draft.*.name.required'        => 'প্রতিটি প্রতিষ্ঠানের নাম দিতে হবে।',
            'draft.*.ministry.required_if' => 'অধিদপ্তর/দপ্তর/সংস্থার জন্য মন্ত্রণালয়/বিভাগ নির্বাচন করতে হবে।',
        ]);

        $created = 0;
        $skipped = [];
        $userId  = auth()->id();

        DB::transaction(function () use ($data, $userId, &$created, &$skipped) {
            foreach ($data['draft'] as $row) {
                $name     = $this->clean($row['name']);
                $parentId = null;

                if ($row['type'] === Institute::DIRECTORATE) {
                    // Find the ministry, or create it if it is new
                    $ministry = Institute::firstOrCreate(
                        ['type' => Institute::MINISTRY, 'parent_id' => null, 'name' => $this->clean($row['ministry'])],
                        ['created_by' => $userId]
                    );
                    if ($ministry->wasRecentlyCreated) {
                        $created++;
                    }
                    $parentId = $ministry->id;
                }

                $institute = Institute::firstOrCreate(
                    ['type' => $row['type'], 'parent_id' => $parentId, 'name' => $name],
                    ['created_by' => $userId]
                );

                if ($institute->wasRecentlyCreated) {
                    $created++;
                } else {
                    $skipped[] = $name;
                }
            }
        });

        $message = $created . 'টি তথ্য সংরক্ষণ করা হয়েছে।';
        if ($skipped) {
            $message .= ' ইতিমধ্যে আছে: ' . implode(', ', $skipped) . '।';
        }

        return response()->json([
            'success'    => true,
            'message'    => $message,
            'created'    => $created,
            'ministries' => $this->ministryList(),
            'stats'      => $this->stats(),
        ]);
    }

    /**
     * Saved records, one group at a time, paginated.
     * group = ministry (each with its first page of directorates) | autonomous | ngo | other
     */
    public function list(Request $request): JsonResponse
    {
        $group = $request->query('group', Institute::MINISTRY);
        abort_unless(in_array($group, [
            Institute::MINISTRY,
            Institute::AUTONOMOUS,
            Institute::NGO,
            Institute::OTHER,
        ], true), 422);

        $search = trim((string) $request->query('q', ''));
        $like   = '%' . addcslashes($search, '%_\\') . '%';

        $query = Institute::where('type', $group);

        if ($search !== '') {
            $query->where(function ($q) use ($like, $group) {
                $q->where('name', 'like', $like);
                if ($group === Institute::MINISTRY) {
                    // also match ministries that have a matching directorate
                    $q->orWhereHas('directorates', function ($d) use ($like) {
                        $d->where('name', 'like', $like);
                    });
                }
            });
        }

        $page = $query->orderBy('name')->paginate(self::PER_PAGE, ['id', 'name']);

        $rows = $page->getCollection()->map(function ($i) use ($group, $search) {
            $row = [
                'id'                => $i->id,
                'name'              => $i->name,
                'directorates'      => [],
                'directorates_meta' => null,
                'dir_q'             => '',
            ];

            if ($group === Institute::MINISTRY) {
                // if the search matched only a directorate, show just the matching ones
                $dirQ = ($search !== '' && mb_stripos($i->name, $search) === false) ? $search : '';
                $dirs = $this->directoratePage($i, $dirQ, 1);

                $row['directorates']      = $this->directoratePayload($dirs);
                $row['directorates_meta'] = $this->pageMeta($dirs);
                $row['dir_q']             = $dirQ;
            }

            return $row;
        })->values();

        return response()->json([
            'data' => $rows,
            'meta' => $this->pageMeta($page),
        ]);
    }

    /** One page of directorates for a single ministry card. */
    public function directorates(Request $request, Institute $ministry): JsonResponse
    {
        abort_unless($ministry->type === Institute::MINISTRY, 404);

        $dirs = $this->directoratePage(
            $ministry,
            trim((string) $request->query('q', '')),
            (int) $request->query('page', 1)
        );

        return response()->json([
            'data' => $this->directoratePayload($dirs),
            'meta' => $this->pageMeta($dirs),
        ]);
    }

    /** Download everything as CSV (opens in Excel): ministries, their directorates, autonomous bodies, NGOs, Others. */
    public function export()
    {
        $filename = 'institutes-' . date('Y-m-d') . '.csv';
        $L = Institute::LABELS;

        return response()->streamDownload(function () use ($L) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // UTF-8 BOM so Excel shows Bangla text correctly

            fputcsv($out, ['ক্রমিক', 'ক্যাটাগরি', 'নাম', 'মন্ত্রণালয়/বিভাগ']);
            $sl = 0;

            foreach ($this->allMinistriesWithDirectorates() as $m) {
                fputcsv($out, [++$sl, $L[Institute::MINISTRY], $this->csvSafe($m->name), '']);
                foreach ($m->directorates as $d) {
                    fputcsv($out, [++$sl, $L[Institute::DIRECTORATE], $this->csvSafe($d->name), $this->csvSafe($m->name)]);
                }
            }

            foreach (Institute::autonomous()->orderBy('name')->pluck('name') as $name) {
                fputcsv($out, [++$sl, $L[Institute::AUTONOMOUS], $this->csvSafe($name), '']);
            }

            foreach (Institute::ngos()->orderBy('name')->pluck('name') as $name) {
                fputcsv($out, [++$sl, $L[Institute::NGO], $this->csvSafe($name), '']);
            }

            foreach (Institute::others()->orderBy('name')->pluck('name') as $name) {
                fputcsv($out, [++$sl, $L[Institute::OTHER], $this->csvSafe($name), '']);
            }

            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /** Printable page (use the browser's Print > Save as PDF). */
    public function report()
    {
        return view('institutes.report', [
            'ministries'  => $this->allMinistriesWithDirectorates(),
            'autonomous'  => Institute::autonomous()->orderBy('name')->pluck('name'),
            'ngos'        => Institute::ngos()->orderBy('name')->pluck('name'),
            'others'      => Institute::others()->orderBy('name')->pluck('name'),
            'generatedAt' => now(),
        ]);
    }

    public function destroy(Institute $institute): JsonResponse
    {
        // Never delete a ministry together with its directorates by accident
        if ($institute->type === Institute::MINISTRY && $institute->directorates()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'এই মন্ত্রণালয়/বিভাগের অধীনে অধিদপ্তর/দপ্তর/সংস্থা আছে। আগে সেগুলো মুছে ফেলুন।',
            ], 422);
        }

        // Same for a directorate that still has sections (sections are managed on another page)
        if ($institute->type === Institute::DIRECTORATE && $institute->sections()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'এই অধিদপ্তর/দপ্তর/সংস্থার অধীনে শাখা আছে। আগে শাখাগুলো মুছে ফেলুন।',
            ], 422);
        }

        try {
            $institute->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            // e.g. a meeting still references this record through a foreign key
            return response()->json([
                'success' => false,
                'message' => 'এই তথ্যটি ব্যবহৃত হচ্ছে, তাই মুছে ফেলা যাবে না।',
            ], 409);
        }

        return response()->json([
            'success'    => true,
            'message'    => 'সফলভাবে মুছে ফেলা হয়েছে।',
            'ministries' => $this->ministryList(),
            'stats'      => $this->stats(),
        ]);
    }

    /* ---------- helpers ---------- */

    private function allMinistriesWithDirectorates()
    {
        return Institute::ministries()
            ->with(['directorates' => function ($q) {
                $q->select('id', 'name', 'parent_id')->orderBy('name');
            }])
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    // stop spreadsheet formula injection (cells starting with = + - @)
    private function csvSafe(string $value): string
    {
        return preg_match('/^[=+\-@\t\r]/', $value) ? "'" . $value : $value;
    }

    private function directoratePage(Institute $ministry, string $q, int $page)
    {
        $query = $ministry->directorates();

        if ($q !== '') {
            $query->where('name', 'like', '%' . addcslashes($q, '%_\\') . '%');
        }

        return $query->orderBy('name')
                     ->paginate(self::DIRECTORATES_PER_PAGE, ['id', 'name'], 'page', max(1, $page));
    }

    private function directoratePayload($dirs)
    {
        return $dirs->getCollection()->map(function ($d) {
            return ['id' => $d->id, 'name' => $d->name];
        })->values();
    }

    private function pageMeta($p): array
    {
        return [
            'current_page' => $p->currentPage(),
            'last_page'    => $p->lastPage(),
            'total'        => $p->total(),
            'from'         => $p->firstItem(),
            'to'           => $p->lastItem(),
        ];
    }

    private function clean(string $value): string
    {
        return trim(preg_replace('/\s+/u', ' ', $value));
    }

    private function ministryList()
    {
        return Institute::ministries()->orderBy('name')->get(['id', 'name']);
    }

    private function stats(): array
    {
        // Change 'meetings' if your meeting table has a different name.
        $meetings = Schema::hasTable('meetings') ? DB::table('meetings')->count() : 0;

        $ngo        = Institute::ngos()->count();
        $other      = Institute::others()->count();
        $autonomous = Institute::autonomous()->count();

        return [
            'meetings'     => $meetings,
            'ministries'   => Institute::ministries()->count(),
            'directorates' => Institute::onlyDirectorates()->count(),
            'autonomous'   => $autonomous,
            'ngo'          => $ngo,
            'other'        => $other,
            'orgs'         => $ngo + $other,
        ];
    }
}