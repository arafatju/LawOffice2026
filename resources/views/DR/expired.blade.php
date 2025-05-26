@extends('common.admin')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4 mb-4">Dashboard Overview</h2>
    
    <!-- Stats Cards Row -->
    <div class="row">
         

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Valid</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{$validCount}}</div>
                        </div>
                        <div class="col-auto">
                            <span class="fa fa-globe fa-2x text-gray-300"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Expired</div>
                            <div class="h3 mb-0 font-weight-bold text-purple-800">{{$expiredCount}}</div>
                        </div>
                        <div class="col-auto">
                            <span class="fa fa-calendar-times fa-2x text-gray-300"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Applications Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Applications</h6>
            <div class="col-md-4 ml-auto">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control bg-light border-0 small" placeholder="Search applications...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <span class="fa fa-search"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                            <table class="table table-bordered yajra-datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>App ID</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jQuery and DataTables JS/CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
$(function () {
    $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url()->current() }}",
        columns: [
            { data: 'applicationid', name: 'applicationid' },
            { data: 'name', name: 'personalinfo.name' },
            { data: 'mobile', name: 'personalinfo.mobile' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>

<script>
function renewPrompt(applicationId) {
    Swal.fire({
        title: 'Renew Application',
        html:
            '<label>Previous Date:</label><input type="date" id="previousDate" class="swal2-input">' +
            '<label>Next Date:</label><input type="date" id="nextDate" class="swal2-input">',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Renew',
        preConfirm: () => {
            const previous = document.getElementById('previousDate').value;
            const next = document.getElementById('nextDate').value;

            if (!previous || !next) {
                Swal.showValidationMessage('Both dates are required');
                return false;
            }

            const url = `/renew/${applicationId}/${previous}/${next}`;
            window.location.href = url;
        }
    });
}
</script>

<script>
    function doubleConfirm(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to approve this application? Did you check all the information properly?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, continue',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Final Confirmation',
                    text: "You cannot revert this action after approval. Proceed?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, approve it',
                    cancelButtonText: 'Back',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33'
                }).then((result2) => {
                    if (result2.isConfirmed) {
                        window.location.href = url;
                    }
                });
            }
        });
    }
    
    function deleteConfirm(url) {
        Swal.fire({
            title: 'Delete Application',
            text: "Are you sure you want to delete this application? This action cannot be undone.",
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
    </script>

<script>
$(document).ready(function() {
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#applicationTableBody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>

<!-- Make sure Font Awesome is included -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Add custom CSS for left border on cards -->
<style>
.border-left-primary {
    border-left: 4px solid #4e73df;
}
.border-left-success {
    border-left: 4px solid #1cc88a;
}
.border-left-info {
    border-left: 4px solid #36b9cc;
}
.border-left-warning {
    border-left: 4px solid #f6c23e;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #e3e6f0;
    border-radius: 0.35rem;
}
.shadow {
    box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15)!important;
}
</style>
@endsection
