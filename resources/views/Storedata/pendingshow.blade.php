@extends('common.masterall')

@section('content')
@section('title', 'Section Admin Management ')

@section('breadcrumb', 'User Management')

<h2>Dashboard</h2>
<div class="row mt-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-info">Pending  Highest Office</h5>
                <p>Name 7</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-bold fw-bold text-success">Office Highest Order</h5>
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
                <h5 class="card-title fw-bold text-danger">Product going out of Stock</h5>
                <p class="card-text h6">
                    <div>Name 6</div>
                    Name 6<br>
                    Name 6
                </p>
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
            <td class="number">{{ enToBnNumber($product->number) }}</td>
            <td>{{ enToBnNumber(App\Http\Controllers\Storeuser::getAllotmentDetails($product->prcode,$product->userid)) }}</td>
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
    <button type="button" class="btn btn-success" id="openApproveModalBtn" 
            data-id="{{ $pendingTransactions->first()->userid }}">
        <i class="fas fa-check"></i> Approve All Items
    </button>
</div>
@endif

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel">Approve Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="modalTransactionTable">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Quantity Demand</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- JS will populate rows -->
                    </tbody>
                </table>
                <input type="hidden" id="modalTransactionId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="saveApprove">Save & Approve</button>
            </div>
        </div>
    </div>
</div>

<!-- Print Modal -->
<div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printModalLabel">Approved Items - Ready to Print</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="printContent">
                    <div class="print-header">
                        <h3>Transaction Approval Report</h3>
                        <p>Date: <span id="approvalDate"></span></p>
                        <p>User ID: <span id="approvedUserId"></span></p>
                    </div>
                    
                    <table class="table" id="printTable">
                        <thead>
                            <tr>
                                <th class="text-center">Serial No.</th>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th class="text-center">Approved Quantity</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- JS will populate approved items -->
                        </tbody>
                    </table>
                    
                    <div class="totals-section">
                        <p><strong>Total Items: <span id="totalItems">0</span></strong></p>
                        <p><strong>Total Quantity: <span id="totalQuantity">0</span></strong></p>
                    </div>
                    
                    <div class="signature-section">
                        <div class="signature-row">
                            <div class="signature-item">
                                <strong>Approved By</strong>
                            </div>
                            <div class="signature-item">
                                <strong>Date & Signature</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="printButton">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Print styles */
@media print {
    @page {
        margin: 3px;
    }
    
    body {
        margin: 0 !important;
        padding: 0 !important;
    }
    
    body * {
        visibility: hidden;
    }
    
    #printContent, #printContent * {
        visibility: visible;
    }
    
    #printContent {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        padding: 3px;
        margin: 0;
    }
    
    .print-header {
        text-align: center;
        margin-bottom: 10px;
    }
    
    .print-header h3 {
        font-size: 18px;
        margin: 3px 0;
        font-weight: bold;
    }
    
    .print-header p {
        margin: 2px 0;
        font-size: 12px;
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 10px 0;
        font-size: 11px;
    }
    
    .table th, .table td {
        border: 1px solid #000;
        padding: 4px;
        text-align: left;
    }
    
    .table th {
        background-color: #f8f9fa !important;
        font-weight: bold;
    }
    
    .text-center {
        text-align: center;
    }
    
    .totals-section {
        text-align: right;
        margin: 8px 0;
    }
    
    .totals-section p {
        margin: 2px 0;
        font-size: 12px;
    }
    
    .signature-section {
        margin-top: 20px;
        page-break-inside: avoid;
    }
    
    .signature-row {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
    }
    
    .signature-item {
        width: 45%;
        text-align: center;
        border-top: 1px solid #000;
        padding-top: 3px;
        font-weight: bold;
        font-size: 11px;
    }
    
    .badge {
        background-color: transparent !important;
        color: #000 !important;
        border: 1px solid #000 !important;
        padding: 1px 3px !important;
        font-size: 10px !important;
    }
}

.signature-section .border-top {
    margin-top: 40px;
    border-top: 1px solid #dee2e6;
}

.totals-section {
    text-align: right;
    margin: 20px 0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Store approved items for printing
    let approvedItems = [];
    let approveModalInstance = null;
    let printModalInstance = null;
    
    // Initialize modal instances
    approveModalInstance = new bootstrap.Modal(document.getElementById('approveModal'));
    printModalInstance = new bootstrap.Modal(document.getElementById('printModal'));
    
    // Open approve modal button click handler
    document.getElementById('openApproveModalBtn').addEventListener('click', function() {
        const userId = this.getAttribute('data-id');
        
        console.log('Opening modal for user:', userId);
        
        document.getElementById('modalTransactionId').value = userId;
        
        // Clear modal table and reset approved items
        document.querySelector('#modalTransactionTable tbody').innerHTML = '';
        approvedItems = [];
        
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
            approvedItems.push(itemData);
            
            let rowHtml = '<tr>';
            rowHtml += '<td>' + prcode + '</td>';
            rowHtml += '<td>' + pname + '</td>';
            rowHtml += '<td><input type="number" class="form-control modal-number" data-rowid="'+transactionId+'" value="'+number+'"></td>';
            rowHtml += '</tr>';
            
            document.querySelector('#modalTransactionTable tbody').insertAdjacentHTML('beforeend', rowHtml);
        });
        
        // Show modal
        approveModalInstance.show();
    });
    
    // Save & Approve button click handler
    document.getElementById('saveApprove').addEventListener('click', function() {
        const numbers = {};
        const modalNumbers = document.querySelectorAll('.modal-number');
        
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
        
        // Using fetch to send request
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
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Close approve modal
            approveModalInstance.hide();
            
            // Show success message
            alert('Transaction approved successfully!');
            
            // Prepare print data
            preparePrintModal(userId, numbers);
            
            // Show print modal
            printModalInstance.show();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Approval failed! Please try again.');
        });
    });
    
    // Prepare print modal with approved items
    function preparePrintModal(userId, approvedNumbers) {
        // Set header information
        const currentDate = new Date().toLocaleDateString('en-GB', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
        document.getElementById('approvalDate').textContent = currentDate;
        document.getElementById('approvedUserId').textContent = userId;
        
        // Clear print table
        document.querySelector('#printTable tbody').innerHTML = '';
        
        let totalItems = 0;
        let totalQuantity = 0;
        let serialNo = 1;
        
        // Populate print table with approved items
        const modalNumbers = document.querySelectorAll('.modal-number');
        modalNumbers.forEach(function(input) {
            const rowId = input.getAttribute('data-rowid');
            const approvedQty = approvedNumbers[rowId];
            
            // Find corresponding item data
            const itemData = approvedItems.find(item => item.transactionId == rowId);
            
            if (itemData && approvedQty > 0) {
                let printRowHtml = '<tr>';
                printRowHtml += '<td class="text-center">' + serialNo + '</td>';
                printRowHtml += '<td>' + itemData.prcode + '</td>';
                printRowHtml += '<td>' + itemData.pname + '</td>';
                printRowHtml += '<td class="text-center">' + approvedQty + '</td>';
                printRowHtml += '<td class="text-center"><span class="badge bg-success">Approved</span></td>';
                printRowHtml += '</tr>';
                
                document.querySelector('#printTable tbody').insertAdjacentHTML('beforeend', printRowHtml);
                
                totalItems++;
                totalQuantity += parseInt(approvedQty);
                serialNo++;
            }
        });
        
        // Update totals
        document.getElementById('totalItems').textContent = totalItems;
        document.getElementById('totalQuantity').textContent = totalQuantity;
    }
    
    // Print button click handler
    document.getElementById('printButton').addEventListener('click', function() {
        // Hide modal elements that shouldn't be printed
        document.querySelectorAll('.modal-header, .modal-footer').forEach(el => {
            el.style.display = 'none';
        });
        
        // Print the modal content
        window.print();
        
        // Restore modal elements after printing
        setTimeout(function() {
            document.querySelectorAll('.modal-header, .modal-footer').forEach(el => {
                el.style.display = '';
            });
            
            // Close print modal and reload page
            printModalInstance.hide();
            location.reload();
        }, 1000);
    });
    
    // Handle modal cleanup
    document.getElementById('approveModal').addEventListener('hidden.bs.modal', function() {
        approvedItems = [];
        document.querySelector('#modalTransactionTable tbody').innerHTML = '';
        document.getElementById('modalTransactionId').value = '';
    });
    
    document.getElementById('printModal').addEventListener('hidden.bs.modal', function() {
        approvedItems = [];
        document.querySelector('#printTable tbody').innerHTML = '';
    });
});
</script>

@endsection