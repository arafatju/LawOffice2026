
@extends('common.dataentrydash')
 
 
  
  
  
      
 
  
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



<h2>Dashboard  </h2>
<div class="row mt-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-info">মোট অপেক্ষমাণ  </h5>
                 <p> 
                 66 
             </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-bold fw-bold text-success">Office  Highest Order  </h5>
                <p class="card-text h6">Name  77 </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary">Pending Applications</h5>
                <p class="card-text h6">5 </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-danger"> Product going out of Stock </h5>
                <p class="card-text h6"> 
 

            
             <div>  Name   6</div>
            Name   6
             Name   6
                </p>
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
        <th>মঞ্জুরির তারিখ </th>
         <th> PDF </th> 
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
            <td>{{ enToBnNumber($transactions->first()->updated_at->format('d, M, Y')) }}</td>
            <td> 
    <a href="{{ route('officeapproved', ['id' => $transactions->first()->trid, 'userid' => $user->userid]) }}" 
       target="_blank" 
       class="btn btn-sm btn-primary">
        Print
    </a>
</td>
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

