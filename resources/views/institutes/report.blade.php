<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Institute list</title>
    <style>
        @page { margin: 16mm 14mm; }
        * { box-sizing: border-box; }
        body {
            font-family: "Segoe UI", "Noto Sans", "Noto Sans Bengali", "Nirmala UI", Arial, sans-serif;
            color: #1b1f3b; margin: 0; padding: 24px; line-height: 1.5;
        }
        h1 { margin: 0 0 4px; font-size: 1.6rem; color: #1a237e; }
        h2 { margin: 28px 0 10px; font-size: 1.15rem; padding-bottom: 6px; border-bottom: 2px solid #1a237e; color: #1a237e; }
        h3 { margin: 0 0 6px; font-size: 1rem; }
        .meta, .muted { color: #667085; font-size: .9rem; }
        .count { color: #667085; font-weight: 400; font-size: .9rem; }
        .ministry { margin-bottom: 14px; break-inside: avoid; page-break-inside: avoid; }
        ol { margin: 0 0 0 22px; padding-left: 18px; }
        li { margin: 2px 0; }
        .toolbar { margin-bottom: 18px; }
        .toolbar button {
            padding: 9px 18px; font-size: .95rem; font-weight: 600; border: 0; border-radius: 8px;
            background: #1a237e; color: #fff; cursor: pointer;
        }
        @media print { .no-print { display: none !important; } body { padding: 0; } }
    </style>
</head>
<body>
    <div class="toolbar no-print">
        <button type="button" onclick="window.print()">Print / Save as PDF</button>
    </div>

    <h1>Institute list</h1>
    <p class="meta">Generated: {{ $generatedAt->format('d M Y, h:i A') }}</p>

    <h2>1. Ministries and directorates</h2>
    @forelse($ministries as $i => $m)
        <div class="ministry">
            <h3>{{ $i + 1 }}. {{ $m->name }} <span class="count">({{ $m->directorates->count() }} directorates)</span></h3>
            @if($m->directorates->count())
                <ol>
                    @foreach($m->directorates as $d)
                        <li>{{ $d->name }}</li>
                    @endforeach
                </ol>
            @else
                <p class="muted" style="margin-left:22px">No directorates</p>
            @endif
        </div>
    @empty
        <p class="muted">No ministries saved.</p>
    @endforelse

    <h2>2. NGO</h2>
    @if($ngos->count())
        <ol>
            @foreach($ngos as $name)
                <li>{{ $name }}</li>
            @endforeach
        </ol>
    @else
        <p class="muted">No NGOs saved.</p>
    @endif

    <h2>3. Others</h2>
    @if($others->count())
        <ol>
            @foreach($others as $name)
                <li>{{ $name }}</li>
            @endforeach
        </ol>
    @else
        <p class="muted">No others saved.</p>
    @endif
</body>
</html>