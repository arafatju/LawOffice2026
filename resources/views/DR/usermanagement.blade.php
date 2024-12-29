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
    let url = $(this).data('url');  // Get the route URL from the data-url attribute

    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            url: url, // Use the URL from data-url
            type: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function (response) {
                alert(response.success);
                table.ajax.reload(); // Reload DataTable
            },
            error: function (xhr, status, error) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    }
});


$('#users-table').on('click', '.view-pdf', function () {
    let userId = $(this).data('id');
    let url = '/userpdf111/' + userId;

    // Redirect to the PDF generation URL to view/download the PDF
    window.open(url, '_blank');
});

        // Handle change password action
        $('#users-table').on('click', '.change-password', function () {
            let userId = $(this).data('id');
            let url = $(this).data('url'); 
            let newPassword = prompt('Enter new password:');
            if (newPassword) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        password: newPassword
                    },
                    success: function (response) {
                        alert(response.success);
                    },
                    error: function (xhr, status, error) {
                alert('An error occurred: ' + xhr.responseText);
            }
                });
            }
        });
         
        // Handle change email action
        $('#users-table').on('click', '.change-email', function () {
            let userId = $(this).data('id');
            let url = $(this).data('url'); 
            let newEmail = prompt('Enter new email:');
            if (newEmail) {
                $.ajax({
                    url: url,
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
@endsection

