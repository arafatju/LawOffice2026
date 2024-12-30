@extends('common.test')

@section('content')
<div class="container mt-2">
    <h2>Email,Password,User changing history</h2>
     
    <table id="users-table" class="table table-bordered">
        <thead>
            <tr>
                <th>Mobile</th>
                <th>Email</th>
                <th>Time</th>
                <th>Device</th>
                
                <th>Browser</th>
                <th>IP </th>
                
                <th>Location</th>
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
            ajax: '{{ route('log112') }}',
            columns: [
                { data: 'mobile', name: 'mobile' },
                { data: 'mail', name: 'mail' },
                { data: 'time', name: 'time' },
                { data: 'Device', name: 'Device' },
                { data: 'Browser', name: 'Browser' },
                { data: 'ip', name: 'ip' },
                { data: 'Location', name: 'Location' },
             ]
        });

        
    });
</script>
@endsection
