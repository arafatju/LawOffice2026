{{-- resources/views/dashboard.blade.php --}}
@extends('common.master2')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* Custom Toastr Colors - Blue/Primary Theme */
    .toast-success {
        background-color: #0d6efd !important;
        color: white !important;
    }
    
    .toast-info {
        background-color: #0dcaf0 !important;
        color: white !important;
    }
    
    .toast-warning {
        background-color: #fd7e14 !important;
        color: white !important;
    }
    
    .toast-error {
        background-color: #dc3545 !important;
        color: white !important;
    }
    
    .toast-title {
        color: white !important;
        font-weight: bold !important;
    }
    
    .toast-message {
        color: white !important;
    }
    
    .toast-progress {
        background-color: rgba(255, 255, 255, 0.4) !important;
    }
    
    .toast-close-button {
        color: white !important;
        opacity: 0.8;
    }
    
    .toast-close-button:hover {
        opacity: 1;
    }

    /* Profile Card Styles */
    .profile-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        text-align: center;
        position: relative;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
        background-size: cover;
        opacity: 0.3;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        margin: 0 auto 1rem;
        border: 5px solid white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 1;
    }

    .profile-name {
        font-size: 1.8rem;
        font-weight: 600;
        margin: 0.5rem 0;
        position: relative;
        z-index: 1;
    }

    .profile-role {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
        backdrop-filter: blur(10px);
        position: relative;
        z-index: 1;
    }

    .profile-body {
        padding: 2rem;
    }

    .info-section {
        margin-bottom: 2rem;
    }

    .info-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #667eea;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-title i {
        font-size: 1.4rem;
    }

    .info-item {
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        border-left: 3px solid #667eea;
    }

    .info-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .info-label {
        font-weight: 600;
        color: #495057;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.3rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-label i {
        color: #667eea;
        font-size: 1rem;
    }

    .info-value {
        color: #212529;
        font-size: 1rem;
        margin: 0;
    }

    .print-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    
    .print-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        padding: 1.5rem;
        background: #f8f9fa;
        border-top: 1px solid #dee2e6;
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
        
        .no-print, .action-buttons {
            display: none !important;
        }
        
        .profile-card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
        
        .info-item {
            break-inside: avoid;
        }

        .profile-header {
            background: #667eea !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-avatar {
            width: 100px;
            height: 100px;
            font-size: 2.5rem;
        }

        .profile-name {
            font-size: 1.5rem;
        }

        .profile-body {
            padding: 1.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons button {
            width: 100%;
        }
    }
</style>

@section('content')
@section('title', 'Section Admin Management') 
@section('breadcrumb', 'Profile Management')

<h2 class="no-print mb-4">Profile of User</h2>

<div class="print-area">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card profile-card">
                    <!-- Profile Header -->
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3 class="profile-name">{{ $user->name }}</h3>
                        <span class="profile-role">
                            <i class="fas fa-shield-alt"></i> {{ ucfirst($user->role ?? 'User') }}
                        </span>
                    </div>

                    <!-- Profile Body -->
                    <div class="profile-body">
                        <!-- Contact Information -->
                        <div class="info-section">
                            <h5 class="info-title">
                                <i class="fas fa-address-card"></i>
                                Contact Information
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-envelope"></i>
                                            Email Address
                                        </div>
                                        <p class="info-value">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-mobile-alt"></i>
                                            Mobile Number
                                        </div>
                                        <p class="info-value">{{ $user->mobile ?? 'Not provided' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-map-marker-alt"></i>
                                            Location
                                        </div>
                                        <p class="info-value">{{ $user->location ?? 'Not provided' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-laptop"></i>
                                            Device
                                        </div>
                                        <p class="info-value">{{ $user->device ?? 'Not provided' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Professional Information -->
                        <div class="info-section">
                            <h5 class="info-title">
                                <i class="fas fa-briefcase"></i>
                                Professional Information
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-user-tie"></i>
                                            Officer/Staff Designation
                                        </div>
                                        <p class="info-value">{{ $user->personalinfo->designation ?? 'Not provided' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-user-shield"></i>
                                            Officer Designation
                                        </div>
                                        <p class="info-value">{{ $user->personalinfo->designation2 ?? 'Not provided' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-building"></i>
                                            Office
                                        </div>
                                        <p class="info-value">{{ $user->personalinfo->office ?? 'Not provided' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-id-badge"></i>
                                            User ID
                                        </div>
                                        <p class="info-value">{{ $user->userid }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Account Information -->
                        <div class="info-section">
                            <h5 class="info-title">
                                <i class="fas fa-info-circle"></i>
                                Account Information
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-calendar-plus"></i>
                                            Member Since
                                        </div>
                                        <p class="info-value">{{ $user->created_at->format('F j, Y') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-clock"></i>
                                            Last Updated
                                        </div>
                                        <p class="info-value">{{ $user->updated_at->format('F j, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Print timestamp -->
                        <div class="mt-4 text-center text-muted" style="display: none;" id="print-info">
                            <small><i class="fas fa-print"></i> Printed on: <span id="print-date"></span></small>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons no-print">
                        <button onclick="printProfile()" class="btn btn-primary print-btn" title="Print Profile">
                            <i class="fas fa-print"></i> Print Profile
                        </button>
                        <button onclick="window.history.back()" class="btn btn-outline-secondary" style="border-radius: 50px;">
                            <i class="fas fa-arrow-left"></i> Go Back
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configure toastr
    if (typeof toastr !== 'undefined') {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 3000
        };
    }
    
    // Print function
    window.printProfile = function() {
        try {
            const printInfo = document.getElementById('print-info');
            const printDate = document.getElementById('print-date');
            
            if (printInfo && printDate) {
                const now = new Date();
                printDate.textContent = now.toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                }) + ' at ' + now.toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                printInfo.style.display = 'block';
            }
            
            if (typeof toastr !== 'undefined') {
                toastr.info('Opening print dialog...', 'Print Profile');
            }
            
            setTimeout(() => {
                window.print();
            }, 300);
            
        } catch (error) {
            console.error('Print error:', error);
            alert('Unable to print. Please try using Ctrl+P.');
        }
    };
    
    // After print event
    window.addEventListener('afterprint', function() {
        const printInfo = document.getElementById('print-info');
        if (printInfo) {
            printInfo.style.display = 'none';
        }
        if (typeof toastr !== 'undefined') {
            toastr.success('Print completed!', 'Success');
        }
    });
    
    // Keyboard shortcut
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'p') {
            e.preventDefault();
            printProfile();
        }
    });
});
</script>

@endsection