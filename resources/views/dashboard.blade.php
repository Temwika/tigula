@extends('layouts.app', ['activeMenu' => 'dashboard'])

@section('title', 'Dashboard - Tigula')

@section('content')
<!-- xTransfer-Style Dashboard Header -->
<div class="xtransfer-dashboard-header">
    <div class="dashboard-nav">
        <div class="nav-brand">
            <i class="fas fa-seedling brand-icon"></i>
            <span class="brand-text">TIGULA</span>
        </div>

        <div class="nav-actions">
            <div class="user-greeting">
                <span class="greeting">Welcome back,</span>
                <span class="user-name">{{ auth()->user()->name ?? 'User' }}</span>
            </div>

            <div class="nav-buttons">
                <button class="nav-btn">
                    <i class="fas fa-bell"></i>
                </button>
                <button class="nav-btn">
                    <i class="fas fa-cog"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Dashboard Hero -->
    <div class="dashboard-hero">
        <div class="hero-content">
            <h1 class="hero-title animate-slide-in">Smart Grain Trading Dashboard</h1>
            <p class="hero-subtitle">Monitor operations, manage payments, and grow your business digitally</p>

            <div class="hero-actions">
                <a href="{{ route('transactions.quick-create') }}" class="btn-hero-primary">
                    <i class="fas fa-plus-circle me-2"></i>Quick Purchase
                </a>
                <a href="{{ route('farmers.create') }}" class="btn-hero-secondary">
                    <i class="fas fa-user-plus me-2"></i>Add Farmer
                </a>
            </div>
        </div>

        <!-- Key Metrics Bar -->
        <div class="metrics-bar">
            <div class="metric-card animate-slide-in" style="animation-delay: 0.1s">
                <div class="metric-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="metric-content">
                    <div class="metric-value">{{ $stats['total_transactions_today'] ?? 0 }}</div>
                    <div class="metric-label">Purchases Today</div>
                </div>
            </div>

            <div class="metric-card animate-slide-in" style="animation-delay: 0.2s">
                <div class="metric-icon">
                    <i class="fas fa-money-bill-wave-alt"></i>
                </div>
                <div class="metric-content">
                    <div class="metric-value">ZMW {{ number_format($stats['total_amount_today'] ?? 0, 0) }}</div>
                    <div class="metric-label">Paid Today</div>
                </div>
            </div>

            <div class="metric-card animate-slide-in" style="animation-delay: 0.3s">
                <div class="metric-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="metric-content">
                    <div class="metric-value">{{ $stats['farmers_served_today'] ?? 0 }}</div>
                    <div class="metric-label">Farmers Served</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Dashboard Content -->
<div class="dashboard-container">
    <div class="dashboard-content">

        <!-- Alert Messages (xTransfer Style) -->
        @if (session('status') || session('success'))
            <div class="alert-banner success animate-slide-in">
                <i class="fas fa-check-circle alert-icon"></i>
                <span>{{ session('status') ?? session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert-banner error animate-slide-in">
                <i class="fas fa-exclamation-triangle alert-icon"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Quick Actions Grid -->
        <section class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-zap section-icon"></i>Quick Actions
                </h2>
                <p class="section-subtitle">Start working with your most-used tools</p>
            </div>

            <div class="action-grid">
                <a href="{{ route('transactions.quick-create') }}" class="action-item animate-fade-in">
                    <div class="action-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">Quick Purchase</h3>
                        <p class="action-description">Create new grain transaction</p>
                    </div>
                    <div class="action-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>

                @if(auth()->user()->isAdmin())
                <a href="{{ route('payments.pending') }}" class="action-item animate-fade-in" style="animation-delay: 0.1s">
                    <div class="action-icon success">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">Approve Payments</h3>
                        <p class="action-description">Review pending payments</p>
                    </div>
                    <div class="action-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>
                @endif

                <a href="{{ route('transactions.index') }}" class="action-item animate-fade-in" style="animation-delay: 0.2s">
                    <div class="action-icon info">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">Transaction History</h3>
                        <p class="action-description">View all your purchases</p>
                    </div>
                    <div class="action-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>

                <a href="{{ route('farmers.index') }}" class="action-item animate-fade-in" style="animation-delay: 0.3s">
                    <div class="action-icon warning">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">Manage Farmers</h3>
                        <p class="action-description">Farmers database & payments</p>
                    </div>
                    <div class="action-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>
            </div>
        </section>

        <!-- Recent Activity & Market Overview -->
        <div class="dashboard-grid">
            <section class="dashboard-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-clock section-icon"></i>Recent Activity
                    </h2>
                </div>

                <div class="activity-list">
                    <div class="activity-item animate-fade-in">
                        <div class="activity-avatar">
                            <i class="fas fa-seedling text-primary"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Transaction Completed</div>
                            <div class="activity-subtitle">50kg maize purchased from Maria Zulu</div>
                            <div class="activity-time">2 minutes ago</div>
                        </div>
                        <div class="activity-status success">
                            ZMW 250
                        </div>
                    </div>

                    <div class="activity-item animate-fade-in" style="animation-delay: 0.1s">
                        <div class="activity-avatar">
                            <i class="fas fa-mobile-alt text-success"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Mobile Money Payment</div>
                            <div class="activity-subtitle">Payment sent to Airtel Money • 096XXXXXXX</div>
                            <div class="activity-time">15 minutes ago</div>
                        </div>
                        <div class="activity-status success">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>

                    <div class="activity-item animate-fade-in" style="animation-delay: 0.2s">
                        <div class="activity-avatar">
                            <i class="fas fa-user-plus text-primary"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Farmer Registered</div>
                            <div class="activity-subtitle">New farmer onboarded - John Banda</div>
                            <div class="activity-time">1 hour ago</div>
                        </div>
                        <div class="activity-status">
                            NRC: 1234/78/1
                        </div>
                    </div>
                </div>
            </section>

            <section class="dashboard-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-chart-bar section-icon"></i>Market Overview
                    </h2>
                </div>

                <div class="market-cards">
                    <div class="market-card animate-fade-in">
                        <div class="grain-icon">
                            <i class="fas fa-seedling text-warning"></i>
                        </div>
                        <div class="grain-content">
                            <h4 class="grain-name">Maize</h4>
                            <div class="grain-price">ZMW 185/25kg</div>
                            <div class="grain-change up">
                                <i class="fas fa-arrow-up"></i>+2.5%
                            </div>
                        </div>
                    </div>

                    <div class="market-card animate-fade-in" style="animation-delay: 0.1s">
                        <div class="grain-icon">
                            <i class="fas fa-seedling text-primary"></i>
                        </div>
                        <div class="grain-content">
                            <h4 class="grain-name">Soybeans</h4>
                            <div class="grain-price">ZMW 420/25kg</div>
                            <div class="grain-change up">
                                <i class="fas fa-arrow-up"></i>+1.8%
                            </div>
                        </div>
                    </div>

                    <div class="market-card animate-fade-in" style="animation-delay: 0.2s">
                        <div class="grain-icon">
                            <i class="fas fa-seedling text-info"></i>
                        </div>
                        <div class="grain-content">
                            <h4 class="grain-name">Groundnuts</h4>
                            <div class="grain-price">ZMW 380/25kg</div>
                            <div class="grain-change down">
                                <i class="fas fa-arrow-down"></i>-0.8%
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Today's Summary Stats -->
        <section class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-calendar-day section-icon"></i>Today's Summary
                </h2>
                <p class="section-subtitle">{{ date('l, F j, Y') }}</p>
            </div>

            <div class="summary-grid">
                <div class="summary-card animate-fade-in">
                    <div class="card-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-value">{{ $stats['total_transactions_today'] ?? 0 }}</div>
                    <div class="card-label">Total Purchases</div>
                    <div class="card-subtext">
                        <span class="change-indicator up">
                            <i class="fas fa-arrow-up"></i>+12%
                        </span> vs yesterday
                    </div>
                </div>

                <div class="summary-card animate-fade-in" style="animation-delay: 0.1s">
                    <div class="card-icon success">
                        <i class="fas fa-money-bill-wave-alt"></i>
                    </div>
                    <div class="card-value">ZMW {{ number_format($stats['total_amount_today'] ?? 0, 0) }}</div>
                    <div class="card-label">Total Paid</div>
                    <div class="card-subtext">
                        <span class="change-indicator up">
                            <i class="fas fa-arrow-up"></i>+22%
                        </span> vs yesterday
                    </div>
                </div>

                <div class="summary-card animate-fade-in" style="animation-delay: 0.2s">
                    <div class="card-icon info">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-value">{{ $stats['farmers_served_today'] ?? 0 }}</div>
                    <div class="card-label">Farmers Served</div>
                    <div class="card-subtext">
                        <span class="change-indicator up">
                            <i class="fas fa-arrow-up"></i>+5%
                        </span> vs yesterday
                    </div>
                </div>

                <div class="summary-card animate-fade-in" style="animation-delay: 0.3s">
                    <div class="card-icon warning">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="card-value">{{ $stats['active_buyers'] ?? 0 }}</div>
                    <div class="card-label">Active Buyers</div>
                    <div class="card-subtext">
                        3 new today
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

</div>

@push('styles')
<style>
/* xTransfer-Style Dashboard CSS */
:root {
    --tigula-primary: #1a472a;
    --tigula-secondary: #d35400;
    --tigula-accent: #e67e22;
    --tigula-success: #27ae60;
    --tigula-info: #3498db;
    --tigula-warning: #f39c12;
    --tigula-danger: #e74c3c;
    --tigula-light: #ecf0f1;
    --tigula-dark: #34495e;
    --tigula-gradient: linear-gradient(135deg, #1a472a 0%, #d35400 100%);
    --tigula-shadow: 0 8px 32px rgba(0,0,0,0.1);
}

/* Dashboard Header Styles */
.xtransfer-dashboard-header {
    background: var(--tigula-gradient);
    color: white;
    overflow: hidden;
    position: relative;
}

.dashboard-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 2rem;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
}

.nav-brand {
    display: flex;
    align-items: center;
    gap: 12px;
}

.brand-icon {
    color: white;
    font-size: 24px;
}

.brand-text {
    font-size: 24px;
    font-weight: bold;
    letter-spacing: -0.5px;
}

.user-greeting {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.greeting {
    font-size: 12px;
    opacity: 0.8;
    margin-bottom: 2px;
}

.user-name {
    font-size: 16px;
    font-weight: 600;
}

.nav-buttons {
    display: flex;
    gap: 8px;
}

.nav-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

.nav-btn:hover {
    background: rgba(255,255,255,0.3);
}

.dashboard-hero {
    padding: 3rem 2rem;
    background: linear-gradient(135deg, rgba(108, 92, 231, 0.1) 0%, rgba(76, 217, 250, 0.1) 100%);
}

.hero-content {
    max-width: 800px;
}

.hero-title {
    font-size: 3.2rem;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.hero-subtitle {
    font-size: 1.3rem;
    opacity: 0.9;
    margin-bottom: 2rem;
    line-height: 1.4;
}

.hero-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn-hero-primary {
    background: white;
    color: #1a472a;
    font-weight: 600;
    border: none;
    padding: 0.8rem 2rem;
    border-radius: 12px;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.btn-hero-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.2);
}

.btn-hero-secondary {
    background: rgba(255,255,255,0.2);
    color: white;
    border: 2px solid rgba(255,255,255,0.3);
    padding: 0.8rem 2rem;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.btn-hero-secondary:hover {
    background: rgba(255,255,255,0.3);
}

.metrics-bar {
    display: flex;
    gap: 2rem;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.metric-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 16px;
    padding: 1.5rem;
    min-width: 200px;
    text-align: center;
    transition: all 0.3s ease;
}

.metric-card:hover {
    background: rgba(255,255,255,0.15);
    transform: translateY(-4px);
}

.metric-icon {
    font-size: 2rem;
    margin-bottom: 1rem;
    opacity: 0.9;
}

.metric-value {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
}

.metric-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

/* Main Dashboard Content */
.dashboard-container {
    padding: 2rem 0;
}

.dashboard-content {
    padding: 0 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

/* Alert Banners */
.alert-banner {
    padding: 1rem 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    font-weight: 500;
}

.alert-banner.success {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.alert-banner.error {
    background: #f8d7da;
    border: 1px solid #f5c2c7;
    color: #721c24;
}

.alert-icon {
    margin-right: 1rem;
    font-size: 1.2rem;
}

/* Sections */
.dashboard-section {
    margin-bottom: 3rem;
}

.section-header {
    margin-bottom: 2rem;
}

.section-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    display: flex;
    align-items: center;
    color: var(--tigula-dark);
}

.section-icon {
    margin-right: 0.5rem;
    color: var(--tigula-primary);
}

.section-subtitle {
    color: #6c757d;
    font-size: 1rem;
}

/* Quick Actions */
.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.action-item {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.action-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.action-content {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.action-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 1rem;
    background: var(--tigula-light);
    color: var(--tigula-primary);
}

.action-icon.success {
    background: #d4edda;
    color: var(--tigula-success);
}

.action-icon.info {
    background: #cce8ff;
    color: var(--tigula-info);
}

.action-icon.warning {
    background: #fce9cd;
    color: var(--tigula-warning);
}

.action-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--tigula-dark);
    margin: 0;
}

.action-description {
    color: #6c757d;
    font-size: 0.9rem;
    margin: 0;
}

.action-arrow {
    margin-left: auto;
    transition: transform 0.3s ease;
}

.action-item:hover .action-arrow {
    transform: translateX(4px);
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

/* Activity List */
.activity-list {
    space-y: 1rem;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.activity-item:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.activity-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    background: var(--tigula-light);
}

.activity-content {
    flex: 1;
    min-width: 0;
}

.activity-title {
    font-weight: 600;
    color: var(--tigula-dark);
    margin-bottom: 0.25rem;
    font-size: 0.9rem;
}

.activity-subtitle {
    color: #6c757d;
    font-size: 0.8rem;
    margin-bottom: 0.25rem;
}

.activity-time {
    font-size: 0.7rem;
    color: #9ca3af;
}

.activity-status {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    white-space: nowrap;
}

.activity-status.success {
    background: #d4edda;
    color: #155724;
}

/* Market Cards */
.market-cards {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

.market-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    border: 1px solid #e9ecef;
}

.grain-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: var(--tigula-light);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.grain-content {
    flex: 1;
}

.grain-name {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 0.25rem;
    color: var(--tigula-dark);
}

.grain-price {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--tigula-primary);
    margin-bottom: 0.25rem;
}

.grain-change {
    font-size: 0.8rem;
    border-radius: 15px;
    padding: 0.25rem 0.5rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.grain-change.up {
    background: #d4edda;
    color: #155724;
}

.grain-change.down {
    background: #f8d7da;
    color: #721c24;
}

/* Summary Grid */
.summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.summary-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    text-align: center;
}

.summary-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.card-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--tigula-gradient);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin: 0 auto 1rem;
}

.card-icon.success {
    background: var(--tigula-success);
}

.card-icon.info {
    background: var(--tigula-info);
}

.card-icon.warning {
    background: var(--tigula-warning);
}

.card-value {
    font-size: 2.2rem;
    font-weight: 800;
    color: var(--tigula-dark);
    margin-bottom: 0.5rem;
}

.card-label {
    font-size: 1rem;
    color: #6c757d;
    margin-bottom: 1rem;
    font-weight: 500;
}

.card-subtext {
    font-size: 0.9rem;
    color: #9ca3af;
}

.change-indicator {
    color: var(--tigula-success);
    margin-right: 0.25rem;
}

.change-indicator.up {
    color: var(--tigula-success);
}

.change-indicator.down {
    color: var(--tigula-danger);
}

/* Animations */
.animate-slide-in {
    animation: slideInUp 0.6s ease-out;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeInScale 0.5s ease-out;
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }

    .metrics-bar {
        gap: 1rem;
    }

    .metric-card {
        min-width: 150px;
    }

    .dashboard-content {
        padding: 0 1rem;
    }

    .action-grid,
    .dashboard-grid,
    .summary-grid {
        grid-template-columns: 1fr;
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
