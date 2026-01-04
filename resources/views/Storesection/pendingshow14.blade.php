 @extends('common.master2')

@section('content')
@section('title', 'Section Admin Management')

@section('breadcrumb', 'User Management')

<!-- Inject Fonts and Icons -->
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* --- Base Styles & Typography --- */
    :root {
        --primary-color: #4361ee;
        --primary-hover: #3a56d4;
        --success-color: #2ec4b6;
        --danger-color: #ef476f;
        --text-main: #2b2d42;
        --text-light: #8d99ae;
        --bg-body: #f8f9fa;
        --card-shadow: 0 4px 20px rgba(0,0,0,0.05);
        --border-radius: 12px;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-body);
        color: var(--text-main);
    }

    /* Helper for Bangla text */
    .font-bn {
        font-family: 'Hind Siliguri', sans-serif;
    }

    /* --- Dashboard Header --- */
    .page-header {
        margin-bottom: 24px;
    }
    
    .page-header h2 {
        font-weight: 700;
        font-size: 1.75rem;
        color: var(--text-main);
        margin: 0;
    }

    /* --- Stats Cards --- */
    .stat-card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        overflow: hidden;
        background: white;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .stat-card .card-body {
        padding: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-info h5 {
        font-weight: 600;
        color: var(--text-light);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .stat-info p {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        color: var(--text-main);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .bg-light-info { background-color: rgba(67, 97, 238, 0.1); color: var(--primary-color); }
    .bg-light-success { background-color: rgba(46, 196, 182, 0.1); color: var(--success-color); }

    /* --- Main Table --- */
    .table-container {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        padding: 24px;
        overflow: hidden;
    }

    .custom-table thead th {
        background-color: #f1f5f9;
        color: var(--text-main);
        font-weight: 600;
        border-bottom: 2px solid #e2e8f0;
        padding: 16px;
        font-size: 0.9rem;
        vertical-align: middle;
    }

    .custom-table tbody td {
        padding: 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: var(--text-main);
        transition: background 0.2s;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fafc;
    }

    .btn-action {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        transition: all 0.2s;
    }

    /* --- Modals --- */
    .modal-content {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    }

    .modal-header {
        border-bottom: 1px solid #f1f5f9;
        padding: 20px 24px;
    }

    .modal-title {
        font-weight: 700;
        color: var(--text-main);
    }

    .modal-body {
        padding: 24px;
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        border-color: var(--primary-color);
    }

    /* --- Toast Notifications --- */
    #toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }
    
    .toast {
        background: white;
        padding: 16px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        min-width: 300px;
        border-left: 4px solid #ccc;
        animation: slideIn 0.3s ease-out;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .toast.show { opacity: 1; }
    
    .toast.success { border-left-color: var(--success-color); }
    .toast.error { border-left-color: var(--danger-color); }
    .toast.warning { border-left-color: #ff9f1c; }
    
    .toast-icon { margin-right: 12px; font-size: 1.2rem; }
    .toast.success .toast-icon { color: var(--success-color); }
    .toast.error .toast-icon { color: var(--danger-color); }
    
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    /* --- Print Styles --- */
    @media print {
        @page { margin: 10mm; size: A4 portrait; }
        body { background: white; -webkit-print-color-adjust: exact; }
        
        /* Hide UI Elements */
        .no-print, .stat-card, .table-actions, .page-header, 
        .modal-header .btn-close, .modal-footer, #toast-container {
            display: none !important;
        }
        
        .modal { position: static; display: block; overflow: visible; }
        .modal-dialog { max-width: 100%; margin: 0; }
        .modal-content { box-shadow: none; border: none; }
        .modal-body { padding: 0; }
        
        /* Print Specific Styling */
        #printContent {
            padding: 20px;
            border: 2px solid #000;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }
        
        .print-header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .print-header h3 { margin: 0; font-size: 22px; font-family: 'Hind Siliguri', sans-serif; }
        .print-meta { display: flex; justify-content: space-between; margin-top: 10px; font-size: 14px; }
        
        #printTable { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        #printTable th, #printTable td { border: 1px solid #000; padding: 8px; text-align: left; }
        #printTable th { background-color: #f0f0f0 !important; font-weight: bold; font-size: 13px; }
        #printTable td { font-size: 13px; }
        .text-center { text-align: center; }
        
        .signature-section { margin-top: 50px; display: flex; justify-content: space-between; }
        .sign-box { width: 40%; text-align: center; border-top: 1px solid #000; padding-top: 5px; font-weight: bold; }
    }
</style>

<div class="container-fluid">
    <!-- Header -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <h2>Dashboard</h2>
        <div class="d-flex align-items-center text-muted">
            <span class="me-2"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::now()->format('d M Y') }}</span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="stat-info">
                        <h5>Total Accepted</h5>
                        <p>{{ $totalaccepted }}</p>
                    </div>
                    <div class="stat-icon bg-light-info">
                        <i class="fas fa-box-open"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="stat-info">
                        <h5>Highest Order</h5>
                        <p class=" mb-0 text-truncate" style="max-width: 550px;">
                            {{ $product111->name ?? 'N/A' }}
                        </p>
                        <small class="text-muted">Qty: {{ $highest->number ?? '0' }}</small>
                    </div>
                    <div class="stat-icon bg-light-success">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Table -->
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="font-bn m-0">মুলতবি থাকা ডিমান্ড লিস্ট</h4>
            @if($pendingTransactions->isNotEmpty())
            <button type="button" class="btn btn-primary px-4" id="openApproveModalBtn" 
                    data-id="{{ $pendingTransactions->first()->userid }}">
                <i class="fas fa-check-circle me-2"></i> Approve All
            </button>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table custom-table table-hover">
                <thead>
                    <tr>
                        <th >প্রোডাক্ট আইডি</th>
                        <th >প্রোডাক্ট নাম</th>
                        <th >চাহিদা</th>
                        <th >মাসিক বরাদ্দ</th>
                        <th >মাসিক বিতরণ</th>
                        <th >মজুদ আছে</th>
                        <th >তারিখ</th>
                        <th class="table-actions text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        function enToBnNumber($number) {
                            $english = ['0','1','2','3','4','5','6','7','8','9'];
                            $bangla  = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
                            return str_replace($english, $bangla, $number);
                        }
                    @endphp
                    @foreach($pendingTransactions as $product)
                    <tr data-transaction-id="{{ $product->id }}" data-user-id="{{ $product->userid }}">
                        <td >{{ enToBnNumber($product->prcode) }}</td>
                        <td class="fw-bold">{{ enToBnNumber(App\Http\Controllers\Storeuser::getProductDetails($product->prcode)) }}</td>
                        <td > {{ $product->number }}</span></td>
                        <td >{{ (App\Http\Controllers\StoreSectionadmin::getAllotmentDetails14($product->prcode,$product->userid)) }}</td>
                        <td >{{ enToBnNumber(App\Http\Controllers\StoreSectionadmin::getTransactionDetails14($product->prcode,$product->month,$product->userid)) }}</td>
                        <td >{{ enToBnNumber(App\Http\Controllers\StoreSectionadmin::getStockDetails14($product->prcode)) }}</td>
                        <td >{{ enToBnNumber($product->created_at->format('d M Y')) }}</td>
                        <td class="table-actions">
                            <form action="{{ route('transactions144.delete', $product->id) }}" method="POST" 
                                  class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-action btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($pendingTransactions->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="fas fa-inbox fa-3x mb-3 opacity-25"></i>
                <p>No pending transactions found.</p>
            </div>
        @endif
    </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-bn"><i class="fas fa-tasks me-2"></i>Approve Demand List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info py-2 small">
                    <i class="fas fa-info-circle me-1"></i> Review quantities before approving.
                </div>
                <div class="table-responsive" style="max-height: 50vh; overflow-y: auto;">
                    <table class="table table-sm table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="font-bn">প্রোডাক্ট</th>
                                <th class="font-bn">চাহিদা</th>
                                <th class="font-bn">অনুমোদন</th>
                            </tr>
                        </thead>
                        <tbody id="modalTransactionTableBody">
                            <!-- Populated by JS -->
                        </tbody>
                    </table>
                </div>
                <input type="hidden" id="modalTransactionId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary px-4" id="saveApprove">
                    <i class="fas fa-check me-2"></i>Approve & Print
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Print Modal (Hidden until needed) -->
<div class="modal fade" id="printModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header no-print">
                <h5 class="modal-title">Print Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-white">
                <div id="printContent">
                    <div class="print-header">
                        <h3>সেকশন অফিসের মালামাল বিতরণ মেমো</h3>
                        <div class="print-meta font-bn">
                            <span>তারিখ: <span id="approvalDate"></span></span>
                            <span>ইউজার আইডি: <span id="approvedUserId"></span></span>
                        </div>
                    </div>
                    
                    <table class="table" id="printTable">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">ক্রমিক</th>
                                <th style="width: 100px;">প্রোডাক্ট আইডি</th>
                                <th>প্রোডাক্টের নাম</th>
                                <th class="text-center" style="width: 100px;">অনুমোদিত পরিমাণ</th>
                                <th class="text-center" style="width: 100px;">মন্তব্য</th>
                            </tr>
                        </thead>
                        <tbody class="font-bn">
                            <!-- JS will populate -->
                        </tbody>
                    </table>
                    
                    <div class="font-bn" style="text-align: right; margin: 15px 0;">
                        <strong>মোট পণ্য: <span id="totalItems">0</span> টি</strong> &nbsp;|&nbsp; 
                        <strong>মোট পরিমাণ: <span id="totalQuantity">0</span></strong>
                    </div>
                    
                    <div class="signature-section font-bn">
                        <div class="sign-box">গ্রহীতার স্বাক্ষর</div>
                        <div class="sign-box">অনুমোদনকারীর স্বাক্ষর</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer no-print">
                <button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" id="printButton">
                    <i class="fas fa-print me-2"></i> Print Document
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div id="toast-container"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- State Management ---
    let approvedItems = [];
    let approveModalInstance;
    let printModalInstance;
    
    // --- Helpers: Toast Notification ---
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        
        let iconClass = 'fa-check-circle';
        if(type === 'error') iconClass = 'fa-exclamation-circle';
        if(type === 'warning') iconClass = 'fa-exclamation-triangle';
        
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <i class="fas ${iconClass} toast-icon"></i>
            <div class="toast-message small text-secondary">${message}</div>
        `;
        
        container.appendChild(toast);
        
        // Animate in
        requestAnimationFrame(() => toast.classList.add('show'));
        
        // Remove after 4 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    }

    // --- Initialization ---
    try {
        approveModalInstance = new bootstrap.Modal(document.getElementById('approveModal'));
        printModalInstance = new bootstrap.Modal(document.getElementById('printModal'));
    } catch (e) {
        console.error('Bootstrap modal initialization failed', e);
    }

    // --- Open Approve Modal ---
    document.getElementById('openApproveModalBtn').addEventListener('click', function() {
        const userId = this.getAttribute('data-id');
        document.getElementById('modalTransactionId').value = userId;
        
        // Reset state
        document.querySelector('#modalTransactionTableBody').innerHTML = '';
        approvedItems = [];
        
        // Gather data
        const rows = document.querySelectorAll('tr[data-user-id="' + userId + '"]');
        
        if (rows.length === 0) {
            showToast('No items found for this user', 'warning');
            return;
        }
        
        rows.forEach(function(row) {
            const transactionId = row.getAttribute('data-transaction-id');
            const prcode = row.querySelector('td:first-child').textContent.trim();
            const pname = row.querySelector('td:nth-child(2)').textContent.trim();
            const number = row.querySelector('td:nth-child(3)').textContent.trim(); // Raw number
            
            approvedItems.push({ transactionId, prcode, pname, number });
            
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${pname}<br><small class="text-muted">${prcode}</small></td>
                <td class="text-center">${number}</td>
                <td>
                    <input type="number" class="form-control form-control-sm modal-number" 
                           data-rowid="${transactionId}" value="${number}" min="0">
                </td>
            `;
            document.querySelector('#modalTransactionTableBody').appendChild(tr);
        });
        
        approveModalInstance.show();
    });
    
    // --- Save & Approve Logic ---
    document.getElementById('saveApprove').addEventListener('click', function() {
        const numbers = {};
        const inputs = document.querySelectorAll('.modal-number');
        
        inputs.forEach(input => {
            numbers[input.getAttribute('data-rowid')] = input.value;
        });
        
        const userId = document.getElementById('modalTransactionId').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        
        if (!csrfToken) return alert('CSRF token missing');
        
        // UI Loading State
        const btn = this;
        const originalContent = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
        
        fetch("{{ route('transactions.approveMultiple14') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.getAttribute('content')
            },
            body: JSON.stringify({ id: userId, numbers: numbers })
        })
        .then(res => res.json().then(data => ({ status: res.status, ok: res.ok, data })))
        .then(({ status, ok, data }) => {
            btn.disabled = false;
            btn.innerHTML = originalContent;
            approveModalInstance.hide();
            
            if (data.success) {
                if (data.partial) {
                    // Partial Success
                    showToast(`Partial Success: ${data.approved} approved, ${data.failed} failed`, 'warning');
                    preparePrintModal(userId, numbers, data.failedItems);
                    printModalInstance.show();
                } else {
                    // Full Success
                    showToast('All transactions approved successfully!');
                    preparePrintModal(userId, numbers, []);
                    printModalInstance.show();
                }
            } else {
                // Failure
                let msg = data.message || 'Approval failed.';
                if (data.failedItems && data.failedItems.length > 0) {
                    msg += '\n\nমজুদ সংকট:\n' + data.failedItems.map(i => `- ${i.productName || i.prcode}`).join('\n');
                }
                alert(msg); // Using alert for complex errors as requested fallback
                setTimeout(() => location.reload(), 2000);
            }
        })
        .catch(error => {
            console.error(error);
            btn.disabled = false;
            btn.innerHTML = originalContent;
            approveModalInstance.hide();
            showToast('Network error. Please try again.', 'error');
        });
    });
    
    // --- Prepare Print Modal ---
    function preparePrintModal(userId, approvedNumbers, failedItems) {
        const failedRowIds = failedItems.map(item => item.rowId);
        
        // Set Header
        const dateStr = new Date().toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
        document.getElementById('approvalDate').textContent = dateStr;
        document.getElementById('approvedUserId').textContent = userId;
        
        // Reset Table
        const tbody = document.querySelector('#printTable tbody');
        tbody.innerHTML = '';
        
        let totalItems = 0;
        let totalQty = 0;
        let serial = 1;
        
        approvedItems.forEach(item => {
            const rowId = item.transactionId;
            const qty = approvedNumbers[rowId];
            
            if (failedRowIds.includes(rowId) || qty <= 0) return;
            
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="text-center">${serial++}</td>
                <td>${item.prcode}</td>
                <td>${item.pname}</td>
                <td class="text-center fw-bold">${qty}</td>
                <td class="text-center"><span class="badge bg-light-success text-success">Approved</span></td>
            `;
            tbody.appendChild(tr);
            
            totalItems++;
            totalQty += parseInt(qty);
        });
        
        document.getElementById('totalItems').textContent = enToBn(totalItems.toString());
        document.getElementById('totalQuantity').textContent = enToBn(totalQty.toString());
    }
    
    // Helper to keep print consistent with view
    function enToBn(n) {
        const en = ['0','1','2','3','4','5','6','7','8','9'];
        const bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return n.replace(/\d/g, d => bn[en.indexOf(d)]);
    }
    
    // --- Print Action ---
    document.getElementById('printButton').addEventListener('click', function() {
        if (parseInt(document.getElementById('totalItems').textContent) === 0) {
            showToast('No items to print', 'error');
            return;
        }
        window.print();
    });

    // Cleanup modals on close to prevent state bleeding
    document.getElementById('printModal').addEventListener('hidden.bs.modal', function () {
        location.reload(); // Refresh to reflect changes in DB
    });
});
</script>

@endsection