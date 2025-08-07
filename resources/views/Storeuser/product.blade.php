
@extends('common.notary2')
 
  <style>
        .action-btn {
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            margin: 2px;
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
    </style>
  
  
  
      
 
  
@section('content')




<h2>Dashboard  </h2>
<div class="row mt-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-info">Total Product    </h5>
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
<!-- Button to open modal -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#productModal">
    + New Product
</button>
 
<table class="table table-border ">
    <tr class="bg-primary text-white">
         <th>Serial</th> 
        <th> Name
             </th> 
    
        <th>  Code  </th> 
        <th> Quantity </th> 
         
        <th>Actions </th>
    </tr>
    
    <tr> 
     <td> aaaaa jjjjj kkkkkkkk 
     </td> 
     <td> aaaaa 77777
     </td> 
     <td> aaaaa 
     </td> 
     <td> aaaaa 
     </td> <td>  
        <button class="action-btn btn-delete">
                            <i class="fas fa-trash"></i> Delete Product 
                        </button>
                        <button class="action-btn btn-view">
                            <i class="fas fa-eye"></i> View Allotment
                        </button>
                        <button class="action-btn btn-allotment">
                            <i class="fas fa-edit"></i>Update  Allotment
                        </button>
                       
     </td>  
     </tr>
     
</table>
 <!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('product.store') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <div class="mb-3">
            <label for="prcode" class="form-label">Code</label>
            <input type="text" class="form-control" name="prcode" required>
          </div>

          <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>

          <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" name="quantity" required>
          </div>

          <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" name="category">
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

