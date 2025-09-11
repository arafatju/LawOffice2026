{{-- Blade Template: productreport.blade.php --}}
@extends('common.adminmonitor')
@section('content')
<style>
@media print {
    /* Hide everything first */
    body * {
        visibility: hidden;
    }
    
    /* Show only print area */
    .print-area, .print-area * {
        visibility: visible;
    }
    
    /* Position print area - REMOVE height restriction for multi-page */
    .print-area {
        position: static !important; /* Changed from absolute */
        left: 0;
        top: 0;
        width: 100% !important;
        margin: 0 !important;
        padding: 15px !important;
        /* Removed height: 100% to allow multiple pages */
    }
    
    /* Hide elements that shouldn't print */
    .no-print, .no-print-pagination {
        display: none !important;
    }
    
    /* Allow table to break across pages */
    .print-area table {
        width: 100% !important;
        font-size: 11px !important;
        border-collapse: collapse !important;
        page-break-inside: auto !important;
        
    }
    
    /* Allow table rows to break across pages */
    .print-area tr {
        page-break-inside: avoid !important;
        page-break-after: auto !important;
    }
    
    /* Repeat table header on each page */
    .print-area thead {
        display: table-header-group !important;
    }
    
    /* Optimize table for print */
    .print-area th,
    .print-area td {
        padding: 6px 4px !important;
        border: 1px solid #000 !important;
        font-size: 11px !important;
    }
    
    /* Ensure table header is bold and visible */
    .print-area th {
        background-color: #0d6efd !important;
        color: white !important;
        font-weight: bold !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    
    /* Remove Bootstrap container margins */
    .container, .container-fluid {
        margin: 0 !important;
        padding: 0 !important;
        max-width: none !important;
    }
    
    /* Page margins */
    @page {
        margin: 0.5in;
        size: A4;
    }
    
    /* Title styling for print */
    .print-area h2 {
        font-size: 18px !important;
        margin-bottom: 15px !important;
        page-break-after: avoid !important;
    }
}

/* Enhanced Category Card Styles */
.category-card {
    transition: all 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
    min-height: 280px;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.category-card-primary:hover {
    box-shadow: 0 8px 25px rgba(13, 110, 253, 0.3) !important;
}

.category-card-danger:hover {
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3) !important;
}

.category-card-warning:hover {
    box-shadow: 0 8px 25px rgba(255, 193, 7, 0.3) !important;
}

.category-card-success:hover {
    box-shadow: 0 8px 25px rgba(25, 135, 84, 0.3) !important;
}

.stock-item {
    transition: all 0.3s ease;
}

.stock-item:hover .bg-light {
    background-color: #f8f9fa !important;
    transform: translateX(5px);
}

.toggle-btn {
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.toggle-btn:hover {
    transform: scale(1.05);
}

.product-name {
    font-size: 0.9rem;
    line-height: 1.4;
    word-wrap: break-word;
}

.card-header {
    border-radius: 12px 12px 0 0;
}

/* Top Cards Enhanced Styling */
.top-card {
    transition: all 0.3s ease;
    border-radius: 12px;
    border: none;
}

.top-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.12) !important;
}

.top-card .card-body {
    padding: 1.5rem;
}

.top-card .card-title {
    font-size: 1.1rem;
    margin-bottom: 0.8rem;
}

.top-card .card-text {
    font-size: 1.2rem;
    font-weight: 600;
}

/* Search and Button Styling */
.search-control {
    border-radius: 25px;
    border: 2px solid #e9ecef;
    padding: 0.7rem 1.2rem;
    transition: all 0.3s ease;
}

.search-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    transform: scale(1.02);
}

.btn-enhanced {
    border-radius: 25px;
    padding: 0.7rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-enhanced:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

/* Table Enhancements */
.enhanced-table {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.enhanced-table th {
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
    font-weight: 600;
    letter-spacing: 0.5px;
    border: none;
    padding: 1rem 0.75rem;
}

.enhanced-table td {
    padding: 0.8rem 0.75rem;
    border-color: #e9ecef;
    vertical-align: middle;
}

.enhanced-table tbody tr:hover {
    background-color: #f8f9fa;
    transform: scale(1.01);
    transition: all 0.2s ease;
}

@media (max-width: 768px) {
    .category-card {
        margin-bottom: 1rem;
        min-height: 200px;
    }
    
    .product-name {
        font-size: 0.85rem;
    }
    
    .card-title {
        font-size: 0.95rem;
    }
    
    .top-card .card-text {
        font-size: 1.1rem;
    }
}

/* Animation for expanding items */
.stock-item.show {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Badge hover effects */
.badge {
    transition: all 0.2s ease;
}

.badge:hover {
    transform: scale(1.1);
}

/* Fade-in animation */
.fade-in {
    animation: fadeInUp 0.6s ease-out forwards;
    opacity: 0;
    transform: translateY(20px);
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<h2 class="mb-4 no-print text-center">
    <i class="fas fa-chart-bar me-2 text-primary"></i>
    Dashboard
</h2>

{{-- Enhanced First Row --}}
<div class="row d-flex justify-content-center mb-5">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card shadow-sm top-card border-0">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-trophy text-success" style="font-size: 2.5rem;"></i>
                </div>
                <h5 class="card-title fw-bold text-success mb-3">প্রোডাক্ট সর্বাধিক অর্ডার</h5>
                <p class="card-text text-success">{{ $highestProduct->product->name ?? 'N/A' }}</p>
                <p class="card-text h4 text-success">{{ $highestProduct->total_quantity ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card shadow-sm top-card border-0">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-boxes text-primary" style="font-size: 2.5rem;"></i>
                </div>
                <h5 class="card-title fw-bold text-primary mb-3">মোট প্রোডাক্ট</h5>
                <p class="card-text h3 text-primary">{{ $total }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Enhanced Four Category Columns Row --}}
<div class="row g-4 mb-5">
    @php
        $categories = [
            'ক্রোকারিজ' => ['color' => 'primary', 'icon' => 'fas fa-utensils'],
            'অফিস স্টেশনারি' => ['color' => 'danger', 'icon' => 'fas fa-pencil-alt'],
            'এ্যারোসল, এয়ারফ্রেশনার এবং কারসেন্ট' => ['color' => 'warning', 'icon' => 'fas fa-spray-can'],
            'অফিস আসবাব' => ['color' => 'success', 'icon' => 'fas fa-chair']
        ];
        $categoryIndex = 0;
    @endphp

    @foreach ($categories as $categoryName => $categoryData)
        @php
            $categoryProducts = $lowStockProducts->where('category', $categoryName);
            $displayIndex = 0;
            $totalProducts = $categoryProducts->count();
        @endphp
        
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card h-100 shadow-sm border-0 category-card category-card-{{ $categoryData['color'] }}">
                {{-- Card Header --}}
                <div class="card-header bg-{{ $categoryData['color'] }} bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="{{ $categoryData['icon'] }} text-{{ $categoryData['color'] }} me-2"></i>
                            <h6 class="card-title mb-0 fw-bold text-{{ $categoryData['color'] }}">
                                {{ $categoryName }}
                            </h6>
                        </div>
                        <span class="badge bg-{{ $categoryData['color'] }} bg-opacity-20 text-{{ $categoryData['color'] }} border border-{{ $categoryData['color'] }}">
                            {{ $totalProducts }}
                        </span>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="card-body px-3 py-3">
                    <div class="stock-list" id="stockList{{ $categoryIndex }}">
                        @if($totalProducts > 0)
                            <div class="stock-items">
                                @foreach ($categoryProducts as $product)
                                    <div class="stock-item stock-item-{{ $categoryIndex }} {{ $displayIndex >= 5 ? 'd-none extra-item-' . $categoryIndex : '' }} mb-2">
                                        <div class="d-flex justify-content-between align-items-center p-2 rounded bg-light border-start border-3 border-{{ $categoryData['color'] }}">
                                            <span class="product-name fw-medium text-dark">{{ $product->name }}</span>
                                            <span class="badge bg-{{ $product->quantity <= 5 ? 'danger' : ($product->quantity <= 10 ? 'warning' : 'secondary') }}">
                                                {{ $product->quantity }}
                                            </span>
                                        </div>
                                    </div>
                                    @php $displayIndex++; @endphp
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-box-open text-muted mb-2" style="font-size: 2rem;"></i>
                                <p class="text-muted mb-0">কোন পণ্য পাওয়া যায়নি</p>
                            </div>
                        @endif
                    </div>

                    {{-- Toggle Button --}}
                    @if($totalProducts > 5)
                        <div class="text-center mt-3 pt-2 border-top">
                            <button id="toggleBtn{{ $categoryIndex }}" 
                                    class="btn btn-outline-{{ $categoryData['color'] }} btn-sm toggle-btn"
                                    data-category="{{ $categoryIndex }}">
                                <i class="fas fa-chevron-down me-1"></i>
                                আরও দেখুন ({{ $totalProducts - 5 }})
                            </button>
                        </div>
                    @endif
                </div>

                {{-- Card Footer --}}
                @if($totalProducts > 0)
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            সর্বশেষ আপডেট: {{ now()->format('d/m/Y H:i') }}
                        </small>
                    </div>
                @endif
            </div>
        </div>
        @php $categoryIndex++; @endphp
    @endforeach
</div>

{{-- Enhanced Controls Section --}}
<div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded-3">
    <!-- Left: Download PDF -->
    <a href="{{ route('productapproved111') }}" 
       target="_blank" 
       class="btn btn-primary btn-enhanced">
        <i class="fas fa-file-pdf me-2"></i>
        Download PDF
    </a>

    <!-- Right: Search box -->
    <div class="position-relative">
        <input type="text" 
               id="productSearch" 
               class="form-control search-control" 
               placeholder="🔍 Search products..."
               style="width: 300px;">
        <i class="fas fa-search position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></i>
    </div>
</div>

{{-- Enhanced Table --}}
<div class="print-area">
    <h2 class="text-center mb-4">
        <i class="fas fa-clipboard-list me-2 text-primary"></i>
        Product Info
    </h2>
    
    <div class="enhanced-table">
        <table class="table table-hover text-center mb-0" id="productTable">
            <thead class="text-white">
                <tr>
                    <th><i class="fas fa-hashtag me-1"></i>ক্রমিক নং</th>
                    <th><i class="fas fa-box me-1"></i>প্রোডাক্ট নাম</th>
                    <th><i class="fas fa-barcode me-1"></i>কোড</th>
                    <th><i class="fas fa-sort-numeric-up me-1"></i>পরিমাণ</th>
                    <th><i class="fas fa-tags me-1"></i>ক্যাটাগরি</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td class="fw-medium">{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td class="font-monospace">{{ $product->prcode }}</td>
                    <td>
                        <span class="badge bg-{{ $product->quantity <= 5 ? 'danger' : ($product->quantity <= 10 ? 'warning' : ($product->quantity <= 20 ? 'info' : 'success')) }} fs-6">
                            {{ $product->quantity }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-secondary bg-opacity-75">{{ $product->category }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Enhanced toggle functionality with better animations
    const expandedStates = {};
    const toggleButtons = document.querySelectorAll('.toggle-btn');
    
    console.log("Toggle buttons found:", toggleButtons.length);
    
    toggleButtons.forEach(function(btn) {
        const categoryIndex = btn.getAttribute('data-category');
        expandedStates[categoryIndex] = false;
        
        const extraItems = document.querySelectorAll('.extra-item-' + categoryIndex);
        console.log(`Category ${categoryIndex} extra items:`, extraItems.length);
        
        if (extraItems.length > 0) {
            btn.addEventListener("click", function (e) {
                e.preventDefault();
                
                expandedStates[categoryIndex] = !expandedStates[categoryIndex];
                const expanded = expandedStates[categoryIndex];
                
                extraItems.forEach(function(el) {
                    if (expanded) {
                        el.classList.remove("d-none");
                        el.classList.add("show");
                    } else {
                        el.classList.add("d-none");
                        el.classList.remove("show");
                    }
                });
                
                // Enhanced button text and icon updates
                const icon = btn.querySelector('i');
                if (expanded) {
                    btn.innerHTML = `<i class="fas fa-chevron-up me-1"></i>কম দেখান`;
                } else {
                    btn.innerHTML = `<i class="fas fa-chevron-down me-1"></i>আরও দেখুন (${extraItems.length})`;
                }
                
                console.log(`Category ${categoryIndex} toggled, expanded:`, expanded);
            });
        }
    });

    // Enhanced search functionality
    const searchInput = document.getElementById('productSearch');
    const table = document.getElementById('productTable');
    const rows = table.getElementsByTagName('tr');
    let searchTimeout;

    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const filter = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;
            
            // Start from 1 to skip table header
            for (let i = 1; i < rows.length; i++) {
                let rowText = rows[i].innerText.toLowerCase();
                const isVisible = rowText.includes(filter);
                rows[i].style.display = isVisible ? '' : 'none';
                
                if (isVisible) {
                    visibleCount++;
                    // Add subtle animation
                    rows[i].style.animation = 'fadeIn 0.3s ease';
                }
            }
            
            // Show search results count (optional)
            console.log(`Showing ${visibleCount} results for "${filter}"`);
        }, 300); // Debounce search
    });

    // Add entrance animations to cards
    document.querySelectorAll('.category-card, .top-card').forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('fade-in');
    });

    // Add fade-in keyframes
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);
});
</script>

@endsection