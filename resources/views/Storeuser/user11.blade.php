
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
  <a href="{{ route('accepted11') }}" class="btn btn-primary mb-1">Accepted User</a>
 <a href="{{ route('admin11') }}" class="btn btn-primary mb-1">Admin User</a>

<table class="table table-border ">
    <tr class="bg-primary text-white">
        <th>Serial</th> 
    
        <th> Name </th> 
        <th>Email   </th> 
        <th> Mobile   </th> 
         <th> Device  </th> 
          <th> Location  </th> 

          
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
<td class="text-center">

    <!-- Delete Product -->
   <!-- Delete Button -->
<button type="button" class="btn btn-sm btn-danger me-1 btn-delete" data-id="{{ $user44->id }}">
    <i class="fas fa-trash"></i> Delete
</button>


    <!-- Admin Monitor -->
    <button 
    type="button" 
    class="btn btn-sm btn-info me-1 btn-change-role" 
    data-id="{{ $user44->id }}" 
    data-role="userdr" 
    title="Change to Admin Monitor"
>
    <i class="fas fa-desktop"></i> Monitor
</button>


    <!-- Admin Approver -->
        
        <button 
    type="button" 
    class="btn btn-sm btn-info me-1 btn-change-role" 
    data-id="{{ $user44->id }}" 
    data-role="usersr" 
    title="Change to Admin Approver"
>
       
       
        <i class="fas fa-check"></i> Approve
    </button>

    <!-- Data Entry -->
     <button 
    type="button" 
    class="btn btn-sm btn-info me-1 btn-change-role" 
    data-id="{{ $user44->id }}" 
    data-role="userdd" 
    title="Change to Data Entry"
>
        <i class="fas fa-keyboard"></i> Data Entry
    </button>

</td>

     </tr> 
      @endforeach
</table>
 <!-- Include SweetAlert2 -->
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-change-role").forEach(function (button) {
        button.addEventListener("click", function () {
            let userId = this.getAttribute("data-id");
            let newRole = this.getAttribute("data-role");

            Swal.fire({
                title: "Are you sure?",
                text: `Change this user's role to "${newRole}"?`,
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, change it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/users/${userId}/role`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ role: newRole })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire("Updated!", data.message, "success");
                        } else {
                            Swal.fire("Error", data.message, "error");
                        }
                    })
                    .catch(() => {
                        Swal.fire("Error", "Something went wrong", "error");
                    });
                }
            });
        });
    });
});
</script>

@endsection

