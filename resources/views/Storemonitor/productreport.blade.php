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

/* Custom styling for category cards */
.category-card {
    min-height: 200px;
}

.card-text {
    font-size: 0.9rem;
    line-height: 1.4;
}
</style>

<h2 class="mb-4 no-print">Dashboard</h2>

{{-- First Row --}}
<div class="row d-flex justify-content-center">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-bold text-success">প্রোডাক্ট সর্বাধিক অর্ডার</h5>
                <p class="card-text h6">{{ $highestProduct->product->name ?? 'N/A' }} {{ $highestProduct->total_quantity ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4 ">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary">মোট প্রোডাক্ট</h5>
                <p class="card-text h6">{{ $total }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Four Category Columns Row --}}
<div class="row mb-4">
    @php
        $categories = [
            'ক্রোকারিজ' => 'text-info',
            'অফিস স্টেশনারি' => 'text-danger', 
            'এ্যারোসল, এয়ারফ্রেশনার এবং কারসেন্ট' => 'text-warning',
            'অফিস আসবাব' => 'text-success'
        ];
        $categoryIndex = 0;
    @endphp

    @foreach ($categories as $categoryName => $colorClass)
        @php
            $categoryProducts = $lowStockProducts->where('category', $categoryName);
            $displayIndex = 0;
        @endphp
        
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm category-card">
                <div class="card-body">
                    <h6 class="card-title fw-bold {{ $colorClass }}">{{ $categoryName }}</h6>
                    <p class="card-text" id="stockList{{ $categoryIndex }}">
                        @if($categoryProducts->count() > 0)
                            @foreach ($categoryProducts as $product)
                                <span class="stock-item stock-item-{{ $categoryIndex }} {{ $displayIndex >= 5 ? 'd-none extra-item-' . $categoryIndex : '' }}">
                                    {{ $product->name }} ({{ $product->quantity }})@if (!$loop->last), @endif
                                </span>
                                @php $displayIndex++; @endphp
                            @endforeach
                        @else
                            <span class="text-muted">কোন পণ্য পাওয়া যায়নি</span>
                        @endif
                    </p>

                    @if($categoryProducts->count() > 5)
                        <button id="toggleBtn{{ $categoryIndex }}" class="btn btn-link p-0 text-decoration-none toggle-btn" 
                                data-category="{{ $categoryIndex }}">আরও দেখুন...</button>
                    @endif
                </div>
            </div>
        </div>
        @php $categoryIndex++; @endphp
    @endforeach
</div>

<div class="d-flex justify-content-between align-items-center m-2">
    <!-- Left: Download PDF -->
    <a href="{{ route('productapproved111') }}" 
       target="_blank" 
       class="btn btn-primary">
        Download PDF
    </a>

    <!-- Right: Search box -->
    <input type="text" id="productSearch" class="form-control w-25" placeholder="🔍 Search products...">
</div>


{{-- Table --}}
<div class="print-area">
    <h2 class="text-center mb-3"> product Info</h2>
    <table class="table table-bordered text-center" style="margin: auto; width: 95%;" id="productTable">
        <thead class="bg-primary text-white">
            <tr>
                <th>ক্রমিক নং</th>
                <th>প্রোডাক্ট নাম</th>
                <th>কোড</th>
                <th>পরিমাণ</th>
                <th>ক্যাটাগরি</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->prcode }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->category }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Object to track expanded state for each category
    const expandedStates = {};
    
    // Get all toggle buttons
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
                
                // Toggle state for this category
                expandedStates[categoryIndex] = !expandedStates[categoryIndex];
                const expanded = expandedStates[categoryIndex];
                
                // Toggle visibility of extra items
                extraItems.forEach(function(el) {
                    if (expanded) {
                        el.classList.remove("d-none");
                    } else {
                        el.classList.add("d-none");
                    }
                });
                
                // Update button text
                btn.textContent = expanded ? "কম দেখান..." : "আরও দেখুন...";
                
                console.log(`Category ${categoryIndex} toggled, expanded:`, expanded);
            });
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('productSearch');
    const table = document.getElementById('productTable');
    const rows = table.getElementsByTagName('tr');

    searchInput.addEventListener('keyup', function () {
        const filter = searchInput.value.toLowerCase();
        
        // Start from 1 to skip table header
        for (let i = 1; i < rows.length; i++) {
            let rowText = rows[i].innerText.toLowerCase();
            rows[i].style.display = rowText.includes(filter) ? '' : 'none';
        }
    });
});
</script>
@endsection