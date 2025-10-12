@extends('common.masterall')

@section('content')
@section('title', 'Section Admin Management ')

@section('breadcrumb', 'User Management')

<h2>Dashboard</h2>
<div class="row mt-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-info">Total  ordered </h5>
                <p>{{ $pending }}</p>
            </div>
        </div>
    </div>
    
    
   
</div>

<table class="table table-bordered">
    <thead>
        <tr class="bg-primary text-white">
            <th>প্রোডাক্ট আইডি</th>
            <th>প্রোডাক্ট নাম</th>
            <th>চাহিদা</th>
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
            <th>মাসিক বরাদ্দ</th>
            <th>মাসিক বিতরণ</th>
            <th>মজুদ আছে</th>
            <th>তারিখ</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pendingTransactions as $product)
        <tr data-transaction-id="{{ $product->id }}" data-user-id="{{ $product->userid }}">
            <td class="prcode">{{ enToBnNumber($product->prcode) }}</td>
            <td class="pname">{{ enToBnNumber(App\Http\Controllers\Storeuser::getProductDetails($product->prcode))  }}</td>
            <td class="number">{{ ($product->number) }}</td>
            <td>{{ (App\Http\Controllers\Storeuser::getAllotmentDetails($product->prcode,$product->userid)) }}</td>
            <td>{{ enToBnNumber(App\Http\Controllers\Storeuser::getTransactionDetails($product->prcode,$product->month,$product->userid)) }}</td>
            <td>{{ enToBnNumber(App\Http\Controllers\Storeentry::getStockDetails($product->prcode)) }}</td>
            <td>{{ enToBnNumber($product->created_at->format('d, M, Y')) }}</td>
            <td>
                <form action="{{ route('transactions.delete', $product->id) }}" method="POST" 
                      style="display: inline-block;" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($pendingTransactions->isNotEmpty())
<div class="mt-3 text-center">
    <button type="button" class="btn btn-primary" id="openApproveModalBtn" 
            data-id="{{ $pendingTransactions->first()->userid }}">
        <i class="fas fa-edit"></i> Edit All Items
    </button>
</div>
@endif

<!-- Edit Modal (No Approval) -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="approveModalLabel">
                    <i class="fas fa-edit"></i> Edit Transactions
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info mb-3">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Note:</strong> You can edit the quantities below. Changes will be saved without approval workflow.
                </div>
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
/* Modal styling */
#modalTransactionTable input[type="number"] {
    text-align: center;
    font-weight: 500;
}

#modalTransactionTable input[type="number"]:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.modal-body {
    max-height: 60vh;
    overflow-y: auto;
}

/* Responsive table */
@media (max-width: 768px) {
    .modal-dialog {
        margin: 0.5rem;
    }
    
    #modalTransactionTable {
        font-size: 0.875rem;
    }
}

/* Loading state */
.spinner-border-sm {
    width: 1rem;
    height: 1rem;
    border-width: 0.15em;
}

/* Table styling */
.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.025);
    cursor: default;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Store transaction items for editing
    let transactionItems = [];
    let approveModalInstance = null;
    
    // Initialize modal instance
    approveModalInstance = new bootstrap.Modal(document.getElementById('approveModal'));
    
    // Open modal button click handler
    document.getElementById('openApproveModalBtn').addEventListener('click', function() {
        const userId = this.getAttribute('data-id');
        
        console.log('Opening modal for user:', userId);
        
        document.getElementById('modalTransactionId').value = userId;
        
        // Clear modal table and reset items
        document.querySelector('#modalTransactionTable tbody').innerHTML = '';
        transactionItems = [];
        
        // Find all rows in table with same userId
        const rows = document.querySelectorAll('tr[data-user-id="' + userId + '"]');
        console.log('Found rows:', rows.length);
        
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
            rowHtml += '<td><input type="number" class="form-control modal-number" data-rowid="'+transactionId+'" value="'+number+'" min="0" step="1"></td>';
            rowHtml += '</tr>';
            
            document.querySelector('#modalTransactionTable tbody').insertAdjacentHTML('beforeend', rowHtml);
        });
        
        // Show modal
        approveModalInstance.show();
    });
    
    // Save button click handler (no approval, no print)
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
            // Parse JSON regardless of status code
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
                    // Partial success - some items saved, some failed
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
                    // Full success - all items saved
                    alert('All transactions updated successfully!');
                }
                
                // Reload page to show updated data
                setTimeout(() => location.reload(), 500);
                
            } else {
                // Complete failure - no items saved
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
        document.querySelector('#modalTransactionTable tbody').innerHTML = '';
        document.getElementById('modalTransactionId').value = '';
        // Remove validation classes
        document.querySelectorAll('.modal-number').forEach(input => {
            input.classList.remove('is-invalid');
        });
    });
});
</script>

@endsection