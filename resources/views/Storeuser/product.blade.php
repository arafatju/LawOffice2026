@extends('common.notary2')

@section('content')
<style>
@media print {
    body * {
        visibility: hidden;
    }
    .print-area, .print-area * {
        visibility: visible;
    }
    .print-area {
        position: absolute;
        left: 50%;
        top: 20px;
        transform: translateX(-50%);
        margin: 2px;
        width: 90%;
        text-align: center;
    }
    .print-area table {
        margin: auto;
        border-collapse: collapse;
        width: 100%;
    }
    .print-area table th,
    .print-area table td {
        border: 1px solid black;
        padding: 4px;
    }
    .print-area table th:last-child,
    .print-area table td:last-child {
        display: none;
    }
    .no-print {
        display: none !important;
    }
}

.action-btn {
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    margin: 2px 5px 2px 0;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-delete {
    background: #dc3545;
    color: white;
}

.btn-delete:hover {
    background: #c82333;
    transform: translateY(-1px);
}

.btn-view {
    background: #17a2b8;
    color: white;
}

.btn-view:hover {
    background: #138496;
    transform: translateY(-1px);
}

table th, table td {
    vertical-align: middle;
    text-align: center;
}
</style>

<h2 class="mb-4">Dashboard</h2>

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row mb-4">
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title fw-bold text-info">Total Products</h5>
                <p class="card-text fs-5">{{ count($products) }}</p>
                <small class="text-muted">Total number of products available</small>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title fw-bold text-success">Highest Order</h5>
                <p class="card-text fs-5">77</p>
                <small class="text-muted">Office highest product orders</small>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title fw-bold text-primary">Pending Applications</h5>
                <p class="card-text fs-5">5</p>
                <small class="text-muted">Applications currently awaiting</small>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title fw-bold text-danger">Out of Stock</h5>
                <p class="card-text fs-6 mb-1">Name 6</p>
                <p class="card-text fs-6 mb-1">Name 6</p>
                <small class="text-muted">Products going out of stock soon.</small>
            </div>
        </div>
    </div>
</div>

<!-- Buttons -->
<button type="button" class="btn btn-primary mb-4 no-print" data-bs-toggle="modal" data-bs-target="#productModal">
    + New Product
</button>
<button onclick="window.print()" class="btn btn-outline-success print-btn no-print mb-4" title="Direct Print">
    <i class="fas fa-print"></i> Print
</button>

<!-- Products Table -->
<div class="print-area">
    <h2>Product Info</h2>
    <table class="table table-bordered table-striped align-middle">
        <thead class="bg-primary text-white">
            <tr>
                <th>Serial</th>
                <th>Name</th>
                <th>Code</th>
                <th>Quantity</th>
                <th>Category</th>
                <th class="no-print" style="min-width: 200px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->prcode }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->category }}</td>
                <td class="no-print">
                    <!-- View Allotment -->
                    <button 
                        class="action-btn btn-view btn-view-allotment" 
                        data-prcode="{{ $product->prcode }}" 
                        data-bs-toggle="modal" 
                        data-bs-target="#viewAllotmentModal"
                        title="View Allotment"
                    >
                        <i class="fas fa-eye"></i> View Allotment
                    </button>

                    <!-- Delete Product -->
                    <form action="{{ route('delete.bytype', ['type' => 'product', 'prcode' => $product->prcode]) }}" method="POST" class="delete-form d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="action-btn btn-delete btn-delete-confirm" title="Delete Product">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">No products found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- New Product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('product312') }}" id="newProductForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="prcode" class="form-label">Code</label>
                        <input type="text" class="form-control" name="prcode" id="prcode" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" name="category" id="category">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Product</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Allotment Modal -->
<div class="modal fade" id="viewAllotmentModal" tabindex="-1" aria-labelledby="viewAllotmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewAllotmentModalLabel">Allotments for Product <span id="modalPrCodeTitle"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped" id="allotmentTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Designation</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div id="noAllotmentMessage" class="text-center text-muted" style="display:none;">
                    No allotments found for this product.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // CRITICAL: Close modal before form submission
    const newProductForm = document.getElementById('newProductForm');
    const productModal = document.getElementById('productModal');
    const productModalInstance = bootstrap.Modal.getOrCreateInstance(productModal);

    newProductForm.addEventListener('submit', function(e) {
        // Close modal immediately
        productModalInstance.hide();
        
        // Clean up backdrop
        setTimeout(function() {
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        }, 100);
    });

    // Reset form when modal closes
    productModal.addEventListener('hidden.bs.modal', function () {
        newProductForm.reset();
    });

    // View Allotment Modal
    const viewButtons = document.querySelectorAll('.btn-view-allotment');
    const modalTitle = document.getElementById('modalPrCodeTitle');
    const tbody = document.querySelector('#allotmentTable tbody');
    const noDataMsg = document.getElementById('noAllotmentMessage');

    viewButtons.forEach(button => {
        button.addEventListener('click', function () {
            const prcode = this.getAttribute('data-prcode');
            modalTitle.textContent = prcode;
            tbody.innerHTML = '';
            noDataMsg.style.display = 'none';

            fetch(`/allotments/${prcode}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        noDataMsg.style.display = 'block';
                        return;
                    }
                    data.forEach((item, index) => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${item.designation}</td>
                            <td>${item.quantity}</td>
                        `;
                        tbody.appendChild(tr);
                    });
                })
                .catch((error) => {
                    console.error('Error:', error);
                    noDataMsg.textContent = 'Failed to load allotments.';
                    noDataMsg.style.display = 'block';
                });
        });
    });

    // Delete Confirmation
    const deleteButtons = document.querySelectorAll('.btn-delete-confirm');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const form = this.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

@endsection