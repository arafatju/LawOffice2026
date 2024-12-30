@extends('common.test')

@section('content')
<div class="container mt-2">
    <h2>Office and Designation</h2>
    <div class="d-flex justify-content-end">
        <button class="btn btn-sm btn-primary add-user"> Add Office </button>  
    </div>
    <table id="users-table" class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Add Office Modal -->
<div class="modal fade" id="addOfficeModal" tabindex="-1" aria-labelledby="addOfficeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOfficeModalLabel">Add Office</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addOfficeForm">
                    <div class="mb-3">
                        <label for="name11" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"placeholder="Enter Name">
                    </div>
                    <div class="mb-3">
                        <label for="status11" class="form-label">Type</label>
                        <select class="form-control" id="status" name="status">
                                <option>designation </option> 
                                <option>office </option> 
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save-office">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        let table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('office2') }}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Show the modal when "Add Office" button is clicked
        $('.add-user').click(function () {
            $('#addOfficeModal').modal('show');
        });

        // Save Office - AJAX request
        $('.save-office').click(function () {
            let name = $('#name').val();
            let status = $('#status').val();

            if (!name || !status) {
                alert('Please fill in all fields.');
                return;
            }

            $.ajax({
                url: '{{ route('office3') }}', // Define this route in your Laravel backend
                type: 'POST',
                data: {
                    name: name,
                    status: status,
                    _token: '{{ csrf_token() }}' // CSRF token
                },
                success: function (response) {
                    alert('Office added successfully!');
                    $('#addOfficeModal').modal('hide'); // Hide the modal
                    $('#addOfficeForm')[0].reset(); // Reset the form
                    table.ajax.reload(); // Reload DataTable
                },
                error: function (xhr, status, error) {
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        });

        // Handle delete action
        $('#users-table').on('click', '.delete-user', function () {
            let userId = $(this).data('id');
            let url = $(this).data('url'); // Get the route URL from the data-url attribute

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
    });
</script>
@endsection
