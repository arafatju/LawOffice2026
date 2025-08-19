@extends('common.notary2')

@section('content')

<h2>Dashboard</h2>
<div class="row mt-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-info">Product Highest Order</h5>
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
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Quantity Demand</th>
            <th>Alloted</th>
            <th>Delivered</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pendingTransactions as $product)
        <tr data-transaction-id="{{ $product->id }}" data-user-id="{{ $product->userid }}">
            <td class="prcode">{{ $product->prcode }}</td>
            <td class="pname">{{ App\Http\Controllers\Storeuser::getProductDetails($product->prcode) }}</td>
            <td class="number" contenteditable="true">{{ $product->number }}</td>
            <td>{{ App\Http\Controllers\Storeuser::getAllotmentDetails($product->prcode,$product->userid) }}</td>
            <td>{{ App\Http\Controllers\Storeuser::getTransactionDetails($product->prcode,$product->month,$product->userid) }}</td>
            <td>{{ $product->created_at->format('d, M, Y') }}</td>
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
    <button class="btn btn-success openApproveModal" 
            data-id="{{ $pendingTransactions->first()->userid }}">
        <i class="fas fa-check"></i> Approve All Items
    </button>
</div>
@endif

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
<div class="modal fade" id="printModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approved Items - Ready to Print</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
    /* Remove default page margins */
    @page {
        margin: 3px;
    }
    
    /* Reset body margins */
    body {
        margin: 0 !important;
        padding: 0 !important;
    }
    
    /* Hide everything except the print content */
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
    
    /* Clean print layout */
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
    
    /* Table styling for print */
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
    
    /* Totals section */
    .totals-section {
        text-align: right;
        margin: 8px 0;
    }
    
    .totals-section p {
        margin: 2px 0;
        font-size: 12px;
    }
    
    /* Signature section */
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
    
    /* Remove Bootstrap classes that might interfere */
    .badge {
        background-color: transparent !important;
        color: #000 !important;
        border: 1px solid #000 !important;
        padding: 1px 3px !important;
        font-size: 10px !important;
    }
}

/* Screen styles */
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
$(document).ready(function(){
    // Store approved items for printing
    var approvedItems = [];
    
    // Open modal and populate rows for that transaction/user
    $('.openApproveModal').click(function(){
        var userId = $(this).data('id');
        $('#modalTransactionId').val(userId);

        // Clear modal table and reset approved items
        $('#modalTransactionTable tbody').html('');
        approvedItems = [];

        // Find all rows in table with same userId
        $('tr[data-user-id="' + userId + '"]').each(function(){
            var transactionId = $(this).data('transaction-id');
            var prcode = $(this).find('.prcode').text().trim();
            var pname = $(this).find('.pname').text().trim();
            var number = $(this).find('.number').text().trim();

            // Store item data for later use
            var itemData = {
                transactionId: transactionId,
                prcode: prcode,
                pname: pname,
                number: number
            };
            approvedItems.push(itemData);

            var rowHtml = '<tr>';
            rowHtml += '<td>' + prcode + '</td>';
            rowHtml += '<td>' + pname + '</td>';
            rowHtml += '<td><input type="number" class="form-control modal-number" data-rowid="'+transactionId+'" value="'+number+'"></td>';
            rowHtml += '</tr>';

            $('#modalTransactionTable tbody').append(rowHtml);
        });

        $('#approveModal').modal('show');
    });

    // Save & Approve
    $('#saveApprove').click(function(){
        var numbers = {};

        $('.modal-number').each(function(){
            var rowId = $(this).data('rowid');
            var number = $(this).val();
            numbers[rowId] = number;
        });

        var userId = $('#modalTransactionId').val();

        $.ajax({
            url: "{{ route('transactions.approveMultiple') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: userId,
                numbers: numbers
            },
            success: function(response){
                // Close approve modal
                $('#approveModal').modal('hide');
                
                // Show success message
                alert('Transaction approved successfully!');
                
                // Prepare print data
                preparePrintModal(userId, numbers);
                
                // Show print modal
                $('#printModal').modal('show');
            },
            error: function(xhr, status, error){
                console.log('Error:', xhr.responseText);
                alert('Approval failed! Please try again.');
            }
        });
    });

    // Prepare print modal with approved items
    function preparePrintModal(userId, approvedNumbers) {
        // Set header information
        var currentDate = new Date().toLocaleDateString('en-GB', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
        $('#approvalDate').text(currentDate);
        $('#approvedUserId').text(userId);

        // Clear print table
        $('#printTable tbody').html('');

        var totalItems = 0;
        var totalQuantity = 0;
        var serialNo = 1;

        // Populate print table with approved items
        $('.modal-number').each(function(){
            var rowId = $(this).data('rowid');
            var approvedQty = approvedNumbers[rowId];
            
            // Find corresponding item data
            var itemData = approvedItems.find(item => item.transactionId == rowId);
            
            if (itemData && approvedQty > 0) {
                var printRowHtml = '<tr>';
                printRowHtml += '<td class="text-center">' + serialNo + '</td>';
                printRowHtml += '<td>' + itemData.prcode + '</td>';
                printRowHtml += '<td>' + itemData.pname + '</td>';
                printRowHtml += '<td class="text-center">' + approvedQty + '</td>';
                printRowHtml += '<td class="text-center"><span class="badge bg-success">Approved</span></td>';
                printRowHtml += '</tr>';

                $('#printTable tbody').append(printRowHtml);
                
                totalItems++;
                totalQuantity += parseInt(approvedQty);
                serialNo++;
            }
        });

        // Update totals
        $('#totalItems').text(totalItems);
        $('#totalQuantity').text(totalQuantity);
    }

    // Print function
    $('#printButton').click(function(){
        // Hide modal elements that shouldn't be printed
        $('.modal-header, .modal-footer').addClass('no-print');
        
        // Print the modal content
        window.print();
        
        // Restore modal elements after printing
        setTimeout(function(){
            $('.modal-header, .modal-footer').removeClass('no-print');
            
            // Close print modal and reload page
            $('#printModal').modal('hide');
            location.reload();
        }, 1000);
    });

    // Handle modal cleanup
    $('#printModal').on('hidden.bs.modal', function() {
        approvedItems = [];
    });
});
</script>

@endsection