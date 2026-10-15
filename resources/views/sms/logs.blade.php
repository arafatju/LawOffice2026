@extends('common.notary2')

@section('content')
<div class="container-fluid py-3">
    <h4 class="mb-3">SMS Logs</h4>

    {{-- Totals --}}
    <div class="row mb-3 text-center">
        <div class="col-md-4">
            <div class="card"><div class="card-body">
                <div class="text-muted">Total</div>
                <h3 class="mb-0">{{ $totals->total }}</h3>
            </div></div>
        </div>
        <div class="col-md-4">
            <div class="card border-success"><div class="card-body">
                <div class="text-success">Successful</div>
                <h3 class="mb-0 text-success">{{ $totals->sent }}</h3>
            </div></div>
        </div>
        <div class="col-md-4">
            <div class="card border-danger"><div class="card-body">
                <div class="text-danger">Failed</div>
                <h3 class="mb-0 text-danger">{{ $totals->failed }}</h3>
            </div></div>
        </div>
    </div>

    {{-- Search / filters --}}
    <form method="GET" action="{{ route('sms.logs') }}" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
                   placeholder="Search mobile, transaction ID, user, message, response"
                   value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">All status</option>
                <option value="sent"   @selected(request('status') === 'sent')>Sent</option>
                <option value="failed" @selected(request('status') === 'failed')>Failed</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
        </div>
        <div class="col-md-2">
            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button class="btn btn-primary w-100">Search</button>
            <a href="{{ route('sms.logs') }}" class="btn btn-outline-secondary w-100">Reset</a>
        </div>
    </form>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Transaction</th>
                    <th>User</th>
                    <th>Mobile</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Response</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $logs->firstItem() + $loop->index }}</td>
                        <td>{{ $log->created_at->format('d M Y, h:i A') }}</td>
                        <td>{{ $log->trid ?? '-' }}</td>
                        <td>{{ $log->userid ?? '-' }}</td>
                        <td>{{ $log->mobile }}</td>
                        <td title="{{ $log->message }}">{{ \Illuminate\Support\Str::limit($log->message, 50) }}</td>
                        <td>
                            @if($log->status === 'sent')
                                <span class="badge bg-success">Sent</span>
                            @else
                                <span class="badge bg-danger">Failed</span>
                            @endif
                        </td>
                        <td title="{{ $log->response }}">{{ \Illuminate\Support\Str::limit($log->response, 40) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted">No SMS logs found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-between align-items-center">
        <div class="text-muted">
            Showing {{ $logs->firstItem() ?? 0 }} to {{ $logs->lastItem() ?? 0 }} of {{ $logs->total() }}
        </div>
        {{ $logs->links() }}
    </div>
</div>
@endsection