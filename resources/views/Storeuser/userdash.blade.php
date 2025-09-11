@extends('common.userdashboard')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Enhanced Custom Styles -->
<style>
    :root {
        --primary-color: #667eea;
        --secondary-color: #764ba2;
        --success-color: #48bb78;
        --warning-color: #ed8936;
        --error-color: #f56565;
        --info-color: #4299e1;
        --light-bg: #f7fafc;
        --card-shadow: 0 10px 25px rgba(0,0,0,0.1);
        --border-radius: 15px;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .dashboard-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        margin: 20px;
        padding: 30px;
    }

    .dashboard-title {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 2rem;
        text-align: center;
    }

    /* Enhanced Statistics Cards */
    .stats-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        padding: 2rem;
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--card-gradient);
        border-radius: var(--border-radius) var(--border-radius) 0 0;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .stats-card.total-ordered::before { background: linear-gradient(135deg, var(--info-color), #63b3ed); }
    .stats-card.highest-product::before { background: linear-gradient(135deg, var(--success-color), #68d391); }
    .stats-card.pending-apps::before { background: linear-gradient(135deg, var(--warning-color), #fbb040); }
    .stats-card.approved-apps::before { background: linear-gradient(135deg, var(--error-color), #fc8181); }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.5rem;
        color: white;
    }

    .stats-icon.info { background: linear-gradient(135deg, var(--info-color), #63b3ed); }
    .stats-icon.success { background: linear-gradient(135deg, var(--success-color), #68d391); }
    .stats-icon.warning { background: linear-gradient(135deg, var(--warning-color), #fbb040); }
    .stats-icon.danger { background: linear-gradient(135deg, var(--error-color), #fc8181); }

    .stats-value {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #2d3748;
    }

    .stats-label {
        color: #718096;
        font-weight: 500;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Enhanced Form Cards */
    .form-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        border: none;
        overflow: hidden;
    }

    .card-header-gradient {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 1.5rem;
        border: none;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .form-floating {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-control, .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn-enhanced {
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .btn-enhanced::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-enhanced:hover::before {
        left: 100%;
    }

    .btn-success-enhanced {
        background: linear-gradient(135deg, var(--success-color), #68d391);
        color: white;
    }

    .btn-primary-enhanced {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
    }

    .btn-danger-enhanced {
        background: linear-gradient(135deg, var(--error-color), #fc8181);
        color: white;
    }

    /* Enhanced Table */
    .table-enhanced {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .table-enhanced thead th {
        background: linear-gradient(135deg, #f7fafc, #edf2f7);
        font-weight: 600;
        color: #4a5568;
        border: none;
        padding: 1rem;
    }

    .table-enhanced tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-color: #e2e8f0;
    }

    .table-enhanced tbody tr:hover {
        background-color: #f7fafc;
    }

    /* Warning Box */
    .warning-box {
        background: linear-gradient(135deg, #fef5e7, #fed7aa);
        border: 2px solid #f6ad55;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
        color: #c05621;
        font-weight: 500;
    }

    /* Loading Animation */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255,255,255,.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Toast Enhancements - Force black text on all toasts */
    #toast-container {
        z-index: 9999 !important;
    }
    
    .toast {
        border-radius: 10px !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2) !important;
        min-height: 60px !important;
        color: #000000 !important;
    }
    
    /* All toast types with white background and black text */
    .toast-success, 
    .toast-info, 
    .toast-warning, 
    .toast-error { 
        background-color: #ffffff !important;
        color: #000000 !important;
        border-left: 5px solid #28a745 !important;
    }
    
    .toast-success {
        border-left-color: var(--success-color) !important;
    }
    
    .toast-info {
        border-left-color: var(--info-color) !important;
    }
    
    .toast-warning {
        border-left-color: var(--warning-color) !important;
    }
    
    .toast-error {
        border-left-color: var(--error-color) !important;
    }
    
    /* Force black text on all toast elements */
    .toast-title,
    .toast-message,
    .toast .toast-title,
    .toast .toast-message,
    #toast-container .toast-title,
    #toast-container .toast-message,
    #toast-container .toast div {
        color: #000000 !important;
        font-weight: 600 !important;
    }
    
    .toast-title {
        font-size: 16px !important;
        margin-bottom: 5px !important;
    }
    
    .toast-message {
        font-size: 14px !important;
        line-height: 1.4 !important;
    }
    
    /* Close button styling */
    .toast-close-button {
        color: #000000 !important;
        opacity: 0.7 !important;
        text-decoration: none !important;
        font-size: 18px !important;
        font-weight: bold !important;
    }
    
    .toast-close-button:hover,
    .toast-close-button:focus {
        opacity: 1 !important;
        color: #000000 !important;
    }
    
    /* Progress bar */
    .toast-progress {
        background-color: rgba(0, 0, 0, 0.1) !important;
        height: 3px !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .dashboard-container {
            margin: 10px;
            padding: 20px;
        }
        
        .dashboard-title {
            font-size: 2rem;
        }
        
        .stats-card {
            text-align: center;
            margin-bottom: 1rem;
        }
    }

    /* Animation Classes */
    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

@section('content')
<div class="dashboard-container">
    <h1 class="dashboard-title">
        <i class="fas fa-tachometer-alt me-3"></i>Dashboard
    </h1>

    <!-- Enhanced Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-3">
            <div class="stats-card total-ordered fade-in">
                <div class="stats-icon info">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stats-value">{{ $totalQuantity }}</div>
                <div class="stats-label">Total Ordered</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stats-card highest-product fade-in" style="animation-delay: 0.1s">
                <div class="stats-icon success">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stats-value">{{ $highestProduct->total_quantity ?? 0 }}</div>
                <div class="stats-label">Top Product Orders</div>
                <small class="text-muted">{{ $highestProduct->product->name ?? 'N/A' }}</small>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stats-card pending-apps fade-in" style="animation-delay: 0.2s">
                <div class="stats-icon warning">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stats-value">{{ $pendingCount }}</div>
                <div class="stats-label">Pending Applications</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stats-card approved-apps fade-in" style="animation-delay: 0.3s">
                <div class="stats-icon danger">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stats-value">{{ $approvedCount }}</div>
                <div class="stats-label">Approved Applications</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Enhanced Product Selection Form -->
        <div class="col-lg-6">
            <div class="form-card fade-in" style="animation-delay: 0.4s">
                <div class="card-header-gradient">
                    <i class="fas fa-plus-circle me-2"></i>Select Products
                </div>
                <div class="card-body p-4">
                    <!-- Category Selection -->
                    <div class="form-floating">
                        <select id="category" class="form-select">
                            <option value="">Choose Category...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                        <label for="category"><i class="fas fa-tags me-2"></i>Category</label>
                    </div>

                    <!-- Product Selection -->
                    <div class="form-floating">
                        <select id="product" class="form-select">
                            <option value="">Choose Product...</option>
                        </select>
                        <label for="product"><i class="fas fa-box me-2"></i>Product</label>
                    </div>

                    <!-- Warning Message -->
                    <div id="allotmentWarning" class="warning-box" style="display:none;">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <span id="warningText"></span>
                    </div>

                    <!-- Available Quantity -->
                    <div class="form-floating">
                        <input type="text" id="quantity" class="form-control" readonly>
                        <label for="quantity"><i class="fas fa-warehouse me-2"></i>Available Quantity</label>
                    </div>

                    <!-- Demand Input -->
                    <div class="form-floating">
                        <input type="number" id="demand11" class="form-control" min="0" placeholder="0">
                        <label for="demand11"><i class="fas fa-hand-paper me-2"></i>Your Demand</label>
                    </div>

                    <button id="addBtn" class="btn btn-success-enhanced btn-enhanced w-100">
                        <i class="fas fa-plus me-2"></i>Add to Draft
                    </button>
                </div>
            </div>
        </div>

        <!-- Enhanced Draft List -->
        <div class="col-lg-6">
            <div class="form-card fade-in" style="animation-delay: 0.5s">
                <div class="card-header-gradient d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-list-ul me-2"></i>Draft List</span>
                    <span id="draftCount" class="badge bg-light text-dark">0 items</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-enhanced mb-0" id="draftTable">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-box me-2"></i>Product</th>
                                    <th><i class="fas fa-sort-numeric-up me-2"></i>Quantity</th>
                                    <th><i class="fas fa-cogs me-2"></i>Action</th>
                                </tr>
                            </thead>
                            <tbody id="draftTableBody">
                                <tr id="emptyRow">
                                    <td colspan="3" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                        No items in draft yet
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light p-3">
                    <button id="saveDraft" class="btn btn-primary-enhanced btn-enhanced w-100" disabled>
                        <i class="fas fa-paper-plane me-2"></i>
                        <span class="btn-text">Submit Application</span>
                        <span class="spinner d-none"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(document).ready(function() {
    // Enhanced Toastr Configuration
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "4000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // Enhanced message function
    function showMessage(type, message, title = '') {
        toastr[type](message, title);
    }

    // Update draft count
    function updateDraftCount() {
        const count = $('#draftTableBody tr:not(#emptyRow)').length;
        $('#draftCount').text(count + (count === 1 ? ' item' : ' items'));
        $('#saveDraft').prop('disabled', count === 0);
        
        if (count === 0) {
            $('#emptyRow').show();
        } else {
            $('#emptyRow').hide();
        }
    }

    // Enhanced loading state
    function setLoadingState(element, isLoading) {
        const $btn = $(element);
        const $spinner = $btn.find('.spinner');
        const $text = $btn.find('.btn-text');
        
        if (isLoading) {
            $btn.prop('disabled', true).addClass('loading');
            $spinner.removeClass('d-none');
            $text.text('Processing...');
        } else {
            $btn.prop('disabled', false).removeClass('loading');
            $spinner.addClass('d-none');
            $text.text($btn.data('original-text') || 'Submit Application');
        }
    }

    // Load products when category changes
    $('#category').on('change', function() {
        const category = this.value;
        const $productSelect = $('#product');
        
        // Reset dependent fields
        $productSelect.html('<option value="">Choose Product...</option>');
        $('#quantity, #demand11').val('');
        $('#allotmentWarning').hide();
        
        if (category) {
            $productSelect.prop('disabled', true);
            
            fetch(`/products-by-category/${category}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(p => {
                        $productSelect.append(`<option value="${p.prcode}">${p.name}</option>`);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('error', 'Failed to load products');
                })
                .finally(() => {
                    $productSelect.prop('disabled', false);
                });
        }
    });

    // Load quantity when product changes
    $('#product').on('change', function() {
        const prcode = this.value;
        $('#demand11, #quantity').val('');
        $('#allotmentWarning').hide();

        if (prcode) {
            fetch(`/product-quantity/${prcode}`)
                .then(res => res.text())
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        $('#quantity').val(data.quantity ?? 0);

                        if (data.allotment_warning) {
                            $('#warningText').text(data.allotment_warning);
                            $('#allotmentWarning').fadeIn();
                        }
                    } catch (err) {
                        console.error("JSON parse error:", err);
                        showMessage('error', 'Invalid server response');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('error', 'Failed to load product quantity');
                });
        }
    });

    // Enhanced add to draft
    $('#addBtn').on('click', function() {
        const $productSelect = $('#product');
        const productCode = $productSelect.val();
        const productName = $productSelect.find('option:selected').text();
        const demandQuantity = parseInt($('#demand11').val());
        const availableQuantity = parseInt($('#quantity').val());

        // Validations
        if (!productCode) {
            showMessage('warning', 'Please select a product');
            return;
        }

        if (!demandQuantity || demandQuantity <= 0) {
            showMessage('warning', 'Please enter a valid quantity');
            return;
        }

        if (demandQuantity > availableQuantity) {
            showMessage('error', `Demand (${demandQuantity}) exceeds available quantity (${availableQuantity})`);
            return;
        }

        // Check for duplicates
        if ($(`#draftTableBody tr[data-prcode="${productCode}"]`).length > 0) {
            showMessage('warning', 'Product already exists in draft');
            return;
        }

        // Add to draft with animation
        const row = `
            <tr data-prcode="${productCode}" class="fade-in">
                <td>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-box text-primary me-2"></i>
                        <span>${productName}</span>
                    </div>
                </td>
                <td>
                    <span class="badge bg-info">${demandQuantity}</span>
                </td>
                <td>
                    <button class="btn btn-danger-enhanced btn-sm removeBtn">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        
        $('#draftTableBody').append(row);
        updateDraftCount();
        
        // Clear form
        $('#demand11').val('');
        showMessage('success', 'Product added to draft');
    });

    // Remove from draft
    $('#draftTableBody').on('click', '.removeBtn', function() {
        $(this).closest('tr').fadeOut(300, function() {
            $(this).remove();
            updateDraftCount();
        });
        showMessage('success', 'Product removed from draft');
    });

    // Enhanced save draft
    $('#saveDraft').on('click', function() {
        const rows = $('#draftTableBody tr:not(#emptyRow)');
        
        if (rows.length === 0) {
            showMessage('error', 'No items in draft to submit');
            return;
        }

        const draftData = [];
        rows.each(function() {
            const $row = $(this);
            draftData.push({
                prcode: $row.attr('data-prcode'),
                product: $row.find('td:eq(0) span').text(),
                quantity: parseInt($row.find('.badge').text())
            });
        });

        setLoadingState(this, true);
        showMessage('info', 'Submitting your application...', 'Please wait');

        fetch('/save-draft', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({ draft: draftData })
        })
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            if (data.success === true) {
                let message = data.message || 'Application submitted successfully!';
                if (data.items_saved) {
                    message += ` (${data.items_saved} items processed)`;
                }
                if (data.trid) {
                    message += ` Reference ID: ${data.trid}`;
                }
                
                showMessage('success', message, 'Success!');
                $('#draftTableBody').empty().append(`
                    <tr id="emptyRow">
                        <td colspan="3" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                            No items in draft yet
                        </td>
                    </tr>
                `);
                updateDraftCount();
                
            } else {
                showMessage('error', data.message || 'Submission failed', 'Error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('error', 'Network error. Please try again.', 'Connection Failed');
        })
        .finally(() => {
            setLoadingState('#saveDraft', false);
        });
    });

    // Initial setup
    updateDraftCount();
});
</script>

@endsection