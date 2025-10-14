@extends('layouts.app', ['hideNav' => true])

@section('title', 'Create Account - TIGULA')

@section('content')
<style>
/* XTransfer-style Register Page */
.xtransfer-register {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

.xtransfer-register::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="80" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="20" cy="80" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="40" r="1.5" fill="rgba(255,255,255,0.1)"/></svg>');
    opacity: 0.3;
}

/* Navigation */
.register-nav {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.nav-brand {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.brand-icon {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.2);
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
    color: white;
    letter-spacing: -0.5px;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.nav-link {
    color: rgba(255,255,255,0.9);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.nav-link:hover {
    color: white;
}

.btn-outline-secondary {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
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
    background: rgba(255,255,255,0.2);
    border-color: rgba(255,255,255,0.5);
    transform: translateY(-1px);
}

/* Main Content */
.register-main {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    position: relative;
    z-index: 10;
}

.register-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    max-width: 1200px;
    width: 100%;
}

.register-left {
    text-align: center;
}

.register-logo {
    width: 80px;
    height: 80px;
    background: rgba(255,255,255,0.15);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    backdrop-filter: blur(10px);
}

.register-logo i {
    font-size: 2.5rem;
    color: white;
}

.register-title {
    font-size: 3rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.register-subtitle {
    font-size: 1.2rem;
    color: rgba(255,255,255,0.9);
    margin-bottom: 3rem;
    line-height: 1.6;
}

.register-benefits {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-top: 3rem;
}

.benefit-item {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 12px;
    padding: 1.5rem;
    min-width: 150px;
}

.benefit-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    color: white;
    font-size: 1.5rem;
}

.benefit-item h4 {
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.benefit-item p {
    color: rgba(255,255,255,0.8);
    font-size: 0.9rem;
    margin: 0;
}

/* Register Form */
.register-form-container {
    max-width: 450px;
    width: 100%;
}

.register-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    overflow: hidden;
}

.register-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem;
    text-align: center;
    color: white;
}

.register-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.register-header p {
    opacity: 0.9;
    font-size: 1rem;
}

.register-body {
    padding: 2.5rem;
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

.alert-success {
    background: #d4edda;
    color: #155724;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
}

.register-form .form-group {
    margin-bottom: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.form-label {
    font-weight: 600;
    color: #374151;
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
    color: #6b7280;
    z-index: 10;
}

.form-control-xtransfer {
    padding: 0.875rem 1rem 0.875rem 3rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fafafa;
}

.form-control-xtransfer:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background: white;
}

.is-invalid {
    border-color: #ef4444 !important;
}

.invalid-feedback {
    display: block;
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

/* Submit Button */
.btn-register-primary {
    width: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 1rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-register-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.btn-register-primary:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

/* Footer */
.form-footer {
    text-align: center;
    padding-top: 1.5rem;
    border-top: 1px solid #f3f4f6;
}

.signup-prompt {
    font-size: 0.9rem;
    color: #6b7280;
}

.link-signin {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.link-signin:hover {
    color: #764ba2;
}

/* Terms & Conditions */
.terms-section {
    background: #f8fafc;
    padding: 1rem;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
    text-align: center;
}

.terms-text {
    font-size: 0.85rem;
    color: #6b7280;
    margin: 0;
}

.terms-link {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
}

.terms-link:hover {
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 1024px) {
    .register-container {
        grid-template-columns: 1fr;
        gap: 2rem;
        text-align: center;
    }

    .register-left {
        order: 2;
    }

    .register-form-container {
        order: 1;
    }

    .register-main {
        padding: 1rem;
    }

    .register-benefits {
        flex-wrap: wrap;
        gap: 1rem;
    }
}

@media (max-width: 640px) {
    .register-nav {
        padding: 1rem;
    }

    .brand-text {
        font-size: 1.25rem;
    }

    .btn-outline-secondary {
        padding: 0.4rem 1rem;
        font-size: 0.8rem;
    }

    .register-title {
        font-size: 2.2rem;
    }

    .register-subtitle {
        font-size: 1rem;
    }

    .benefit-item {
        min-width: 120px;
        padding: 1rem;
    }

    .register-benefits {
        flex-direction: column;
        align-items: center;
    }

    .register-header,
    .register-body {
        padding: 1.5rem;
    }

    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }
}
</style>

<div class="xtransfer-register">
    <!-- Navigation -->
    <nav class="register-nav">
        <div class="nav-brand">
            <a href="{{ route('welcome') }}" style="display: flex; align-items: center; gap: 0.75rem; color: white; text-decoration: none;">
                <span class="brand-icon">
                    <i class="fas fa-seedling"></i>
                </span>
                <span class="brand-text">TIGULA</span>
            </a>
        </div>

        <div class="nav-links">
            <a href="{{ route('welcome') }}" class="nav-link">Home</a>
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="btn-outline-secondary">
                    <i class="fas fa-sign-in-alt"></i>Sign In
                </a>
            @endif
        </div>
    </nav>

    <!-- Main Content -->
    <main class="register-main">
        <div class="register-container">
            <!-- Left Side - Branding & Benefits -->
            <div class="register-left">
                <div class="register-logo">
                    <i class="fas fa-seedling"></i>
                </div>
                <h1 class="register-title">Join TIGULA Today</h1>
                <p class="register-subtitle">
                    Start managing farmer payments and track your grain transactions securely
                </p>

                <div class="register-benefits">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4>Mobile Money</h4>
                        <p>Instant payments</p>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Secure</h4>
                        <p>Bank-level protection</p>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Analytics</h4>
                        <p>Real-time insights</p>
                    </div>
                </div>
            </div>

            <!-- Right Side - Register Form -->
            <div class="register-form-container">
                <div class="register-card">
                    <div class="register-header">
                        <h2>Create Account</h2>
                        <p>Get started with TIGULA in minutes</p>
                    </div>

                    <div class="register-body">
                        @if (session('status'))
                            <div class="alert alert-xtransfer alert-success">
                                <i class="fas fa-check-circle alert-icon"></i>
                                <span>{{ session('status') }}</span>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-xtransfer alert-danger">
                                <i class="fas fa-exclamation-triangle alert-icon"></i>
                                <ul class="mb-0 mt-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}" class="register-form">
                            @csrf

                            <!-- Name & Role -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name" class="form-label">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input id="name" type="text" class="form-control form-control-xtransfer @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your full name">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="role" class="form-label">Type of Account</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-briefcase"></i>
                                        </span>
                                        <select id="role" class="form-control form-control-xtransfer @error('role') is-invalid @enderror" name="role" required>
                                            <option value="">Select account type</option>
                                            <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Agro-Dealer</option>
                                            <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>Cooperative Manager</option>
                                            <option value="3" {{ old('role') == '3' ? 'selected' : '' }}>Grain Buyer</option>
                                            <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>Administrator</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input id="email" type="email" class="form-control form-control-xtransfer @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Enter your email address">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-mobile-alt"></i>
                                    </span>
                                    <input id="phone" type="text" class="form-control form-control-xtransfer @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required placeholder="Enter your phone number">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>

                            <!-- Passwords Row -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input id="password" type="password" class="form-control form-control-xtransfer @error('password') is-invalid @enderror" name="password" required placeholder="Create password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input id="password-confirm" type="password" class="form-control form-control-xtransfer" name="password_confirmation" required placeholder="Confirm password">
                                    </div>
                                </div>
                            </div>

                            <!-- Terms Acceptance -->
                            <div class="form-group">
                                <label class="form-check-label-xtransfer">
                                    <input class="form-check-input-xtransfer" type="checkbox" name="accept_terms" id="accept_terms" required {{ old('accept_terms') ? 'checked' : '' }}>
                                    <span class="check-mark"></span>
                                    I accept the <a href="#" class="link-signin">Terms & Conditions</a> and <a href="#" class="link-signin">Privacy Policy</a>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-register-primary" id="register-btn">
                                <span class="btn-text">
                                    <i class="fas fa-user-plus"></i>
                                    Create Account
                                </span>
                            </button>

                            <!-- Footer -->
                            <div class="form-footer">
                                <p class="signup-prompt">
                                    Already have an account?
                                    <a href="{{ route('login') }}" class="link-signin">
                                        <i class="fas fa-sign-in-alt"></i>Sign in instead
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Terms Section -->
                <div class="terms-section">
                    <p class="terms-text">
                        By creating an account, you agree to our <a href="#" class="terms-link">Terms of Service</a> and <a href="#" class="terms-link">Privacy Policy</a>.
                        We protect your data with bank-level security standards.
                    </p>
                </div>
            </div>
        </div>
    </main>
</div>

@push('styles')
<style>
.check-mark {
    position: absolute;
    left: 0;
    top: 0;
    width: 18px;
    height: 18px;
    border: 2px solid #d1d5db;
    border-radius: 4px;
    background: white;
    transition: all 0.3s ease;
}

.form-check-input-xtransfer:checked + .check-mark {
    background: #667eea;
    border-color: #667eea;
}

.form-check-input-xtransfer:checked + .check-mark::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 12px;
    font-weight: bold;
}

.form-check-label-xtransfer {
    position: relative;
    cursor: pointer;
    font-size: 0.9rem;
    color: #6b7280;
    font-weight: 500;
    display: flex;
    align-items: flex-start;
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
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.register-form');
    const registerBtn = document.getElementById('register-btn');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password-confirm');

    function checkFormValidity() {
        const inputs = form.querySelectorAll('input[required], select[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
            }
        });

        // Check password confirmation
        if (passwordInput.value && confirmInput.value && passwordInput.value !== confirmInput.value) {
            isValid = false;
        }

        registerBtn.disabled = !isValid;
    }

    // Real-time validation
    form.addEventListener('input', checkFormValidity);
    form.addEventListener('change', checkFormValidity);

    // Password confirmation check
    confirmInput.addEventListener('input', function() {
        if (confirmInput.value && passwordInput.value !== confirmInput.value) {
            confirmInput.classList.add('is-invalid');
            if (!confirmInput.parentNode.querySelector('.invalid-feedback')) {
                const feedback = document.createElement('div');
                feedback.className = 'invalid-feedback';
                feedback.textContent = 'Passwords do not match';
                confirmInput.parentNode.appendChild(feedback);
            }
        } else {
            confirmInput.classList.remove('is-invalid');
            const feedback = confirmInput.parentNode.querySelector('.invalid-feedback');
            if (feedback) feedback.remove();
        }
    });

    // Form submission
    form.addEventListener('submit', function() {
        registerBtn.disabled = true;
        registerBtn.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div> Creating Account...';
    });

    checkFormValidity();
});
</script>
@endpush

@endsection

</final_file_content>

IMPORTANT: For any future changes to this file, use the final_file_content shown above as your reference. This content reflects the current state of the file, including any auto-formatting (e.g., if you used single quotes but the formatter converted them to double quotes). Always base your standards.x/password-toggle-icon').className = 'fas fa-eye';
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
resources/views/auth/register.blade.php

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
resources/views/welcome.blade.php
resources/views/auth/login.blade.php
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

# Actively Running Terminals
## Original command: `php artisan serve`

# Current Time
10/14/2025, 3:33:45 PM (Africa/Johannesburg, UTC+2:00)

# Current Mode
ACT MODE
