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

        <!-- Aggregator Dashboard Content -->
        <div class="px-4 py-6 sm:px-0">
            <!-- Page Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Aggregator Dashboard</h2>
                <p class="mt-2 text-gray-600">Manage depot operations and farmer transactions</p>
            </div>

            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Today's Transactions -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-grain-orange">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-grain-orange bg-opacity-10">
                            <svg class="w-6 h-6 text-grain-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Today's Transactions</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['today_transactions'] ?? '7' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Today's Volume -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-grain-green">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-grain-green bg-opacity-10">
                            <svg class="w-6 h-6 text-grain-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Today's Volume</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['today_volume'] ?? 2400) }} kg</p>
                        </div>
                    </div>
                </div>

                <!-- Pending Payments -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Pending Payments</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_payments'] ?? '3' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Active Farmers -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Active Farmers</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['active_farmers'] ?? '156' }}</p>
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
                        <a href="{{ route('transactions.create') }}" class="flex items-center p-4 bg-gradient-to-r from-grain-orange to-grain-green text-white rounded-lg hover:shadow-lg transition duration-300">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            New Transaction
                        </a>
                        
                        <a href="{{ route('transactions.index') }}" class="flex items-center p-4 bg-white border-2 border-grain-green text-grain-green rounded-lg hover:bg-grain-green hover:text-white transition duration-300">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            View All Transactions
                        </a>
                        
                        <a href="{{ route('payments.pending') }}" class="flex items-center p-4 bg-white border-2 border-yellow-500 text-yellow-600 rounded-lg hover:bg-yellow-500 hover:text-white transition duration-300">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Process Payments
                        </a>
                        
                        <a href="{{ route('farmers.index') }}" class="flex items-center p-4 bg-white border-2 border-blue-500 text-blue-600 rounded-lg hover:bg-blue-500 hover:text-white transition duration-300">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Manage Farmers
                        </a>
                    </div>
                </div>

                <!-- Current Grain Prices -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Current Grain Prices</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-sm font-bold">🌽</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">White Maize</p>
                                    <p class="text-sm text-gray-600">Grade 1 - Premium</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">K10.20/kg</p>
                                <p class="text-sm text-green-600">+2.5%</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-sm font-bold">🌱</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Soya Beans</p>
                                    <p class="text-sm text-gray-600">Grade 1 - Premium</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">K13.20/kg</p>
                                <p class="text-sm text-green-600">+1.8%</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-sm font-bold">🌾</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Wheat</p>
                                    <p class="text-sm text-gray-600">Grade 1 - Premium</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">K15.50/kg</p>
                                <p class="text-sm text-red-600">-0.5%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Transactions</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Farmer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grain Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TXN20251019ABC123</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">John Mwansa</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">White Maize</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">500 kg</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">K5,100.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Completed
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Oct 17, 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-grain-orange hover:text-grain-green">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TXN20251019XYZ456</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Mary Tembo</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Soya Beans</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">300 kg</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">K3,960.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending Payment
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Oct 18, 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-grain-orange hover:text-grain-green mr-2">View</button>
                                    <button class="text-blue-600 hover:text-blue-900">Pay</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>