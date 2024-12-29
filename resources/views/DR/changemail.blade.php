@extends('common.test')

@section('content')
<div class="container">
    <h2>Users</h2>
    <table id="users-table" class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Userid</th>
                <th>Type</th>
                <th>Action</th>
                
            </tr>
        </thead>
    </table>
</div>

 
<script>
    $(document).ready(function () {
        // Initialize DataTable
        let table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('usermanagement') }}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'serviceid', name: 'serviceid' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection