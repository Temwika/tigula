<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Tigula - Smart grain trading platform connecting farmers, aggregators, and buyers across Zambia">
    <title>@yield('title', 'Tigula - Smart Grain Trading Platform')</title>
    
    <link rel="icon" type="image/png" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🌾</text></svg>">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
        .gradient-tigula { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); }
        .nav-item { transition: all 0.3s ease; }
        .nav-item:hover { background-color: rgba(249, 115, 22, 0.1); }
        .badge-pulse { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: .7; } }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    @auth
    <!-- Top Banner -->
    <div class="gradient-tigula text-white py-2 px-4">
        <div class="container mx-auto flex justify-between items-center text-sm">
            <div class="flex items-center space-x-2">
                <span class="font-semibold">🌾 Tigula</span>
                <span class="hidden md:inline">- From the field to the marketplace</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="hidden sm:inline text-orange-100">📞 Support: +260-XXX-XXX-XXX</span>
                <span class="text-orange-100">Powered by Uplift Services Limited</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="bg-white shadow-lg border-b-4 border-orange-500">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="gradient-tigula w-12 h-12 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold bg-gradient-to-r from-orange-600 to-orange-500 bg-clip-text text-transparent">
                                Tigula
                            </h1>
                            <p class="text-xs text-gray-500">Smart Grain Trading</p>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-2">
                    <!-- Common Links for All Users -->
                    <a href="{{ route('dashboard') }}" 
                       class="nav-item px-4 py-2 rounded-lg text-gray-700 hover:text-orange-600 font-medium flex items-center space-x-2 {{ request()->routeIs('dashboard') ? 'bg-orange-50 text-orange-600' : '' }}">
                        <span>📊</span>
                        <span>Dashboard</span>
                    </a>
                    
                    <!-- Aggregator & Admin Links -->
                    @if(auth()->user()->isAggregator() || auth()->user()->isAdmin())
                    <a href="{{ route('farmers.index') }}" 
                       class="nav-item px-4 py-2 rounded-lg text-gray-700 hover:text-orange-600 font-medium flex items-center space-x-2 {{ request()->routeIs('farmers.*') ? 'bg-orange-50 text-orange-600' : '' }}">
                        <span>👨‍🌾</span>
                        <span>Small-Scale Farmers</span>
                    </a>
                    
                    <a href="{{ route('transactions.index') }}" 
                       class="nav-item px-4 py-2 rounded-lg text-gray-700 hover:text-orange-600 font-medium flex items-center space-x-2 {{ request()->routeIs('transactions.index') || request()->routeIs('transactions.show') ? 'bg-orange-50 text-orange-600' : '' }}">
                        <span>�</span>
                        <span>Mobile Payments</span>
                    </a>
                    
                    <a href="{{ route('transactions.quick-create') }}" 
                       class="nav-item px-4 py-2 rounded-lg bg-gradient-to-r from-green-500 to-green-600 text-white hover:from-green-600 hover:to-green-700 font-semibold shadow-md flex items-center space-x-2">
                        <span>⚖️</span>
                        <span>Quick Purchase</span>
                    </a>
                    @endif
                    
                    <!-- Admin Only Links -->
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('transactions.pending') }}" 
                       class="nav-item px-4 py-2 rounded-lg text-gray-700 hover:text-orange-600 font-medium flex items-center space-x-2 {{ request()->routeIs('transactions.pending') ? 'bg-orange-50 text-orange-600' : '' }}">
                        <span>⏳</span>
                        <span>Pending Approvals</span>
                        @php
                            $pendingCount = \App\Models\Transaction::where('status', 'pending')->count();
                        @endphp
                        @if($pendingCount > 0)
                        <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold badge-pulse">
                            {{ $pendingCount }}
                        </span>
                        @endif
                    </a>
                    
                    <a href="{{ route('payments.index') }}" 
                       class="nav-item px-4 py-2 rounded-lg text-gray-700 hover:text-orange-600 font-medium flex items-center space-x-2 {{ request()->routeIs('payments.*') ? 'bg-orange-50 text-orange-600' : '' }}">
                        <span>💰</span>
                        <span>Payments</span>
                    </a>
                    @endif
                    
                    <!-- Farmer Only Links -->
                    @if(auth()->user()->isFarmer())
                    <a href="{{ route('transactions.index') }}" 
                       class="nav-item px-4 py-2 rounded-lg text-gray-700 hover:text-orange-600 font-medium flex items-center space-x-2 {{ request()->routeIs('transactions.*') ? 'bg-orange-50 text-orange-600' : '' }}">
                        <span>📋</span>
                        <span>My Sales</span>
                    </a>
                    @endif
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <div class="hidden lg:block text-right">
                        <div class="font-semibold text-gray-800">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-gray-500">{{ ucfirst(auth()->user()->role) }}</div>
                    </div>
                    
                    <div class="relative group">
                        <button class="flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-gray-100">
                            <div class="w-10 h-10 rounded-full gradient-tigula flex items-center justify-center text-white font-bold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="hidden group-hover:block absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                <p class="text-xs text-orange-600 mt-1">{{ ucfirst(auth()->user()->role) }} Account</p>
                            </div>
                            
                            <div class="border-t border-gray-100 mt-2 pt-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 font-medium">
                                        <span class="mr-2">🚪</span> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 min-h-screen">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow-md animate-fade-in">
                <div class="flex items-start">
                    <span class="text-2xl mr-3">✅</span>
                    <div>
                        <p class="font-semibold">Success!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 shadow-md animate-fade-in">
                <div class="flex items-start">
                    <span class="text-2xl mr-3">❌</span>
                    <div>
                        <p class="font-semibold">Error!</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 shadow-md">
                <div class="flex items-start">
                    <span class="text-2xl mr-3">⚠️</span>
                    <div>
                        <p class="font-semibold mb-2">Please fix the following errors:</p>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </main>

    @auth
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="gradient-tigula w-10 h-10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-orange-400">Tigula</h3>
                    </div>
                    <p class="text-gray-400 text-sm mb-2">Smart Digital Grain Trading Platform</p>
                    <p class="text-gray-500 text-xs">Built by Uplift Services Limited</p>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('dashboard') }}" class="hover:text-orange-400">Dashboard</a></li>
                        <li><a href="{{ route('farmers.index') }}" class="hover:text-orange-400">Farmers</a></li>
                        <li><a href="{{ route('transactions.create') }}" class="hover:text-orange-400">New Transaction</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>📞 +260-XXX-XXX-XXX</li>
                        <li>📧 support@tigula.zm</li>
                        <li>🕐 Mon-Fri: 8AM-5PM</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">About Tigula</h4>
                    <p class="text-gray-400 text-sm mb-4">
                        Empowering Zambia's agricultural community through transparent, efficient, and profitable grain trading.
                    </p>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} Tigula. All rights reserved.</p>
            </div>
        </div>
    </footer>
    @endauth

    <!-- Scripts -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        setTimeout(function() {
            $('.animate-fade-in').fadeOut('slow');
        }, 5000);
    </script>

    @stack('scripts')
</body>
</html>