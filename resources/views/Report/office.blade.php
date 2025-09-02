@php
function enToBnNumber($number) {
    $english = ['0','1','2','3','4','5','6','7','8','9'];
    $bangla  = ['০','১','২','৩','৪','৫','৆','৭','৮','৯'];
    return str_replace($english, $bangla, $number);
}
@endphp

@php
    use Carbon\Carbon;
@endphp 

<style>
@media print {
    * {
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
        print-color-adjust: exact !important;
        box-sizing: border-box !important;
    }

    body * {
        visibility: hidden;
    }

    .print-area, .print-area * {
        visibility: visible;
    }
    
    .print-area {
        margin: 15mm auto;
        padding: 0;
        width: 100%;
        max-width: none;
        text-align: center;
    }

    .print-header {
        text-align: center;
        margin-bottom: 20px;
        page-break-after: avoid;
    }

    .print-header h4,
    .print-header h5,
    .print-header p {
        margin: 2px 0;
        line-height: 1.2;
    }

    .print-area h3 {
        margin: 15px 0 20px 0;
        page-break-after: avoid;
        font-weight: bold;
    }

    /* Remove all default table styling first */
    .print-area .table,
    .print-area .table-border {
        border: none !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Apply fresh table styling */
    .print-area table {
        border-collapse: collapse !important;
        border-spacing: 0 !important;
        width: 100% !important;
        margin: 0 auto !important;
        border: 2px solid #000 !important;
        table-layout: fixed !important;
        background: white !important;
    }

    .print-area table thead {
        display: table-header-group !important;
    }

    .print-area table tbody {
        display: table-row-group !important;
    }

    /* Header cells with stronger border rules */
    .print-area table thead th {
        border: 2px solid #000 !important;
        border-top: 2px solid #000 !important;
        border-bottom: 2px solid #000 !important;
        border-left: 2px solid #000 !important;
        border-right: 2px solid #000 !important;
        padding: 8px 4px !important;
        text-align: center !important;
        vertical-align: middle !important;
        background-color: #0d6efd !important;
        color: white !important;
        font-weight: bold !important;
        font-size: 11px !important;
        line-height: 1.2 !important;
        page-break-inside: avoid !important;
    }

    /* Data cells with explicit border on all sides */
    .print-area table tbody td {
        border: 1px solid #000 !important;
        border-top: 1px solid #000 !important;
        border-bottom: 1px solid #000 !important;
        border-left: 1px solid #000 !important;
        border-right: 1px solid #000 !important;
        padding: 6px 4px !important;
        text-align: center !important;
        vertical-align: middle !important;
        font-size: 10px !important;
        line-height: 1.3 !important;
        page-break-inside: avoid !important;
        word-wrap: break-word !important;
        background: white !important;
    }

    /* Table rows with explicit borders */
    .print-area table tr {
        page-break-inside: avoid !important;
        border: 1px solid #000 !important;
        background: white !important;
        height: auto !important;
        min-height: 30px !important;
    }

    .print-area table thead tr {
        page-break-after: avoid !important;
        border: 2px solid #000 !important;
        background-color: #0d6efd !important;
    }

    .print-area table tbody tr {
        page-break-before: auto !important;
        page-break-after: auto !important;
        page-break-inside: avoid !important;
        border: 1px solid #000 !important;
    }

    /* Better control of page breaks around table */
    .print-area table tbody tr:nth-child(n+8) {
        page-break-before: auto !important;
    }

    /* Prevent isolated header at page bottom */
    .print-area table thead {
        page-break-after: avoid !important;
        page-break-inside: avoid !important;
    }

    /* Force clean breaks */
    .print-area table tbody tr:nth-child(7) {
        page-break-after: page !important;
    }

    /* Ensure minimum content per page */
    .print-area tbody {
        orphans: 3 !important;
        widows: 3 !important;
    }

    /* Alternative approach - split table naturally */
    .print-area table {
        page-break-before: avoid !important;
    }

    @page {
        size: A4;
        margin: 15mm 10mm;
    }

    /* Override any Bootstrap or other framework styles */
    .print-area table.table {
        border: 2px solid #000 !important;
    }

    .print-area table.table th,
    .print-area table.table td {
        border: 1px solid #000 !important;
    }

    .print-area table.table-border {
        border: 2px solid #000 !important;
    }

    .print-area table.table-border th,
    .print-area table.table-border td {
        border: 1px solid #000 !important;
    }
}

/* Screen styles remain unchanged */
</style>

<h2>Dashboard</h2>
 
<div class="mb-3 d-flex align-items-center">
    <button onclick="window.print()" class="btn btn-outline-success print-btn no-print mb-4" title="Direct Print">
        <i class="fas fa-print"></i> Print
    </button>
</div> 

<!-- Print section starts -->
<div class="print-area">
    <div class="print-header">
        <h4>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h4>
        <h5>আইন মন্ত্রণালয়</h5>
        <p>ffffffffff</p>
        <hr>
    </div>
    <h3 class="text-center my-3">REPORT</h3>
    
    <table class="table table-border">
        <thead>
            <tr class="bg-primary text-white">
                <th>ক্রমিক নং</th> 
                <th>আবেদনকারীর নাম</th> 
                <th>দপ্তর</th> 
                <th>আবেদন এর সময়</th> 
                <th>ডেলিভারড</th> 
                <th>পণ্য তালিকা</th> 
                <th>নিষ্পন্ন করার সময়</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $i => $app)
                <tr>
                    <td>{{ enToBnNumber($i+1) }}</td>
                    <td>{{ $app->user->personalInfo->name ?? '-' }}</td>
                    <td>{{ $app->user->personalInfo->office ?? '-' }}</td>

                    {{-- Applied --}}
                    <td>{{ \Carbon\Carbon::parse($app->created_at)->format('d M Y h:i A') }}</td>

                    {{-- Delivered --}}
                    <td>
                        @if($app->transactions->count() > 0)
                            @php
                                $approved = $app->transactions->firstWhere('status', 'approved');
                            @endphp
                            {{ $approved ? \Carbon\Carbon::parse($approved->updated_at)->format('d M Y h:i A') : '-' }}
                        @else
                            -
                        @endif
                    </td>

                    {{-- Product list --}}
                    <td>
                        @if($app->transactions->count() > 0)
                            {{ $app->transactions->map(function($tran) {
                                return ($tran->product->name ?? '-') . ' (' . enToBnNumber($tran->number) . ')';
                            })->implode(', ') }}
                        @else
                            -
                        @endif
                    </td>

                    {{-- Time difference column --}}
                    <td>
                        @if($app->transactions->count() > 0 && $approved)
                            @php
                                $applied = \Carbon\Carbon::parse($app->created_at);
                                $delivered = \Carbon\Carbon::parse($approved->updated_at);
                                
                                $diff_minutes = $applied->diffInMinutes($delivered);
                                $diff_hours   = $applied->diffInHours($delivered);
                                $diff_days    = $applied->diffInDays($delivered);
                            @endphp
                            {{-- Show in days and months in Bangla --}}
                            {{ enToBnNumber($diff_minutes) }} মিনিট , 
                            {{ enToBnNumber($diff_hours) }} ঘণ্টা , 
                            {{ enToBnNumber($diff_days) }} দিন ¨
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function printReportTable() {
    var printContents = document.getElementById('report-print-section').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    window.location.reload(); // reloads to recover JS/events/styles
}
</script>