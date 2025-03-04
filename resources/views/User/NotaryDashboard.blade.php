
@extends('common.notary2')
 
 
  
  
  
      
 
  
@section('content')




<h2>Dashboard Overview</h2>
<div class="row mt-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">License Status</h5>
                <p class="card-text h3">Valid</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Last Renewal Date</h5>
                <p class="card-text h3">567</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Next Renewal Date</h5>
                <p class="card-text h3">89</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Appliction Status</h5>
                <p class="card-text h3">Draft</p>
            </div>
        </div>
    </div>
</div>
<table class="table table-border ">
    <tr>
        <th>Application id</th> 
    
        <th> Application Status</th> 
        <th> Action11</th> 
    </tr>
    <tr>
        <td> Application id</td> 
        <td> Application Status</td>
        <td>
            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-primary btn-sm">View</button>
                <button class="btn btn-warning btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm">Delete</button>
            </div>  
         </td>

    </tr>
    
    
</table>

@endsection