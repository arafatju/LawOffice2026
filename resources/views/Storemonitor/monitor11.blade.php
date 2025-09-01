@extends('common.adminmonitor')

@section('content')
<style>
@media print {
    body * {
        visibility: hidden; /* Hide everything */
    }
    .print-area, .print-area * {
        visibility: visible; /* Show only print area */
    }
    .print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        margin: 10px auto;
    }

    .no-print {
        display: none !important; /* Hide buttons */
    }
}
</style>

    <h2 class="mb-4">Dashboard</h2>

    {{-- First Row --}}
    <div class="row">
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
                    <h5 class="card-title fw-bold text-success">অফিস সর্বাধিক অর্ডার</h5>
                    <p class="card-text h6">{{ $highestOffice->office ?? 'N/A' }} {{ $highestOffice->total_quantity ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-primary">অপেক্ষমাণ আবেদন</h5>
                    <p class="card-text h6">{{ $pendingCount }}</p>
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
    <div class="row">
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-success">মোট ব্যবহারকারী</h5>
                    <p class="card-text h6">77</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-success">অ্যাডমিন মনিটর</h5>
                    <p class="card-text h6">77</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-primary">সাধারণ ব্যবহারকারী</h5>
                    <p class="card-text h6">5</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-danger">সুপার অ্যাডমিন</h5>
                    <p class="card-text h6">1</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Print Button --}}
    <div class="d-flex justify-content-end mb-3 no-print">
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
                    <th>দপ্তর</th>
                    <th>নাম</th>
                    <th>মোবাইল</th>
                    <th>ইমেইল</th>
                    <th>স্ট্যাটাস</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user44)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user44->personalinfo->office }}</td>
                        <td>{{ $user44->name }}</td>
                        <td>{{ $user44->mobile }}</td>
                        <td>{{ $user44->email }}</td>
                        <td>
                            @switch($user44->role)
                                @case('userone') সাধারণ ব্যবহারকারী @break
                                @case('userdataentry') তথ্য এন্ট্রি ব্যবহারকারী @break
                                @case('useradmin') সুপার অ্যাডমিন @break
                                @case('usermonitor') অ্যাডমিন মনিটর @break
                                @default অপেক্ষমাণ ব্যবহারকারী
                            @endswitch
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
