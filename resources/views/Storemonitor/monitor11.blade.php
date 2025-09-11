@extends('common.adminmonitor')

@section('content')
<style>
@media print {
    body * {
        visibility: hidden;
    }
    .print-area, .print-area * {
        visibility: visible;
    }
    .print-area {
        position: static !important;
        left: 0;
        top: 0;
        width: 100% !important;
        margin: 0 !important;
        padding: 15px !important;
    }
    .no-print {
        display: none !important;
    }
    .print-area table {
        width: 100% !important;
        font-size: 11px !important;
        border-collapse: collapse !important;
        page-break-inside: auto !important;
    }
    .print-area tr {
        page-break-inside: avoid !important;
        page-break-after: auto !important;
    }
    .print-area thead {
        display: table-header-group !important;
    }
    .print-area th,
    .print-area td {
        padding: 6px 4px !important;
        border: 1px solid #000 !important;
        font-size: 11px !important;
    }
    .print-area th {
        background-color: #0d6efd !important;
        color: white !important;
        font-weight: bold !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    @page {
        margin: 0.5in;
        size: A4;
    }
    .print-area h2 {
        font-size: 18px !important;
        margin-bottom: 15px !important;
        page-break-after: avoid !important;
    }
}

/* Dashboard Card Enhancements */
.dashboard-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border: none;
    border-radius: 15px;
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    min-height: 140px;
}

.dashboard-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--card-gradient));
    border-radius: 15px 15px 0 0;
}

.dashboard-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

/* Card Color Themes */
.card-success::before {
    --card-gradient: #28a745, #20c997;
}

.card-primary::before {
    --card-gradient: #007bff, #6610f2;
}

.card-danger::before {
    --card-gradient: #dc3545, #fd7e14;
}

.card-warning::before {
    --card-gradient: #ffc107, #fd7e14;
}

.card-info::before {
    --card-gradient: #17a2b8, #6f42c1;
}

.card-secondary::before {
    --card-gradient: #6c757d, #495057;
}

.dashboard-card .card-body {
    padding: 1.75rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

.card-icon {
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 2.5rem;
    opacity: 0.15;
    transition: all 0.3s ease;
}

.dashboard-card:hover .card-icon {
    opacity: 0.25;
    transform: scale(1.1);
}

.card-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    line-height: 1.3;
    position: relative;
    z-index: 2;
}

.card-value {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0;
    position: relative;
    z-index: 2;
}

.card-subtitle {
    font-size: 0.85rem;
    margin-top: 0.5rem;
    opacity: 0.8;
}

/* Section Headers */
.section-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    text-align: center;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.section-header h3 {
    margin: 0;
    font-weight: 600;
    font-size: 1.5rem;
}

/* Enhanced Table */
.enhanced-table-container {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    margin-top: 2rem;
}

.enhanced-table {
    margin: 0;
    border: none;
}

.enhanced-table thead th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-weight: 600;
    padding: 1.25rem 1rem;
    border: none;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.enhanced-table tbody td {
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
    vertical-align: middle;
    font-size: 0.9rem;
}

.enhanced-table tbody tr {
    transition: all 0.3s ease;
}

.enhanced-table tbody tr:hover {
    background: linear-gradient(90deg, #f8f9fa 0%, #e9ecef 100%);
    transform: scale(1.01);
}

.enhanced-table tbody tr:last-child td {
    border-bottom: none;
}

/* Status Badges */
.status-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-userone {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
}

.status-userdataentry {
    background: linear-gradient(45deg, #17a2b8, #6610f2);
    color: white;
}

.status-useradmin {
    background: linear-gradient(45deg, #dc3545, #fd7e14);
    color: white;
}

.status-usermonitor {
    background: linear-gradient(45deg, #ffc107, #fd7e14);
    color: #212529;
}

.status-default {
    background: linear-gradient(45deg, #6c757d, #495057);
    color: white;
}

/* Buttons */
.btn-enhanced {
    border-radius: 25px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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

.btn-enhanced:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.btn-print {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

/* Loading Animation */
.fade-in {
    animation: fadeInUp 0.6s ease-out forwards;
    opacity: 0;
    transform: translateY(30px);
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-card {
        min-height: 120px;
        margin-bottom: 1rem;
    }
    
    .card-value {
        font-size: 1.8rem;
    }
    
    .card-title {
        font-size: 0.9rem;
    }
    
    .card-icon {
        font-size: 2rem;
    }
    
    .enhanced-table thead th,
    .enhanced-table tbody td {
        padding: 0.75rem 0.5rem;
        font-size: 0.8rem;
    }
}

/* Stats Overview */
.stats-overview {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    border-radius: 15px;
    margin-bottom: 2rem;
    text-align: center;
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    display: block;
}

.stat-label {
    font-size: 0.85rem;
    opacity: 0.9;
    margin-top: 0.5rem;
}
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="section-header">
        <h3><i class="fas fa-tachometer-alt me-2"></i>Dashboard Overview</h3>
    </div>

    <!-- Stats Overview -->
    <div class="stats-overview">
        <h4 class="mb-0">System Statistics</h4>
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number">{{ $userCount }}</span>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $pendingCount }}</span>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $approvedCount }}</span>
                <div class="stat-label">Approved</div>
            </div>
        </div>
    </div>

    <!-- Order Statistics Row -->
    <div class="section-header" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
        <h3><i class="fas fa-chart-line me-2"></i>Order Statistics</h3>
    </div>
    
    <div class="row g-4 mb-5">
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card dashboard-card card-success">
                <i class="fas fa-trophy card-icon text-success"></i>
                <div class="card-body">
                    <h5 class="card-title text-success">প্রোডাক্ট সর্বাধিক অর্ডার</h5>
                    <p class="card-value text-success">{{ $highestProduct->total_quantity ?? 0 }}</p>
                    <p class="card-subtitle text-success">{{ $highestProduct->product->name ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card dashboard-card card-success">
                <i class="fas fa-building card-icon text-success"></i>
                <div class="card-body">
                    <h5 class="card-title text-success">অফিস সর্বাধিক অর্ডার</h5>
                    <p class="card-value text-success">{{ $highestOffice->total_quantity ?? 0 }}</p>
                    <p class="card-subtitle text-success">{{ $highestOffice->office ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Statistics Row -->
    <div class="section-header" style="background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);">
        <h3><i class="fas fa-file-alt me-2"></i>Application Statistics</h3>
    </div>
    
    <div class="row g-4 mb-5">
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card dashboard-card card-primary">
                <i class="fas fa-clock card-icon text-primary"></i>
                <div class="card-body">
                    <h5 class="card-title text-primary">অপেক্ষমাণ আবেদন</h5>
                    <p class="card-value text-primary">{{ $pendingCount }}</p>
                    <p class="card-subtitle text-primary">Pending Applications</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card dashboard-card card-danger">
                <i class="fas fa-check-circle card-icon text-danger"></i>
                <div class="card-body">
                    <h5 class="card-title text-danger">গৃহীত আবেদন পত্র</h5>
                    <p class="card-value text-danger">{{ $approvedCount }}</p>
                    <p class="card-subtitle text-danger">Approved Applications</p>
                </div>
            </div>
        </div>
    </div>

    <!-- User Management Row -->
    <div class="section-header" style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);">
        <h3><i class="fas fa-users me-2"></i>User Management</h3>
    </div>
    
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card card-success">
                <i class="fas fa-users card-icon text-success"></i>
                <div class="card-body">
                    <h5 class="card-title text-success">মোট ব্যবহারকারী</h5>
                    <p class="card-value text-success">{{ $userCount }}</p>
                    <p class="card-subtitle text-success">Total Users</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card card-info">
                <i class="fas fa-user-shield card-icon text-info"></i>
                <div class="card-body">
                    <h5 class="card-title text-info">অ্যাডমিন মনিটর</h5>
                    <p class="card-value text-info">{{ $useradmin }}</p>
                    <p class="card-subtitle text-info">Admin Monitors</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card card-primary">
                <i class="fas fa-user card-icon text-primary"></i>
                <div class="card-body">
                    <h5 class="card-title text-primary">সাধারণ ব্যবহারকারী</h5>
                    <p class="card-value text-primary">{{ $userone111 }}</p>
                    <p class="card-subtitle text-primary">General Users</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card card-danger">
                <i class="fas fa-crown card-icon text-danger"></i>
                <div class="card-body">
                    <h5 class="card-title text-danger">সুপার অ্যাডমিন</h5>
                    <p class="card-value text-danger">{{ $usersuper111 }}</p>
                    <p class="card-subtitle text-danger">Super Admins</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Info Row -->
    <div class="row g-4 mb-5">
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card dashboard-card card-warning">
                <i class="fas fa-user-cog card-icon text-warning"></i>
                <div class="card-body">
                    <h5 class="card-title text-warning">সেকশন অ্যাডমিন</h5>
                    <p class="card-value text-warning">{{ $userdata111 }}</p>
                    <p class="card-subtitle text-warning">Section Admins</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card dashboard-card card-secondary">
                <i class="fas fa-sign-in-alt card-icon text-secondary"></i>
                <div class="card-body">
                    <h5 class="card-title text-secondary">Last Login</h5>
                    <p class="card-value text-secondary" style="font-size: 1.4rem;">
                        {{ \Carbon\Carbon::parse($lastLogin)->format('d M Y') }}
                    </p>
                    <p class="card-subtitle text-secondary">{{ \Carbon\Carbon::parse($lastLogin)->format('h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Button -->
    <div class="d-flex justify-content-end mb-4 no-print">
        <button onclick="window.print()" class="btn btn-enhanced btn-print">
            <i class="fas fa-print me-2"></i> প্রিন্ট
        </button>
    </div>

    <!-- Enhanced Table -->
    <div class="print-area">
        <h2 class="text-center mb-4">
            <i class="fas fa-users me-2 text-primary"></i>
            Users Information
        </h2>
        
        <div class="enhanced-table-container">
            <table class="table enhanced-table text-center">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag me-1"></i>ক্রমিক নং</th>
                        <th><i class="fas fa-building me-1"></i>দপ্তর</th>
                        <th><i class="fas fa-user me-1"></i>নাম</th>
                        <th><i class="fas fa-phone me-1"></i>মোবাইল</th>
                        <th><i class="fas fa-envelope me-1"></i>ইমেইল</th>
                        <th><i class="fas fa-user-tag me-1"></i>স্ট্যাটাস</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user44)
                        <tr>
                            <td class="fw-bold">{{ $loop->iteration }}</td>
                            <td>{{ $user44->personalinfo->office }}</td>
                            <td class="fw-medium">{{ $user44->name }}</td>
                            <td class="font-monospace">{{ $user44->mobile }}</td>
                            <td>{{ $user44->email }}</td>
                            <td>
                                @switch($user44->role)
                                    @case('userone')
                                        <span class="status-badge status-userone">সাধারণ ব্যবহারকারী</span>
                                        @break
                                    @case('userdataentry')
                                        <span class="status-badge status-userdataentry">তথ্য এন্ট্রি ব্যবহারকারী</span>
                                        @break
                                    @case('useradmin')
                                        <span class="status-badge status-useradmin">সুপার অ্যাডমিন</span>
                                        @break
                                    @case('usermonitor')
                                        <span class="status-badge status-usermonitor">অ্যাডমিন মনিটর</span>
                                        @break
                                    @default
                                        <span class="status-badge status-default">অপেক্ষমাণ ব্যবহারকারী</span>
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add entrance animations to cards
    const cards = document.querySelectorAll('.dashboard-card, .enhanced-table-container');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('fade-in');
    });

    // Add hover effects to table rows
    const tableRows = document.querySelectorAll('.enhanced-table tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});
</script>

@endsection