<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Grain Trading System</title>
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
<body class="bg-gray-50">
    <!-- Navigation Header -->
    <nav class="bg-gradient-to-r from-grain-orange to-grain-green shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                            <span class="text-grain-orange text-lg font-bold">🌾</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-xl font-bold text-white">Grain Trading System</h1>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="text-white">Welcome, {{ Auth::user()->name ?? 'User' }}</span>
                    <span class="px-3 py-1 bg-white bg-opacity-20 rounded-full text-sm text-white">
                        {{ ucfirst(Auth::user()->role ?? 'user') }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white hover:text-grain-light-orange transition duration-300">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Success/Error Messages -->
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

        <!-- Farmer Dashboard Content -->
        <div class="px-4 py-6 sm:px-0">
            <!-- Page Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Farmer Dashboard</h2>
                <p class="mt-2 text-gray-600">Track your grain sales and earnings</p>
            </div>

            <!-- Farmer Profile Card -->
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-grain-orange to-grain-green rounded-full flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">👨‍🌾</span>
                    </div>
                    <div class="ml-6">
                        <h3 class="text-xl font-bold text-gray-900">{{ $farmer->full_name ?? 'Farmer Profile' }}</h3>
                        <p class="text-gray-600">{{ $farmer->village ?? 'Village' }}, {{ $farmer->district ?? 'District' }}</p>
                        <div class="mt-2">
                            @if($farmer->is_verified ?? false)
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                    ✓ Verified Farmer
                                </span>
                            @else
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                    ⏳ Pending Verification
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Transactions -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-grain-orange">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-grain-orange bg-opacity-10">
                            <svg class="w-6 h-6 text-grain-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">My Transactions</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_transactions'] ?? '3' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Earnings -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-grain-green">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-grain-green bg-opacity-10">
                            <svg class="w-6 h-6 text-grain-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Earnings</p>
                            <p class="text-2xl font-bold text-gray-900">K{{ number_format($stats['total_earnings'] ?? 9000, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pending Earnings -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Pending Earnings</p>
                            <p class="text-2xl font-bold text-gray-900">K{{ number_format($stats['pending_earnings'] ?? 3900, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Average Price -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Average Price/kg</p>
                            <p class="text-2xl font-bold text-gray-900">K{{ number_format($stats['average_price'] ?? 13.5, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-4">
                        <a href="{{ route('transactions.index') }}" class="flex items-center p-4 bg-gradient-to-r from-grain-orange to-grain-green text-white rounded-lg hover:shadow-lg transition duration-300">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            View My Transactions
                        </a>
                        
                        <a href="{{ route('payments.index') }}" class="flex items-center p-4 bg-white border-2 border-grain-green text-grain-green rounded-lg hover:bg-grain-green hover:text-white transition duration-300">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Check Payment Status
                        </a>
                        
                        <a href="{{ route('profile.edit') }}" class="flex items-center p-4 bg-white border-2 border-blue-500 text-blue-600 rounded-lg hover:bg-blue-500 hover:text-white transition duration-300">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Update Profile
                        </a>
                    </div>
                </div>

                <!-- Grain Type Performance -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">My Grain Performance</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-sm font-bold">🌽</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">White Maize</p>
                                    <p class="text-sm text-gray-600">500 kg sold</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">K5,100</p>
                                <p class="text-sm text-green-600">K10.20/kg</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-sm font-bold">🌱</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Soya Beans</p>
                                    <p class="text-sm text-gray-600">300 kg sold</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">K3,960</p>
                                <p class="text-sm text-green-600">K13.20/kg</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">My Recent Transactions</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grain Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price/kg</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TXN20251019ABC123</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">White Maize</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">500 kg</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">K10.20</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">K5,100.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Completed
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Oct 17, 2025</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TXN20251019XYZ456</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Soya Beans</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">300 kg</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">K13.20</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">K3,960.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Oct 18, 2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>