@extends('layouts.login')

@section('title', 'Sign In - TIGULA')

@section('content')
<div class="login-container">
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
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    @foreach($errors->all() as $error)
                        {{ $error }}@if(!$loop->last)<br>@endif
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email address" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="form-group remember">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Remember me
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
.login-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #1a472a 0%, #d35400 100%);
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
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    overflow: hidden;
}

.login-header {
    background: linear-gradient(135deg, #1a472a 0%, #d35400 100%);
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

.form-group label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    font-size: 0.9rem;
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
    border-color: #1a472a;
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
    background: linear-gradient(135deg, #1a472a 0%, #d35400 100%);
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
    color: #1a472a;
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

.alert-success {
    background: #d4edda;
    color: #155724;
    border-left-color: #28a745;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border-left-color: #dc3545;
}

@media (max-width: 480px) {
    .login-container {
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
