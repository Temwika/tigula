@extends('layouts.app', ['hideNav' => true])

@section('title', 'Welcome to TIGULA')

@section('content')
<div class="xtransfer-login">
    <!-- Header Navigation -->
    <nav class="login-nav">
        <div class="nav-brand">
            <span class="brand-icon">
                <i class="fas fa-seedling"></i>
            </span>
            <span class="brand-text">TIGULA</span>
        </div>

        <div class="nav-links">
            <a href="{{ route('welcome') }}" class="nav-link">Home</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-outline-secondary">
                    <i class="fas fa-user-plus me-1"></i>Create Account
                </a>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="login-hero">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title animate-slide-in">Welcome Back to TIGULA</h1>
                    <p class="hero-subtitle animate-slide-in" style="animation-delay: 0.1s;">
                        Smart Grain Trading Platform for<br>Zambia's Agricultural Sector
                    </p>

                    <div class="hero-features animate-slide-in" style="animation-delay: 0.2s;">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="feature-text">
                                <strong>ZMW 50M+</strong>
                                <span>Payments Processed</span>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="feature-text">
                                <strong>10,000+</strong>
                                <span>Farmers Served</span>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="feature-text">
                                <strong>500+</strong>
                                <span>Agro-Dealers</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Login Form (xTransfer Style) -->
                <div class="login-form-container animate-slide-in" style="animation-delay: 0.3s;">
                    <div class="login-card">
                        <div class="login-header">
                            <h2 class="login-title">
                                <i class="fas fa-sign-in-alt me-2 text-primary"></i>Sign In
                            </h2>
                            <p class="login-subtitle">Access your account to start trading</p>
                        </div>

                        <div class="login-body">
                            <!-- Alert Messages -->
                            @if (session('status'))
                                <div class="alert alert-xtransfer alert-success animate-fade-in">
                                    <i class="fas fa-check-circle alert-icon"></i>
                                    <span>{{ session('status') }}</span>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-xtransfer alert-danger animate-fade-in">
                                    <i class="fas fa-exclamation-triangle alert-icon"></i>
                                    <span>{{ session('error') }}</span>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-xtransfer alert-danger animate-fade-in">
                                    <i class="fas fa-exclamation-triangle alert-icon"></i>
                                    <ul class="mb-0 mt-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}" class="login-form" novalidate>
                                @csrf

                                <!-- Email Field -->
                                <div class="form-group">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input id="email" type="email"
                                               class="form-control form-control-xtransfer @error('email') is-invalid @enderror"
                                               name="email"
                                               value="{{ old('email') }}"
                                               required
                                               autocomplete="email"
                                               autofocus
                                               placeholder="Enter your email address">

                                        @error('email')
                                            <div class="invalid-feedback">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password Field -->
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        Password
                                        <span class="float-end">
                                            <button type="button" class="btn-link-small text-muted" onclick="togglePassword()">
                                                <i class="fas fa-eye" id="password-toggle-icon"></i>
                                            </button>
                                        </span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input id="password" type="password"
                                               class="form-control form-control-xtransfer @error('password') is-invalid @enderror"
                                               name="password"
                                               required
                                               autocomplete="current-password"
                                               placeholder="Enter your password">

                                        @error('password')
                                            <div class="invalid-feedback">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Remember Me -->
                                <div class="form-group form-check-group">
                                    <label class="form-check-label-xtransfer">
                                        <input class="form-check-input-xtransfer" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="check-mark"></span>
                                        Remember me for 30 days
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-actions">
                                    <button type="submit" class="btn-login-primary" disabled id="login-btn">
                                        <span class="btn-text">
                                            <i class="fas fa-sign-in-alt me-2"></i>Sign In to Your Account
                                        </span>
                                        <div class="btn-spinner d-none">
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </button>
                                </div>

                                <!-- Links -->
                                <div class="form-footer">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="link-forgot">
                                            <i class="fas fa-key me-1"></i>Forgot your password?
                                        </a>
                                    @endif

                                    @if (Route::has('register'))
                                        <div class="signup-prompt">
                                            Don't have an account?
                                            <a href="{{ route('register') }}" class="link-signup">
                                                <i class="fas fa-user-plus me-1"></i>Create one now
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Trust Signals -->
                    <div class="trust-block">
                        <div class="trust-badges">
                            <span class="trust-badge">
                                <i class="fas fa-lock"></i>
                                Secure & Encrypted
                            </span>
                            <span class="trust-badge">
                                <i class="fas fa-shield-alt"></i>
                                Bank-Grade Security
                            </span>
                        </div>

                        <div class="login-features">
                            <div class="login-feature-item">
                                <i class="fas fa-mobile-alt text-success"></i>
                                <span>Mobile money payments</span>
                            </div>
                            <div class="login-feature-item">
                                <i class="fas fa-users text-primary"></i>
                                <span>Farmer management</span>
                            </div>
                            <div class="login-feature-item">
                                <i class="fas fa-chart-line text-warning"></i>
                                <span>Market insights</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background Pattern -->
        <div class="hero-background">
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
/* xTransfer Login Page Styles */
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
    --shadow-soft: 0 2px 10px rgba(0,0,0,0.08);
    --shadow-medium: 0 4px 20px rgba(0,0,0,0.12);
    --shadow-large: 0 8px 32px rgba(0,0,0,0.16);
}

/* Navigation */
.login-nav {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(0,0,0,0.08);
}

.nav-brand {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.brand-icon {
    width: 40px;
    height: 40px;
    background: var(--tigula-gradient);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.brand-text {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--tigula-primary);
    letter-spacing: -0.5px;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.nav-link {
    color: #6c757d;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.nav-link:hover {
    color: var(--tigula-primary);
}

.btn-outline-secondary {
    background: transparent;
    color: var(--tigula-primary);
    border: 2px solid var(--tigula-primary);
    padding: 0.5rem 1.25rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-outline-secondary:hover {
    background: var(--tigula-primary);
    color: white;
    transform: translateY(-1px);
}

/* Hero Section */
.xtransfer-login {
    min-height: 100vh;
    background: var(--tigula-gradient);
    position: relative;
    overflow: hidden;
}

.login-hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    position: relative;
    z-index: 10;
}

.hero-container {
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
}

.hero-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    min-height: 600px;
}

.hero-text {
    color: white;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.hero-subtitle {
    font-size: 1.4rem;
    opacity: 0.9;
    line-height: 1.5;
    margin-bottom: 3rem;
}

.hero-features {
    display: flex;
    gap: 2rem;
    margin-top: 2rem;
}

.feature-item {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 12px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    min-width: 200px;
}

.feature-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.feature-text strong {
    display: block;
    font-size: 1.5rem;
    font-weight: 800;
}

.feature-text span {
    font-size: 0.9rem;
    opacity: 0.8;
}

/* Login Form */
.login-form-container {
    max-width: 450px;
}

.login-card {
    background: white;
    border-radius: 20px;
    box-shadow: var(--shadow-large);
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.08);
}

.login-header {
    padding: 2.5rem 2rem 1.5rem;
    text-align: center;
    border-bottom: 1px solid #f0f2f5;
}

.login-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--tigula-dark);
    margin-bottom: 0.5rem;
}

.login-subtitle {
    color: #6c757d;
    font-size: 1rem;
    margin: 0;
}

.login-body {
    padding: 2rem;
}

.alert-xtransfer {
    padding: 1rem 1.25rem;
    border-radius: 12px;
    border: none;
    font-size: 0.95rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
}

.alert-xtransfer.alert-success {
    background: #d4edda;
    color: #155724;
}

.alert-xtransfer.alert-danger {
    background: #f8d7da;
    color: #721c24;
}

.alert-icon {
    margin-top: 0.1rem;
}

.login-form {
    margin-top: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: var(--tigula-dark);
    margin-bottom: 0.5rem;
    display: block;
}

.input-group {
    position: relative;
}

.input-group-text {
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 48px;
    background: none;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    z-index: 10;
    pointer-events: none;
}

.form-control-xtransfer {
    padding: 0.875rem 1rem 0.875rem 3rem;
    border: 2px solid #e1e5e9;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fcfdfe;
}

.form-control-xtransfer:focus {
    border-color: var(--tigula-primary);
    box-shadow: 0 0 0 3px rgba(26, 71, 42, 0.1);
    background: white;
    outline: none;
}

.form-control-xtransfer::placeholder {
    color: #9ca3af;
}

.is-invalid {
    border-color: var(--tigula-danger) !important;
}

.invalid-feedback {
    display: block;
    color: var(--tigula-danger);
    font-size: 0.875rem;
    margin-top: 0.5rem;
    font-weight: 500;
}

/* Custom Checkbox */
.form-check-group {
    margin-bottom: 2rem;
}

.form-check-label-xtransfer {
    position: relative;
    cursor: pointer;
    font-size: 0.95rem;
    color: #6c757d;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding-left: 2rem;
    margin-bottom: 0;
    line-height: 1.4;
}

.form-check-input-xtransfer {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.check-mark {
    position: absolute;
    left: 0;
    top: 0.1rem;
    width: 1.2rem;
    height: 1.2rem;
    border: 2px solid #d1d5db;
    border-radius: 4px;
    background: white;
    transition: all 0.3s ease;
}

.form-check-input-xtransfer:checked + .check-mark {
    background: var(--tigula-primary);
    border-color: var(--tigula-primary);
}

.form-check-input-xtransfer:checked + .check-mark::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 0.8rem;
    font-weight: bold;
}

/* Button Styles */
.form-actions {
    margin: 2rem 0 1.5rem;
}

.btn-login-primary {
    width: 100%;
    background: var(--tigula-gradient);
    color: white;
    border: none;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    cursor: pointer;
    min-height: 48px;
}

.btn-login-primary:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

.btn-login-primary:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.btn-text {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Form Footer */
.form-footer {
    text-align: center;
    padding-top: 1rem;
    border-top: 1px solid #f0f2f5;
}

.link-forgot {
    color: #6c757d;
    text-decoration: none;
    font-size: 0.95rem;
    font-weight: 500;
    display: inline-block;
    margin-bottom: 1rem;
    transition: color 0.3s ease;
}

.link-forgot:hover {
    color: var(--tigula-primary);
}

.signup-prompt {
    font-size: 0.95rem;
    color: #6c757d;
    margin: 0;
}

.link-signup {
    color: var(--tigula-primary);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.link-signup:hover {
    color: var(--tigula-secondary);
}

/* Trust Block */
.trust-block {
    background: #f8fafc;
    padding: 2rem;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
}

.trust-badges {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

.trust-badge {
    background: white;
    border: 1px solid #e1e5e9;
    border-radius: 20px;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    color: #374151;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
}

.login-features {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

.login-feature-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: #6c757d;
    font-weight: 500;
}

/* Background Shapes */
.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
    z-index: 1;
}

.floating-shapes .shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.1;
}

.shape-1 {
    width: 300px;
    height: 300px;
    background: rgba(255,255,255,0.3);
    top: 10%;
    right: 15%;
    animation: float 6s ease-in-out infinite;
}

.shape-2 {
    width: 200px;
    height: 200px;
    background: rgba(255,255,255,0.2);
    bottom: 20%;
    left: 10%;
    animation: float 8s ease-in-out infinite reverse;
}

.shape-3 {
    width: 150px;
    height: 150px;
    background: rgba(255,255,255,0.25);
    top: 40%;
    left: 60%;
    animation: float 7s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
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

.animate-slide-in {
    animation: slideInUp 0.6s ease-out;
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
    .hero-content {
        grid-template-columns: 1fr;
        gap: 2rem;
        text-align: center;
    }

    .hero-title {
        font-size: 2.5rem;
    }

    .hero-features {
        justify-content: center;
        flex-wrap: wrap;
    }

    .feature-item {
        min-width: auto;
        flex: 1;
        max-width: 140px;
    }

    .login-nav {
        padding: 1rem;
    }

    .nav-links {
        gap: 1rem;
    }

    .login-card {
        border-radius: 16px;
        margin: 0 1rem;
    }

    .login-header,
    .login-body {
        padding: 1.5rem;
    }

    .trust-block {
        padding: 1.5rem;
    }

    .trust-badges {
        justify-content: center;
    }

    .login-features {
        flex-direction: column;
        text-align: center;
    }
}

/* Password Toggle */
.btn-link-small {
    background: none;
    border: none;
    color: inherit;
    text-decoration: none;
    padding: 0.25rem;
    border-radius: 4px;
    transition: background-color 0.3s ease;
    font-size: 0.875rem;
    cursor: pointer;
}

.btn-link-small:hover {
    background-color: rgba(0,0,0,0.05);
}

.btn-link-small:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(26, 71, 42, 0.2);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const loginBtn = document.getElementById('login-btn');

    function checkFormValidity() {
        if (emailInput.value.trim() !== '' && passwordInput.value.trim() !== '') {
            loginBtn.disabled = false;
        } else {
            loginBtn.disabled = true;
        }
    }

    emailInput.addEventListener('input', checkFormValidity);
    passwordInput.addEventListener('input', checkFormValidity);

    // Form submission
    const form = document.querySelector('.login-form');
    form.addEventListener('submit', function() {
        loginBtn.disabled = true;
        document.querySelector('.btn-text').style.display = 'none';
        document.querySelector('.btn-spinner').classList.remove('d-none');
    });

    // Password visibility toggle
    window.togglePassword = function() {
        const passwordField = document.getElementById('password');
        const toggleIcon = document.getElementById('password-toggle-icon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.className = 'fas fa-eye-slash';
        } else {
            passwordField.type = 'password';
            toggleIcon.className = 'fas fa-eye';
        }
    };

    checkFormValidity();
});
</script>
@endpush

@endsection

</final_file_content>

IMPORTANT: For any future changes to this file, use the final_file_content shown above as your reference. This content reflects the current state of the file, including any auto-formatting (e.g., if you used single quotes but the formatter converted them to double quotes). Always base your SEARCH/REPLACE operations on this final version to ensure accuracy.

<environment_details>
# Visual Studio Code Visible Files
resources/views/auth/login.blade.php

# Visual Studio Code Open Tabs
app/Models/Farmer.php
app/Models/GrainType.php
app/Models/Depot.php
app/Models/Transaction.php
app/Models/Payment.php
app/Models/Notification.php
app/Models/AuditLog.php
app/Http/Controllers/Auth/DashboardController.php
app/Http/Controllers/Auth/FarmerController.php
app/Http/Controllers/Auth/TransactionController.php
app/Http/Controllers/Auth/PaymentController.php
app/Http/Controllers/Auth/GrainTypeController.php
app/Http/Controllers/Auth/DepotController.php
app/Http/Controllers/Auth/ReportController.php
composer.json
resources/views/payments/pending.blade.php
routes/web.php
app/Services/PaymentService.php
app/Http/Middleware/CheckRole.php
bootstrap/app.php
app/Http/Middleware/AdminMiddleware.php
app/Http/Controllers/PaymentController.php
database/seeders/InitialDataSeeder.php
database/migrations/2025_10_11_002852_create_payments_table.php
database/migrations/2025_10_11_002846_create_transactions_table.php
database/migrations/2025_10_11_002841_create_depots_table.php
database/migrations/2025_10_11_002835_create_grain_types_table.php
database/migrations/2025_10_11_002830_create_farmers_table.php
database/migrations/2025_10_11_002655_add_role_and_phone_to_users.php
app/Models/User.php
app/Http/Controllers/TransactionController.php
config/services.php
SMS_SETUP.md
test-zamtel.php
.env
app/Services/NotificationService.php
resources/views/transactions/index.blade.php
resources/views/layouts/app.blade.php
resources/views/transactions/create.blade.php
resources/views/welcome.blade.php
resources/views/dashboard.blade.php
app/Http/Controllers/Auth/LoginController.php
resources/views/auth/login.blade.php
app/Http/Controllers/Auth/VerificationController.php
app/Http/Controllers/Auth/ResetPasswordController.php
app/Http/Controllers/Auth/ConfirmPasswordController.php
app/Http/Controllers/Auth/RegisterController.php
resources/views/transactions/quick-create.blade.php
app/Models/FloatAllocation.php
database/migrations/2025_10_11_014129_create_float_allocations_table.php
app/Http/Controllers/FarmerController.php
resources/views/farmers/index.blade.php
resources/views/farmers/show.blade.php
resources/sass/app.scss
resources/views/transactions/show.blade.php
resources/views/transactions/pending.blade.php
database/seeders/DatabaseSeeder.php
resources/views/farmers/create.blade.php
.gitignore
README.md
database/migrations/2025_10_12_133108_create_notifications_table.php
database/migrations/2025_10_12_115813_add_sample_grain_types_and_depots.php
app/Http/Controllers/Controller.php
app/Http/Controllers/DashboardController.php
resources/views/payments/index.blade.php
routes/api.php

# Current Time
10/14/2025, 1:53:08 AM (Africa/Johousands, UTC+2:00)

# Current Mode
ACT MODE
</error_details>
<environment_details>
# Visual Studio Code Visible Files
resources/views/auth/login.blade.php

# Visual Studio Code Open Tabs
app/Models/Farmer.php
app/Models/GrainType.php
app/Models/Depot.php
app/Models/Transaction.php
app/Models/Payment.php
app/Models/Notification.php
app/Models/AuditLog.php
app/Http/Controllers/Auth/DashboardController.php
app/Http/Controllers/Auth/FarmerController.php
app/Http/Controllers/Auth/TransactionController.php
app/Http/Controllers/Auth/PaymentController.php
app/Http/Controllers/Auth/GrainTypeController.php
app/Http/Controllers/Auth/DepotController.php
app/Http/Controllers/Auth/ReportController.php
composer.json
resources/views/payments/pending.blade.php
routes/web.php
app/Services/PaymentService.php
app/Http/Middleware/CheckRole.php
bootstrap/app.php
app/Http/Middleware/AdminMiddleware.php
app/Http/Controllers/PaymentController.php
database/seeders/InitialDataSeeder.php
database/migrations/2025_10_11_002852_create_payments_table.php
database/migrations/2025_10_11_002846_create_transactions_table.php
database/migrations/2025_10_11_002841_create_depots_table.php
database/migrations/2025_10_11_002835_create_grain_types_table.php
database/migrations/2025_10_11_002830_create_farmers_table.php
database/migrations/2025_10_11_002655_add_role_and_phone_to_users.php
app/Models/User.php
app/Http/Controllers/TransactionController.php
config/services.php
SMS_SETUP.md
test-zamtel.php
.env
app/Services/NotificationService.php
resources/views/transactions/index.blade.php
resources/views/layouts/app.blade.php
resources/views/transactions/create.blade.php
resources/views/welcome.blade.php
resources/views/dashboard.blade.php
app/Http/Controllers/Auth/LoginController.php
resources/views/auth/login.blade.php
app/Http/Controllers/Auth/VerificationController.php
app/Http/Controllers/Auth/ResetPasswordController.php
app/Http/Controllers/Auth/ConfirmPasswordController.php
app/Http/Controllers/Auth/RegisterController.php
resources/views/transactions/quick-create.blade.php
app/Models/FloatAllocation.php
database/migrations/2025_10_11_014129_create_float_allocations_table.php
app/Http/Controllers/FarmerController.php
resources/views/farmers/index.blade.php
resources/views/farmers/show.blade.php
resources/sass/app.scss
resources/views/transactions/show.blade.php
resources/views/transactions/pending.blade.php
database/seeders/DatabaseSeeder.php
resources/views/farmers/create.blade.php
.gitignore
README.md
database/migrations/2025_10_12_133108_create_notifications_table.php
database/migrations/2025_10_12_115813_add_sample_grain_types_and_depots.php
app/Http/Controllers/Controller.php
app/Http/Controllers/DashboardController.php
resources/views/payments/index.blade.php
routes/api.php

# Current Time
10/14/2025, 1:53:08 AM (Africa/Johannesburg, UTC+2:00)

# Current Mode
ACT MODE
