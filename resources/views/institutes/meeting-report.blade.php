<!doctype html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>মিটিং তালিকা</title>
    <style>
        @page { size: A4 landscape; margin: 12mm; }
        * { box-sizing: border-box; }
        body {
            font-family: "Noto Sans Bengali", "Nirmala UI", "Siyam Rupali", "Segoe UI", "Noto Sans", Arial, sans-serif;
            color: #1b1f3b; margin: 0; padding: 20px; font-size: 12px; line-height: 1.45;
        }
        h1 { margin: 0 0 4px; font-size: 20px; color: #1a237e; }
        .meta { color: #667085; margin: 2px 0; }
        .filters { margin: 8px 0 12px; padding: 8px 12px; background: #f6f7fb; border: 1px solid #dfe3f0; border-radius: 6px; }
        .filters b { color: #1a237e; }
        .note { margin: 10px 0 0; color: #b7791f; font-weight: 600; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        thead { display: table-header-group; }          /* repeat the header on every page */
        th, td { border: 1px solid #cfd4e6; padding: 6px 8px; vertical-align: top; text-align: left; }
        th { background: #e8eaf6; color: #1a237e; font-size: 12px; }
        tr { break-inside: avoid; page-break-inside: avoid; }

        .w-meeting { width: 19%; } .w-subject { width: 29%; } .w-time { width: 10%; }
        .w-inst { width: 16%; }    .w-part { width: 18%; }    .w-att { width: 8%; }

        .name { font-weight: 700; }
        .code { font-family: ui-monospace, Menlo, Consolas, monospace; font-size: 10.5px; color: #1a237e; }
        .muted { color: #667085; }
        .tag { display: inline-block; font-size: 10px; font-weight: 700; padding: 1px 7px; border-radius: 4px; background: #e3effb; color: #2b6cb0; margin-bottom: 2px; }
        .tag.autonomous { background: #ede9fe; color: #6b46c1; }
        .tag.ngo { background: #e3f4ea; color: #2f855a; }
        .tag.other { background: #fdf0d5; color: #b7791f; }
        .tag.mtype { background: #e8eaf6; color: #1a237e; }
        .yes { color: #2f855a; font-weight: 700; }
        .no  { color: #c53030; font-weight: 700; }
        .kw { color: #1a237e; font-weight: 600; font-size: 11px; margin-bottom: 2px; }
        .subject { overflow-wrap: anywhere; }

        .toolbar { margin-bottom: 14px; display: flex; gap: 10px; align-items: center; flex-wrap: wrap; }
        .toolbar button {
            padding: 9px 18px; font-size: 14px; font-weight: 600; border: 0; border-radius: 8px;
            background: #1a237e; color: #fff; cursor: pointer;
        }
        .toolbar span { color: #667085; font-size: 13px; }

        @media print {
            .no-print { display: none !important; }
            body { padding: 0; }
        }
    </style>
</head>
<body>
    <div class="toolbar no-print">
        <button type="button" onclick="window.print()">প্রিন্ট / পিডিএফ</button>
        <span>প্রিন্ট উইন্ডোতে গন্তব্য হিসেবে <b>Save as PDF</b> নির্বাচন করুন।</span>
    </div>

    <h1>মিটিং তালিকা</h1>
    <p class="meta">তৈরির সময়: {{ $generatedAt->format('d M Y, h:i A') }} &nbsp;|&nbsp; মোট: {{ $total }}টি</p>

    @if(count($filterSummary))
        <div class="filters">
            <b>ফিল্টার:</b>
            @foreach($filterSummary as $line)
                <span>{{ $line }}@if(!$loop->last) &nbsp;&bull;&nbsp; @endif</span>
            @endforeach
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th class="w-meeting">মিটিং</th>
                <th class="w-subject">বিষয়</th>
                <th class="w-time">সময়</th>
                <th class="w-inst">প্রতিষ্ঠান</th>
                <th class="w-part">অংশগ্রহণকারী</th>
                <th class="w-att">হাজিরা</th>
            </tr>
        </thead>
        <tbody>
            @forelse($meetings as $m)
                <tr>
                    <td>
                        @if(isset(\App\Models\Meeting::TYPES[$m->meeting_type]))
                            <span class="tag mtype">{{ \App\Models\Meeting::TYPES[$m->meeting_type] }}</span>
                        @endif
                        <div class="name">{{ $m->meeting_name }}</div>
                        <div class="code">({{ $m->meeting_code }})</div>
                    </td>
                    <td>
                        @if($m->meeting_keyword)
                            <div class="kw">{{ $m->meeting_keyword }}</div>
                        @endif
                        @if(trim((string) $m->meeting_contents) !== '')
                            <div class="subject">{!! nl2br(e($m->meeting_contents)) !!}</div>
                        @else
                            <span class="muted">&ndash;</span>
                        @endif
                    </td>
                    <td>
                        {{ $m->meeting_at->format('d M Y') }}<br>
                        <span class="muted">{{ $m->meeting_at->format('h:i A') }}</span>
                    </td>
                    <td>
                        <span class="tag {{ $m->category }}">{{ $categoryLabels[$m->category] ?? $m->category }}</span>
                        <div class="name">{{ optional($m->institute)->name }}</div>
                        @if($m->directorate)
                            <div class="muted">{{ $m->directorate->name }}</div>
                        @endif
                        @if($m->section)
                            <div class="muted">{{ $m->section->name }}</div>
                        @endif
                    </td>
                    <td>
                        <div class="name">{{ $m->participant_name }}</div>
                        <div class="muted">{{ $m->participant_email }}</div>
                        <div class="muted">{{ $m->participant_mobile }}</div>
                    </td>
                    <td class="{{ $m->attended ? 'yes' : 'no' }}">{{ $m->attended ? 'হ্যাঁ' : 'না' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="muted" style="text-align:center;padding:24px">কোনো মিটিং পাওয়া যায়নি।</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($capped)
        <p class="note">সর্বশেষ {{ $max }}টি মিটিং দেখানো হয়েছে (মোট {{ $total }}টি)। বাকিগুলোর জন্য অনুসন্ধান সংকীর্ণ করুন।</p>
    @endif

    <script>
        // open the print dialog automatically; the button above works too
        window.addEventListener('load', function () { setTimeout(function () { window.print(); }, 500); });
    </script>
</body>
</html>