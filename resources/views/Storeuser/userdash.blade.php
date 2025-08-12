@extends('common.userdashboard')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

@section('content')

<h2>Dashboard</h2>
<div class="row mt-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-info">Total Product</h5>
                <p>Name 7</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-bold fw-bold text-success">Product Highest Order</h5>
                <p class="card-text h6">Name 77</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary">Pending Applications</h5>
                <p class="card-text h6">5</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-danger">Approved Applications</h5>
                <p class="card-text h6">6</p>
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

                <!-- Available Quantity (readonly) -->
                <div class="mb-3">
                    <label class="form-label">Available Quantity</label>
                    <input type="text" id="quantity" class="form-control" readonly>
                </div>
                 
                <!-- User Demand Input -->
                <div class="mb-3">
                    <label class="form-label">Enter your Demand</label>
                    <input type="number" id="demand11" class="form-control" min="0" placeholder="Enter quantity you want">
                </div>

                <button id="addBtn" class="btn btn-success w-100 mb-2">
                    <i class="fas fa-plus"></i> Add to Draft
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
                            <th>Demand Quantity</th>
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
                <button id="submitBtn" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Submit
                </button>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    // Load products when category changes
    document.getElementById('category').addEventListener('change', function() {
        let category = this.value;
        
        // Clear previous selections
        document.getElementById('product').innerHTML = `<option value="">-- Select Product --</option>`;
        document.getElementById('quantity').value = '';
        document.getElementById('demand11').value = '';
        document.getElementById('allotmentWarning').style.display = 'none';
        
        if (category) {
            fetch(`/products-by-category/${category}`)
                .then(res => res.json())
                .then(data => {
                    let productSelect = document.getElementById('product');
                    data.forEach(p => {
                        productSelect.innerHTML += `<option value="${p.prcode}">${p.name}</option>`;
                    });
                })
                .catch(error => {
                    console.error('Error fetching products:', error);
                    toastr.error('Error loading products');
                });
        }
    });

    // Show available quantity when product changes
    document.getElementById('product').addEventListener('change', function() {
        let prcode = this.value;
        
        // Clear demand input when product changes
        document.getElementById('demand11').value = '';
        document.getElementById('quantity').value = '';
        document.getElementById('allotmentWarning').style.display = 'none';
        
        if (prcode) {
            fetch(`/product-quantity/${prcode}`)
                .then(res => res.json())
                .then(data => {
                    // Set AVAILABLE quantity in readonly field
                    document.getElementById('quantity').value = data.quantity ?? 0;

                    // Show allotment warning
                    let warningBox = document.getElementById('allotmentWarning');
                    if (data.allotment_warning) {
                        warningBox.innerText = data.allotment_warning;
                        warningBox.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error fetching quantity:', error);
                    toastr.error('Error loading product quantity');
                });
        }
    });

    // Add to Draft - Clean version
    document.getElementById('addBtn').addEventListener('click', function() {
        let productSelect = document.getElementById('product');
        let demandQuantity = document.getElementById('demand11').value;
        
        // Basic validations only
        if (!productSelect.value) {
            return;
        }

        if (!demandQuantity || parseInt(demandQuantity) <= 0) {
            return;
        }

        // Get product info
        let productCode = productSelect.value;
        let productName = productSelect.options[productSelect.selectedIndex].text;

        // Add to table
        let tableBody = document.querySelector('#draftTable tbody');
        let row = document.createElement('tr');
        row.setAttribute('data-prcode', productCode);
        row.innerHTML = `
            <td>${productName}</td>
            <td>${demandQuantity}</td>
            <td><button class="btn btn-sm btn-danger removeBtn">Remove</button></td>
        `;
        tableBody.appendChild(row);
        
        // Clear form
        document.getElementById('demand11').value = '';
    });

    // Remove from draft
    document.querySelector('#draftTable').addEventListener('click', function(e) {
        if (e.target.classList.contains('removeBtn')) {
            e.target.closest('tr').remove();
            toastr.success('Product removed from draft');
        }
    });

    // Save Draft
    document.getElementById('saveDraft').addEventListener('click', function() {
        let rows = document.querySelectorAll('#draftTable tbody tr');
        
        if (rows.length === 0) {
            toastr.error('No items in draft to save');
            return;
        }

        let draftData = [];
        rows.forEach(row => {
            draftData.push({
                prcode: row.getAttribute('data-prcode'),
                product: row.cells[0].innerText,
                quantity: parseInt(row.cells[1].innerText)
            });
        });

        // Show loading message
        toastr.info('Saving draft...', 'Please wait');

        fetch('/save-draft', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ draft: draftData })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Full response:', data); // Debug log
            
            if (data.success === true) {
                let message = data.message || 'Draft saved successfully!';
                let title = 'Success';
                if (data.items_saved) {
                    message += ` (${data.items_saved} items saved)`;
                }
                if (data.trid) {
                    message += ` - ID: ${data.trid}`;
                }
                toastr.success(message, title);
                console.log('Success message:', message); // Debug log
            } else {
                let errorMessage = data.message || 'Unknown error occurred';
                toastr.error(errorMessage, 'Error');
                console.log('Error message:', errorMessage); // Debug log
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            toastr.error('Network error occurred. Please try again.', 'Connection Error');
        });
    });

    // Submit All Draft Items
    document.getElementById('submitBtn').addEventListener('click', function() {
        let rows = document.querySelectorAll('#draftTable tbody tr');
        
        if (rows.length === 0) {
            toastr.error('No items in draft to submit');
            return;
        }

        let submitData = [];
        rows.forEach(row => {
            submitData.push({
                prcode: row.getAttribute('data-prcode'),
                product: row.cells[0].innerText,
                quantity: parseInt(row.cells[1].innerText)
            });
        });

        fetch('/submit-products', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ products: submitData })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                toastr.success(data.message || 'Products submitted successfully');
                // Clear draft table after successful submission
                document.querySelector('#draftTable tbody').innerHTML = '';
            } else {
                toastr.error(data.message || 'Error submitting products');
            }
        })
        .catch(error => {
            console.error('Error submitting products:', error);
            toastr.error('Error submitting products');
        });
    });

});
</script>

@endsection