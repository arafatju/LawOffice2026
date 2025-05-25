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
                                Mobile Log in </div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">  </div>
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
                                Desktop Log in </div>
                            <div class="h3 mb-0 font-weight-bold text-purple-800">  </div>
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
            <!-- Add this above the table -->
<div class="mb-3 col  d-flex justify-content-center">
    <input type="text" id="searchMobile" class="form-control m-1" placeholder="Search by Mobile">
    <input type="text" id="searchName" class="form-control m-1" placeholder="Search by Name">

</div>

            <div class="table-responsive">
                <table class="table table-bordered" id="loginfoTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>IP</th>
            <th>Location</th>
            <th>Device</th>
            <th>Browser</th>
            <th>Created At</th>
        </tr>
    </thead>
</table>


                 
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
<!-- DataTables + Buttons CDN -->
<!-- jQuery + DataTables + Buttons -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script>
 $(document).ready(function() {
    var table = $('#loginfoTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: '{{ route("loginfo.data") }}',
            data: function(d) {
                d.mobile = $('#searchMobile').val(); // Pass mobile value to controller
                d.name = $('#searchName').val();
            }
        },
        columns: [
            { data: 'name', name: 'name' },
            { data: 'mail', name: 'mail' },
            { data: 'mobile', name: 'mobile' },
            { data: 'ip', name: 'ip' },
            { data: 'Location', name: 'Location' },
            { data: 'Device', name: 'Device' },
            { data: 'Browser', name: 'Browser' },
            { data: 'created_at', name: 'created_at' }
        ],
        dom: 'Bfrtip',
        buttons: [
            {
               extend: 'pdfHtml5',
               text: '<i class="fas fa-file-pdf"></i> Export All to PDF',
               titleAttr: 'Export all data to PDF',
               className: 'btn btn-danger btn-sm',
               exportOptions: {
                   modifier: {
                       page: 'all'
                   }
               }
            },
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> Export Excel',
                titleAttr: 'Export to Excel',
                className: 'btn btn-success btn-sm'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Print',
                titleAttr: 'Print Table',
                className: 'btn btn-secondary btn-sm'
            }
        ]
    });

    // ✅ Now this works because `table` is defined
    $('#searchMobile,#searchName').on('keyup', function() {
        table.draw();
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
