@extends('layouts.app', ['activeMenu' => 'dashboard'])

@section('title', 'Dashboard - Tigula')

@section('content')
<div class="dashboard-simple">
    <!-- Welcome Header -->
    <div class="welcome-header">
        <div class="welcome-content">
            <h1>Welcome to Tigula</h1>
            <p>Simple & Smart Grain Trading</p>
        </div>

        <div class="quick-stats">
            <div class="stat-item">
                <div class="stat-number">{{ $stats['total_transactions_today'] ?? 0 }}</div>
                <div class="stat-label">Purchases Today</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">ZMW {{ number_format($stats['total_amount_today'] ?? 0, 0) }}</div>
                <div class="stat-label">Paid Today</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $stats['farmers_served_today'] ?? 0 }}</div>
                <div class="stat-label">Farmers Served</div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Quick Actions -->
    <div class="quick-actions">
        <div class="action-row">
            <a href="{{ route('transactions.create') }}" class="action-btn primary">
                <i class="fas fa-plus-circle"></i>
                <span>New Purchase</span>
            </a>

            <a href="{{ route('transactions.index') }}" class="action-btn secondary">
                <i class="fas fa-history"></i>
                <span>View History</span>
            </a>
        </div>

        <div class="action-row">
            <a href="{{ route('farmers.index') }}" class="action-btn secondary">
                <i class="fas fa-users"></i>
                <span>Farmers</span>
            </a>

            @if(auth()->user()->isAdmin())
            <a href="{{ route('payments.pending') }}" class="action-btn warning">
                <i class="fas fa-credit-card"></i>
                <span>Approve Payments</span>
            </a>
            @endif
        </div>
    </div>

    <!-- Recent Activity (Simplified) -->
    <div class="recent-activity">
        <h3>Recent Activity</h3>
        <div class="activity-items">
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <div class="activity-text">
                    <div class="activity-title">Ready to start?</div>
                    <div class="activity-desc">Create your first grain purchase</div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Simple, lightweight dashboard styles */
.dashboard-simple {
    padding: 1rem;
    max-width: 600px;
    margin: 0 auto;
}

.welcome-header {
    text-align: center;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.welcome-content h1 {
    color: #2d6a4f;
    font-size: 1.8rem;
    margin-bottom: 0.5rem;
    font-weight: 700;
}

.welcome-content p {
    color: #666;
    font-size: 1rem;
    margin: 0;
}

.quick-stats {
    display: flex;
    justify-content: space-around;
    margin-top: 1.5rem;
    gap: 0.5rem;
}

.stat-item {
    flex: 1;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: #2d6a4f;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.8rem;
    color: #666;
    text-transform: uppercase;
    font-weight: 600;
}

.quick-actions {
    margin-bottom: 2rem;
}

.action-row {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

.action-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    padding: 1rem;
    border-radius: 12px;
    text-decoration: none;
    color: #fff;
    font-weight: 600;
    font-size: 0.9rem;
    border: none;
    cursor: pointer;
    transition: transform 0.2s;
}

.action-btn:active {
    transform: scale(0.98);
}

.action-btn.primary {
    background: linear-gradient(135deg, #2d6a4f 0%, #ff6600 100%);
}

.action-btn.secondary {
    background: #6c757d;
    color: #fff;
}

.action-btn.warning {
    background: #ff9500;
    color: #fff;
}

.recent-activity {
    background: #fff;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.recent-activity h3 {
    color: #2d6a4f;
    margin-bottom: 1rem;
    font-size: 1.2rem;
    font-weight: 700;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2d6a4f;
}

.activity-text h4 {
    margin: 0 0 0.25rem 0;
    font-size: 0.9rem;
    font-weight: 600;
    color: #333;
}

.activity-desc {
    margin: 0;
    font-size: 0.8rem;
    color: #666;
}

.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
}

.alert-success {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.alert-error {
    background: #f8d7da;
    border: 1px solid #f5c2c7;
    color: #721c24;
}

/* Mobile optimization */
@media (max-width: 480px) {
    .dashboard-simple {
        padding: 0.5rem;
    }

    .welcome-header {
        padding: 1rem;
    }

    .quick-stats {
        flex-direction: column;
        gap: 0.5rem;
    }

    .action-row {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>
@endpush

<script>
function transferFloat(buyerId, buyerName) {
    const amount = prompt(`How much float do you want to send to ${buyerName}?`, '1000');
    if (amount && !isNaN(amount) && parseFloat(amount) > 0) {
        // TODO: Implement actual float transfer
        alert(`Sending ZMW ${amount} float to ${buyerName}. This feature will be implemented with backend integration.`);
        console.log(`Transfer K${amount} to buyer ${buyerId}`);
    }
}
</script>

@endsection
