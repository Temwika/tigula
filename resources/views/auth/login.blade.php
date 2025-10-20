<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TIGULA - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'grain-orange': '#FF8C00',
                        'grain-green': '#228B22',
                        'grain-light-orange': '#FFB84D',
                        'grain-dark-green': '#006400'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-grain-light-orange to-grain-green min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-to-r from-grain-orange to-grain-green rounded-full mx-auto mb-4 flex items-center justify-center shadow-lg">
                        <span class="text-white text-3xl font-bold">🌾</span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">TIGULA</h1>
                    <p class="mt-2 text-gray-600">Grain Trading System</p>
                </div>

                <!-- Messages -->
                @if(session('success'))
                    <div class="mb-6 bg-grain-green text-white p-4 rounded-lg shadow">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-red-500 text-white p-4 rounded-lg shadow">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <ul class="text-red-600 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address
                        </label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            autocomplete="email" 
                            required 
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent transition duration-300 @error('email') border-red-500 @enderror"
                            placeholder="Enter your email"
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="current-password" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent transition duration-300 @error('password') border-red-500 @enderror"
                            placeholder="Enter your password"
                        >
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                id="remember" 
                                name="remember" 
                                type="checkbox" 
                                class="h-4 w-4 text-grain-orange focus:ring-grain-orange border-gray-300 rounded"
                            >
                            <label for="remember" class="ml-2 block text-sm text-gray-700">
                                Remember me
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="text-grain-orange hover:text-grain-dark-green transition duration-300">
                                Forgot your password?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button 
                            type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-white bg-gradient-to-r from-grain-orange to-grain-green hover:from-grain-dark-green hover:to-grain-orange focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-grain-orange transition duration-300 transform hover:scale-105 font-medium"
                        >
                            Sign In
                        </button>
                    </div>
                </form>

                <!-- Demo Credentials -->
                <div class="mt-8 p-4 bg-gradient-to-r from-blue-50 to-green-50 rounded-lg border">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3 text-center">🚀 Demo Login Credentials</h3>
                    <div class="space-y-3 text-sm">
                        <div class="bg-white p-3 rounded shadow-sm border-l-4 border-red-500">
                            <strong class="text-red-600">👨‍💼 Admin:</strong><br>
                            <code class="text-xs">admin@graintrading.com</code><br>
                            <code class="text-xs">password123</code>
                        </div>
                        <div class="bg-white p-3 rounded shadow-sm border-l-4 border-grain-orange">
                            <strong class="text-grain-orange">🏢 Aggregator:</strong><br>
                            <code class="text-xs">aggregator@graintrading.com</code><br>
                            <code class="text-xs">password123</code>
                        </div>
                        <div class="bg-white p-3 rounded shadow-sm border-l-4 border-grain-green">
                            <strong class="text-grain-green">👨‍🌾 Farmer:</strong><br>
                            <code class="text-xs">farmer@graintrading.com</code><br>
                            <code class="text-xs">password123</code>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-6 text-center">
                    <p class="text-xs text-gray-500">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-grain-orange hover:text-grain-dark-green transition duration-300">
                            Sign up here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
            
            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent @error('email') border-red-500 @enderror" 
                    placeholder="Enter your email"
                    required
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent @error('password') border-red-500 @enderror" 
                    placeholder="Enter your password"
                    required
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 flex items-center">
                <input 
                    type="checkbox" 
                    id="remember" 
                    name="remember" 
                    class="h-4 w-4 text-grain-orange focus:ring-grain-orange border-gray-300 rounded"
                >
                <label for="remember" class="ml-2 text-gray-700">Remember me</label>
            </div>

            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-grain-orange to-grain-green text-white font-bold py-3 px-4 rounded-lg hover:shadow-lg transform hover:scale-105 transition duration-300"
            >
                Sign In
            </button>
        </form>

        <!-- Footer Links -->
        <div class="mt-8 text-center">
            <a href="{{ route('password.request') }}" class="text-grain-green hover:text-grain-dark-green transition duration-300">
                Forgot your password?
            </a>
        </div>

        <!-- Test Credentials -->
        <div class="mt-8 p-4 bg-gray-100 rounded-lg">
            <h3 class="font-bold text-gray-800 mb-2">🧪 Test Credentials:</h3>
            <div class="text-sm text-gray-600 space-y-1">
                <div><strong>Admin:</strong> admin@graintrade.com</div>
                <div><strong>Aggregator:</strong> aggregator@graintrade.com</div>
                <div><strong>Farmer:</strong> mary@graintrade.com</div>
                <div class="mt-2"><strong>Password:</strong> password123</div>
            </div>
        </div>
    </div>
</body>
</html>