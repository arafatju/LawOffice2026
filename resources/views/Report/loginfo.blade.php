@extends('common.notary2')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3 text-primary fw-bold">User Login Activity Logs</h3>

    <table class="table table-bordered table-striped" id="loginfo-table">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Device</th>
                <th>Browser</th>
                <th>IP</th>
                <th>Location</th>
                <th>Login Time</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Include jQuery + DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<!-- DataTables + Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- PDFMake for PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>


<script>
$(function () {
    $('#loginfo-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('loginfo.data') }}',
        columns: [
            { data: 'id', name: 'id', className: 'text-center' },
            { data: 'name', name: 'name' },
            { data: 'mobile', name: 'mobile' },
            { data: 'mail', name: 'mail' },
            { data: 'Device', name: 'Device' },
            { data: 'Browser', name: 'Browser' },
            { data: 'ip', name: 'ip' },
            { data: 'Location', name: 'Location' },
            { data: 'created_at', name: 'created_at', className: 'text-center' },
        ],
        order: [[0, 'desc']],
        pageLength: 25,
    });
    
});
</script>
@endsection
