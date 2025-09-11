@extends('common.userdashboard')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Enhanced Custom Styles -->
<style>
    :root {
        --primary-color: #2563eb;
        --secondary-color: #7c3aed;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --error-color: #ef4444;
        --info-color: #06b6d4;
        --light-bg: #f8fafc;
        --card-shadow: 0 10px 25px rgba(0,0,0,0.08);
        --border-radius: 12px;
        --bengali-font: 'SolaimanLipi', 'Kalpurush', 'Noto Sans Bengali', Arial, sans-serif;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: var(--bengali-font);
    }

    .dashboard-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        margin: 20px;
        padding: 30px;
    }

    .page-title {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
    }

    /* Enhanced Statistics Card */
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
        background: linear-gradient(135deg, var(--info-color), #38bdf8);
        border-radius: var(--border-radius) var(--border-radius) 0 0;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--info-color), #38bdf8);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.5rem;
        color: white;
    }

    .stats-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .stats-label {
        color: #64748b;
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* Enhanced Table Container */
    .table-container {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        overflow: hidden;
        margin-top: 2rem;
    }

    .table-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 1.5rem;
        margin: 0;
        font-weight: 600;
        font-size: 1.2rem;
    }

    /* Enhanced Table */
    .enhanced-table {
        width: 100%;
        margin: 0;
        font-size: 0.9rem;
        border-collapse: collapse;
    }

    .enhanced-table thead th {
        background: linear-gradient(135deg, #1e40af, #7c3aed);
        color: white;
        font-weight: 600;
        padding: 1rem 0.8rem;
        text-align: center;
        font-size: 0.85rem;
        border: none;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .enhanced-table tbody td {
        padding: 1rem 0.8rem;
        vertical-align: middle;
        border-bottom: 1px solid #e2e8f0;
        text-align: center;
    }

    .enhanced-table tbody tr {
        transition: all 0.3s ease;
    }

    .enhanced-table tbody tr:hover {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .enhanced-table tbody tr:nth-child(even) {
        background: #f8fafc;
    }

    /* Status Badges */
    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-delivered {
        background: linear-gradient(135deg, var(--success-color), #34d399);
        color: white;
    }

    .status-pending {
        background: linear-gradient(135deg, var(--warning-color), #fbbf24);
        color: white;
    }

    /* Serial Number */
    .serial-number {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* Product List Styling */
    .product-list {
        max-width: 200px;
        word-wrap: break-word;
        font-size: 0.8rem;
        line-height: 1.4;
    }

    .product-item {
        background: #f1f5f9;
        padding: 0.3rem 0.6rem;
        border-radius: 15px;
        margin: 0.2rem;
        display: inline-block;
        border-left: 3px solid var(--info-color);
    }

    /* Time Display */
    .time-info {
        font-size: 0.8rem;
        line-height: 1.3;
    }

    .time-applied {
        color: var(--info-color);
        font-weight: 500;
    }

    .time-delivered {
        color: var(--success-color);
        font-weight: 500;
    }

    .time-difference {
        background: linear-gradient(135deg, #fef3c7, #fcd34d);
        padding: 0.5rem;
        border-radius: 8px;
        font-weight: 600;
        color: #92400e;
        font-size: 0.75rem;
    }

    /* Enhanced Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
        padding: 1rem;
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
    }

    .pagination .page-item .page-link {
        border: none;
        padding: 0.75rem 1rem;
        margin: 0 0.2rem;
        border-radius: 8px;
        color: var(--primary-color);
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .pagination .page-item .page-link:hover {
        background: #f1f5f9;
        transform: translateY(-2px);
    }

    /* Filter and Search Section */
    .filter-section {
        background: white;
        border-radius: var(--border-radius);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--card-shadow);
    }

    .search-box {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .search-box:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    /* Loading Animation */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        backdrop-filter: blur(5px);
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid #f3f4f6;
        border-top: 4px solid var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .dashboard-container {
            margin: 10px;
            padding: 15px;
        }
        
        .enhanced-table {
            font-size: 0.75rem;
        }
        
        .enhanced-table thead th,
        .enhanced-table tbody td {
            padding: 0.5rem 0.3rem;
        }
        
        .page-title {
            font-size: 1.8rem;
        }
    }

    /* Animation Classes */
    .fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

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

@section('content')
<div class="dashboard-container">
    <!-- Page Title -->
    <h1 class="page-title fade-in">
        <i class="fas fa-chart-bar me-3"></i>আবেদন ড্যাশবোর্ড
    </h1>

    <!-- Statistics Card -->
    <div class="row mb-4">
        <div class="col-md-6 col-lg-4 mx-auto">
            <div class="stats-card fade-in">
                <div class="stats-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stats-value">{{ enToBnNumber($totalQuantity) }}</div>
                <div class="stats-label">মোট অর্ডারকৃত পণ্য</div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section fade-in">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>আবেদন তালিকা</h5>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                    <input type="text" class="form-control search-box" placeholder="অনুসন্ধান করুন..." style="max-width: 250px;">
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Table -->
    <div class="table-container fade-in">
        <div class="table-responsive">
            <table class="enhanced-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag me-1"></i>ক্রমিক নং</th>
                        <th><i class="fas fa-user me-1"></i>আবেদনকারীর নাম</th>
                        <th><i class="fas fa-building me-1"></i>দপ্তর</th>
                        <th><i class="fas fa-clock me-1"></i>আবেদনের সময়</th>
                        <th><i class="fas fa-truck me-1"></i>ডেলিভারির সময়</th>
                        <th><i class="fas fa-box me-1"></i>পণ্য তালিকা</th>
                        <th><i class="fas fa-stopwatch me-1"></i>নিষ্পন্নের সময়</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $i => $app)
                        <tr class="fade-in" style="animation-delay: {{ $i * 0.1 }}s">
                            <!-- Serial Number -->
                            <td>
                                <span class="serial-number">{{ enToBnNumber($applications->firstItem()+$i) }}</span>
                            </td>
                            
                            <!-- Applicant Name -->
                            <td>
                                <div class="fw-bold text-primary">
                                    {{ $app->user->personalInfo->name ?? 'তথ্য নেই' }}
                                </div>
                            </td>
                            
                            <!-- Office -->
                            <td>
                                <small class="text-muted">
                                    {{ $app->user->personalInfo->office ?? 'উল্লেখ নেই' }}
                                </small>
                            </td>

                            <!-- Applied Time -->
                            <td>
                                <div class="time-info">
                                    <div class="time-applied">
                                        {{ \Carbon\Carbon::parse($app->created_at)->format('d M Y') }}
                                    </div>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($app->created_at)->format('h:i A') }}
                                    </small>
                                </div>
                            </td>

                            <!-- Delivered Time -->
                            <td>
                                @if($app->transactions->count() > 0)
                                    @php
                                        $approved = $app->transactions->firstWhere('status', 'approved');
                                    @endphp
                                    @if($approved)
                                        <div class="time-info">
                                            <div class="time-delivered">
                                                {{ \Carbon\Carbon::parse($approved->updated_at)->format('d M Y') }}
                                            </div>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($approved->updated_at)->format('h:i A') }}
                                            </small>
                                        </div>
                                         
                                    @else
                                        <span class="status-badge status-pending">
                                            <i class="fas fa-hourglass-half me-1"></i>অপেক্ষমান
                                        </span>
                                    @endif
                                @else
                                    <span class="status-badge status-pending">
                                        <i class="fas fa-hourglass-half me-1"></i>অপেক্ষমান
                                    </span>
                                @endif
                            </td>

                            <!-- Product List -->
                            <td>
                                <div class="product-list">
                                    @if($app->transactions->count() > 0)
                                        @foreach($app->transactions as $tran)
                                            <span class="product-item">
                                                {{ $tran->product->name ?? 'অজানা পণ্য' }} 
                                                ({{ enToBnNumber($tran->number) }})
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">কোন পণ্য নেই</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Time Difference -->
                            <td>
                                @if($app->transactions->count() > 0 && isset($approved))
                                    @php
                                        $applied = \Carbon\Carbon::parse($app->created_at);
                                        $delivered = \Carbon\Carbon::parse($approved->updated_at);
                                        
                                        $diff_minutes = $applied->diffInMinutes($delivered);
                                        $diff_hours = $applied->diffInHours($delivered);
                                        $diff_days = $applied->diffInDays($delivered);
                                    @endphp
                                    <div class="time-difference">
                                        <div>{{ enToBnNumber($diff_days) }} দিন</div>
                                        <small>{{ enToBnNumber($diff_hours) }} ঘন্টা</small>
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                <h5 class="text-muted">কোন আবেদন পাওয়া যায়নি</h5>
                                <p class="text-muted">এখনও কোন আবেদন জমা দেওয়া হয়নি।</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Enhanced Pagination -->
    @if($applications->hasPages())
        <div class="pagination-container fade-in">
            {!! $applications->links() !!}
        </div>
    @endif
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
        "timeOut": "3000"
    };

    // Search functionality
    $('.search-box').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('.enhanced-table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Show loading animation for table interactions
    $('.enhanced-table tbody tr').on('click', function() {
        // You can add row click functionality here
    });

    // Success message on page load
 
});
</script>

@endsection