
@extends('common.dataentrydash')
 
 
  
  
  
      
 
  
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
        width: 90%; /* টেবিল একটু ছোট করে সেন্টারে দেখাবে */
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
    /* Actions কলাম লুকাতে */
    .print-area table th:last-child,
    .print-area table td:last-child {
        display: none;
    }
}
</style>

<style>
  
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
        background:   <button onclick="window.print()" class="btn btn-outline-success print-btn no-print mb-4" title="Direct Print">
                                <i class="fas fa-print"></i> Print
                            </button>#e0a800;
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
</style>



<h2>Dashboard  </h2>
<div class="row mt-4">
  <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-info">Product Highest Order  </h5>
                 <p> 
                  {{ $product111->name ?? 'N/A' }}      {{ $highest->total_delivered ?? 0 }}
             </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-bold fw-bold text-success">Office  Highest Order  </h5>
                <p class="card-text h6">{{ $highestOffice->office ?? 'N/A' }}      {{ $highestOffice->total_delivered ?? 0 }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary">Pending Applications</h5>
                <p class="card-text h6">{{ $pendingCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-danger"> Last Login </h5>
                <p class="card-text h6"> 
 
{{ \Carbon\Carbon::parse($lastUserLog->created_at)->format('d M Y h:i A') }}

                </p>
            </div>
        </div>
    </div>
</div>
 

<!-- Button to open new product modal -->
 
 

                             <a href="{{ route('productapproved' ) }}" 
       target="_blank" 
       class="btn btn-primary">
     Download    PDF
    </a>

<!-- Products Table -->
 <div class="print-area">
    <h2>Product  Info</h2>
<table class="table table-bordered table-striped align-middle">
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
                <!-- Delete Product -->
                 

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
            <label for="quantityInput" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantityInput" name="quantity" min="0" required>
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

            form.action = `/allotments/${prcode}`; // Adjust if you use named route

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Populate Update Quantity Modal
    const updateButtons = document.querySelectorAll('.btn-update-quantity');
    const quantityInput = document.getElementById('quantityInput');
    const modalPrcode = document.getElementById('modalPrcode');
    const form = document.getElementById('updateQuantityForm');

    updateButtons.forEach(button => {
        button.addEventListener('click', function () {
            const prcode = this.getAttribute('data-prcode');
            const quantity = this.getAttribute('data-quantity');

            modalPrcode.value = prcode;
            quantityInput.value = quantity;

            // Set the form action dynamically to your update route for quantity
            form.action = `/products/${prcode}/quantity`; // Adjust if needed to named route
        });
    });

    // SweetAlert2 confirmation for delete
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

            // Clear previous data
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

@endsection

