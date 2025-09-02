{{-- Blade Template: productreport.blade.php --}}
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
    .no-print, .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
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
</style>

<h2 class="mb-4 no-print">Dashboard</h2>

{{-- Dashboard Cards --}}
<div class="row no-print">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-bold text-success">অফিস সর্বাধিক অর্ডার</h5>
                <p class="card-text h6">{{ $maxOrderOffice ?? '' }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary">মোট অফিস</h5>
                <p class="card-text h6">{{ $totalOffices ?? '' }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-bold text-danger">অপেক্ষমাণ আবেদন</h5>
                <p class="card-text h6">{{ $pendingApplications ?? '' }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Filter and Print Section --}}
<div class="d-flex justify-content-start no-print">
    <form method="GET" class="form-inline" action="">
        <label for="office" class="mr-2 fw-bold">দপ্তর বাছাই করুন:</label>
        <select name="office" id="office" class="form-control mr-2" style="width:auto;display:inline-block;">
            <option value="">সকল দপ্তর</option>
            @foreach($offices as $ofc)
                <option value="{{ $ofc }}" {{ (request('office') == $ofc) ? 'selected' : '' }}>
                    {{ $ofc }}
                </option>
            @endforeach
        </select>
        <button type="button" id="filterBtn" class="btn btn-primary ml-2">রিপোর্ট দেখান</button>
    </form> 

    <button onclick="window.print()" class="btn btn-outline-success ml-3">
        <i class="fas fa-print"></i> প্রিন্ট
    </button>
</div>

{{-- Table --}}
<div class="print-area">
    <h2 class="text-center mb-3">দপ্তর রিপোর্ট</h2>
    <table id="reportTable" class="table table-bordered text-center" style="margin: auto; width: 95%;">
        <thead>
            <tr class="bg-primary text-white">
                <th>ক্রমিক নং</th> 
                <th>আবেদনকারীর নাম</th> 
                <th>দপ্তর</th> 
                <th>আবেদন এর সময়</th> 
                <th>ডেলিভারড</th> 
                <th>পণ্য তালিকা</th> 
                <th>নিষ্পন্ন করার সময়</th>
            </tr>
        </thead>
        <tbody>
            {{-- DataTable will populate this --}}
        </tbody>
    </table>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#reportTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('product.report.data') }}",
            data: function(d) {
                d.office = $('#office').val();
            }
        },
        columns: [
            { data: 'serial', name: 'serial', orderable: false, searchable: false },
            { data: 'user_name', name: 'user_name' },
            { data: 'office', name: 'office' },
            { data: 'applied_at', name: 'created_at' },
            { data: 'delivered_at', name: 'delivered_at' },
            { data: 'products', name: 'products', orderable: false },
            { data: 'processing_time', name: 'processing_time', orderable: false }
        ],
        order: [[3, 'desc']],
        pageLength: 25,
        language: {
            "processing": "লোড হচ্ছে...",
            "lengthMenu": "_MENU_ টি রেকর্ড দেখান",
            "zeroRecords": "কোন রেকর্ড পাওয়া যায়নি",
            "info": "_START_ থেকে _END_ পর্যন্ত (_TOTAL_ টির মধ্যে)",
            "infoEmpty": "০ থেকে ০ পর্যন্ত (০ টির মধ্যে)",
            "search": "খুঁজুন:",
            "paginate": {
                "first": "প্রথম",
                "last": "শেষ",
                "next": "পরবর্তী",
                "previous": "পূর্বের"
            }
        }
    });

    // Filter button click
    $('#filterBtn').on('click', function() {
        table.ajax.reload();
    });
});
</script>
@endpush