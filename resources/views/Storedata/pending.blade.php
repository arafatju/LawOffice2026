@extends('common.masterall')

@section('content')

@section('title', 'Section Admin Management') 

@section('breadcrumb', 'Pending Applications')

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
    /* Custom Font Support for Bangla */
    .font-bn {
        font-family: 'Hind Siliguri', 'SolaimanLipi', sans-serif;
    }
    
    /* Print Styles: Hide specific elements when printing */
    @media print {
        .no-print {
            display: none !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
        .table-responsive {
            overflow: visible !important;
        }
        body {
            background-color: white;
        }
        thead {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pending Applications</h1>
    </div>

    <!-- Content Row (Stats Card) -->
    <div class="row mb-4 no-print">
        <!-- Total Pending Applications Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2" style="border-left: 5px solid #ffc107;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Pending Applications
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-warning font-bn">
                                {{ $pendingCount }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card shadow-sm mb-4 no-print">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Options</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="" class="row g-3 align-items-center">
                <div class="col-md-4">
                    <label for="office" class="form-label fw-bold">দপ্তর বাছাই করুন:</label>
                    <select name="office" id="office" class="form-select">
                        <option value="">সকল দপ্তর</option>
                        @foreach($offices as $ofc)
                            <option value="{{ $ofc }}" {{ (request('office') == $ofc) ? 'selected' : '' }}>
                                {{ $ofc }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-2"></i> রিপোর্ট দেখান
                    </button>
                </div>
            </form> 
        </div>
    </div> 

    <!-- Report Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Pending Applications Report</h6>
            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm no-print">
                <i class="fas fa-print"></i> Print Report
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" style="width: 80px;">ক্রমিক নং</th>
                            <th>ব্যবহারকারীর নাম</th>
                            <th>পণ্য তালিকা</th>
                            <th>আবেদনের তারিখ</th>
                            <th class="text-center" style="width: 120px;">Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingTransactions as $userId => $transactions)
                            @php
                                $user = $transactions->first()->user; // same user for all in group
                            @endphp

                            <tr>
                                <td class="text-center font-bn">{{ enToBnNumber($loop->iteration) }}</td>
                                <td>
                                    <strong class="text-primary">{{ $user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $user->personalInfo->office ?? 'N/A' }}</small>
                                </td>
                                <td>
                                    <ul class="list-unstyled mb-0 font-bn">
                                        @foreach($transactions as $transaction)
                                            <li class="mb-1">
                                                <i class="fas fa-chevron-right small text-primary me-1"></i>
                                                {{ $transaction->product->name }} 
                                                <span class="badge bg-light text-dark border ms-1">
                                                    Qty: {{ enToBnNumber($transaction->number) }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="font-bn">{{ enToBnNumber($transactions->first()->created_at->format('d, M, Y')) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('productpending1124', $user->userid) }}" 
                                       class="btn btn-sm btn-success">
                                        বিস্তারিত
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <p>No pending applications found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection