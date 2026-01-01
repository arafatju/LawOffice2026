
@extends('common.master2')
 
 
  
  
  
      
 
  
@section('content')

@section('title', 'Section Admin Management ') 

@section('breadcrumb', 'Pending  Applications ')  
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



<h2>Dashboard  </h2>
<div class="row mt-4">
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary">Total Pending Applications</h5>
                <p class="card-text h6">{{ $pendingCount }}</p>
            </div>
        </div>
    </div>
     
</div>
 
 <div class="mb-3 d-flex align-items-center">
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
        <button type="submit" class="btn btn-primary ml-2">রিপোর্ট দেখান</button>
    </form>  
</div> 

<!-- Print section starts -->
<div class="print-area">
    <h3 class="text-center my-3">REPORT</h3>
<table class="table table-border">
    <tr class="bg-primary text-white">
        <th> ক্রমিক নং  </th>
        <th>ব্যবহারকারীর নাম </th>
        <th>পণ্য তালিকা </th>
        <th>আবেদনের তারিখ </th>
        <th>Action</th>
    </tr>

    @foreach($pendingTransactions as $userId => $transactions)
        @php
            $user = $transactions->first()->user; // same user for all in group
        @endphp

        {{-- Show first row with user info --}}
        <tr>
            <td>{{ enToBnNumber($loop->iteration) }}</td>
            <td>{{ $user->name }}</td>
            <td>
                {{-- List all products for this user --}}
                <ul>
                    @foreach($transactions as $transaction)
                        <li>{{ $transaction->product->name }} ({{ enToBnNumber($transaction->number) }})</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ enToBnNumber($transactions->first()->created_at->format('d, M, Y')) }}</td>
            <td>
                <a href="{{ route('productpending1135', $user->userid) }}" class="btn btn-success btn-sm">বিস্তারিত </a>
            </td>
        </tr>
    @endforeach
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
 
@endsection

