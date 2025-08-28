
@extends('common.userdashboard')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Custom Toastr Styles -->

<style>
    /* Custom Toastr Colors - Blue/Primary Theme */
    .toast-success {
        background-color: #0d6efd !important; /* Bootstrap primary blue */
        color: white !important;
    }
    
    .toast-info {
        background-color: #0dcaf0 !important; /* Bootstrap info blue */
        color: white !important;
    }
    
    .toast-warning {
        background-color: #fd7e14 !important; /* Bootstrap warning orange */
        color: white !important;
    }
    
    .toast-error {
        background-color: #dc3545 !important; /* Bootstrap danger red */
        color: white !important;
    }
    
    /* Toast title colors */
    .toast-title {
        color: white !important;
        font-weight: bold !important;
    }
    
    /* Toast message colors */
    .toast-message {
        color: white !important;
    }
    
    /* Progress bar colors */
    .toast-progress {
        background-color: rgba(255, 255, 255, 0.4) !important;
    }
    
    /* Close button color */
    .toast-close-button {
        color: white !important;
        opacity: 0.8;
    }
    
    .toast-close-button:hover {
        opacity: 1;
    }
    
    /* Optional: Make all toasts use primary blue color */
    .toast-primary {
        background-color: #0d6efd !important;
        color: white !important;
    }
</style>

@section('content')

<h2>Dashboard</h2>
<div class="row mt-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-info">Total Ordered</h5>
                <p>{{ $totalQuantity }}</p>
            </div>
        </div>
    </div>
    
</div>

<table class="table table-border">
    <tr class="bg-primary text-white">
        <th>ক্রমিক নং </th> 
        <th>আবেদনকারীর নাম</th> 
        <th>দপ্তর </th> 
        <th>আবেদন এর সময় </th> 
        <th>ডেলিভারড @php
function enToBnNumber($number) {
    $english = ['0','1','2','3','4','5','6','7','8','9'];
    $bangla  = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    return str_replace($english, $bangla, $number);
}
@endphp

@php
    use Carbon\Carbon;
@endphp এর সময় </th> 
        <th>পণ্য তালিকা</th> 
        <th>নিষ্পন্ন করার সময় </th> {{-- Time difference --}}
    </tr>
    @foreach($applications as $i => $app)
        <tr>
            <td>{{ enToBnNumber($applications->firstItem()+$i) }}</td>
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
                    {{ enToBnNumber($diff_minutes) }} মিনিট, 
        {{ enToBnNumber($diff_hours) }} ঘণ্টা, 
        {{ enToBnNumber($diff_days) }} দিন
                @else
                    -
                @endif
            </td>
        </tr>
    @endforeach
</table>
<div class="d-flex justify-content-center mt-3">
    {!! $applications->links() !!}
</div>
@endsection