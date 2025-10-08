@extends('common.notary2')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-success">
            <i class="bi bi-box-seam me-2"></i>Lot Information
        </h3>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table id="lots-table" class="table table-striped table-bordered align-middle w-100">
                <thead class="table-success text-center">
                    <tr>
                        <th>ID</th>
                        <th>Lot Number</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Purchase Date</th>
                        <th>Purchase Type</th>
                        <th>Created</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- DataTable Scripts -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#lots-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('lots.data') }}',
        responsive: true,
        language: {
            processing: '<div class="spinner-border text-success" role="status"><span class="visually-hidden">Loading...</span></div>'
        },
        columns: [
            { data: 'id', name: 'id', className: 'text-center' },
            { data: 'lotnumber', name: 'lotnumber', className: 'fw-bold text-center' },
            { data: 'product_name', name: 'product.name' },
            { data: 'quantity', name: 'quantity', className: 'text-center' },
            { data: 'purchaseddate', name: 'purchaseddate', className: 'text-center' },
            { data: 'purchasedtype', name: 'purchasedtype', className: 'text-center' },
            { data: 'created_at', name: 'created_at', className: 'text-center' },
        ],
        order: [[0, 'desc']]
    });
});
</script>
@endsection
