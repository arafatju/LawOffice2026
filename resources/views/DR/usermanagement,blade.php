@extends('common.test')

@section('content')
<div class="container">
    <h2>Users</h2>
    <table id="users-table" class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Service ID</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
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

        // Handle delete action
        $('#users-table').on('click', '.delete-user', function () {
            let userId = $(this).data('id');
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '/users/' + userId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        alert(response.success);
                        table.ajax.reload(); // Reload DataTable
                    }
                });
            }
        });

        // Handle change password action
        $('#users-table').on('click', '.change-password', function () {
            let userId = $(this).data('id');
            let newPassword = prompt('Enter new password:');
            if (newPassword) {
                $.ajax({
                    url: '/users/' + userId + '/change-password',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        password: newPassword
                    },
                    success: function (response) {
                        alert(response.success);
                    }
                });
            }
        });

        // Handle change email action
        $('#users-table').on('click', '.change-email', function () {
            let userId = $(this).data('id');
            let newEmail = prompt('Enter new email:');
            if (newEmail) {
                $.ajax({
                    url: '/users/' + userId + '/change-email',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: newEmail
                    },
                    success: function (response) {
                        alert(response.success);
                    }
                });
            }
        });
    });
</script>
@endpush
