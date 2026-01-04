@extends('common.masterall')

@section('content')

@section('title', 'Section Admin Management') 

@section('breadcrumb', 'User Management')

@php
function enToBnNumber($number) {
    $english = ['0','1','2','3','4','5','6','7','8','9'];
    $bangla  = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    return str_replace($english, $bangla, $number);
}
@endphp

@php
    use Carbon\Carbon;
@endphp 

<style>
    /* Custom Font Support for Bangla */
    .font-bn {
        font-family: 'Hind Siliguri', 'SolaimanLipi', sans-serif;
    }
    
    /* Print Styles */
    @media print {
        .no-print {
            display: none !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
        .table-responsive {
            overflow: visible !important;
        }
        body {
            background-color: white;
        }
    }
</style>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Management</h1>
    </div>

    <!-- Stats Card -->
    <div class="row mb-4 no-print">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2" style="border-left: 5px solid #36b9cc;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Ordered
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-info font-bn">
                                {{ $pending }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Table Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Product Transactions</h6>
            
            @if($pendingTransactions->isNotEmpty())
                <button type="button" class="btn btn-primary btn-sm" id="openApproveModalBtn" 
                        data-id="{{ $pendingTransactions->first()->userid }}">
                    <i class="fas fa-edit me-1"></i> Edit All Items
                </button>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th>প্রোডাক্ট আইডি</th>
                            <th>প্রোডাক্ট নাম</th>
                            <th>চাহিদা</th>
                            <th>মাসিক বরাদ্দ</th>
                            <th>মাসিক বিতরণ</th>
                            <th>মজুদ আছে</th>
                            <th>তারিখ</th>
                            <th class="text-center no-print">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingTransactions as $product)
                        <tr data-transaction-id="{{ $product->id }}" data-user-id="{{ $product->userid }}">
                            <td class="prcode font-bn">{{ enToBnNumber($product->prcode) }}</td>
                            <td class="pname font-bn">{{ enToBnNumber(App\Http\Controllers\Storeuser::getProductDetails($product->prcode))  }}</td>
                            <td class="number font-bn fw-bold text-primary">{{ ($product->number) }}</td>
                            <td class="font-bn">{{ (App\Http\Controllers\Storeuser::getAllotmentDetails($product->prcode,$product->userid)) }}</td>
                            <td class="font-bn">{{ enToBnNumber(App\Http\Controllers\Storeuser::getTransactionDetails($product->prcode,$product->month,$product->userid)) }}</td>
                            <td class="font-bn">{{ enToBnNumber(App\Http\Controllers\Storeentry::getStockDetails($product->prcode)) }}</td>
                            <td class="font-bn">{{ enToBnNumber($product->created_at->format('d, M, Y')) }}</td>
                            <td class="text-center no-print">
                                <form action="{{ route('transactions.delete', $product->id) }}" method="POST" 
                                      style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-box-open fa-3x mb-3"></i>
                                        <p>No transactions found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-bn" id="approveModalLabel">
                    <i class="fas fa-edit"></i> Edit Transactions
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info mb-3">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Note:</strong> You can edit the quantities below. Changes will be saved immediately.
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="modalTransactionTable">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 25%;">Product ID</th>
                                <th style="width: 45%;">Product Name</th>
                                <th style="width: 30%;">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- JS will populate rows -->
                        </tbody>
                    </table>
                </div>
                
                <input type="hidden" id="modalTransactionId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="button" class="btn btn-primary" id="saveApprove">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Modal Input Styling */
#modalTransactionTable input[type="number"] {
    text-align: center;
    font-weight: 500;
    border: 1px solid #ced4da;
    padding: 5px;
}

#modalTransactionTable input[type="number"]:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    outline: none;
}

.modal-body {
    max-height: 60vh;
    overflow-y: auto;
}

/* Validation Style */
.is-invalid {
    border-color: #dc3545 !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Store transaction items for editing
    let transactionItems = [];
    let approveModalInstance = null;
    
    // Initialize modal instance
    if (typeof bootstrap !== 'undefined') {
        approveModalInstance = new bootstrap.Modal(document.getElementById('approveModal'));
    } else {
        console.error('Bootstrap 5 is not loaded.');
        return;
    }
    
    // Open modal button click handler
    const openBtn = document.getElementById('openApproveModalBtn');
    if(openBtn) {
        openBtn.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            
            document.getElementById('modalTransactionId').value = userId;
            
            // Clear modal table and reset items
            const tbody = document.querySelector('#modalTransactionTable tbody');
            tbody.innerHTML = '';
            transactionItems = [];
            
            // Find all rows in table with same userId
            const rows = document.querySelectorAll('tr[data-user-id="' + userId + '"]');
            
            rows.forEach(function(row) {
                const transactionId = row.getAttribute('data-transaction-id');
                const prcode = row.querySelector('.prcode').textContent.trim();
                const pname = row.querySelector('.pname').textContent.trim();
                const number = row.querySelector('.number').textContent.trim();
                
                // Store item data for later use
                const itemData = {
                    transactionId: transactionId,
                    prcode: prcode,
                    pname: pname,
                    number: number
                };
                transactionItems.push(itemData);
                
                let rowHtml = '<tr>';
                rowHtml += '<td>' + prcode + '</td>';
                rowHtml += '<td>' + pname + '</td>';
                rowHtml += '<td><input type="number" class="form-control modal-number font-bn" data-rowid="'+transactionId+'" value="'+number+'" min="0" step="1"></td>';
                rowHtml += '</tr>';
                
                tbody.insertAdjacentHTML('beforeend', rowHtml);
            });
            
            // Show modal
            approveModalInstance.show();
        });
    }
    
    // Save button click handler
    document.getElementById('saveApprove').addEventListener('click', function() {
        const numbers = {};
        const modalNumbers = document.querySelectorAll('.modal-number');
        
        // Validate inputs
        let hasError = false;
        modalNumbers.forEach(function(input) {
            if (input.value === '' || parseFloat(input.value) < 0) {
                hasError = true;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });
        
        if (hasError) {
            alert('Please enter valid quantities (must be 0 or greater).');
            return;
        }
        
        // Collect all updated numbers
        modalNumbers.forEach(function(input) {
            const rowId = input.getAttribute('data-rowid');
            const number = input.value;
            numbers[rowId] = number;
        });
        
        const userId = document.getElementById('modalTransactionId').value;
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            alert('CSRF token not found. Please refresh the page.');
            return;
        }
        
        // Disable button to prevent double submission
        const saveButton = this;
        saveButton.disabled = true;
        const originalButtonText = saveButton.innerHTML;
        saveButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';
        
        // Send save request
        fetch("{{ route('transactions.approveMultiple11') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.getAttribute('content')
            },
            body: JSON.stringify({
                id: userId,
                numbers: numbers
            })
        })
        .then(response => {
            return response.json().then(data => {
                return { 
                    status: response.status, 
                    ok: response.ok,
                    data: data 
                };
            });
        })
        .then(result => {
            const { status, ok, data } = result;
            
            // Re-enable button
            saveButton.disabled = false;
            saveButton.innerHTML = originalButtonText;
            
            // Close modal
            approveModalInstance.hide();
            
            if (data.success) {
                if (data.partial) {
                    // Partial success
                    let message = 'PARTIAL SUCCESS\n\n';
                    message += data.updated + ' item(s) updated successfully\n';
                    message += data.failed + ' item(s) failed\n\n';
                    message += 'Failed items:\n';
                    message += '─────────────────────────\n';
                    
                    data.failedItems.forEach((item, index) => {
                        message += (index + 1) + '. Row ID: ' + item.rowId + '\n';
                        message += '   Reason: ' + item.reason + '\n\n';
                    });
                    
                    alert(message);
                } else {
                    // Full success
                    alert('All transactions updated successfully!');
                }
                
                // Reload page to show updated data
                setTimeout(() => location.reload(), 500);
                
            } else {
                // Complete failure
                let errorMessage = 'UPDATE FAILED\n\n';
                errorMessage += data.message || 'Unable to update transactions.';
                errorMessage += '\n\n';
                
                if (data.failedItems && data.failedItems.length > 0) {
                    errorMessage += 'Error details:\n';
                    errorMessage += '─────────────────────────\n';
                    data.failedItems.forEach((item, index) => {
                        errorMessage += (index + 1) + '. Row ID: ' + item.rowId + '\n';
                        errorMessage += '   Reason: ' + item.reason + '\n\n';
                    });
                }
                
                errorMessage += 'Please try again.';
                
                alert(errorMessage);
                
                // Reload page to show current state
                setTimeout(() => location.reload(), 1000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            
            // Re-enable button
            saveButton.disabled = false;
            saveButton.innerHTML = originalButtonText;
            
            // Close modal
            approveModalInstance.hide();
            
            alert('An unexpected error occurred!\n\nPlease check your internet connection and try again.\n\nIf the problem persists, contact support.');
            
            // Reload page
            setTimeout(() => location.reload(), 1000);
        });
    });
    
    // Handle modal cleanup
    document.getElementById('approveModal').addEventListener('hidden.bs.modal', function() {
        transactionItems = [];
        const tbody = document.querySelector('#modalTransactionTable tbody');
        if(tbody) tbody.innerHTML = '';
        document.getElementById('modalTransactionId').value = '';
        // Remove validation classes
        document.querySelectorAll('.modal-number').forEach(input => {
            input.classList.remove('is-invalid');
        });
    });
});
</script>

@endsection