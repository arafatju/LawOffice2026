@extends('common.test')

@section('content')
<div class="container mt-2">
    <h2>Email,Password,User changing history</h2>
     
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
            ajax: '{{ route('emaildash1') }}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'userid', name: 'userid' },
                { data: 'type', name: 'type' },
                { data: 'action', name: 'action' },
             ]
        });

        
    });
</script>
@endsection
