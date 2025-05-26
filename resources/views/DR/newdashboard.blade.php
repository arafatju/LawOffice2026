@extends('common.admin')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4 mb-4">Dashboard Overview</h2>

    <!-- Stats Cards Row -->
    <div class="row">
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Processing</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{$processing}}</div>
                        </div>
                        <div class="col-auto">
                            <span class="fa fa-clipboard-list fa-2x text-gray-300"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Approved</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{$approved}}</div>
                        </div>
                        <div class="col-auto">
                            <span class="fa fa-check-circle fa-2x text-gray-300"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Valid </div>
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

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="applications-table" width="100%" cellspacing="0">
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

<!-- SweetAlert and Font Awesome -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- DataTables Script -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
    $('#applications-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url()->current() }}",
        columns: [
            { data: 'applicationid', name: 'applicationid' },
            { data: 'name', name: 'personalinfo.name' },
            { data: 'mobile', name: 'personalinfo.mobile' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
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
        box-shadow: 0 .15rem 1.75rem 0 rgba(58, 59, 69, .15) !important;
    }
</style>
@endsection