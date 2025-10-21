<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'TENGELO - The easiest way to buy grains in Zambia')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tengelo-orange': '#FF8C00',
                        'tengelo-green': '#228B22',
                        'tengelo-yellow': '#FFD700',
                        'tengelo-brown': '#8B4513'
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        @auth
            <!-- Dashboard Layout -->
            <div class="flex h-screen bg-gray-50">
                <!-- Sidebar -->
                <div class="hidden md:flex md:w-64 md:flex-col">
                    <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto bg-gradient-to-b from-tengelo-green to-tengelo-orange">
                        <div class="flex items-center flex-shrink-0 px-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                                    <span class="text-tengelo-green text-xl">🌾</span>
                                </div>
                                <h1 class="ml-3 text-xl font-bold text-white">TENGELO</h1>
                            </div>
                        </div>
                        <nav class="mt-8 flex-1 px-2 space-y-1">
                            <a href="{{ route('dashboard') }}" class="group flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-white hover:bg-opacity-20 {{ request()->routeIs('dashboard') ? 'bg-white bg-opacity-20' : '' }}">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                            
                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'aggregator')
                                <a href="{{ route('farmers.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-white hover:bg-opacity-20 {{ request()->routeIs('farmers.*') ? 'bg-white bg-opacity-20' : '' }}">
                                    <i class="fas fa-users mr-3"></i>
                                    Farmers
                                </a>
                            @endif
                            
                            <a href="{{ route('transactions.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-white hover:bg-opacity-20 {{ request()->routeIs('transactions.*') ? 'bg-white bg-opacity-20' : '' }}">
                                <i class="fas fa-exchange-alt mr-3"></i>
                                Transactions
                            </a>
                            
                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'aggregator')
                                <a href="{{ route('payments.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-white hover:bg-opacity-20 {{ request()->routeIs('payments.*') ? 'bg-white bg-opacity-20' : '' }}">
                                    <i class="fas fa-credit-card mr-3"></i>
                                    Payments
                                </a>
                                
                                <a href="{{ route('reports.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium text-white rounded-md hover:bg-white hover:bg-opacity-20 {{ request()->routeIs('reports.*') ? 'bg-white bg-opacity-20' : '' }}">
                                    <i class="fas fa-chart-bar mr-3"></i>
                                    Reports
                                </a>
                            @endif
                        </nav>
                        
                        <!-- User Info -->
                        <div class="flex-shrink-0 px-4 py-4 border-t border-white border-opacity-20">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                                    <span class="text-tengelo-green text-sm font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-white text-opacity-70 capitalize">{{ auth()->user()->role }}</p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                @csrf
                                <button type="submit" class="w-full text-left text-xs text-white hover:text-opacity-80">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="flex flex-col w-0 flex-1 overflow-hidden">
                    <!-- Top Navigation -->
                    <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
                        <button class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-tengelo-green md:hidden">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <div class="flex-1 px-4 flex justify-between">
                            <div class="flex-1 flex">
                                <div class="w-full flex md:ml-0">
                                    <div class="relative w-full max-w-xs">
                                        <!-- Search can be added here -->
                                    </div>
                                </div>
                            </div>
                            
                            <div class="ml-4 flex items-center md:ml-6 space-x-4">
                                <!-- Notifications -->
                                <button class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-tengelo-green">
                                    <i class="fas fa-bell"></i>
                                </button>
                                
                                <!-- User menu -->
                                <div class="flex items-center space-x-3">
                                    <span class="text-sm text-gray-700">{{ auth()->user()->name }}</span>
                                    <div class="w-8 h-8 bg-tengelo-green rounded-full flex items-center justify-center">
                                        <span class="text-white text-sm font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Page Content -->
                    <main class="flex-1 relative overflow-y-auto focus:outline-none">
                        <div class="py-6">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                                @if(session('success'))
                                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if(session('error'))
                                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                                        <i class="fas fa-exclamation-circle mr-2"></i>
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @yield('content')
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        @else
            <!-- Guest Layout -->
            <div class="min-h-screen bg-gray-100">
                @yield('content')
            </div>
        @endauth
    </div>
    @stack('scripts')
</body>
</html>