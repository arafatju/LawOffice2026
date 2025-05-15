
@extends('common.notary2')
 
 
  
  
  
      
 
  
@section('content')




<h2>Dashboard Overview</h2>
<div class="row mt-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">License Status</h5>
                <p class="card-text h3">N/A</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Last Renewal Date</h5>
                <p class="card-text h3">N/A </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Next Renewal Date</h5>
                <p class="card-text h3">N/A </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Appliction id </h5>
                <p class="card-text h3">Draft</p>
            </div>
        </div>
    </div>
</div>
 
<table class="table table-border ">
    <tr class="bg-primary text-white">
        <th>id</th> 
    
        <th> Date </th> 
        <th> Action</th> 
    </tr>
    @foreach ($info as $info11 )
    <tr>
        <td> {{$info11-> id}}</td> 
        <td> {{$info11->created_at}}</td>
         <td>
            {{$info11->status}}
         </td> 

    </tr>
    @endforeach
    
</table>

@endsection