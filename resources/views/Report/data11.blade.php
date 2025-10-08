@extends('common.notary2')

@section('content')
<div class="container py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">
            <i class="bi bi-currency-exchange me-2"></i>Transaction List
        </h3>
    </div>

    <!-- DataTable Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table id="transactions-table" class="table table-striped table-bordered align-middle w-100">
                <thead class="table-primary text-center">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Product</th>
                        <th>Status</th>
                        <th>Quantity</th>
                        <th>Lot Number</th>
                        <th>Month</th>
                        <th>Year</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- CDN Scripts -->
<link rel="stylesheet" 
      href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" 
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTable Script -->
<script>
$(document).ready(function() {
    $('#transactions-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('transactions.data') }}',
        responsive: true,
        language: {
            processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
        },
        columns: [
            { data: 'id', name: 'id', className: 'text-center' },
            { data: 'user_name', name: 'user.name' },
            { data: 'product_name', name: 'product.name' },
            { 
                data: 'status', 
                name: 'status',
                render: function(data) {
                    let badgeClass = data === 'approved' ? 'success' :
                                     data === 'pending' ? 'warning' : 'secondary';
                    return `<span class="badge bg-${badgeClass} text-uppercase">${data}</span>`;
                },
                className: 'text-center'
            },
            { data: 'number', name: 'number', className: 'text-center' },
            { data: 'lotnumber', name: 'lotnumber', className: 'text-center' },
            { data: 'month', name: 'month', className: 'text-center' },
            { data: 'year', name: 'year', className: 'text-center' },
        ],
        order: [[0, 'desc']]
    });
});
</script>
@endsection
