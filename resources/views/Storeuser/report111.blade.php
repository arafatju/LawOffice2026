
@extends('common.notary2')
 
 
  
  
  
      
 
  
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
    .action-btn {
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        margin: 2px 5px 2px 0;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
        transform: translateY(-1px);
    }

    .btn-view {
        background: #17a2b8;
        color: white;
    }

    .btn-view:hover {
        background: #138496;
        transform: translateY(-1px);
    }

    .btn-allotment {
        background: #28a745;
        color: white;
    }

    .btn-allotment:hover {
        background: #218838;
        transform: translateY(-1px);
    }

    .btn-update {
        background: #ffc107;
        color: #212529;
    }

    .btn-update:hover {
        background: #e0a800;
        transform: translateY(-1px);
    }

    /* Table header style */
    table th {
        vertical-align: middle;
        text-align: center;
    }

    /* Table data style */
    table td {
        vertical-align: middle;
        text-align: center;
    }
</style>


<h2>Dashboard  </h2>
<div class="row mt-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-info">Product Highest Order  </h5>
                 <p> 
                  {{ $product111->name ?? 'N/A' }}      {{ $highest->total_delivered ?? 0 }}
             </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-bold fw-bold text-success">Office  Highest Order  </h5>
                <p class="card-text h6">{{ $highestOffice->office ?? 'N/A' }}      {{ $highestOffice->total_delivered ?? 0 }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary">Pending Applications</h5>
                <p class="card-text h6">{{ $pendingCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-danger"> Product going out of Stock </h5>
                <p class="card-text h6"> 
 
                @php 
             foreach ($outOfStockProducts as $product) {
    echo $product->name . ' (' . $product->quantity . ')' . '<br>';
}
@endphp

        </div>
    </div>
</div>
 
<table class="table table-border">
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



@endsection

