<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tigula Login - Cashless Grain Trading</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .grain-pattern {
            background-image: 
                radial-gradient(circle at 25px 25px, rgba(255, 165, 0, 0.1) 2px, transparent 2px),
                radial-gradient(circle at 75px 75px, rgba(34, 197, 94, 0.1) 2px, transparent 2px);
            background-size: 100px 100px;
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .input-group {
            position: relative;
        }
        
        .floating-label {
            position: absolute;
            left: 16px;
            top: 16px;
            color: #6b7280;
            transition: all 0.3s ease;
            pointer-events: none;
            background: white;
            padding: 0 4px;
        }
        
        .form-input:focus + .floating-label,
        .form-input:not(:placeholder-shown) + .floating-label {
            top: -8px;
            left: 12px;
            font-size: 12px;
            color: #f97316;
            font-weight: 500;
        }
        
        .form-input {
            background: white;
            border: 2px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
            outline: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            transition: all 0.3s ease;
            transform: translateY(0);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #ea580c 0%, #dc2626 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(249, 115, 22, 0.3);
        }
        
        .stats-card {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-green-50 to-orange-50 flex items-center justify-center p-4">
    
    <!-- Clean Background Pattern -->
    <div class="absolute inset-0 overflow-hidden opacity-40">
        <div class="absolute top-20 left-20 text-3xl opacity-30 floating-animation">🌾</div>
        <div class="absolute top-40 right-32 text-2xl opacity-25 floating-animation" style="animation-delay: 1s;">🚜</div>
        <div class="absolute bottom-32 left-32 text-3xl opacity-30 floating-animation" style="animation-delay: 2s;">🌽</div>
        <div class="absolute bottom-20 right-20 text-2xl opacity-25 floating-animation" style="animation-delay: 3s;">👨‍🌾</div>
    </div>

    <div class="w-full max-w-6xl mx-auto flex items-center justify-center min-h-screen">
        <div class="grid lg:grid-cols-2 gap-12 items-center w-full">
            
            <!-- Left Side - Branding & Info -->
            <div class="hidden lg:block space-y-8">
                <div class="text-center lg:text-left">
                    <!-- Logo -->
                    <div class="flex items-center justify-center lg:justify-start mb-6">
                        <div class="bg-white rounded-full p-4 shadow-2xl">
                            <span class="text-4xl">🌾</span>
                        </div>
                        <div class="ml-4">
                            <h1 class="text-4xl font-bold text-gray-800">Tigula</h1>
                            <p class="text-gray-600 font-medium">Cashless Grain Trading</p>
                        </div>
                    </div>
                    
                    <!-- Main Heading -->
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4 leading-tight">
                        Empowering Small-Scale Farmers in 
                        <span class="text-orange-600">Eastern Province</span>
                    </h2>
                    
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Join the digital revolution in grain trading. Connect farmers with buyers, 
                        eliminate cash risks, and enable instant mobile money payments across Eastern Province.
                    </p>
                </div>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="stats-card rounded-xl p-6 text-center">
                        <div class="text-2xl mb-2">👨‍🌾</div>
                        <div class="text-2xl font-bold text-gray-800">287+</div>
                        <div class="text-sm text-gray-600">Small-Scale Farmers</div>
                    </div>
                    <div class="stats-card rounded-xl p-6 text-center">
                        <div class="text-2xl mb-2">📱</div>
                        <div class="text-2xl font-bold text-gray-800">100%</div>
                        <div class="text-sm text-gray-600">Cashless Payments</div>
                    </div>
                    <div class="stats-card rounded-xl p-6 text-center">
                        <div class="text-2xl mb-2">💰</div>
                        <div class="text-2xl font-bold text-gray-800">K2.3M+</div>
                        <div class="text-sm text-gray-600">Paid to Farmers</div>
                    </div>
                    <div class="stats-card rounded-xl p-6 text-center">
                        <div class="text-2xl mb-2">⚡</div>
                        <div class="text-2xl font-bold text-gray-800">Instant</div>
                        <div class="text-sm text-gray-600">Mobile Money</div>
                    </div>
                </div>
                
                <!-- Features -->
                <div class="space-y-3">
                    <div class="flex items-center text-gray-700">
                        <div class="bg-green-500 rounded-full p-1 mr-3">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span>Zero cash risk for field buyers</span>
                    </div>
                    <div class="flex items-center text-gray-700">
                        <div class="bg-green-500 rounded-full p-1 mr-3">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span>Instant mobile money to farmers</span>
                    </div>
                    <div class="flex items-center text-gray-700">
                        <div class="bg-green-500 rounded-full p-1 mr-3">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span>Real-time transaction tracking</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Login Form -->
            <div class="w-full max-w-md mx-auto">
                <div class="login-card rounded-2xl shadow-2xl p-8">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden text-center mb-8">
                        <div class="flex items-center justify-center mb-4">
                            <div class="bg-gradient-to-r from-orange-500 to-green-500 rounded-full p-3 shadow-lg">
                                <span class="text-2xl">🌾</span>
                            </div>
                            <div class="ml-3">
                                <h1 class="text-2xl font-bold text-gray-800">Tigula</h1>
                                <p class="text-gray-600 text-sm">Cashless Grain Trading</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Welcome Back</h3>
                        <p class="text-gray-600">Sign in to your Tigula account</p>
                    </div>
                    
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">Login Failed</span>
                            </div>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        
                        <!-- Email Input -->
                        <div class="input-group">
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   class="form-input w-full px-4 py-4 rounded-xl text-gray-800 placeholder-transparent @error('email') border-red-500 @enderror" 
                                   placeholder="Email Address"
                                   value="{{ old('email') }}"
                                   required 
                                   autofocus>
                            <label for="email" class="floating-label">📧 Email Address</label>
                            @error('email')
                                <p class="text-red-500 text-sm mt-2 ml-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Password Input -->
                        <div class="input-group">
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   class="form-input w-full px-4 py-4 rounded-xl text-gray-800 placeholder-transparent @error('password') border-red-500 @enderror" 
                                   placeholder="Password"
                                   required>
                            <label for="password" class="floating-label">🔒 Password</label>
                            @error('password')
                                <p class="text-red-500 text-sm mt-2 ml-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Remember Me -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" class="rounded border-gray-300 text-orange-500 shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-600">Remember me</span>
                            </label>
                            
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-orange-600 hover:text-orange-500">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" class="btn-primary w-full py-4 px-6 rounded-xl text-white font-semibold shadow-lg">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Sign In to Tigula
                            </span>
                        </button>
                    </form>
                    
                    <!-- Demo Credentials -->
                    <div class="mt-8 p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Demo Credentials:</h4>
                        <div class="text-xs text-gray-600 space-y-1">
                            <p><strong>Admin:</strong> admin@test.com / password</p>
                            <p><strong>Buyer:</strong> aggregator@test.com / password</p>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile Features (shown on mobile only) -->
                <div class="lg:hidden mt-8 text-center">
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="text-center">
                            <div class="bg-white bg-opacity-60 rounded-full p-3 mb-2 mx-auto w-fit shadow-sm">
                                <span class="text-2xl">👨‍🌾</span>
                            </div>
                            <div class="text-gray-700 text-sm">287+ Farmers</div>
                        </div>
                        <div class="text-center">
                            <div class="bg-white bg-opacity-60 rounded-full p-3 mb-2 mx-auto w-fit shadow-sm">
                                <span class="text-2xl">📱</span>
                            </div>
                            <div class="text-gray-700 text-sm">100% Cashless</div>
                        </div>
                        <div class="text-center">
                            <div class="bg-white bg-opacity-60 rounded-full p-3 mb-2 mx-auto w-fit shadow-sm">
                                <span class="text-2xl">⚡</span>
                            </div>
                            <div class="text-gray-700 text-sm">Instant Pay</div>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 text-sm">
                        Empowering small-scale farmers through cashless grain trading
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-gray-500 text-xs">
                Powered by <strong>Uplift Services Limited</strong> | Making grain trade smarter & fairer
            </p>
        </div>
    </div>

</body>
</html>
