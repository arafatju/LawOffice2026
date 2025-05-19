
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
        <th> Status </th> 
        <th> Action </th>
    </tr>
     <tr>
        <td> {{$info-> id}}</td> 
        <td> {{$info->created_at}}</td>
         <td>
            {{$info->status}}
         </td> 
        <td>
            <a href="{{ route('personal11', $info->applicationid) }}" 
                class="btn btn-primary" 
                onclick="event.preventDefault(); doubleConfirm('{{ route('sendto111', $info->applicationid) }}');">
                Send
             </a>
                         
    </tr>
     
</table>

<script>
    function doubleConfirm(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to send this?Did you check all the information Properly?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, continue',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Final Confirmation',
                    text: "You can not edit after sending.  Proceed?",
                    
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, send it',
                    cancelButtonText: 'Back'
                }).then((result2) => {
                    if (result2.isConfirmed) {
                        window.location.href = url;
                    }
                });
            }
        });
    }
    </script>
    
@endsection

