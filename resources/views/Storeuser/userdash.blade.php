@extends('common.userdashboard')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Custom Toastr Styles -->
<style>
    /* Custom Toastr Colors - Blue/Primary Theme */
    .toast-success {
        background-color: #0d6efd !important; /* Bootstrap primary blue */
        color: white !important;
    }
    
    .toast-info {
        background-color: #0dcaf0 !important; /* Bootstrap info blue */
        color: white !important;
    }
    
    .toast-warning {
        background-color: #fd7e14 !important; /* Bootstrap warning orange */
        color: white !important;
    }
    
    .toast-error {
        background-color: #dc3545 !important; /* Bootstrap danger red */
        color: white !important;
    }
    
    /* Toast title colors */
    .toast-title {
        color: white !important;
        font-weight: bold !important;
    }
    
    /* Toast message colors */
    .toast-message {
        color: white !important;
    }
    
    /* Progress bar colors */
    .toast-progress {
        background-color: rgba(255, 255, 255, 0.4) !important;
    }
    
    /* Close button color */
    .toast-close-button {
        color: white !important;
        opacity: 0.8;
    }
    
    .toast-close-button:hover {
        opacity: 1;
    }
    
    /* Optional: Make all toasts use primary blue color */
    .toast-primary {
        background-color: #0d6efd !important;
        color: white !important;
    }
</style>

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
                <div id="allotmentWarning" class="text-primary fw-bold mb-2" style="display:none;"></div>

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
                
                <button id="saveDraft" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Submit
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts - Load jQuery first, then Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
// Wait for both jQuery and DOM to be ready
$(document).ready(function() {
    
    // Configure Toastr options
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
    
    // Helper function to show messages
    function showMessage(type, message, title = '') {
        switch(type) {
            case 'success':
                toastr.success(message, title);
                break;
            case 'error':
                toastr.error(message, title);
                break;
            case 'info':
                toastr.info(message, title);
                break;
            case 'warning':
                toastr.warning(message, title);
                break;
        }
    }

    // Load products when category changes
    $('#category').on('change', function() {
        let category = this.value;
        
        // Clear previous selections
        $('#product').html('<option value="">-- Select Product --</option>');
        $('#quantity').val('');
        $('#demand11').val('');
        $('#allotmentWarning').hide();
        
        if (category) {
            fetch(`/products-by-category/${category}`)
                .then(res => res.json())
                .then(data => {
                    let productSelect = $('#product')[0];
                    data.forEach(p => {
                        productSelect.innerHTML += `<option value="${p.prcode}">${p.name}</option>`;
                    });
                })
                .catch(error => {
                    console.error('Error fetching products:', error);
                    showMessage('error', 'Error loading products');
                });
        }
    });

    // Show available quantity when product changes
    $('#product').on('change', function() {
        let prcode = this.value;

        $('#demand11').val('');
        $('#quantity').val('');
        $('#allotmentWarning').hide();

        if (prcode) {
            fetch(`/product-quantity/${prcode}`)
                .then(res => res.text())
                .then(text => {
                    console.log("Raw Response:", text);

                    try {
                        const data = JSON.parse(text);
                        $('#quantity').val(data.quantity ?? 0);

                        let warningBox = $('#allotmentWarning');
                        if (data.allotment_warning) {
                            warningBox.text(data.allotment_warning);
                            warningBox.show();
                        }
                    } catch (err) {
                        console.error("JSON parse error:", err);
                        showMessage('error', 'Invalid response from server. Check console.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching quantity:', error);
                    showMessage('error', 'Error loading product quantity');
                });
        }
    });

    // Add to Draft
    $('#addBtn').on('click', function() {
        let productSelect = $('#product')[0];
        let demandQuantity = $('#demand11').val();
        
        // Basic validations
        if (!productSelect.value) {
            showMessage('warning', 'Please select a product');
            return;
        }

        if (!demandQuantity || parseInt(demandQuantity) <= 0) {
            showMessage('warning', 'Please enter a valid quantity');
            return;
        }

        // Get product info
        let productCode = productSelect.value;
        let productName = productSelect.options[productSelect.selectedIndex].text;

        // Check if product already exists in draft
        let existingRow = $(`#draftTable tbody tr[data-prcode="${productCode}"]`);
        if (existingRow.length > 0) {
            showMessage('warning', 'Product already added to draft');
            return;
        }

        // Add to table
        let tableBody = $('#draftTable tbody');
        let row = `
            <tr data-prcode="${productCode}">
                <td>${productName}</td>
                <td>${demandQuantity}</td>
                <td><button class="btn btn-sm btn-danger removeBtn">Remove</button></td>
            </tr>
        `;
        tableBody.append(row);
        
        // Clear form
        $('#demand11').val('');
        showMessage('success', 'Product added to draft');
    });

    // Remove from draft
    $('#draftTable').on('click', '.removeBtn', function() {
        $(this).closest('tr').remove();
        showMessage('success', 'Product removed from draft');
    });

    // Save Draft
    $('#saveDraft').on('click', function() {
        let rows = $('#draftTable tbody tr');
        
        if (rows.length === 0) {
            showMessage('error', 'No items in draft to save');
            return;
        }

        let draftData = [];
        rows.each(function() {
            let $row = $(this);
            draftData.push({
                prcode: $row.attr('data-prcode'),
                product: $row.find('td:eq(0)').text(),
                quantity: parseInt($row.find('td:eq(1)').text())
            });
        });

        // Show loading message
        showMessage('info', 'Sending List...', 'Please wait');

        // Disable button to prevent double clicks
        $('#saveDraft').prop('disabled', true);

        fetch('/save-draft', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
            console.log('Full response:', data);
            
            if (data.success === true) {
                let message = data.message || 'Submitted successfully!';
                if (data.items_saved) {
                    message += ` (${data.items_saved} items saved)`;
                }
                if (data.trid) {
                    message += ` - ID: ${data.trid}`;
                }
                
                showMessage('success', message, 'Success');
                
                // Clear draft table after successful save
                $('#draftTable tbody').empty();
                
            } else {
                let errorMessage = data.message || 'Unknown error occurred';
                showMessage('error', errorMessage, 'Error');
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            showMessage('error', 'Failed to save draft. Please try again.', 'Network Error');
        })
        .finally(() => {
            // Re-enable button
            $('#saveDraft').prop('disabled', false);
        });
    });

    // Submit All Draft Items
    $('#submitBtn').on('click', function() {
        let rows = $('#draftTable tbody tr');
        
        if (rows.length === 0) {
            showMessage('error', 'No items in draft to submit');
            return;
        }

        let submitData = [];
        rows.each(function() {
            let $row = $(this);
            submitData.push({
                prcode: $row.attr('data-prcode'),
                product: $row.find('td:eq(0)').text(),
                quantity: parseInt($row.find('td:eq(1)').text())
            });
        });

        // Show loading message
        showMessage('info', 'Submitting products...', 'Please wait');

        // Disable button to prevent double clicks
        $('#submitBtn').prop('disabled', true);

        fetch('/submit-products', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({ products: submitData })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showMessage('success', data.message || 'Products submitted successfully');
                // Clear draft table after successful submission
                $('#draftTable tbody').empty();
            } else {
                showMessage('error', data.message || 'Error submitting products');
            }
        })
        .catch(error => {
            console.error('Error submitting products:', error);
            showMessage('error', 'Error submitting products');
        })
        .finally(() => {
            // Re-enable button
            $('#submitBtn').prop('disabled', false);
        });
    });

});
</script>

@endsection