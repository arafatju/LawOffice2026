
@extends('common.userdashboard')
 
 
  
  
  
      
 
  
@section('content')




<h2>Dashboard  </h2>
<div class="row mt-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-info">Total Product    </h5>
                 <p> 
                  Name      7
             </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-bold fw-bold text-success">Product   Highest Order  </h5>
                <p class="card-text h6">Name  77 </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary">Pending Applications</h5>
                <p class="card-text h6">5 </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-danger"> Approved Applications</h5>
                <p class="card-text h6"> 
 

            
                 6 
             
                </p>
            </div>
        </div>
    </div>
</div>
 
<div class="row">
    <!-- Left Side: Selection Form -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Select Product
            </div>
            <div class="card-body">
                <!-- Category -->
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" class="form-select">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Product -->
                <div class="mb-3">
                    <label for="product" class="form-label">Product</label>
                    <select id="product" class="form-select">
                        <option value="">-- Select Product --</option>
                    </select>
                </div>

                <!-- Warning message -->
                <div id="allotmentWarning" class="text-danger fw-bold mb-2" style="display:none;"></div>

                <!-- Quantity -->
                <div class="mb-3">
                    <label class="form-label">Available Quantity</label>
                    <input type="text" id="quantity" class="form-control" readonly>
                </div>

                <button id="addBtn" class="btn btn-success w-100 mb-2">
                    <i class="fas fa-plus"></i> Add to Draft
                </button>
                <button id="submitBtn" class="btn btn-primary w-100">
                    <i class="fas fa-paper-plane"></i> Submit
                </button>
            </div>
        </div>
    </div>

    <!-- Right Side: Draft List -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                Draft List
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="draftTable">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Draft items will be added here dynamically -->
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-end">
                <button id="saveDraft" class="btn btn-primary">Save Draft</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {

    // Load products when category changes
    document.getElementById('category').addEventListener('change', function() {
        let category = this.value;
        if (category) {
            fetch(`/products-by-category/${category}`)
                .then(res => res.json())
                .then(data => {
                    let productSelect = document.getElementById('product');
                    productSelect.innerHTML = `<option value="">-- Select Product --</option>`;
                    data.forEach(p => {
                        productSelect.innerHTML += `<option value="${p.prcode}">${p.name}</option>`;
                    });
                });
        }
    });

    // Show quantity & allotment warning when product changes
    document.getElementById('product').addEventListener('change', function() {
        let prcode = this.value;
        if (prcode) {
            fetch(`/product-quantity/${prcode}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('quantity').value = data.quantity ?? 0;

                    // Show allotment warning
                    let warningBox = document.getElementById('allotmentWarning');
                    if (data.allotment_warning) {
                        warningBox.innerText = data.allotment_warning;
                        warningBox.style.display = 'block';
                    } else {
                        warningBox.style.display = 'none';
                    }
                });
        }
    });

    // Add to Draft
    document.getElementById('addBtn').addEventListener('click', function() {
        let product = document.getElementById('product');
        let quantity = document.getElementById('quantity').value;

        if (!product.value) {
            toastr.error('Please select a product');
            return;
        }

        let tableBody = document.querySelector('#draftTable tbody');
        let row = `
            <tr>
                <td>${product.options[product.selectedIndex].text}</td>
                <td>${quantity}</td>
                <td><button class="btn btn-sm btn-danger removeBtn">Remove</button></td>
            </tr>
        `;
        tableBody.insertAdjacentHTML('beforeend', row);
    });

    // Remove from draft
    document.querySelector('#draftTable').addEventListener('click', function(e) {
        if (e.target.classList.contains('removeBtn')) {
            e.target.closest('tr').remove();
        }
    });

    // Save Draft
    document.getElementById('saveDraft').addEventListener('click', function() {
        let rows = document.querySelectorAll('#draftTable tbody tr');
        let draftData = [];

        rows.forEach(row => {
            draftData.push({
                product: row.cells[0].innerText,
                quantity: row.cells[1].innerText
            });
        });

        fetch('/save-draft', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ draft: draftData })
        })
        .then(res => res.json())
        .then(data => {
            toastr.success(data.message);
        });
    });

    // Submit
    document.getElementById('submitBtn').addEventListener('click', function() {
        let product = document.getElementById('product').value;
        let quantity = document.getElementById('quantity').value;

        if (!product) {
            toastr.error('Please select a product');
            return;
        }

        fetch('/submit-product', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ prcode: product, quantity: quantity })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }
        });
    });

});
</script>
 
@endsection

