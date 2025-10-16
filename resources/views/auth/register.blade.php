@extends('layouts.login')

@section('title', 'Create Account - TIGULA')

@section('content')
<style>
/* TIGULA Corporate Green & Orange Brand Colors */
:root {
    --tigula-primary-green: #059669;
    --tigula-bright-green: #10b981;
    --tigula-dark-green: #047857;
    --tigula-primary-orange: #ff6600;
    --tigula-bright-orange: #ff8533;
    --tigula-dark-orange: #cc5200;
    --tigula-gradient-green: linear-gradient(135deg, #059669 0%, #10b981 100%);
    --tigula-gradient-orange: linear-gradient(135deg, #ff6600 0%, #ff8533 100%);
    --tigula-gradient-mixed: linear-gradient(135deg, #059669 0%, #ff6600 50%, #10b981 100%);
    --tigula-accent: #ff6600;
    --tigula-success-green: #22c55e;
    --tigula-warning-orange: #f97316;
}

/* Spectacular TIGULA Register Page */
.tigula-register {
    min-height: 100vh;
    background:
        radial-gradient(ellipse 80% 80% at 50% -20%, rgba(5, 150, 105, 0.25), transparent),
        radial-gradient(ellipse 80% 80% at 80% 50%, rgba(255, 102, 0, 0.2), transparent),
        radial-gradient(ellipse 90% 40% at 40% 40%, rgba(16, 185, 129, 0.15), transparent),
        linear-gradient(135deg, #059669 0%, #ff6600 100%);
    position: relative;
    overflow: hidden;
}

.tigula-register::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background:
        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 1200"><defs><radialGradient id="a" cx="0.5" cy="0.5" r="0.5" gradientUnits="objectBoundingBox"><stop offset="0%" stop-color="rgba(255,255,255,0.1)"/><stop offset="100%" stop-color="transparent"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="1000" cy="400" r="80" fill="url(%23a)"/><circle cx="400" cy="800" r="120" fill="url(%23a)"/><circle cx="800" cy="150" r="50" fill="url(%23a)"/><circle cx="600" cy="600" r="90" fill="url(%23a)"/></svg>'),
        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon points="50,0 100,50 50,100 0,50" stroke="rgba(255,255,255,0.05)" fill="none" stroke-width="1"/><polygon points="200,100 250,150 200,200 150,150" stroke="rgba(255,255,255,0.03)" fill="none" stroke-width="1"/><polygon points="800,300 850,350 800,400 750,350" stroke="rgba(255,255,255,0.05)" fill="none" stroke-width="1"/><polygon points="400,700 450,750 400,800 350,750" stroke="rgba(255,255,255,0.03)" fill="none" stroke-width="1"/></svg>');
    animation: backgroundFloat 20s ease-in-out infinite;
}

@keyframes backgroundFloat {
    0%, 100% { transform: translate(-10px, -10px) rotate(0deg); }
    50% { transform: translate(10px, 10px) rotate(2deg); }
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
    background: linear-gradient(135deg, var(--tigula-primary-green), var(--tigula-primary-orange));
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.2);
    position: relative;
    overflow: hidden;
    animation: logoPulse 3s ease-in-out infinite;
    box-shadow: 0 15px 35px rgba(5, 150, 105, 0.4), 0 5px 15px rgba(255, 102, 0, 0.2);
}

.register-logo::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
    animation: logoShine 4s ease-in-out infinite;
}

@keyframes logoPulse {
    0%, 100% { box-shadow: 0 0 20px rgba(5, 150, 105, 0.4), 0 0 30px rgba(255, 102, 0, 0.3); transform: scale(1); }
    50% { box-shadow: 0 0 40px rgba(5, 150, 105, 0.5), 0 0 50px rgba(255, 102, 0, 0.4); transform: scale(1.05); }
}

@keyframes logoShine {
    0% { transform: translateX(-100%); }
    50% { transform: translateX(100%); }
    100% { transform: translateX(100%); }
}

.register-logo i {
    font-size: 2.5rem;
    color: white;
    position: relative;
    z-index: 2;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}

.register-title {
    font-size: 3rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    animation: titleGlow 3s ease-in-out infinite alternate;
}

@keyframes titleGlow {
    from {
        text-shadow: 0 2px 10px rgba(0,0,0,0.2), 0 0 20px rgba(5, 150, 105, 0.4), 0 0 30px rgba(255, 102, 0, 0.3);
    }
    to {
        text-shadow: 0 2px 10px rgba(0,0,0,0.2), 0 0 40px rgba(5, 150, 105, 0.6), 0 0 50px rgba(255, 102, 0, 0.4), 0 0 60px rgba(16, 185, 129, 0.2);
    }
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
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
    animation: benefitPulse 4s ease-in-out infinite;
}

.benefit-item:nth-child(1) { animation-delay: 0s; }
.benefit-item:nth-child(2) { animation-delay: 1s; }
.benefit-item:nth-child(3) { animation-delay: 2s; }

@keyframes benefitPulse {
    0%, 100% {
        transform: scale(1);
        box-shadow: 0 5px 15px rgba(255,255,255,0.1), 0 0 20px rgba(5, 150, 105, 0.2);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(255,255,255,0.25), 0 0 30px rgba(5, 150, 105, 0.4), 0 0 40px rgba(255, 102, 0, 0.3);
    }
}

.benefit-item:hover {
    transform: translateY(-10px) scale(1.08);
    box-shadow: 0 20px 40px rgba(152, 245, 255, 0.3);
    border-color: rgba(152, 245, 255, 0.5);
}

.benefit-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: linear-gradient(135deg, rgba(152, 245, 255, 0.2), rgba(255, 119, 198, 0.2));
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    color: white;
    font-size: 1.5rem;
    animation: iconFloat 3s ease-in-out infinite;
}

@keyframes iconFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
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
    background: var(--tigula-gradient-mixed);
    padding: 2rem;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
}

.register-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><g fill="rgba(255,255,255,0.1)" fill-rule="evenodd"><circle cx="3" cy="3" r="3"/><circle cx="13" cy="13" r="3"/><circle cx="23" cy="23" r="3"/><circle cx="33" cy="33" r="3"/></g></svg>');
    opacity: 0.3;
}

.register-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    position: relative;
    z-index: 1;
}

.register-header p {
    opacity: 0.9;
    font-size: 1rem;
    position: relative;
    z-index: 1;
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
    border-color: var(--tigula-primary-green);
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.15), 0 0 0 6px rgba(255, 102, 0, 0.1);
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
    background: var(--tigula-gradient-mixed);
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
    box-shadow: 0 4px 15px rgba(5, 150, 105, 0.3);
}

.btn-register-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(5, 150, 105, 0.4), 0 4px 20px rgba(255, 102, 0, 0.3);
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
    color: var(--tigula-primary-green);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.link-signin:hover {
    color: var(--tigula-primary-orange);
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

<div class="tigula-register">
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
@endsection
