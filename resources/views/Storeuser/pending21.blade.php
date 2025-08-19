
@extends('common.notary2')
 
 
  
  
  
      
 
  
@section('content')




<h2>Dashboard  </h2>
<div class="row mt-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-info">Product Highest Order  </h5>
                 <p> 
                  Name      7
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
<table class="table table-border">
    <tr class="bg-primary text-white">
        <th>Serial</th>
        <th>User Name</th>
        <th>Order List</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

    @foreach($pendingTransactions as $userId => $transactions)
        @php
            $user = $transactions->first()->user; // same user for all in group
        @endphp

        {{-- Show first row with user info --}}
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>
                {{-- List all products for this user --}}
                <ul>
                    @foreach($transactions as $transaction)
                        <li>{{ $transaction->product->name }} ({{ $transaction->number }})</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $transactions->first()->created_at->format('d, M, Y') }}</td>
            <td>
                <a href="{{ route('productpending', $user->userid) }}" class="btn btn-success btn-sm">View</a>
            </td>
        </tr>
    @endforeach
</table>

 
@endsection

