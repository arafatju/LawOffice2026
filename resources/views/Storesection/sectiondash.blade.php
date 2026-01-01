 @extends('common.master2')

@section('content')

@section('title', 'Section Admin Management ')

@section('breadcrumb', 'Section Admin Dashboard')

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

/* Dashboard Cards Styling */
.dashboard-section {
    margin-bottom: 50px;
}

.dashboard-header {
    margin-bottom: 35px;
}

.dashboard-header h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
}

.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    border: none;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--card-color), transparent);
    transition: left 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
}

.stat-card:hover::before {
    left: 100%;
}

.stat-card.card-1 {
    --card-color: #667eea;
}

.stat-card.card-2 {
    --card-color: #28a745;
}

.stat-card.card-3 {
    --card-color: #17a2b8;
}

.stat-card.card-4 {
    --card-color: #dc3545;
}

.card-icon {
    width: 70px;
    height: 70px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin-bottom: 20px;
    background: var(--icon-bg);
    color: var(--icon-color);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.stat-card.card-1 .card-icon {
    --icon-bg: rgba(102, 126, 234, 0.15);
    --icon-color: #667eea;
}

.stat-card.card-2 .card-icon {
    --icon-bg: rgba(40, 167, 69, 0.15);
    --icon-color: #28a745;
}

.stat-card.card-3 .card-icon {
    --icon-bg: rgba(23, 162, 184, 0.15);
    --icon-color: #17a2b8;
}

.stat-card.card-4 .card-icon {
    --icon-bg: rgba(220, 53, 69, 0.15);
    --icon-color: #dc3545;
}

.card-title {
    font-size: 0.9rem;
    color: #999;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
}

.card-value {
    font-size: 2.2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
    line-height: 1.2;
    word-break: break-word;
}

.card-subtitle {
    font-size: 0.85rem;
    color: #999;
    margin: 0;
}

.card-footer {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #f0f0f0;
    font-size: 0.75rem;
    color: #ccc;
}

.stat-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-top: 10px;
}

.stat-card.card-1 .stat-badge {
    background: rgba(102, 126, 234, 0.2);
    color: #667eea;
}

.stat-card.card-2 .stat-badge {
    background: rgba(40, 167, 69, 0.2);
    color: #28a745;
}

.stat-card.card-3 .stat-badge {
    background: rgba(23, 162, 184, 0.2);
    color: #17a2b8;
}

.stat-card.card-4 .stat-badge {
    background: rgba(220, 53, 69, 0.2);
    color: #dc3545;
}

/* Action Buttons */
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

/* Table header style */
table th {
    vertical-align: middle;
    text-align: center;
}

/* Table data style */
table td {
    vertical-align: middle;
    text-align: center;
}

.table-section {
    margin-top: 50px;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    gap: 20px;
    flex-wrap: wrap;
}

.table-header .btn-primary {
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 600;
}

.table-header input {
    border-radius: 8px;
    border: 2px solid #e0e0e0;
    transition: border-color 0.3s ease;
}

.table-header input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

@media (max-width: 768px) {
    .cards-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .dashboard-header h2 {
        font-size: 1.5rem;
    }

    .card-value {
        font-size: 1.8rem;
    }

    .table-header {
        flex-direction: column;
    }

    .table-header input {
        width: 100%;
    }
}
</style>

<!-- Dashboard Header -->
<div class="dashboard-section">
    <div class="dashboard-header">
        <h2>Dashboard</h2>
    </div>

    <!-- Statistics Cards -->
    <div class="cards-grid">
        <!-- Card 1: Product Highest Order -->
        <div class="stat-card card-1">
            <div class="card-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="card-title">Top Product</div>
            <div class="card-value">{{ $product111->name ?? 'N/A' }}</div>
            <p class="card-subtitle">{{ $highest->total_delivered ?? 0 }} Orders Delivered</p>
            <span class="stat-badge">Most Ordered</span>
            <div class="card-footer">Updated today</div>
        </div>

        <!-- Card 2: Office Highest Order -->
        <div class="stat-card card-2">
            <div class="card-icon">
                <i class="fas fa-building"></i>
            </div>
            <div class="card-title">Top Office</div>
            <div class="card-value">{{ $highestOffice->office ?? 'N/A' }}</div>
            <p class="card-subtitle">{{ $highestOffice->total_delivered ?? 0 }} Orders Delivered</p>
            <span class="stat-badge">Leading Branch</span>
            <div class="card-footer">Updated today</div>
        </div>

        <!-- Card 3: Pending Applications -->
        <div class="stat-card card-3">
            <div class="card-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="card-title">Pending</div>
            <div class="card-value">{{ $pendingCount }}</div>
            <p class="card-subtitle">Applications Awaiting Review</p>
            <span class="stat-badge">Action Required</span>
            <div class="card-footer">Requires attention</div>
        </div>

        <!-- Card 4: Last Login -->
        <div class="stat-card card-4">
            <div class="card-icon">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="card-title">Last Active</div>
            <div class="card-value">{{ \Carbon\Carbon::parse($lastUserLog)->format('H:i') }}</div>
            <p class="card-subtitle">{{ \Carbon\Carbon::parse($lastUserLog)->format('d M Y') }}</p>
            <span class="stat-badge">Current Session</span>
            <div class="card-footer">Just now</div>
        </div>
    </div>
</div>

<!-- Products Table Section -->
<div class="table-section">
    <!-- Search Box and Download -->
    <div class="table-header">
        <a href="{{ route('productapproved14') }}" target="_blank" class="btn btn-primary">
            <i class="fas fa-download"></i> Download PDF
        </a>
        <input type="text" id="productSearch" class="form-control" style="max-width: 300px;" placeholder="🔍 Search products...">
    </div>

    <!-- Products Table -->
    <div class="print-area">
        <h3>Product Information</h3>
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

            form.action = `/allotments14/${prcode}`;

            fetch(`/allotments14/${prcode}`)
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
            form.action = `/products14/${prcode}/quantity`;
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

            fetch(`/allotments14/${prcode}`)
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