{{-- resources/views/dashboard.blade.php --}}
@extends('common.dataentrydash')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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

    /* Print styles */
    @media print {
        body * {
            visibility: hidden;
        }
        
        .print-area, .print-area * {
            visibility: visible;
        }
        
        .print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        
        .no-print {
            display: none !important;
        }
        
        .card {
            border: 1px solid #ddd !important;
            box-shadow: none !important;
        }
        
        .badge {
            border: 1px solid #6c757d !important;
        }  
        
        h2, h3, h4, h5, h6 {
            color: #000 !important;
        }
        
        p {
            color: #333 !important;
        }
    }

    /* Print button stylesবদলী আদেশ ( জনাব মোঃ নুরে আলম,বিচারক, জেলা ও দায়রা জজ, সাইবার ট্রাইবুন্যাল,ঢাকা)  */
    .print-btn {
        background-color: #198754;
        border-color: #198754;
    }
    
    .print-btn:hover {
        background-color: #157347;
        border-color: #146c43;
    }
</style>

@section('content')

<h2 class="no-print">Profile of User</h2>

<div class="print-area">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>My Profile</h4>
                        <div class="d-flex gap-2">
                             
                            <!-- Fallback button if main one doesn't work -->
                            <button onclick="window.print()" class="btn btn-outline-success print-btn no-print" title="Direct Print">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Avatar -->
                        <div class="text-center mb-4">
                            <h3 class="mt-3">{{ $user->name }}</h3>
                            <span class="badge bg-secondary">{{ ucfirst($user->role ?? 'User') }}</span>
                        </div>

                        <!-- Profile Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <h6><strong>Email:</strong></h6>
                                <p>{{ $user->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Mobile:</strong></h6>
                                <p>{{ $user->mobile ?? 'Not provided' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Officer Staff Designation:</strong></h6>
                                <p>{{ $user->personalinfo->designation ?? 'Not provided' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Officer Designation:</strong></h6>
                                <p>{{ $user->personalinfo->designation2 ?? 'Not provided' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Location:</strong></h6>
                                <p>{{ $user->location ?? 'Not provided' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Device:</strong></h6>
                                <p>{{ $user->device ?? 'Not provided' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>User ID:</strong></h6>
                                <p>{{ $user->userid }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Member Since:</strong></h6>
                                <p>{{ $user->created_at->format('F j, Y') }}</p>
                            </div>
                        </div>
                        
                        <!-- Print timestamp (only visible when printed) -->
                        <div class="mt-4 text-muted" style="display: none;" id="print-info">
                            <small>Printed on: <span id="print-date"></span></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
// Ensure DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    
    // Make printProfile function global
    window.printProfile = function() {
        try {
            // Show print info with current date/time
            const printInfo = document.getElementById('print-info');
            const printDate = document.getElementById('print-date');
            
            if (printInfo && printDate) {
                printDate.textContent = new Date().toLocaleDateString() + ' ' + new Date().toLocaleTimeString();
                printInfo.style.display = 'block';
            }
            
            // Show success message if toastr is available
            if (typeof toastr !== 'undefined') {
                toastr.success('Opening print dialog...', 'Print Profile');
            }
            
            // Direct print call
            window.print();
            
            // Hide print info after a delay
            setTimeout(() => {
                if (printInfo) {
                    printInfo.style.display = 'none';
                }
            }, 2000);
            
        } catch (error) {
            console.error('Print error:', error);
            alert('Unable to print. Please try using Ctrl+P or right-click and select Print.');
        }
    };
    
    // Alternative direct print function
    window.printProfileDirect = function() {
        window.print();
    };
    
    // Listen for after print event
    window.addEventListener('afterprint', function() {
        if (typeof toastr !== 'undefined') {
            toastr.info('Print dialog closed', 'Print Status');
        }
    });
    
    window.addEventListener('beforeprint', function() {
        if (typeof toastr !== 'undefined') {
            toastr.info('Preparing to print...', 'Print Status');
        }
    });
    
    // Optional: Keyboard shortcut for printing (Ctrl+P)
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'p') {
            e.preventDefault();
            printProfile();
        }
    });
});

// Fallback function that can be called inline
function simplePrint() {
    window.print();
}
</script>

@endsection

