
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
<div class="d-flex justify-content-end mb-1"><a href="{{route('new11')}}">
    <button class="btn btn-primary"> <i class="bi bi-plus-lg"></i> New Application</button>
</a> 
</div>
<table class="table table-border ">
    <tr>
        <th>Application id</th> 
    
        <th> Application Status</th> 
        <th> Action</th> 
    </tr>
    @foreach ($info as $info11 )
    <tr>
        <td> {{$info11->applicationid}}</td> 
        <td> {{$info11->status}}</td>
        <td>
            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-primary btn-sm">View</button>
                <a href="{{ route('edituser', ['id' => $info11->applicationid]) }}">
                <button class="btn btn-warning btn-sm">Edit</button>
                </a> 
                <button class="btn btn-danger btn-sm">Delete</button>
            </div>  
         </td>

    </tr>
    @endforeach
    
</table>

@endsection