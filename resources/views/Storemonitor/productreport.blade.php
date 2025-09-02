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
</style>

<h2 class="mb-4 no-print">Dashboard</h2>

{{-- First Row --}}
<div class="row no-print">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-bold text-success">প্রোডাক্ট সর্বাধিক অর্ডার</h5>
                <p class="card-text h6">{{ $highestProduct->product->name ?? 'N/A' }} {{ $highestProduct->total_quantity ?? 0 }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary">মোট প্রোডাক্ট</h5>
                <p class="card-text h6">{{ $total }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-bold text-danger">স্টক শেষ হতে যাচ্ছে</h5>
                <p class="card-text h6">
                    @foreach ($lowStockProducts as $product)
                        {{ $product->name }} ({{ $product->quantity }})@if (!$loop->last && $loop->iteration < 10), @endif
                        @if($loop->iteration == 10)
                            @break
                        @endif
                    @endforeach
                </p>
            </div>
        </div>
    </div>
</div>

{{-- Second Row --}}
{{-- Print Button --}}
<div class="d-flex justify-content-end m-2 p-4 no-print">
    <button onclick="window.print()" class="btn btn-outline-success">
        <i class="fas fa-print"></i> প্রিন্ট
    </button>
</div>

{{-- Table --}}
<div class="print-area">
    <h2 class="text-center mb-3">Users Info</h2>
    <table class="table table-bordered text-center" style="margin: auto; width: 95%;">
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
@endsection

 