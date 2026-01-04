@extends('common.masterall')

@section('content')

@section('title', 'Section Entry Management ')

@section('breadcrumb', 'Section Entry  Dashboard')

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
}

/* Enhanced Card Styles */
.stat-card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    height: 100%;
    background: white;
    position: relative;
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--card-color), var(--card-light));
}

.stat-card.card-orders {
    --card-color: #3b82f6;
    --card-light: #93c5fd;
}

.stat-card.card-office {
    --card-color: #10b981;
    --card-light: #6ee7b7;
}

.stat-card.card-pending {
    --card-color: #f59e0b;
    --card-light: #fcd34d;
}

.stat-card.card-login {
    --card-color: #ef4444;
    --card-light: #fca5a5;
}

.stat-card .card-body {
    padding: 25px;
    display: flex;
    align-items: center;
    gap: 20px;
}

.card-icon {
    width: 60px;
    height: 60px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: white;
    flex-shrink: 0;
}

.stat-card.card-orders .card-icon {
    background: linear-gradient(135deg, #3b82f6, #1e40af);
}

.stat-card.card-office .card-icon {
    background: linear-gradient(135deg, #10b981, #065f46);
}

.stat-card.card-pending .card-icon {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.stat-card.card-login .card-icon {
    background: linear-gradient(135deg, #ef4444, #991b1b);
}

.card-content {
    flex: 1;
}

.stat-card .card-title {
    font-size: 13px;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
    margin: 0 0 8px 0;
}

.card-value {
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
    line-height: 1;
    margin: 0;
}

.card-subtitle {
    font-size: 12px;
    color: #999;
    margin-top: 5px;
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .stat-card .card-body {
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }

    .card-value {
        font-size: 20px;
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

.btn-allotment {
    background: #28a745;
    color: white;
}

.btn-allotment:hover {
    background: #218838;
    transform: translateY(-1px);
}

.btn-update {
    background: #ffc107;
    color: #212529;
}

.btn-update:hover {
    background: #e0a800;
    transform: translateY(-1px);
}

table th {
    vertical-align: middle;
    text-align: center;
}

table td {
    vertical-align: middle;
    text-align: center;
}
</style>

<h2>Dashboard</h2>
<div class="row mt-4 g-4">
  <div class="col-md-6 col-lg-3">
        <div class="card stat-card card-orders">
            <div class="card-body">
                <div class="card-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Product Highest Order</h5>
                    <p class="card-value">{{ $highest->total_delivered ?? 0 }}</p>
                    <p class="card-subtitle">{{ $product111->name ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card stat-card card-office">
            <div class="card-body">
                <div class="card-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Office Highest Order</h5>
                    <p class="card-value">{{ $highestOffice->total_delivered ?? 0 }}</p>
                    <p class="card-subtitle">{{ $highestOffice->office ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card stat-card card-pending">
            <div class="card-body">
                <div class="card-icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Pending Applications</h5>
                    <p class="card-value">{{ $pendingCount }}</p>
                    <p class="card-subtitle">Awaiting approval</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card stat-card card-login">
            <div class="card-body">
                <div class="card-icon">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Last Login</h5>
                    <p class="card-value">{{ \Carbon\Carbon::parse($lastUserLog)->format('d M Y') }}</p>
                    <p class="card-subtitle">{{ \Carbon\Carbon::parse($lastUserLog)->format('h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Box -->
<div class="d-flex justify-content-between align-items-center m-2 mt-5">
    <!-- Left: Download PDF -->
    <a href="{{ route('productapproved') }}" 
       target="_blank" 
       class="btn btn-primary">
        <i class="fas fa-download"></i> Download PDF
    </a>

    <!-- Right: Search box -->
    <input type="text" id="productSearch" class="form-control w-25" placeholder="🔍 Search products...">
    
     
</div>

<!-- Products Table -->
<div class="print-area">
    <h2>Product Info</h2>
    <table class="table table-bordered table-striped align-middle" id="productTable">
        <thead class="bg-primary text-white">
            <tr>
                <th>Serial</th>
                <th>Name</th>
                <th>Code</th>
                <th>Quantity</th>
                <th>Category</th>
                <th style="min-width: 320px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->prcode }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->category }}</td>
                <td>
                    <!-- Update Product Quantity -->
                    <button 
                        class="action-btn btn-allotment btn-update-quantity" 
                        data-prcode="{{ $product->prcode }}" 
                        data-quantity="{{ $product->quantity }}"
                        data-bs-toggle="modal" 
                        data-bs-target="#updateQuantityModal"
                        title="Update Quantity"
                    >
                        <i class="fas fa-edit"></i> Update Quantity
                    </button>

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

                    <!-- Update Allotment -->
                    <button 
                        class="action-btn btn-allotment btn-update-allotment" 
                        data-prcode="{{ $product->prcode }}" 
                        data-bs-toggle="modal" 
                        data-bs-target="#updateAllotmentModal"
                        title="Update Allotment"
                    >
                        <i class="fas fa-edit"></i> Update Allotment
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Update Quantity Modal -->
<div class="modal fade" id="updateQuantityModal" tabindex="-1" aria-labelledby="updateQuantityModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="updateQuantityForm" method="POST" action="">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateQuantityModalLabel">Update Product Quantity</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="prcode" id="modalPrcode" value="">
          <div class="mb-3">
            <label for="quantityInput" class="form-label">পরিমাণ</label>
            <input type="number" class="form-control" id="quantityInput" name="quantity" min="0" required>
          </div>
          <div class="mb-3">
            <label for="purchaseTypeInput" class="form-label">ক্রয়ের ধরন</label>
            <input type="text" class="form-control" id="purchaseTypeInput" name="purchase_type" required>
          </div>
          <div class="mb-3">
            <label for="purchaseDateInput" class="form-label">ক্রয়ের তারিখ</label>
            <input type="date" class="form-control" id="purchaseDateInput" name="purchase_date" required>    
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Quantity</button>
        </div>
      </div>
    </form>
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
          <tbody>
            <!-- Allotment rows will be injected here -->
          </tbody>
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

<!-- Update Allotment Modal -->
<div class="modal fade" id="updateAllotmentModal" tabindex="-1" aria-labelledby="updateAllotmentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="updateAllotmentForm" method="POST" action="">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateAllotmentModalLabel">Update Allotments for Product <span id="updateAllotmentPrCode"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="prcode" id="updateAllotmentHiddenPrcode" value="">

          <table class="table table-bordered table-striped" id="updateAllotmentTable">
            <thead>
              <tr>
                <th>Designation</th>
                <th>Quantity</th>
              </tr>
            </thead>
            <tbody>
              <!-- Dynamic allotment rows will be inserted here -->
            </tbody>
          </table>

          <div id="updateAllotmentNoData" class="text-center text-muted" style="display:none;">
            No allotments found for this product.
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Changes</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const updateAllotmentButtons = document.querySelectorAll('.btn-update-allotment');
    const modalPrCodeSpan = document.getElementById('updateAllotmentPrCode');
    const hiddenPrcodeInput = document.getElementById('updateAllotmentHiddenPrcode');
    const allotmentTableBody = document.querySelector('#updateAllotmentTable tbody');
    const noDataDiv = document.getElementById('updateAllotmentNoData');
    const form = document.getElementById('updateAllotmentForm');

    updateAllotmentButtons.forEach(button => {
        button.addEventListener('click', function () {
            const prcode = this.getAttribute('data-prcode');
            modalPrCodeSpan.textContent = prcode;
            hiddenPrcodeInput.value = prcode;
            allotmentTableBody.innerHTML = '';
            noDataDiv.style.display = 'none';

            form.action = `/allotments/${prcode}`;

            fetch(`/allotments/${prcode}`)
                .then(res => res.json())
                .then(data => {
                    if (data.length === 0) {
                        noDataDiv.style.display = 'block';
                        return;
                    }
                    data.forEach(item => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${item.designation}</td>
                            <td>
                              <input type="number" 
                                     name="quantities[${item.designation}]" 
                                     value="${item.quantity}" 
                                     min="0" 
                                     class="form-control" 
                                     required>
                            </td>
                        `;
                        allotmentTableBody.appendChild(tr);
                    });
                })
                .catch(() => {
                    noDataDiv.textContent = 'Failed to load allotments.';
                    noDataDiv.style.display = 'block';
                });
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const updateButtons = document.querySelectorAll('.btn-update-quantity');
    const quantityInput = document.getElementById('quantityInput');
    const modalPrcode = document.getElementById('modalPrcode');
    const purchaseTypeInput = document.getElementById('purchaseTypeInput');
    const purchaseDateInput = document.getElementById('purchaseDateInput');
    const form = document.getElementById('updateQuantityForm');

    updateButtons.forEach(button => {
        button.addEventListener('click', function () {
            const prcode = this.getAttribute('data-prcode');
            const quantity = this.getAttribute('data-quantity');

            modalPrcode.value = prcode;
            quantityInput.value = quantity;
            purchaseTypeInput.value = '';
            purchaseDateInput.value = '';
            form.action = `/products/${prcode}/quantity`;
        });
    });

    form.addEventListener('submit', function(e) {
        const quantity = quantityInput.value;
        const purchaseType = purchaseTypeInput.value;
        const purchaseDate = purchaseDateInput.value;
        
        if (!quantity || !purchaseType || !purchaseDate) {
            e.preventDefault();
            alert('All fields are required!');
            return false;
        }
    });

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

<script>
document.addEventListener('DOMContentLoaded', function () {
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
                .catch(() => {
                    noDataMsg.textContent = 'Failed to load allotments.';
                    noDataMsg.style.display = 'block';
                });
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('productSearch');
    const table = document.getElementById('productTable');
    const rows = table.getElementsByTagName('tr');

    searchInput.addEventListener('keyup', function () {
        const filter = searchInput.value.toLowerCase();
        
        for (let i = 1; i < rows.length; i++) {
            let rowText = rows[i].innerText.toLowerCase();
            rows[i].style.display = rowText.includes(filter) ? '' : 'none';
        }
    });
});
</script>

@endsection