@extends('layouts.login')

@section('title', 'Sign In - TIGULA')

@section('content')
<!-- Simple, clean login page -->
<div class="login-simple">
    <div class="login-card">
        <!-- Header -->
        <div class="login-header">
            <div class="logo">
                <i class="fas fa-seedling"></i>
            </div>
            <h2>Welcome to Tigula</h2>
            <p>Sign in to manage grain payments</p>
        </div>

        <!-- Form -->
        <div class="login-body">
            @if(session('success'))
                <div class="alert success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert error">
                    <i class="fas fa-exclamation-triangle"></i>
                    @foreach($errors->all() as $error)
                        {{ $error }}@if(!$loop->last)<br>@endif
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="form-group remember">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </button>
            </form>

            @if(Route::has('password.request'))
            <div class="forgot-link">
                <a href="{{ route('password.request') }}">
                    <i class="fas fa-key"></i> Forgot password?
                </a>
            </div>
            @endif

            @if(Route::has('register'))
            <div class="register-link">
                <a href="{{ route('register') }}">
                    <i class="fas fa-user-plus"></i> Create Account
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.login-simple {
    min-height: 100vh;
    background: linear-gradient(135deg, #2d6a4f 0%, #ff6600 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.login-card {
    max-width: 380px;
    width: 100%;
    background: white;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    overflow: hidden;
}

.login-header {
    background: linear-gradient(135deg, #2d6a4f 0%, #ff6600 100%);
    color: white;
    padding: 30px 20px;
    text-align: center;
}

.login-header .logo {
    font-size: 2.5rem;
    margin-bottom: 15px;
}

.login-header h2 {
    margin: 0 0 8px 0;
    font-size: 1.4rem;
    font-weight: 700;
}

.login-header p {
    margin: 0;
    opacity: 0.9;
    font-size: 0.9rem;
}

.login-body {
    padding: 30px 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group input {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 1rem;
    background: #fafafa;
    box-sizing: border-box;
    transition: border-color 0.3s;
}

.form-group input:focus {
    border-color: #2d6a4f;
    outline: none;
    background: white;
}

.form-group.remember {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
}

.form-group.remember label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    color: #6c757d;
    cursor: pointer;
    margin: 0;
}

.btn-login {
    width: 100%;
    background: linear-gradient(135deg, #2d6a4f 0%, #ff6600 100%);
    color: white;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-login:hover {
    transform: scale(1.02);
}

.btn-login:active {
    transform: scale(0.98);
}

.forgot-link, .register-link {
    text-align: center;
    margin-top: 20px;
}

.forgot-link a, .register-link a {
    color: #6c757d;
    text-decoration: none;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: color 0.3s;
}

.register-link a {
    color: #2d6a4f;
    font-weight: 600;
    border-top: 1px solid #f0f0f0;
    padding-top: 20px;
    width: 100%;
    justify-content: center;
}

.alert {
    padding: 10px 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    display: flex;
    align-items: flex-start;
    gap: 8px;
    font-size: 0.9rem;
    border-left: 4px solid;
}

.alert.success {
    background: #d4edda;
    color: #155724;
    border-left-color: #28a745;
}

.alert.error {
    background: #f8d7da;
    color: #721c24;
    border-left-color: #dc3545;
}

.alert i {
    margin-top: 2px;
}

@media (max-width: 480px) {
    .login-simple {
        padding: 15px;
    }

    .login-card {
        max-width: none;
    }

    .login-header, .login-body {
        padding: 20px 15px;
    }
}
</style>

@endsection

<section style="
    background: linear-gradient(135deg, #2d6a4f 0%, #ff6600 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
">
    <div style="
        max-width: 400px;
        width: 100%;
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    ">
        <!-- Header -->
        <div style="
            background: linear-gradient(135deg, #2d6a4f 0%, #ff6600 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        ">
            <div style="font-size: 3rem; margin-bottom: 10px;">
                <i class="fas fa-seedling"></i>
            </div>
            <h2 style="margin: 0; font-size: 1.5rem; font-weight: 700;">Welcome to Tigula</h2>
            <p style="margin: 10px 0 0 0; opacity: 0.9; font-size: 0.9rem;">
                Sign in to manage grain payments
            </p>
        </div>

        <!-- Form -->
        <div style="padding: 30px 20px;">
            @if(session('success'))
                <div style="
                    background: #d4edda;
                    color: #155724;
                    padding: 10px;
                    border-radius: 8px;
                    margin-bottom: 20px;
                    border-left: 4px solid #28a745;
                ">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div style="
                    background: #f8d7da;
                    color: #721c24;
                    padding: 10px;
                    border-radius: 8px;
                    margin-bottom: 20px;
                    border-left: 4px solid #dc3545;
                ">
                    <i class="fas fa-exclamation-triangle"></i>
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div style="margin-bottom: 20px;">
                    <input
                        type="email"
                        name="email"
                        placeholder="Email Address"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        style="
                            width: 100%;
                            padding: 12px 15px;
                            border: 2px solid #e1e5e9;
                            border-radius: 8px;
                            font-size: 1rem;
                            background: #fafafa;
                            transition: border-color 0.3s;
                            box-sizing: border-box;
                        "
                        onfocus="this.style.borderColor='#2d6a4f'"
                        onblur="this.style.borderColor='#e1e5e9'"
                    >
                </div>

                <div style="margin-bottom: 20px;">
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                        style="
                            width: 100%;
                            padding: 12px 15px;
                            border: 2px solid #e1e5e9;
                            border-radius: 8px;
                            font-size: 1rem;
                            background: #fafafa;
                            transition: border-color 0.3s;
                            box-sizing: border-box;
                        "
                        onfocus="this.style.borderColor='#2d6a4f'"
                        onblur="this.style.borderColor='#e1e5e9'"
                    >
                </div>

                <div style="display: flex; align-items: center; margin-bottom: 25px;">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        style="margin-right: 8px;"
                        {{ old('remember') ? 'checked' : '' }}
                    >
                    <label for="remember" style="color: #6c757d; font-size: 0.9rem; cursor: pointer; margin: 0;">
                        Remember me
                    </label>
                </div>

                <button
                    type="submit"
                    style="
                        width: 100%;
                        background: linear-gradient(135deg, #2d6a4f 0%, #ff6600 100%);
                        color: white;
                        border: none;
                        padding: 12px;
                        border-radius: 8px;
                        font-size: 1.1rem;
                        font-weight: 600;
                        cursor: pointer;
                        transition: transform 0.2s;
                    "
                    onmousedown="this.style.transform='scale(0.98)'"
                    onmouseup="this.style.transform='scale(1)'"
                    onmouseleave="this.style.transform='scale(1)'"
                >
                    <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>
                    Sign In
                </button>
            </form>

            @if(Route::has('password.request'))
            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('password.request') }}" style="color: #6c757d; text-decoration: none; font-size: 0.9rem;">
                    <i class="fas fa-key"></i> Forgot password?
                </a>
            </div>
            @endif

            @if(Route::has('register'))
            <div style="text-align: center; margin-top: 15px; padding-top: 20px; border-top: 1px solid #f0f0f0;">
                <a href="{{ route('register') }}" style="color: #2d6a4f; text-decoration: none; font-weight: 600;">
                    <i class="fas fa-user-plus"></i> Create Account
                </a>
            </div>
            @endif
        </div>
    </div>
</section>

/* Mobile optimization */
@media (max-width: 480px) {
    .welcome-header {
        padding: 1rem;
    }

    .action-row {
        flex-direction: column;
        gap: 0.5rem;
    }
}

<style>
/* XTransfer-style Login Page */
.xtransfer-login {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

.xtransfer-login::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="60" cy="30" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
    opacity: 0.3;
}

/* Navigation */
.login-nav {
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
.login-main {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    position: relative;
    z-index: 10;
}

.login-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    max-width: 1200px;
    width: 100%;
}

.login-left {
    text-align: center;
}

.login-logo {
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

.login-logo i {
    font-size: 2.5rem;
    color: white;
}

.login-title {
    font-size: 3rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.login-subtitle {
    font-size: 1.2rem;
    color: rgba(255,255,255,0.9);
    margin-bottom: 3rem;
    line-height: 1.6;
}

.login-stats {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-top: 3rem;
}

.stat-item {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 12px;
    padding: 1.5rem;
    min-width: 150px;
}

.stat-number {
    display: block;
    font-size: 1.8rem;
    font-weight: 800;
    color: white;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.8);
    font-weight: 500;
}

/* Login Form */
.login-form-container {
    max-width: 450px;
    width: 100%;
}

.login-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    overflow: hidden;
}

.login-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem;
    text-align: center;
    color: white;
}

.login-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.login-header p {
    opacity: 0.9;
    font-size: 1rem;
}

.login-body {
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

.login-form .form-group {
    margin-bottom: 1.5rem;
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

/* Remember Me */
.form-check-label-xtransfer {
    position: relative;
    cursor: pointer;
    font-size: 0.95rem;
    color: #6b7280;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding-left: 2rem;
}

.form-check-input-xtransfer {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

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

/* Submit Button */
.btn-login-primary {
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

.btn-login-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.btn-login-primary:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

/* Links */
.form-footer {
    text-align: center;
    padding-top: 1.5rem;
    border-top: 1px solid #f3f4f6;
}

.link-forgot {
    color: #6b7280;
    text-decoration: none;
    font-size: 0.9rem;
    display: inline-block;
    margin-bottom: 1rem;
    transition: color 0.3s ease;
}

.link-forgot:hover {
    color: #667eea;
}

.signup-prompt {
    font-size: 0.9rem;
    color: #6b7280;
}

.link-signup {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.link-signup:hover {
    color: #764ba2;
}

/* Responsive */
@media (max-width: 1024px) {
    .login-container {
        grid-template-columns: 1fr;
        gap: 2rem;
        text-align: center;
    }

    .login-left {
        order: 2;
    }

    .login-form-container {
        order: 1;
    }

    .login-main {
        padding: 1rem;
    }
}

@media (max-width: 640px) {
    .login-nav {
        padding: 1rem;
    }

    .brand-text {
        font-size: 1.25rem;
    }

    .btn-outline-secondary {
        padding: 0.4rem 1rem;
        font-size: 0.8rem;
    }

    .login-title {
        font-size: 2.2rem;
    }

    .login-subtitle {
        font-size: 1rem;
    }

    .stat-item {
        min-width: 120px;
        padding: 1rem;
    }

    .login-stats {
        flex-wrap: wrap;
        gap: 1rem;
    }

    .login-header,
    .login-body {
        padding: 1.5rem;
    }
}
</style>

<div class="xtransfer-login">
    <!-- Navigation -->
    <nav class="login-nav">
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
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-outline-secondary">
                    <i class="fas fa-user-plus"></i>Create Account
                </a>
            @endif
        </div>
    </nav>

    <!-- Main Content -->
    <main class="login-main">
        <div class="login-container">
            <!-- Left Side - Branding & Stats -->
            <div class="login-left">
                <div class="login-logo">
                    <i class="fas fa-seedling"></i>
                </div>
                <h1 class="login-title">Welcome Back</h1>
                <p class="login-subtitle">
                    Sign in to continue managing<br>your grain payments
                </p>

                <div class="login-stats">
                    <div class="stat-item">
                        <span class="stat-number">15K+</span>
                        <span class="stat-label">Farmers</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">ZMW 75M</span>
                        <span class="stat-label">Paid</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Dealers</span>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="login-form-container">
                <div class="login-card">
                    <div class="login-header">
                        <h2>Sign In</h2>
                        <p>Access your TIGULA account</p>
                    </div>

                    <div class="login-body">
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

                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf

                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input id="email" type="email" class="form-control form-control-xtransfer @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control form-control-xtransfer @error('password') is-invalid @enderror" name="password" required placeholder="Enter your password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="form-group form-check-group">
                                <label class="form-check-label-xtransfer">
                                    <input class="form-check-input-xtransfer" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="check-mark"></span>
                                    Remember me
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-login-primary" id="login-btn">
                                <span class="btn-text">
                                    <i class="fas fa-sign-in-alt"></i>
                                    Sign In
                                </span>
                            </button>

                            <!-- Links -->
                            <div class="form-footer">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="link-forgot">
                                        <i class="fas fa-key"></i>Forgot password?
                                    </a>
                                @endif

                                @if (Route::has('register'))
                                    <p class="signup-prompt">
                                        Don't have an account?
                                        <a href="{{ route('register') }}" class="link-signup">
                                            <i class="fas fa-user-plus"></i>Create one
                                        </a>
                                    </p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
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
