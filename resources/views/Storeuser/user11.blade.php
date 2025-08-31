@extends('common.notary2')
 
 
  
  
  
      
 
  
@section('content')
<style> 
@media print {
    body * {
        visibility: hidden;
    }
    .print-area, .print-area * {
        visibility: visible;
    }
    .print-area {
        position: absolute;
        left: 50%;
        top: 20px;
        transform: translateX(-50%);
        margin: 2px;
        width: 90%;
        text-align: center;
    }
    .print-area table {
        margin: auto;
        border-collapse: collapse;
        width: 100%;
    }
    .print-area table th,
    .print-area table td {
        border: 1px solid black;
        padding: 4px;
    }
    /* Actions কলাম লুকাবে */
    .print-area table th:last-child,
    .print-area table td:last-child {
        display: none;
    }
}
</style>
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

    .btn-change-password {
        background: #6f42c1;
        color: white;
    }

    .btn-change-password:hover {
        background: #5a359a;
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

    /* Custom SweetAlert styles */
    .swal2-input {
        margin: 10px 0;
    }
    
    .password-input-group {
        margin: 10px 0;
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
  <button onclick="window.print()" class="btn btn-outline-success no-print">
    <i class="fas fa-print"></i> Print
</button>
<div class="print-area">
    <h2>Users Info</h2>
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
<!-- Edit User -->

<a href="{{ route('edit112', $user44->id) }}" class="btn btn-sm btn-warning me-1">
    <i class="fas fa-edit"></i> Edit
</a>

<!-- Change Password Button -->
<button type="button" class="btn btn-sm btn-secondary me-1 btn-change-password" data-id="{{ $user44->id }}" data-name="{{ $user44->name }}">
    <i class="fas fa-key"></i> Password
</button>

<!-- 
  <button type="button" class="btn btn-sm btn-warning me-1 btn-edit" 
            data-id="{{ $user44->id }}" 
            data-name="{{ $user44->name }}"
            data-email="{{ $user44->email }}"
            data-mobile="{{ $user44->mobile }}"
            data-designation="{{ optional($user44->personalInfo)->designation ?? '' }}"
            data-designation2="{{ optional($user44->personalInfo)->designation2 ?? '' }}">
        <i class="fas fa-edit"></i> Edit
    </button>
    Admin Monitor -->
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
</div> 
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editUserId" name="user_id">
                    
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <!-- Mobile Field -->
                    <div class="mb-3">
                        <label for="editMobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="editMobile" name="mobile">
                        <div class="invalid-feedback"></div>
                    </div>

                    <!-- Designation Field -->
                    <div class="mb-3">
                        <label for="editDesignation" class="form-label">Officer Staff Designation</label>
                        <input type="text" class="form-control" id="editDesignation" name="designation" placeholder="Enter staff designation">
                        <div class="invalid-feedback"></div>
                    </div>

                    <!-- Designation2 Field -->
                    <div class="mb-3">
                        <label for="editDesignation2" class="form-label">Officer Designation</label>
                        <input type="text" class="form-control" id="editDesignation2" name="designation2" placeholder="Enter officer designation">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
 <!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Edit User Modal
    document.querySelectorAll(".btn-edit").forEach(function (button) {
        button.addEventListener("click", function () {
            let userId = this.getAttribute("data-id");
            let name = this.getAttribute("data-name");
            let email = this.getAttribute("data-email");
            let mobile = this.getAttribute("data-mobile");
            let designation = this.getAttribute("data-designation");
            let designation2 = this.getAttribute("data-designation2");

            // Populate modal fields
            document.getElementById("editUserId").value = userId;
            document.getElementById("editName").value = name || '';
            document.getElementById("editEmail").value = email || '';
            document.getElementById("editMobile").value = mobile || '';
            document.getElementById("editDesignation").value = designation || '';
            document.getElementById("editDesignation2").value = designation2 || '';

            // Clear previous validation errors
            document.querySelectorAll("#editUserModal .form-control").forEach(function(field) {
                field.classList.remove("is-invalid");
                let feedback = field.nextElementSibling;
                if (feedback && feedback.classList.contains("invalid-feedback")) {
                    feedback.textContent = '';
                }
            });

            // Show modal
            new bootstrap.Modal(document.getElementById("editUserModal")).show();
        });
    });

    // Handle form submission
    document.getElementById("editUserForm").addEventListener("submit", function (e) {
        e.preventDefault();

        let userId = document.getElementById("editUserId").value;
        let submitBtn = this.querySelector('button[type="submit"]');
        let originalText = submitBtn.innerHTML;

        // Disable submit button and show loading
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';

        let formData = new FormData(this);
        let data = {
            name: formData.get('name'),
            email: formData.get('email'),
            mobile: formData.get('mobile'),
            designation: formData.get('designation'),
            designation2: formData.get('designation2')
        };

        console.log('Sending data:', data); // Debug log
        console.log('URL:', `/edit-profile/${userId}`); // Debug log

        fetch(`/edit-profile/${userId}`, {
            method: "PUT",
             headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
            body: JSON.stringify(data)
        })
        .then(response => {
            console.log('Response status:', response.status); // Debug log
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data); // Debug log
            
            if (data.success) {
                // Hide modal
                let modal = bootstrap.Modal.getInstance(document.getElementById("editUserModal"));
                if (modal) {
                    modal.hide();
                }
                
                // Show success message
                Swal.fire({
                    title: "Success!",
                    text: data.message,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    // Reload page to show changes
                    location.reload();
                });
            } else {
                // Handle validation errors
                if (data.errors) {
                    Object.keys(data.errors).forEach(function(field) {
                        let input = document.getElementById("edit" + field.charAt(0).toUpperCase() + field.slice(1));
                        if (input) {
                            input.classList.add("is-invalid");
                            let feedback = input.nextElementSibling;
                            if (feedback && feedback.classList.contains("invalid-feedback")) {
                                feedback.textContent = Array.isArray(data.errors[field]) ? data.errors[field][0] : data.errors[field];
                            }
                        }
                    });
                } else {
                    Swal.fire("Error", data.message || "Something went wrong", "error");
                }
            }
        })
        .catch(error => {
            console.error('Fetch error:', error); // Debug log
            Swal.fire("Error", "Network error: " + error.message, "error");
        })
        .finally(() => {
            // Re-enable submit button
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Change Password functionality
    document.querySelectorAll(".btn-change-password").forEach(function (button) {
        button.addEventListener("click", function () {
            let userId = this.getAttribute("data-id");
            let userName = this.getAttribute("data-name");

            // First confirmation dialog
            Swal.fire({
                title: "Change Password?",
                text: `Are you sure you want to change password for ${userName}?`,
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#6f42c1",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, change it!",
                cancelButtonText: "No, cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show password input dialog
                    showPasswordInputDialog(userId, userName);
                }
            });
        });
    });

    function showPasswordInputDialog(userId, userName) {
        Swal.fire({
            title: `Change Password for ${userName}`,
            html: `
                <div class="password-input-group">
                    <input type="password" id="newPassword" class="swal2-input" placeholder="Enter new password" minlength="6">
                </div>
                <div class="password-input-group">
                    <input type="password" id="confirmPassword" class="swal2-input" placeholder="Re-enter new password" minlength="6">
                </div>
                <div id="passwordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: "Change Password",
            cancelButtonText: "Cancel",
            confirmButtonColor: "#6f42c1",
            cancelButtonColor: "#6c757d",
            preConfirm: () => {
                const newPassword = document.getElementById('newPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                const errorDiv = document.getElementById('passwordError');

                // Reset error display
                errorDiv.style.display = 'none';
                errorDiv.textContent = '';

                // Validation
                if (!newPassword || !confirmPassword) {
                    errorDiv.textContent = 'Both password fields are required!';
                    errorDiv.style.display = 'block';
                    return false;
                }

                if (newPassword.length < 6) {
                    errorDiv.textContent = 'Password must be at least 6 characters long!';
                    errorDiv.style.display = 'block';
                    return false;
                }

                if (newPassword !== confirmPassword) {
                    errorDiv.textContent = 'Passwords do not match!';
                    errorDiv.style.display = 'block';
                    return false;
                }

                return {
                    newPassword: newPassword,
                    confirmPassword: confirmPassword
                };
            }
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                // Send password change request
                changeUserPassword(userId, result.value.newPassword, userName);
            }
        });
    }

    function changeUserPassword(userId, newPassword, userName) {
        // Show loading
        Swal.fire({
            title: 'Changing Password...',
            text: 'Please wait',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(`/users/${userId}/change-password`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ 
                password: newPassword,
                password_confirmation: newPassword
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: "Password Changed Successfully!",
                    text: `Password for ${userName} has been updated successfully.`,
                    icon: "success",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#28a745"
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: data.message || "Failed to change password. Please try again.",
                    icon: "error",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#dc3545"
                });
            }
        })
        .catch(error => {
            console.error('Password change error:', error);
            Swal.fire({
                title: "Error!",
                text: "Network error occurred. Please try again.",
                icon: "error",
                confirmButtonText: "OK",
                confirmButtonColor: "#dc3545"
            });
        });
    }
});
</script>

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