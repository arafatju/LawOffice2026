<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; }
        h3 { margin: 0 0 4px; }
        .summary { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 4px; vertical-align: top; }
        th { background: #eee; }
        .sent { color: #198754; } .failed { color: #dc3545; }
    </style>
</head>
<body>
    <h3>
    SMS Logs -
    {{ \Carbon\Carbon::parse($dateFrom)->format('d M Y') }}
    @if($dateFrom !== $dateTo)
        to {{ \Carbon\Carbon::parse($dateTo)->format('d M Y') }}
    @endif
</h3>
    <div class="summary">
        Total: <b>{{ $totals->total }}</b> |
        Successful: <b>{{ $totals->sent }}</b> |
        Failed: <b>{{ $totals->failed }}</b>
        @if($status) | Filter: {{ ucfirst($status) }} @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th><th>Time</th><th>Transaction</th><th>User</th>
                <th>Mobile</th><th>Status</th><th>Response</th>
            </tr>
        </thead>
        <tbody>
        @forelse($logs as $log)
            <tr>
                <td>{{ $loop->iteration }}</td>
              <td>{{ $log->created_at->format('d M Y, h:i A') }}</td>
                <td>{{ $log->trid ?? '-' }}</td>
                <td>{{ $log->userid ?? '-' }}</td>
                <td>{{ $log->mobile }}</td>
                
                <td class="{{ $log->status }}">{{ ucfirst($log->status) }}</td>
                <td>{{ \Illuminate\Support\Str::limit($log->response, 80) }}</td>
            </tr>
        @empty
            <tr><td colspan="8" style="text-align:center">No SMS logs on this date.</td></tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>