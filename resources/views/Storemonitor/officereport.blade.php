{{-- Blade Template: Enhanced Office Report --}}
@extends('common.adminmonitor')
@section('content')
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
    
    .no-print, .no-print-pagination {
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
    
    .container, .container-fluid {
        margin: 0 !important;
        padding: 0 !important;
        max-width: none !important;
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

/* Enhanced Dashboard Cards */
.stats-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border: none;
    border-radius: 15px;
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    min-height: 140px;
}

.stats-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--card-gradient));
    border-radius: 15px 15px 0 0;
}

.stats-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.card-success::before { --card-gradient: #28a745, #20c997; }
.card-primary::before { --card-gradient: #007bff, #6610f2; }
.card-danger::before { --card-gradient: #dc3545, #fd7e14; }

.stats-card .card-body {
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

.stats-card:hover .card-icon {
    opacity: 0.25;
    transform: scale(1.1);
}

.stats-value {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0;
    position: relative;
    z-index: 2;
}

.stats-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    line-height: 1.3;
    position: relative;
    z-index: 2;
}

/* Filter Section */
.filter-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
}

.filter-title {
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    text-align: center;
}

.form-group-enhanced {
    margin-bottom: 1rem;
}

.form-label-enhanced {
    color: white;
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: block;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-control-enhanced {
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.1);
    color: white;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.form-control-enhanced:focus {
    border-color: rgba(255, 255, 255, 0.5);
    background: rgba(255, 255, 255, 0.2);
    box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.15);
    color: white;
}

.form-control-enhanced option {
    background: #495057;
    color: white;
}

/* Enhanced Buttons */
.btn-enhanced {
    border-radius: 25px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
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

.btn-primary-enhanced {
    background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
    color: white;
    border-color: transparent;
}

.btn-success-enhanced {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border-color: transparent;
}

/* Enhanced Table */
.table-container {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    margin-top: 2rem;
}

.enhanced-table {
    margin: 0;
    border: none;
    font-size: 0.9rem;
}

.enhanced-table thead tr {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.enhanced-table th {
    font-weight: 600;
    padding: 1.25rem 1rem;
    border: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.8rem;
    white-space: nowrap;
}

.enhanced-table td {
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
    vertical-align: middle;
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

/* Status and Category Badges */
.badge-enhanced {
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.badge-category {
    background: linear-gradient(45deg, #6c757d, #495057);
    color: white;
}

.badge-quantity {
    background: linear-gradient(45deg, #17a2b8, #6610f2);
    color: white;
    font-family: 'Courier New', monospace;
    font-size: 0.8rem;
}

/* Date Time Styling */
.datetime-cell {
    font-size: 0.8rem;
    line-height: 1.3;
}

.date-part {
    font-weight: 600;
    color: #495057;
}

.time-part {
    color: #6c757d;
    font-weight: 400;
}

/* Page Header */
.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.5rem;
    border-radius: 15px;
    margin-bottom: 2rem;
    text-align: center;
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
}

.page-header h2 {
    margin: 0;
    font-weight: 600;
    font-size: 2rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stats-card {
        min-height: 120px;
        margin-bottom: 1rem;
    }
    
    .stats-value {
        font-size: 1.8rem;
    }
    
    .filter-section {
        padding: 1.5rem;
    }
    
    .enhanced-table th,
    .enhanced-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.8rem;
    }
    
    .btn-enhanced {
        padding: 0.6rem 1.5rem;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
}

/* Animation Classes */
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

/* Pagination Enhancement */
.pagination {
    justify-content: center;
    margin-top: 2rem;
}

.pagination .page-link {
    border-radius: 8px;
    margin: 0 2px;
    border: none;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.6rem 1rem;
    font-weight: 500;
}

.pagination .page-link:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b5b95 100%);
    transform: translateY(-1px);
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header no-print">
        <h2><i class="fas fa-building me-2"></i>Office Report Dashboard</h2>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4 no-print">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card stats-card card-success">
                <i class="fas fa-trophy card-icon text-success"></i>
                <div class="card-body">
                    <h5 class="stats-title text-success">অফিস সর্বাধিক অর্ডার</h5>
                    <p class="stats-value text-success">{{ $highestOffice->total_delivered ?? 0 }}</p>
                    <p class="card-subtitle text-success mb-0">{{ $highestOffice->office ?? '-' }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card stats-card card-primary">
                <i class="fas fa-building card-icon text-primary"></i>
                <div class="card-body">
                    <h5 class="stats-title text-primary">মোট অফিস</h5>
                    <p class="stats-value text-primary">{{ $numberOfOffices }}</p>
                    <p class="card-subtitle text-primary mb-0">Total Offices</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card stats-card card-danger">
                <i class="fas fa-clock card-icon text-danger"></i>
                <div class="card-body">
                    <h5 class="stats-title text-danger">অপেক্ষমাণ আবেদন</h5>
                    <p class="stats-value text-danger">{{ $pendingCount }}</p>
                    <p class="card-subtitle text-danger mb-0">Pending Applications</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Filter Section -->
    <div class="filter-section no-print">
        <h3 class="filter-title"><i class="fas fa-filter me-2"></i>Report Filters</h3>
        
        <form method="GET" action="" class="row g-3 align-items-end">
            <div class="col-lg-3 col-md-6">
                <div class="form-group-enhanced">
                    <label for="office" class="form-label-enhanced">
                        <i class="fas fa-building me-1"></i>দপ্তর বাছাই করুন
                    </label>
                    <select name="office" id="office" class="form-control form-control-enhanced">
                        <option value="">সকল দপ্তর</option>
                        @foreach($offices as $ofc)
                        <option value="{{ $ofc }}" {{ (request('office') == $ofc) ? 'selected' : '' }}>
                            {{ $ofc }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="form-group-enhanced">
                    <label for="month" class="form-label-enhanced">
                        <i class="fas fa-calendar-alt me-1"></i>মাস
                    </label>
                    <select name="month" id="month" class="form-control form-control-enhanced">
                        <option value="">সকল মাস</option>
                        @foreach($month as $m)
                        <option value="{{ $m }}" {{ (request('month') == $m) ? 'selected' : '' }}>
                            {{ $m }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="form-group-enhanced">
                    <label for="year" class="form-label-enhanced">
                        <i class="fas fa-calendar me-1"></i>বছর
                    </label>
                    <select name="year" id="year" class="form-control form-control-enhanced">
                        <option value="">সকল বছর</option>
                        @foreach($year as $y)
                        <option value="{{ $y }}" {{ (request('year') == $y) ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-5 col-md-12">
                <div class="d-flex gap-2 justify-content-center justify-content-lg-start">
                    <button type="submit" class="btn btn-enhanced btn-primary-enhanced">
                        <i class="fas fa-search me-1"></i>রিপোর্ট দেখান
                    </button>
                    <button type="button" id="downloadPdf" class="btn btn-enhanced btn-success-enhanced">
                        <i class="fas fa-file-pdf me-1"></i>PDF ডাউনলোড
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Enhanced Table -->
    <div class="print-area">
        <h2 class="text-center mb-4">
            <i class="fas fa-building me-2 text-primary"></i>
            দপ্তর রিপোর্ট
        </h2>
        
        <div class="table-container">
            <table class="table enhanced-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag me-1"></i>Serial</th>
                        <th><i class="fas fa-box me-1"></i>Product Name</th>
                        <th><i class="fas fa-barcode me-1"></i>Product Code</th>
                        <th><i class="fas fa-tags me-1"></i>Category</th>
                        <th><i class="fas fa-sort-numeric-up me-1"></i>Quantity</th>
                        <th><i class="fas fa-calendar-plus me-1"></i>Applied</th>
                        <th><i class="fas fa-calendar-check me-1"></i>Delivered</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendingTransactions as $tran)
                    <tr>
                        <td class="fw-bold text-center">{{ $loop->iteration }}</td>
                        <td class="fw-medium">{{ $tran->product->name ?? 'N/A' }}</td>
                        <td class="font-monospace text-center">{{ $tran->product->prcode ?? 'N/A' }}</td>
                        <td class="text-center">
                            <span class="badge badge-enhanced badge-category">
                                {{ $tran->product->category ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-enhanced badge-quantity">
                                {{ $tran->number }}
                            </span>
                        </td>
                        <td class="text-center datetime-cell">
                            <div class="date-part">{{ $tran->created_at->format('j F Y') }}</div>
                            <div class="time-part">{{ $tran->created_at->format('g:i a') }}</div>
                        </td>
                        <td class="text-center datetime-cell">
                            <div class="date-part">{{ $tran->updated_at->format('j F Y') }}</div>
                            <div class="time-part">{{ $tran->updated_at->format('g:i a') }}</div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                <h5>কোন রেকর্ড পাওয়া যায়নি</h5>
                                <p>নির্বাচিত ফিল্টার অনুযায়ী কোন তথ্য খুঁজে পাওয়া যায়নি।</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Enhanced Pagination -->
        @if($pendingTransactions->hasPages())
        <div class="mt-4 no-print">
            {{ $pendingTransactions->links() }}
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced PDF download functionality
    document.getElementById('downloadPdf').addEventListener('click', function() {
        const office = document.getElementById('office').value;
        const month = document.getElementById('month').value;
        const year = document.getElementById('year').value;
        
        let pdfUrl = '{{ route("officereport1212") }}';
        const params = [];
        
        if (office && office !== '') params.push(`office=${encodeURIComponent(office)}`);
        if (month && month !== '') params.push(`month=${encodeURIComponent(month)}`);
        if (year && year !== '') params.push(`year=${encodeURIComponent(year)}`);
        
        if (params.length > 0) {
            pdfUrl += '?' + params.join('&');
        }
        
        // Add loading state
        const btn = this;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Generating PDF...';
        btn.disabled = true;
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }, 2000);
        
        window.open(pdfUrl, '_blank');
    });

    // Add entrance animations
    const animatedElements = document.querySelectorAll('.stats-card, .filter-section, .table-container');
    animatedElements.forEach((element, index) => {
        element.style.animationDelay = `${index * 0.1}s`;
        element.classList.add('fade-in');
    });

    // Enhanced table row hover effects
    const tableRows = document.querySelectorAll('.enhanced-table tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Auto-submit form on select change (optional)
    const selects = document.querySelectorAll('#office, #month, #year');
    selects.forEach(select => {
        select.addEventListener('change', function() {
            // Uncomment next line if you want auto-submit
            // this.form.submit();
        });
    });
});
</script>

@endsection