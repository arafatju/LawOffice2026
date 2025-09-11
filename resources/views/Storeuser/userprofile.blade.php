{{-- resources/views/dashboard.blade.php --}}
@extends('common.userdashboard')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-color: #667eea;
        --secondary-color: #764ba2;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --error-color: #ef4444;
        --info-color: #06b6d4;
        --card-shadow: 0 20px 40px rgba(0,0,0,0.1);
        --border-radius: 20px;
        --gradient-bg: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    body {
        background: var(--gradient-bg);
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .profile-container {
        padding: 2rem 0;
        min-height: 100vh;
    }

    .page-title {
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 3rem;
        text-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }

    .profile-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.15);
    }

    .profile-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
        0%, 100% { transform: rotate(0deg); }
        50% { transform: rotate(180deg); }
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ffffff, #f8fafc);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 3rem;
        color: var(--primary-color);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        position: relative;
        z-index: 1;
    }

    .profile-name {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .profile-role {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        z-index: 1;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .profile-body {
        padding: 3rem;
    }

    .info-section {
        margin-bottom: 2.5rem;
    }

    .section-title {
        color: var(--primary-color);
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 2px;
        background: linear-gradient(90deg, var(--primary-color), transparent);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .info-item {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 15px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        border-left: 4px solid var(--info-color);
        position: relative;
        overflow: hidden;
    }

    .info-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .info-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .info-item:hover::before {
        opacity: 1;
    }

    .info-label {
        font-weight: 600;
        color: #374151;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-value {
        color: #1f2937;
        font-size: 1.1rem;
        font-weight: 500;
        position: relative;
        z-index: 1;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .btn-enhanced {
        padding: 0.8rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
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

    .btn-print {
        background: linear-gradient(135deg, var(--success-color), #34d399);
        color: white;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .btn-print:hover {
        background: linear-gradient(135deg, #059669, var(--success-color));
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(16, 185, 129, 0.4);
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #5b21b6, var(--primary-color));
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
        color: white;
    }

    /* Stats Cards */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--gradient-bg);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--gradient-bg);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.2rem;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #6b7280;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Print Styles */
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
        
        .profile-card {
            background: white !important;
            box-shadow: none !important;
            border: 2px solid #ddd !important;
        }
        
        .profile-header {
            background: #f8f9fa !important;
            color: #333 !important;
        }
        
        .info-item {
            background: white !important;
            border: 1px solid #ddd !important;
        }
        
        .page-title {
            color: #333 !important;
            text-shadow: none !important;
        }
    }

    /* Toast Styles */
    .toast-success {
        background: linear-gradient(135deg, var(--success-color), #34d399) !important;
        color: white !important;
    }
    
    .toast-info {
        background: linear-gradient(135deg, var(--info-color), #38bdf8) !important;
        color: white !important;
    }
    
    .toast-warning {
        background: linear-gradient(135deg, var(--warning-color), #fbbf24) !important;
        color: white !important;
    }
    
    .toast-error {
        background: linear-gradient(135deg, var(--error-color), #f87171) !important;
        color: white !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .profile-container {
            padding: 1rem;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .profile-body {
            padding: 2rem 1.5rem;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-enhanced {
            width: 100%;
        }
    }

    /* Loading Animation */
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255,255,255,.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s ease-in-out infinite;
        margin-right: 8px;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

@section('content')
<div class="profile-container">
    <div class="container">
         

        <div class="print-area">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="profile-card fade-in">
                        <!-- Profile Header -->
                        <div class="profile-header">
                            <div class="profile-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <h2 class="profile-name">{{ $user->name }}</h2>
                            <span class="profile-role">{{ ucfirst($user->role ?? 'User') }}</span>
                        </div>

                        <!-- Profile Body -->
                        <div class="profile-body">
                            <!-- Quick Stats -->
                            <div class="stats-row no-print">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="stat-value">{{ $user->created_at->diffInDays() }}</div>
                                    <div class="stat-label">Days Active</div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="stat-value">{{ ucfirst($user->role ?? 'User') }}</div>
                                    <div class="stat-label">Account Type</div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="stat-value">{{ $user->created_at->format('M Y') }}</div>
                                    <div class="stat-label">Member Since</div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="info-section">
                                <h3 class="section-title">
                                    <i class="fas fa-address-card"></i>
                                    Contact Information
                                </h3>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-envelope"></i>
                                            Email Address
                                        </div>
                                        <div class="info-value">{{ $user->email }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-phone"></i>
                                            Mobile Number
                                        </div>
                                        <div class="info-value">{{ $user->mobile ?? 'Not provided' }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Professional Information -->
                            <div class="info-section">
                                <h3 class="section-title">
                                    <i class="fas fa-briefcase"></i>
                                    Professional Details
                                </h3>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-user-tie"></i>
                                            Staff Designation
                                        </div>
                                        <div class="info-value">{{ $user->personalinfo->designation ?? 'Not provided' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-crown"></i>
                                            Officer Designation
                                        </div>
                                        <div class="info-value">{{ $user->personalinfo->designation2 ?? 'Not provided' }}</div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-crown"></i>
                                            Office Name
                                        </div>
                                        <div class="info-value">{{ $user->personalinfo->office ?? 'Not provided' }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- System Information -->
                            <div class="info-section">
                                <h3 class="section-title">
                                    <i class="fas fa-cog"></i>
                                    System Information
                                </h3>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-map-marker-alt"></i>
                                            Location
                                        </div>
                                        <div class="info-value">{{ $user->location ?? 'Not provided' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-desktop"></i>
                                            Device
                                        </div>
                                        <div class="info-value">{{ $user->device ?? 'Not provided' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-id-card"></i>
                                            User ID
                                        </div>
                                        <div class="info-value">{{ $user->userid }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-calendar-plus"></i>
                                            Registration Date
                                        </div>
                                        <div class="info-value">{{ $user->created_at->format('F j, Y') }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            

                            <!-- Print timestamp (only visible when printed) -->
                            <div class="mt-4 text-center text-muted" style="display: none;" id="print-info">
                                <hr>
                                <small><i class="fas fa-clock me-1"></i>Generated on: <span id="print-date"></span></small>
                            </div>
                        </div>
                    </div>
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
    // Configure toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "showDuration": "300",
        "hideDuration": "1000",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // Enhanced print function
    window.printProfile = function() {
        const printBtn = $('#printBtn');
        const originalText = printBtn.html();
        
        // Show loading state
        printBtn.html('<span class="loading-spinner"></span>Preparing...');
        printBtn.prop('disabled', true);
        
        try {
            // Show print info with current date/time
            const printInfo = $('#print-info');
            const printDate = $('#print-date');
            
            if (printInfo.length && printDate.length) {
                const now = new Date();
                printDate.text(now.toLocaleDateString() + ' at ' + now.toLocaleTimeString());
                printInfo.show();
            }
            
            // Show success message
            toastr.success('Opening print dialog...', 'Print Profile');
            
            // Delay print to allow UI updates
            setTimeout(() => {
                window.print();
                
                // Reset button after print dialog
                setTimeout(() => {
                    printBtn.html(originalText);
                    printBtn.prop('disabled', false);
                    printInfo.hide();
                }, 1000);
            }, 500);
            
        } catch (error) {
            console.error('Print error:', error);
            toastr.error('Unable to print. Please try using Ctrl+P', 'Print Error');
            printBtn.html(originalText);
            printBtn.prop('disabled', false);
        }
    };

    // Print event listeners
    window.addEventListener('afterprint', function() {
        toastr.info('Print dialog closed', 'Print Status');
    });
    
    window.addEventListener('beforeprint', function() {
        toastr.info('Preparing document for printing...', 'Print Status');
    });

    // Keyboard shortcut for printing (Ctrl+P)
    $(document).on('keydown', function(e) {
        if (e.ctrlKey && e.key === 'p') {
            e.preventDefault();
            printProfile();
        }
    });

    // Welcome message
    
});

// Fallback print function
function simplePrint() {
    window.print();
}
</script>

@endsection