@extends('layouts.app')

@section('title', 'Transactions - Tigula')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home me-1"></i>Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-exchange-alt me-2"></i>Transactions
                    </li>
                </ol>
            </nav>
            <h1 class="page-title">
                <i class="fas fa-exchange-alt me-3"></i>Transaction Management
            </h1>
            <p class="text-muted">Track and manage all grain trading transactions with complete audit trails.</p>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert alert-modern alert-success animate-fade-in" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-modern alert-danger animate-fade-in" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
        </div>
    @endif

    <!-- Statistics Cards Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="card card-custom stats-card animate-fade-in">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Pending Approval</h6>
                            <h3 class="stats-number text-warning">{{ $transactions->where('status', 'pending')->count() }}</h3>
                        </div>
                        <div class="stats-icon bg-warning">
                            <i class="fas fa-clock text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="card card-custom stats-card animate-fade-in">
                <div class="card-body">
                    <div>
                        <div>
                            <h6 class="text-muted mb-1">Approved</h6>
                            <h3 class="stats-number text-info">{{ $transactions->where('status', 'approved')->count() }}</h3>
                        </div>
                        <div class="stats-icon bg-info">
                            <i class="fas fa-check-circle text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="card card-custom stats-card animate-fade-in">
                <div class="card-body">
                    <div>
                        <div>
                            <h6 class="text-muted mb-1">Completed (Paid)</h6>
                            <h3 class="stats-number text-success">{{ $transactions->where('status', 'paid')->count() }}</h3>
                        </div>
                        <div class="stats-icon bg-success">
                            <i class="fas fa-money-bill-wave text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="card card-custom stats-card animate-fade-in">
                <div class="card-body">
                    <div>
                        <div>
                            <h6 class="text-muted mb-1">Total Value</h6>
                            <h3 class="stats-number text-primary">ZMW {{ number_format($transactions->where('status', 'paid')->sum('total_amount'), 2) }}</h3>
                        </div>
                        <div class="stats-icon bg-primary">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions and Filters Row -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-list me-2 text-primary"></i>All Transactions
                            </h5>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="d-flex justify-content-lg-end gap-2">
                                @if(auth()->user()->isAggregator() || auth()->user()->isAdmin())
                                <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>New Transaction
                                </a>
                                @endif
                                @if(auth()->user()->isAdmin())
                                <a href="{{ route('transactions.pending') }}" class="btn btn-warning">
                                    <i class="fas fa-clock me-2"></i>Pending Approvals
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-table me-2 text-primary"></i>All Transactions
                            </h5>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-md-end gap-2">
                                <div class="input-group" style="width: 250px;">
                                    <input type="text" class="form-control" placeholder="Search transactions..." aria-label="Search">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <select class="form-select" style="width: 150px;">
                                    <option value="">All Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if($transactions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>
                                        <i class="fas fa-hashtag me-1"></i>Transaction #
                                    </th>
                                    <th>
                                        <i class="fas fa-user me-1"></i>Farmer
                                    </th>
                                    <th>
                                        <i class="fas fa-seedling me-1"></i>Grain Type
                                    </th>
                                    <th>
                                        <i class="fas fa-weight me-1"></i>Weight
                                    </th>
                                    <th>
                                        <i class="fas fa-money-bill-wave me-1"></i>Amount
                                    </th>
                                    <th>
                                        <i class="fas fa-info-circle me-1"></i>Status
                                    </th>
                                    <th>
                                        <i class="fas fa-calendar me-1"></i>Date
                                    </th>
                                    <th>
                                        <i class="fas fa-cogs me-1"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $transaction)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-primary">{{ $transaction->transaction_number }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $transaction->farmer->full_name }}</div>
                                        <small class="text-muted">{{ $transaction->farmer->phone_number }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $transaction->grainType->name }}</div>
                                        <small class="text-muted">ZMW {{ number_format($transaction->unit_price, 2) }} per 25kg</small>
                                    </td>
                                    <td>
                                        <span class="badge-custom fw-bold">{{ number_format($transaction->weight_kg, 2) }} kg</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">ZMW {{ number_format($transaction->total_amount, 2) }}</span>
                                    </td>
                                    <td>
                                        @if($transaction->status == 'pending')
                                            <span class="badge bg-warning-subtle text-warning-emphasis">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                        @elseif($transaction->status == 'approved')
                                            <span class="badge bg-info-subtle text-info-emphasis">
                                                <i class="fas fa-check-circle me-1"></i>Approved
                                            </span>
                                        @elseif($transaction->status == 'paid')
                                            <span class="badge bg-success-subtle text-success-emphasis">
                                                <i class="fas fa-money-bill-wave me-1"></i>Paid
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>{{ $transaction->created_at->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ $transaction->created_at->format('h:i A') }}</small>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('transactions.show', $transaction) }}"
                                               class="btn btn-sm btn-outline-primary"
                                               data-bs-toggle="tooltip"
                                               title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if(auth()->user()->isAdmin() && $transaction->canBeApproved())
                                                <form method="POST" action="{{ route('transactions.approve', $transaction) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-success"
                                                            data-bs-toggle="tooltip"
                                                            title="Approve Transaction"
                                                            onclick="return confirm('Approve this transaction?')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if(auth()->user()->isAdmin() && $transaction->status === 'approved')
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-info"
                                                        data-bs-toggle="tooltip"
                                                        title="Process Payment"
                                                        onclick="processPayment({{ $transaction->id }})">
                                                    <i class="fas fa-credit-card"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="py-5">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">No transactions found</h5>
                                            <p class="text-muted">Start by creating your first grain purchase transaction.</p>
                                            @if(auth()->user()->isAggregator() || auth()->user()->isAdmin())
                                                <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus me-2"></i>Create First Transaction
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($transactions->hasPages())
                        <div class="card-footer">
                            {{ $transactions->links() }}
                        </div>
                    @endif
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-database fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Transactions Yet</h5>
                            <p class="text-muted">Your transaction history will appear here once you start buying grain.</p>
                            @if(auth()->user()->isAggregator() || auth()->user()->isAdmin())
                                <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-lg mt-3">
                                    <i class="fas fa-plus-circle me-2"></i>Start Your First Transaction
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function processPayment(transactionId) {
    if (confirm('Process payment for this transaction? This will send money to the farmer.')) {
        // AJAX call to process payment would go here
        alert('Payment processing feature would be implemented with backend integration.');
    }
}
</script>
@endsection
@endsection
