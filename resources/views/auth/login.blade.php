<!DOCTYPE html><!DOCTYPE html><!DOCTYPE html><!DOCTYPE html>

<html>

<head><html lang="en">

    <title>TIGULA</title>

    <script src="https://cdn.tailwindcss.com"></script><head><html lang="en"><html lang="en">

</head>

<body class="bg-gradient-to-br from-yellow-100 to-green-100 min-h-screen">    <meta charset="UTF-8">

    <div class="flex items-center justify-center min-h-screen">

        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">    <meta name="viewport" content="width=device-width, initial-scale=1.0"><head><head>

            <div class="text-center mb-6">

                <h1 class="text-2xl font-bold text-gray-800">🌾 TIGULA</h1>    <title>TIGULA</title>

                <p class="text-gray-600">Grain Trading System</p>

            </div>    <script src="https://cdn.tailwindcss.com"></script>    <meta charset="UTF-8">    <meta charset="UTF-8">



            @if(session('error'))</head>

                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">

                    {{ session('error') }}<body class="min-h-screen bg-gradient-to-br from-yellow-100 to-green-100">    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <meta name="viewport" content="width=device-width, initial-scale=1.0">

                </div>

            @endif    <div class="min-h-screen flex items-center justify-center p-4">



            <form method="POST" action="{{ route('login.post') }}">        <div class="w-full max-w-md">    <title>TIGULA - Login</title>    <title>TIGULA - Login</title>

                @csrf

                            <div class="bg-white rounded-2xl shadow-2xl p-8">

                <div class="mb-4">

                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>                    <script src="https://cdn.tailwindcss.com"></script>    <script src="https://cdn.tailwindcss.com"></script>

                    <input name="email" type="email" required 

                           class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-green-500"                <!-- Logo & Title -->

                           placeholder="Enter email">

                </div>                <div class="text-center mb-8"></head>    <script>



                <div class="mb-6">                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-green-600 rounded-full mx-auto mb-4 flex items-center justify-center">

                    <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>

                    <input name="password" type="password" required                         <span class="text-white text-2xl">🌾</span><body class="min-h-screen bg-gradient-to-br from-yellow-100 to-green-100">        tailwind.config = {

                           class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-green-500"

                           placeholder="Enter password">                    </div>

                </div>

                    <h1 class="text-2xl font-bold text-gray-900">TIGULA</h1>    <div class="min-h-screen flex items-center justify-center p-4">            theme: {

                <button type="submit" 

                        class="w-full bg-gradient-to-r from-yellow-500 to-green-600 text-white py-2 px-4 rounded-lg hover:opacity-90 transition">                    <p class="text-gray-600">Grain Trading System</p>

                    Login to TIGULA

                </button>                </div>        <div class="w-full max-w-md">                extend: {

            </form>



            <div class="mt-6 p-4 bg-gray-50 rounded">

                <h3 class="font-bold text-sm mb-2">Demo Accounts:</h3>                <!-- Messages -->            <div class="bg-white rounded-2xl shadow-2xl p-8">                    colors: {

                <div class="text-xs space-y-1">

                    <div>👨‍💼 Admin: admin@graintrading.com / password123</div>                @if(session('success'))

                    <div>🏢 Aggregator: aggregator@graintrading.com / password123</div>

                    <div>👨‍🌾 Farmer: farmer@graintrading.com / password123</div>                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">                                        'grain-orange': '#FF8C00',

                </div>

            </div>                        {{ session('success') }}

        </div>

    </div>                    </div>                <!-- Logo & Title -->                        'grain-green': '#228B22',

</body>

</html>                @endif

                <div class="text-center mb-8">                        'grain-light-orange': '#FFB84D',

                @if(session('error'))

                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-green-600 rounded-full mx-auto mb-4 flex items-center justify-center">                        'grain-dark-green': '#006400'

                        {{ session('error') }}

                    </div>                        <span class="text-white text-2xl">🌾</span>                    }

                @endif

                    </div>                }

                @if($errors->any())

                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">                    <h1 class="text-2xl font-bold text-gray-900">TIGULA</h1>            }

                        @foreach($errors->all() as $error)

                            <p class="text-sm">{{ $error }}</p>                    <p class="text-gray-600">Grain Trading System</p>        }

                        @endforeach

                    </div>                </div>    </script>

                @endif

</head>

                <!-- Login Form -->

                <form method="POST" action="{{ route('login.post') }}" class="space-y-4">                <!-- Messages --><body class="bg-gradient-to-br from-grain-light-orange to-grain-green min-h-screen">

                    @csrf

                                    @if(session('success'))    <div class="min-h-screen flex items-center justify-center py-12 px-4">

                    <div>

                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">        <div class="max-w-md w-full">

                        <input 

                            id="email"                         {{ session('success') }}            <div class="bg-white rounded-2xl shadow-2xl p-8">

                            name="email" 

                            type="email"                     </div>                <!-- Header -->

                            required 

                            value="{{ old('email') }}"                @endif                <div class="text-center mb-8">

                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"

                            placeholder="Enter your email"                    <div class="w-20 h-20 bg-gradient-to-r from-grain-orange to-grain-green rounded-full mx-auto mb-4 flex items-center justify-center shadow-lg">

                        >

                    </div>                @if(session('error'))                        <span class="text-white text-3xl font-bold">🌾</span>



                    <div>                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">                    </div>

                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>

                        <input                         {{ session('error') }}                    <h1 class="text-3xl font-bold text-gray-900">TIGULA</h1>

                            id="password" 

                            name="password"                     </div>                    <p class="mt-2 text-gray-600">Grain Trading System</p>

                            type="password" 

                            required                 @endif                </div>

                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"

                            placeholder="Enter your password"

                        >

                    </div>                @if($errors->any())                <!-- Messages -->



                    <button                     <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">                @if(session('success'))

                        type="submit" 

                        class="w-full py-3 px-4 bg-gradient-to-r from-yellow-500 to-green-600 text-white rounded-lg hover:from-yellow-600 hover:to-green-700 transition duration-200 font-medium"                        @foreach($errors->all() as $error)                    <div class="mb-6 bg-grain-green text-white p-4 rounded-lg shadow">

                    >

                        Sign In to TIGULA                            <p class="text-sm">{{ $error }}</p>                        {{ session('success') }}

                    </button>

                </form>                        @endforeach                    </div>



                <!-- Demo Credentials -->                    </div>                @endif

                <div class="mt-8 p-4 bg-gray-50 rounded-lg">

                    <h3 class="text-sm font-bold text-gray-700 mb-3 text-center">🔑 Demo Login</h3>                @endif

                    <div class="space-y-2 text-xs">

                        <div class="p-2 bg-white rounded border-l-4 border-red-400">                @if(session('error'))

                            <strong>👨‍💼 Admin:</strong> admin@graintrading.com / password123

                        </div>                <!-- Login Form -->                    <div class="mb-6 bg-red-500 text-white p-4 rounded-lg shadow">

                        <div class="p-2 bg-white rounded border-l-4 border-yellow-400">

                            <strong>🏢 Aggregator:</strong> aggregator@graintrading.com / password123                <form method="POST" action="{{ route('login.post') }}" class="space-y-4">                        {{ session('error') }}

                        </div>

                        <div class="p-2 bg-white rounded border-l-4 border-green-400">                    @csrf                    </div>

                            <strong>👨‍🌾 Farmer:</strong> farmer@graintrading.com / password123

                        </div>                                    @endif

                    </div>

                </div>                    <div>



                <div class="mt-6 text-center">                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>                @if($errors->any())

                    <p class="text-xs text-gray-500">TIGULA - Smart Grain Trading Platform</p>

                </div>                        <input                     <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">

            </div>

        </div>                            id="email"                         <ul class="text-red-600 text-sm space-y-1">

    </div>

</body>                            name="email"                             @foreach($errors->all() as $error)

</html>
                            type="email"                                 <li>{{ $error }}</li>

                            required                             @endforeach

                            value="{{ old('email') }}"                        </ul>

                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"                    </div>

                            placeholder="Enter your email"                @endif

                        >

                    </div>                <!-- Login Form -->

                <form method="POST" action="{{ route('login.post') }}" class="space-y-6">

                    <div>                    @csrf

                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>                    

                        <input                     <div>

                            id="password"                         <label for="email" class="block text-sm font-medium text-gray-700 mb-2">

                            name="password"                             Email Address

                            type="password"                         </label>

                            required                         <input 

                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"                            id="email" 

                            placeholder="Enter your password"                            name="email" 

                        >                            type="email" 

                    </div>                            autocomplete="email" 

                            required 

                    <div class="flex items-center">                            value="{{ old('email') }}"

                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-yellow-500 focus:ring-yellow-400 border-gray-300 rounded">                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent transition duration-300 @error('email') border-red-500 @enderror"

                        <label for="remember" class="ml-2 text-sm text-gray-700">Remember me</label>                            placeholder="Enter your email"

                    </div>                        >

                        @error('email')

                    <button                             <p class="mt-1 text-sm text-red-600">{{ $message }}</p>

                        type="submit"                         @enderror

                        class="w-full py-3 px-4 bg-gradient-to-r from-yellow-500 to-green-600 text-white rounded-lg hover:from-yellow-600 hover:to-green-700 transition duration-200 font-medium"                    </div>

                    >

                        Sign In to TIGULA                    <div>

                    </button>                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">

                </form>                            Password

                        </label>

                <!-- Demo Credentials -->                        <input 

                <div class="mt-8 p-4 bg-gray-50 rounded-lg">                            id="password" 

                    <h3 class="text-sm font-semibold text-gray-700 mb-3 text-center">🔑 Demo Credentials</h3>                            name="password" 

                    <div class="space-y-2 text-xs">                            type="password" 

                        <div class="p-2 bg-white rounded border-l-4 border-red-400">                            autocomplete="current-password" 

                            <strong>👨‍💼 Admin:</strong> admin@graintrading.com / password123                            required 

                        </div>                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent transition duration-300 @error('password') border-red-500 @enderror"

                        <div class="p-2 bg-white rounded border-l-4 border-yellow-400">                            placeholder="Enter your password"

                            <strong>🏢 Aggregator:</strong> aggregator@graintrading.com / password123                        >

                        </div>                        @error('password')

                        <div class="p-2 bg-white rounded border-l-4 border-green-400">                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>

                            <strong>👨‍🌾 Farmer:</strong> farmer@graintrading.com / password123                        @enderror

                        </div>                    </div>

                    </div>

                </div>                    <div class="flex items-center justify-between">

                        <div class="flex items-center">

                <div class="mt-6 text-center">                            <input 

                    <p class="text-xs text-gray-500">TIGULA - Smart Grain Trading Platform</p>                                id="remember" 

                </div>                                name="remember" 

            </div>                                type="checkbox" 

        </div>                                class="h-4 w-4 text-grain-orange focus:ring-grain-orange border-gray-300 rounded"

    </div>                            >

</body>                            <label for="remember" class="ml-2 block text-sm text-gray-700">

</html>                                Remember me
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