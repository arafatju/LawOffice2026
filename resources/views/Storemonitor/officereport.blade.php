{{-- Blade Template: productreport.blade.php --}}
@extends('common.adminmonitor')
@section('content')
@php
function enToBnNumber($number) {
    $english = ['0','1','2','3','4','5','6','7','8','9'];
    $bangla  = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    return str_replace($english, $bangla, $number);
}
@endphp

@php
    use Carbon\Carbon;
@endphp 
<style>
@media print {
    /* Hide everything first */
    body * {
        visibility: hidden;
    }
    
    /* Show only print area */
    .print-area, .print-area * {
        visibility: visible;
    }
    
    /* Position print area - REMOVE height restriction for multi-page */
    .print-area {
        position: static !important; /* Changed from absolute */
        left: 0;
        top: 0;
        width: 100% !important;
        margin: 0 !important;
        padding: 15px !important;
        /* Removed height: 100% to allow multiple pages */
    }
    
    /* Hide elements that shouldn't print */
    .no-print, .no-print-pagination {
        display: none !important;
    }
    
    /* Allow table to break across pages */
    .print-area table {
        width: 100% !important;
        font-size: 11px !important;
        border-collapse: collapse !important;
        page-break-inside: auto !important;
        
    }
    
    /* Allow table rows to break across pages */
    .print-area tr {
        page-break-inside: avoid !important;
        page-break-after: auto !important;
    }
    
    /* Repeat table header on each page */
    .print-area thead {
        display: table-header-group !important;
    }
    
    /* Optimize table for print */
    .print-area th,
    .print-area td {
        padding: 6px 4px !important;
        border: 1px solid #000 !important;
        font-size: 11px !important;
    }
    
    /* Ensure table header is bold and visible */
    .print-area th {
        background-color: #0d6efd !important;
        color: white !important;
        font-weight: bold !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    
    /* Remove Bootstrap container margins */
    .container, .container-fluid {
        margin: 0 !important;
        padding: 0 !important;
        max-width: none !important;
    }
    
    /* Page margins */
    @page {
        margin: 0.5in;
        size: A4;
    }
    
    /* Title styling for print */
    .print-area h2 {
        font-size: 18px !important;
        margin-bottom: 15px !important;
        page-break-after: avoid !important;
    }
}
</style>

<h2 class="mb-4 no-print">Dashboard</h2>

{{-- First Row --}}
<div class="row no-print">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-bold text-success"> অফিস সর্বাধিক অর্ডার</h5>
                <p class="card-text h6">{{$highestOffice->office ?? '-' }} {{ $highestOffice->total_delivered ?? 0 }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary">মোট অফিস </h5>
                <p class="card-text h6"> {{$numberOfOffices}}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-bold text-danger">অপেক্ষমাণ আবেদন </h5>
                <p class="card-text h6">
                     {{$pendingCount}}
                </p>
            </div>
        </div>
    </div>
</div>

{{-- Second Row --}}
{{-- Print Button --}}
 <div class="row no-print m-2">
    <div class="col-12">
        <form method="GET" action="" class="row align-items-end">
            <div class="col-auto">
                <label for="office" class="form-label fw-bold">দপ্তর বাছাই করুন:</label>
                <select name="office" id="office" class="form-control" style="width:150px;">
                    <option value="">সকল দপ্তর</option>
                    @foreach($offices as $ofc)
                    <option value="{{ $ofc }}" {{ (request('office') == $ofc) ? 'selected' : '' }}>
                        {{ $ofc }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-auto">
                <label for="month" class="form-label fw-bold">মাস বাছাই করুন:</label>
                <select name="month" id="month" class="form-control" style="width:120px;">
                    <option value="">সকল মাস</option>
                    @foreach($month as $m)
                    <option value="{{ $m }}" {{ (request('month') == $m) ? 'selected' : '' }}>
                        {{ $m }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-auto">
                <label for="year" class="form-label fw-bold">বছর বাছাই করুন:</label>
                <select name="year" id="year" class="form-control" style="width:100px;">
                    <option value="">সকল বছর</option>
                    @foreach($year as $y)
                    <option value="{{ $y }}" {{ (request('year') == $y) ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary mr-2">রিপোর্ট দেখান</button>
                <button type="button" id="downloadPdf" class="btn btn-success">PDF ডাউনলোড</button>
            </div>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="print-area">
    <h2 class="text-center mb-3"> দপ্তর  রিপোর্ট </h2>
    <table class="table table-bordered text-center" style="margin: auto; width: 95%;">
         
    <tr class="header-row">
            <td class="col-serial">Serial</td>
            <td class="col-product">Product Name</td>
            <td class="col-code">Product Code</td>
            <td class="col-code">Product Category</td>
            <td class="col-quantity">Quantity</td>
            <td class="col-time"> Applied </td>
            <td class="col-time">Delivered </td>
        </tr>

        @foreach ($pendingTransactions as $tran)
        <tr>
            <td class="col-serial">{{ $loop->iteration }}</td>
            <td class="col-product">{{ $tran->product->name ?? 'N/A' }}</td>
            <td class="col-code">{{ $tran->product->prcode ?? 'N/A' }}</td>
            <td class="col-category">{{ $tran->product->category ?? 'N/A' }}</td>
            <td class="col-quantity">{{ $tran->number }}</td>
            <td class="col-time">
                {{ $tran->created_at->format('j F Y') }}<br>
                {{ $tran->created_at->format('g.i a') }}
            </td>
            
            <td class="col-time">
                {{ $tran->updated_at->format('j F Y') }}<br>
                {{ $tran->updated_at->format('g.i a') }}
            </td>
            
        </tr>
        @endforeach
</table>
 <div class="mt-3">
    {{ $pendingTransactions->links() }}
</div>
    
    
</div>
@endsection

 
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('downloadPdf').addEventListener('click', function() {
        const office = document.getElementById('office').value;
        const month = document.getElementById('month').value;
        const year = document.getElementById('year').value;
        
        let pdfUrl = '{{ route("officereport1212") }}';
        const params = [];
        
        // Only add parameters if they have values
        if (office && office !== '') params.push(`office=${encodeURIComponent(office)}`);
        if (month && month !== '') params.push(`month=${encodeURIComponent(month)}`);
        if (year && year !== '') params.push(`year=${encodeURIComponent(year)}`);
        
        if (params.length > 0) {
            pdfUrl += '?' + params.join('&');
        }
        
        console.log('PDF URL:', pdfUrl); // For debugging
        window.open(pdfUrl, '_blank');
    });
});
</script>
