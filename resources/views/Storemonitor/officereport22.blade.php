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
<div class="d-flex justify-content-start no-print">

   <form method="GET" class="form-inline" action="">
        <label for="office" class="mr-2 fw-bold">দপ্তর বাছাই করুন:</label>
        <select name="office" id="office" class="form-control mr-2" style="width:auto;display:inline-block;">
            <option value="">সকল দপ্তর</option>
            @foreach($offices as $ofc)
                <option value="{{ $ofc }}" {{ (request('office') == $ofc) ? 'selected' : '' }}>
                    {{ $ofc }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary m-2">রিপোর্ট দেখান</button>
    </form> 

<a href="{{ route('productapproved111') }}" 
       target="_blank" 
       class="btn btn-primary m-2">
        Download PDF
    </a>
</div>

{{-- Table --}}
<div class="print-area">
    <h2 class="text-center mb-3"> দপ্তর  রিপোর্ট </h2>
    <table class="table table-bordered text-center" style="margin: auto; width: 95%;">
         
    <tr class="bg-primary text-white">
       <th>ক্রমিক নং </th> 
        <th>আবেদনকারীর নাম</th> 
        <th>দপ্তর </th> 
        <th>আবেদন এর সময় </th> 
        <th>ডেলিভারড</th> 
<th>পণ্য তালিকা</th> 
        <th>নিষ্পন্ন করার সময় </th>

    </tr>
    @foreach($applications as $i => $app)
        <tr>
            <td>{{ enToBnNumber(($applications->currentPage() - 1) * $applications->perPage() + $loop->iteration) }}</td>
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
                    {{ enToBnNumber($diff_minutes) }} মিনিট , 
        {{ enToBnNumber($diff_hours) }} ঘণ্টা , 
        {{ enToBnNumber($diff_days) }} দিন ¨
                @else
                    -
                @endif
            </td>
        </tr>
    @endforeach
</table>
 <div class="mt-3">
    {{ $applications->links() }}
</div>
    
    
</div>
@endsection

 