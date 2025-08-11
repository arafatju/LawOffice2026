
@extends('common.notary2')
 
 
  
  
  
      
 
  
@section('content')


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
 

<table class="table table-border ">
    <tr class="bg-primary text-white">
        <th>Serial</th> 
    
        <th> Name </th> 
        <th>Email   </th> 
        <th> Mobile   </th> 
         <th> Device  </th> 
          <th> Location  </th> 

          <th>Type </th> 
        <th> Action </th>
    </tr>
    @foreach ($users  as $user44 )
        
   
    <tr>
<td>  {{ $loop->iteration }}
</td>
<td> {{$user44->name}} 
</td>
<td> {{$user44->email }} 
</td>
<td> {{$user44->mobile}} 
</td>
<td> {{$user44->device}} 
</td>
<td> {{$user44->location}} 
</td>
<td> <button type="button" class="action-btn btn-update btn-delete-confirm" title="Delete Product">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                    <button type="button" class="action-btn btn-edit btn-delete-confirm" title="Delete Product">
                        <i class="fas fa-trash"></i> Password Change
                    </button>
                    <button type="button" class="action-btn btn-edit btn-delete-confirm" title="Delete Product">
                        <i class="fas fa-trash"></i> Pending
                    </button>
</td>
     </tr> 
      @endforeach
</table>
 
@endsection

