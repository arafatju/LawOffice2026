 @extends('common.master2')

@section('content')
@section('title', 'Section Admin Management ')
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
/* Dashboard Header */
.dashboard-header {
    margin-bottom: 35px;
}

.dashboard-header h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
}

/* Card Styling */
.cards-container {
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    border: none;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #667eea, transparent);
    transition: left 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
}

.stat-card:hover::before {
    left: 100%;
}

.card-icon {
    width: 70px;
    height: 70px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin-bottom: 20px;
    background: rgba(102, 126, 234, 0.15);
    color: #667eea;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.card-title {
    font-size: 0.9rem;
    color: #999;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
}

.card-value {
    font-size: 2.8rem;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 10px;
    line-height: 1.2;
}

.card-subtitle {
    font-size: 0.85rem;
    color: #999;
    margin: 0;
}

.stat-badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-top: 10px;
    background: rgba(102, 126, 234, 0.2);
    color: #667eea;
}

/* Filter Section */
.filter-section {
    background: white;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 35px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
}

.filter-section h4 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 20px;
    font-size: 1.1rem;
}

.filter-group {
    display: flex;
    align-items: flex-end;
    gap: 15px;
    flex-wrap: wrap;
}

.filter-group .form-group {
    margin-bottom: 0;
    flex: 1;
    min-width: 250px;
}

.filter-group label {
    display: block;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.filter-group select {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background-color: white;
}

.filter-group select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    outline: none;
}

.filter-group .btn-primary {
    border-radius: 8px;
    padding: 10px 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.filter-group .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
}

/* Table Section */
.table-section {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    overflow: auto;
}

.table-section h3 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 25px;
    font-size: 1.3rem;
}

.table {
    margin-bottom: 0;
}

.table thead th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    font-weight: 600;
    padding: 15px;
    text-align: center;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table tbody td {
    padding: 15px;
    border-color: #f0f0f0;
    vertical-align: middle;
    color: #666;
}

.table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #f0f0f0;
}

.table tbody tr:hover {
    background-color: #f9f9ff;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1);
}

.table tbody tr:last-child {
    border-bottom: none;
}

.serial-number {
    font-weight: 600;
    color: #667eea;
    text-align: center;
}

.user-name {
    font-weight: 600;
    color: #2c3e50;
}

.product-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.product-list li {
    padding: 6px 0;
    color: #666;
    border-bottom: 1px solid #f0f0f0;
}

.product-list li:last-child {
    border-bottom: none;
}

.product-list li::before {
    content: "✓ ";
    color: #28a745;
    font-weight: 600;
    margin-right: 8px;
}

.date-cell {
    color: #999;
    font-size: 0.95rem;
}

.action-btn {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(40, 167, 69, 0.3);
    color: white;
}

.no-data {
    text-align: center;
    padding: 40px 20px;
    color: #999;
}

.no-data i {
    font-size: 3rem;
    margin-bottom: 15px;
    color: #ddd;
}

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
}

@media (max-width: 768px) {
    .filter-group {
        flex-direction: column;
    }

    .filter-group .form-group,
    .filter-group .btn-primary {
        width: 100%;
        min-width: unset;
    }

    .table-section {
        overflow-x: auto;
    }

    .table {
        font-size: 0.85rem;
    }

    .table thead th,
    .table tbody td {
        padding: 10px;
    }
}
</style>

<!-- Dashboard Header -->
<div class="dashboard-header">
    <h2>Pending Applications Dashboard</h2>
</div>

<!-- Statistics Card -->
<div class="cards-container">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="stat-card">
                <div class="card-icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="card-title">Pending Applications</div>
                <div class="card-value">{{ enToBnNumber($pendingCount) }}</div>
                <p class="card-subtitle">Awaiting Review & Action</p>
                <span class="stat-badge">Action Required</span>
            </div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="filter-section">
    <h4><i class="fas fa-filter" style="margin-right: 10px; color: #667eea;"></i>Filter by Office</h4>
    <form method="GET" action="">
        <div class="filter-group">
            <div class="form-group">
                <label for="office">দপ্তর নির্বাচন করুন</label>
                <select name="office" id="office" class="form-control">
                    <option value="">সকল দপ্তর</option>
                    @foreach($offices as $ofc)
                        <option value="{{ $ofc }}" {{ (request('office') == $ofc) ? 'selected' : '' }}>
                            {{ $ofc }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search" style="margin-right: 8px;"></i>রিপোর্ট দেখান
            </button>
        </div>
    </form>
</div>

<!-- Table Section -->
<div class="print-area">
    <div class="table-section">
        <h3><i class="fas fa-file-alt" style="margin-right: 10px; color: #667eea;"></i>Pending Applications Report</h3>

        @if($pendingTransactions->isNotEmpty())
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 5%;">ক্রমিক নং</th>
                        <th style="width: 20%;">ব্যবহারকারীর নাম</th>
                        <th style="width: 35%;">পণ্য তালিকা</th>
                        <th style="width: 15%;">আবেদনের তারিখ</th>
                        <th style="width: 15%;">ব্যবস্থা</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingTransactions as $userId => $transactions)
                        @php
                            $user = $transactions->first()->user;
                        @endphp
                        <tr>
                            <td class="serial-number">{{ enToBnNumber($loop->iteration) }}</td>
                            <td class="user-name">{{ $user->name }}</td>
                            <td>
                                <ul class="product-list">
                                    @foreach($transactions as $transaction)
                                        <li>{{ $transaction->product->name }} <span style="color: #667eea; font-weight: 600;">({{ enToBnNumber($transaction->number) }})</span></li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="date-cell">{{ enToBnNumber($transactions->first()->created_at->format('d, M, Y')) }}</td>
                            <td>
                                <a href="{{ route('productpending1135', $user->userid) }}" class="action-btn">
                                    <i class="fas fa-arrow-right" style="margin-right: 6px;"></i>বিস্তারিত
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">
                <i class="fas fa-inbox"></i>
                <h5>কোন অপেক্ষাধীন আবেদন পাওয়া যায়নি</h5>
                <p>সকল আবেদন প্রক্রিয়া করা হয়েছে।</p>
            </div>
        @endif
    </div>
</div>

<script>
function printReportTable() {
    var printContents = document.querySelector('.print-area').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>

@endsection