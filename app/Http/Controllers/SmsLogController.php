<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SmsLog;
use Illuminate\Http\Request;

class SmsLogController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search'    => 'nullable|string|max:100',
            'status'    => 'nullable|in:sent,failed',
            'date_from' => 'nullable|date',
            'date_to'   => 'nullable|date|after_or_equal:date_from',
        ]);

        $query = SmsLog::query();

        if ($search = trim((string) $request->input('search'))) {
            $query->where(function ($q) use ($search) {
                $q->where('mobile', 'like', "%{$search}%")
                  ->orWhere('trid', 'like', "%{$search}%")
                  ->orWhere('userid', 'like', "%{$search}%")
                  ->orWhere('response', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Totals for the current filter (before ordering/pagination)
        $totals = (clone $query)->selectRaw("
            COUNT(*) as total,
            COALESCE(SUM(status = 'sent'), 0) as sent,
            COALESCE(SUM(status = 'failed'), 0) as failed
        ")->first();

        $logs = $query->latest()->paginate(20)->withQueryString();

        return view('sms.logs', compact('logs', 'totals'));
    }

   public function downloadPdf(Request $request)
{
    $request->validate([
        'date_from' => 'required|date',
        'date_to'   => 'required|date|after_or_equal:date_from',
        'status'    => 'nullable|in:sent,failed',
    ]);

    $query = SmsLog::query()
        ->whereDate('created_at', '>=', $request->date_from)
        ->whereDate('created_at', '<=', $request->date_to);

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $logs = $query->oldest()->get();

    $totals = (object) [
        'total'  => $logs->count(),
        'sent'   => $logs->where('status', 'sent')->count(),
        'failed' => $logs->where('status', 'failed')->count(),
    ];

    $pdf = Pdf::loadView('sms.logs_pdf', [
        'logs'     => $logs,
        'totals'   => $totals,
        'dateFrom' => $request->date_from,
        'dateTo'   => $request->date_to,
        'status'   => $request->status,
    ])->setPaper('a4', 'landscape');

    return $pdf->download("sms-logs-{$request->date_from}_to_{$request->date_to}.pdf");
}
}