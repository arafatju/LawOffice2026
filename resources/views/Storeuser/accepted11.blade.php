
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
</td><td> 
<button type="button" class="btn btn-sm btn-danger me-1 btn-delete" data-id="{{ $user44->id }}">
    <i class="fas fa-trash"></i> Delete
</button>
                    <button 
    type="button" 
    class="btn btn-sm btn-warning" 
    data-bs-toggle="modal" 
    data-bs-target="#passwordChangeModal"
    data-userid="{{ $user44->id }}"
>
    <i class="fas fa-key"></i> Password Change
</button>
                    <button type="button" class="action-btn btn-edit btn-delete-confirm" title="Delete Product">
                        <i class="fas fa-trash"></i> Pending
                    </button>
</td>
     </tr> 
      @endforeach
</table>
<div class="modal fade" id="passwordChangeModal" tabindex="-1" aria-labelledby="passwordChangeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="passwordChangeForm" method="POST" action="{{ route('users.password.update') }}">
      @csrf
      <input type="hidden" name="user_id" id="modalUserId" value="">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="passwordChangeModalLabel">Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="password" required minlength="6">
          </div>

          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="6">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Password</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
  var passwordModal = document.getElementById('passwordChangeModal');
  passwordModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var userId = button.getAttribute('data-userid');
    document.getElementById('modalUserId').value = userId;
  });
});
</script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-delete").forEach(function (button) {
        button.addEventListener("click", function () {
            let userId = this.getAttribute("data-id");

            Swal.fire({
                title: "Are you sure?",
                text: "This action will permanently delete the user!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Example: Send delete request via form submit
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/users/${userId}`;
                    
                    let csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = "{{ csrf_token() }}";
                    form.appendChild(csrf);

                    let method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
});
</script>
@endsection

