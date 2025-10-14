@extends('layouts.app')

@section('title', 'TIGULA - Modern African Agriculture Platform')

@section('content')
<div class="tigula-hero">
    <!-- Navigation -->
    <nav class="hero-nav">
        <div class="nav-container">
            <div class="nav-brand">
                <div class="brand-logo">
                    <div class="logo-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <span class="logo-text">TIGULA</span>
                </div>
            </div>

            <div class="nav-controls">
                <div class="language-toggle">
                    <i class="fas fa-globe"></i>
                    <span>EN</span>
                </div>
                @guest
                    <a href="{{ route('login') }}" class="nav-link">Sign In</a>
                    <a href="{{ route('register') }}" class="primary-btn">Get Started</a>
                @else
                    <div class="user-avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <a href="{{ route('dashboard') }}" class="primary-btn">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-main">
        <div class="hero-background">
            <div class="bg-layer bg-layer-1"></div>
            <div class="bg-layer bg-layer-2"></div>
            <div class="bg-layer bg-layer-3"></div>
            <div class="floating-elements">
                <div class="element element-1"></div>
                <div class="element element-2"></div>
                <div class="element element-3"></div>
            </div>
        </div>

        <div class="hero-container">
            <div class="hero-grid">
                <div class="hero-left">
                    <div class="hero-badge">
                        <div class="badge-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <span>Zambia's Leading Grain Trading Platform</span>
                    </div>

                    <h1 class="hero-title">
                        Empowering Africa's
                        <span class="highlight">Agriculture Future</span>
                    </h1>

                    <p class="hero-subtitle">
                        Instant farmer payments, digital traceability, and secure grain trading across Zambia.
                        Join the revolution transforming how grains are bought, sold, and delivered.
                    </p>

                    <div class="hero-cta">
                        <a href="{{ route('register') }}" class="cta-primary">
                            <div class="cta-icon">
                                <i class="fas fa-rocket-launch"></i>
                            </div>
                            <div class="cta-content">
                                <span class="cta-title">Start Trading Today</span>
                                <span class="cta-subtitle">Free setup • Instant activation</span>
                            </div>
                        </a>
                        <a href="#demo" class="cta-secondary">
                            <i class="fas fa-play"></i>
                            Watch Demo
                        </a>
                    </div>

                    <div class="hero-stats">
                        <div class="stat">
                            <div class="stat-number" data-target="15000">0</div>
                            <div class="stat-label">Farmers Served</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number" data-target="500">0</div>
                            <div class="stat-label">Agro-Dealers</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number" data-target="75000000">0</div>
                            <div class="stat-label">ZMW Transacted</div>
                        </div>
                    </div>
                </div>

                <div class="hero-right">
                    <div class="app-showcase">
                        <div class="phone-mockup">
                            <div class="phone-frame">
                                <div class="phone-screen">
                                    <div class="screen-content">
                                        <!-- App Header -->
                                        <div class="app-header-bar">
                                            <div class="app-logo">
                                                <i class="fas fa-seedling"></i>
                                                <span>TIGULA</span>
                                            </div>
                                            <div class="app-indicator">
                                                <span class="live-dot"></span>
                                                Live
                                            </div>
                                        </div>

                                        <!-- App Dashboard -->
                                        <div class="app-dashboard active-screen">
                                            <div class="dashboard-overview">
                                                <h3>Today's Overview</h3>
                                                <div class="metrics-grid">
                                                    <div class="metric">
                                                        <div class="metric-icon">
                                                            <i class="fas fa-coins"></i>
                                                        </div>
                                                        <div class="metric-data">
                                                            <div class="metric-value">ZMW 45,000</div>
                                                            <div class="metric-label">Payments Today</div>
                                                        </div>
                                                    </div>
                                                    <div class="metric">
                                                        <div class="metric-icon">
                                                            <i class="fas fa-users"></i>
                                                        </div>
                                                        <div class="metric-data">
                                                            <div class="metric-value">234</div>
                                                            <div class="metric-label">Farmers Paid</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="recent-activity">
                                                <h4>Recent Transactions</h4>
                                                <div class="transaction-list">
                                                    <div class="transaction">
                                                        <div class="transaction-avatar">
                                                            <i class="fas fa-user-circle"></i>
                                                        </div>
                                                        <div class="transaction-details">
                                                            <div class="farmer-name">Chileshe Mwale</div>
                                                            <div class="transaction-info">Maize - 45kg</div>
                                                            <div class="transaction-amount">-ZMW 1,125</div>
                                                        </div>
                                                        <div class="transaction-status success">
                                                            <i class="fas fa-check"></i>
                                                        </div>
                                                    </div>
                                                    <div class="transaction">
                                                        <div class="transaction-avatar">
                                                            <i class="fas fa-user-circle"></i>
                                                        </div>
                                                        <div class="transaction-details">
                                                            <div class="farmer-name">Blessings Banda</div>
                                                            <div class="transaction-info">Soybeans - 32kg</div>
                                                            <div class="transaction-amount">-ZMW 960</div>
                                                        </div>
                                                        <div class="transaction-status pending">
                                                            <i class="fas fa-clock"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- App Navigation -->
                                        <div class="app-navigation">
                                            <button class="nav-item active">
                                                <i class="fas fa-home"></i>
                                                <span>Home</span>
                                            </button>
                                            <button class="nav-item">
                                                <i class="fas fa-plus-circle"></i>
                                                <span>Add</span>
                                            </button>
                                            <button class="nav-item">
                                                <i class="fas fa-history"></i>
                                                <span>History</span>
                                            </button>
                                            <button class="nav-item">
                                                <i class="fas fa-cog"></i>
                                                <span>Settings</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Trust Indicators -->
                        <div class="trust-indicators">
                            <div class="indicator shield">
                                <div class="indicator-bg">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                            </div>
                            <div class="indicator zap">
                                <div class="indicator-bg">
                                    <i class="fas fa-bolt"></i>
                                </div>
                            </div>
                            <div class="indicator award">
                                <div class="indicator-bg">
                                    <i class="fas fa-award"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Quick Stats Bar -->
<div class="stats-bar">
    <div class="container-fluid">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number">ZMW 50M+</div>
                    <div class="stat-label">Payments Processed</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number">10,000+</div>
                    <div class="stat-label">Farmers Served</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Agro-Dealers</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="container-fluid py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h2 class="display-5 fw-bold text-primary mb-4">Why Choose Tigula?</h2>
            <p class="lead text-muted">Advanced platform designed specifically for Zambia's agricultural needs</p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Feature 1 -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card card-custom h-100 animate-fade-in">
                <div class="card-body text-center">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5 class="card-title fw-bold">Zero Cash Risk</h5>
                    <p class="card-text text-muted">
                        Eliminate cash handling risks with digital float allocations and secure transactions.
                    </p>
                </div>
            </div>
        </div>

        <!-- Feature 2 -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card card-custom h-100 animate-fade-in" style="animation-delay: 0.2s;">
                <div class="card-body text-center">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h5 class="card-title fw-bold">Mobile Money Integration</h5>
                    <p class="card-text text-muted">
                        Instant payments via Airtel Money, MTN Money, and Zamtel for farmers nationwide.
                    </p>
                </div>
            </div>
        </div>

        <!-- Feature 3 -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card card-custom h-100 animate-fade-in" style="animation-delay: 0.4s;">
                <div class="card-body text-center">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5 class="card-title fw-bold">Real-Time Analytics</h5>
                    <p class="card-text text-muted">
                        Complete visibility into transactions, payments, and market trends with detailed reporting.
                    </p>
                </div>
            </div>
        </div>

        <!-- Feature 4 -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card card-custom h-100 animate-fade-in" style="animation-delay: 0.6s;">
                <div class="card-body text-center">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5 class="card-title fw-bold">Farmer Empowerment</h5>
                    <p class="card-text text-muted">
                        Connect rural farmers directly to markets with fair pricing and transparent transactions.
                    </p>
                </div>
            </div>
        </div>

        <!-- Feature 5 -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card card-custom h-100 animate-fade-in" style="animation-delay: 0.8s;">
                <div class="card-body text-center">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h5 class="card-title fw-bold">Geographic Coverage</h5>
                    <p class="card-text text-muted">
                        Complete coverage across Eastern Province with plans for nationwide expansion.
                    </p>
                </div>
            </div>
        </div>

        <!-- Feature 6 -->
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card card-custom h-100 animate-fade-in" style="animation-delay: 1.0s;">
                <div class="card-body text-center">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h5 class="card-title fw-bold">24/7 Availability</h5>
                    <p class="card-text text-muted">
                        Access your dashboard and transaction history anytime, anywhere through mobile and web.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header text-center">
                    <h3 class="mb-0 fw-bold">
                        <i class="fas fa-cogs me-2 text-primary"></i>How Tigula Works
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-4 text-center">
                            <div class="step-number mb-3">1</div>
                            <h5 class="fw-bold mb-3">Register Farmer</h5>
                            <p class="text-muted">Quick farmer registration with NRC verification and location details</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="step-number mb-3">2</div>
                            <h5 class="fw-bold mb-3">Create Transaction</h5>
                            <p class="text-muted">Record grain type, weight, and quality with digital documentation</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="step-number mb-3">3</div>
                            <h5 class="fw-bold mb-3">Instant Payment</h5>
                            <p class="text-muted">Farmers receive money instantly via mobile money with SMS confirmation</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Current Market Prices -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-chart-bar me-2 text-success"></i>Current Grain Prices
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Grain Type</th>
                                    <th>Current Price</th>
                                    <th>Change</th>
                                    <th>Last Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Maize</strong></td>
                                    <td><span class="fw-bold text-primary">ZMW 185.00</span> per 25kg</td>
                                    <td><span class="badge bg-success-subtle text-success-emphasis">+2.5%</span></td>
                                    <td>Today 10:30 AM</td>
                                </tr>
                                <tr>
                                    <td><strong>Soybeans</strong></td>
                                    <td><span class="fw-bold text-primary">ZMW 420.00</span> per 25kg</td>
                                    <td><span class="badge bg-success-subtle text-success-emphasis">+1.8%</span></td>
                                    <td>Today 9:15 AM</td>
                                </tr>
                                <tr>
                                    <td><strong>Groundnuts</strong></td>
                                    <td><span class="fw-bold text-primary">ZMW 380.00</span> per 25kg</td>
                                    <td><span class="badge bg-danger-subtle text-danger-emphasis">-0.8%</span></td>
                                    <td>Yesterday 4:45 PM</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card card-custom text-center bg-gradient-primary" style="background: var(--tigula-gradient); color: white;">
                <div class="card-body py-5">
                    <h3 class="display-5 fw-bold mb-4">Ready to Transform Your Grain Business?</h3>
                    <p class="lead mb-4 opacity-90">
                        Join hundreds of agro-dealers already using Tigula to eliminate cash risks and empower farmers
                    </p>
                    @guest
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 py-3">
                                <i class="fas fa-rocket me-2"></i>Start Free Trial
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5 py-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In to Dashboard
                            </a>
                        </div>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg px-5 py-3">
                            <i class="fas fa-arrow-right me-2"></i>Go to Your Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>

@if (Route::has('login'))
<div class="h-14.5 hidden lg:block"></div>
@endif
@endsection

@push('styles')
<style>
/* TIGULA Landing Page CSS */
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

/* Hero Section Styles */
.tigula-hero {
    position: relative;
    background: linear-gradient(135deg, #1a472a 0%, #d35400 100%);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.navbar-transparent {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.brand {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    color: white;
}

.brand-logo {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.2);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    backdrop-filter: blur(10px);
}

.brand-name {
    font-size: 24px;
    letter-spacing: -0.5px;
}

.nav-actions {
    gap: 20px;
}

.btn-primary-custom {
    background: rgba(255,255,255,0.2);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    padding: 8px 20px;
    border-radius: 25px;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.btn-primary-custom:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-2px);
}

.btn-circle {
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

.btn-circle:hover {
    background: rgba(255,255,255,0.3);
}

.hero-content {
    flex: 1;
    display: flex;
    align-items: center;
}

.hero-main {
    max-width: 600px;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    padding: 8px 16px;
    border-radius: 20px;
    margin-bottom: 24px;
    backdrop-filter: blur(10px);
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.1;
    color: white;
    margin-bottom: 24px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.hero-subtitle {
    font-size: 1.3rem;
    line-height: 1.6;
    color: rgba(255,255,255,0.9);
    margin-bottom: 40px;
}

.hero-actions {
    display: flex;
    gap: 16px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.btn-hero-primary {
    background: white;
    color: #1a472a;
    font-weight: 600;
    border: none;
    position: relative;
    overflow: hidden;
}

.btn-hero-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-hero-primary:hover::before {
    left: 100%;
}

.btn-hero-secondary {
    background: transparent;
    color: white;
    border: 2px solid rgba(255,255,255,0.3);
    font-weight: 600;
    text-decoration: none;
    padding: 12px 24px;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.btn-hero-secondary:hover {
    background: rgba(255,255,255,0.1);
    border-color: rgba(255,255,255,0.5);
}

.trust-indicators {
    display: flex;
    gap: 24px;
    flex-wrap: wrap;
}

.trust-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.8);
    background: rgba(255,255,255,0.1);
    padding: 8px 12px;
    border-radius: 12px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
}

.trust-item i {
    opacity: 0.8;
}

/* App Preview Styles */
.hero-visual {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 600px;
}

.app-preview-container {
    position: relative;
    width: 320px;
    height: 640px;
    background: linear-gradient(145deg, #f0f0f0 0%, #e8e8e8 100%);
    border-radius: 40px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    overflow: hidden;
    border: 16px solid #f0f0f0;
}

.app-header {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 80px;
    background: linear-gradient(135deg, #1a472a 0%, #d35400 100%);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 24px;
    z-index: 10;
}

.app-icon {
    color: white;
    font-size: 24px;
}

.app-title {
    color: white;
    font-size: 18px;
    font-weight: bold;
    margin: 0;
}

.app-badge {
    background: rgba(255,255,255,0.2);
    color: white;
    padding: 4px 8px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 600;
}

.app-content {
    position: absolute;
    top: 80px;
    left: 0;
    right: 0;
    bottom: 80px;
    background: #f8f9fa;
    overflow: hidden;
}

.demo-screen {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: none;
    padding: 20px;
    background: white;
}

.demo-screen.active {
    display: block;
}

.screen-title {
    font-size: 18px;
    font-weight: bold;
    color: #1a472a;
    margin-bottom: 20px;
}

.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 20px;
}

.stat-card {
    background: #f8f9fa;
    padding: 16px;
    border-radius: 12px;
    border-left: 4px solid #d35400;
    text-align: center;
}

.stat-value {
    display: block;
    font-size: 20px;
    font-weight: bold;
    color: #1a472a;
    margin-bottom: 4px;
}

.stat-label {
    font-size: 12px;
    color: #6c757d;
    text-transform: uppercase;
}

.recent-transactions h4 {
    font-size: 16px;
    color: #1a472a;
    margin-bottom: 12px;
    font-weight: 600;
}

.transaction-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 8px;
}

.transaction-item i {
    color: #6c757d;
}

.transaction-item .transaction-info {
    flex: 1;
}

.transaction-item strong {
    display: block;
    color: #1a472a;
    font-size: 14px;
}

.transaction-item small {
    color: #6c757d;
}

.status-badge.success {
    background: #d4edda;
    color: #155724;
    font-size: 10px;
    padding: 4px 8px;
    border-radius: 8px;
}

.transaction-form-demo {
    margin-top: 20px;
}

.transaction-form-demo .form-group {
    margin-bottom: 16px;
}

.transaction-form-demo input {
    width: 100%;
    padding: 12px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 14px;
    background: white;
}

.transaction-form-demo select {
    width: 100%;
    padding: 12px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 14px;
    background: white;
}

.transaction-form-demo .farmer-found {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    border-radius: 8px;
    padding: 12px;
    margin-top: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.total-amount {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 12px;
    margin-top: 12px;
    font-weight: bold;
    color: white;
}

.total-amount .amount {
    font-size: 18px;
    color: var(--tigula-orange);
}

.total-amount .label {
    font-size: 12px;
    opacity: 0.8;
}
</style>
@endpush
@endsection
