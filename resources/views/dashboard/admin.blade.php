<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TENGELO</title>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        <!-- Dashboard Content -->
        <div class="px-4 py-6 sm:px-0">
            <!-- Page Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900">
                    @if(Auth::user()->role === 'admin')
                        Admin Dashboard
                    @elseif(Auth::user()->role === 'aggregator')
                        Aggregator Dashboard
                    @else
                        Farmer Dashboard
                    @endif
                </h2>
                <p class="mt-2 text-gray-600">Overview of your grain trading activities</p>
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
                            <p class="text-sm font-medium text-gray-600">Total Transactions</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_transactions'] ?? '6' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Amount -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-grain-green">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-grain-green bg-opacity-10">
                            <svg class="w-6 h-6 text-grain-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Value</p>
                            <p class="text-2xl font-bold text-gray-900">K{{ number_format($stats['total_amount'] ?? 15000, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Active Farmers -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Active Farmers</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_farmers'] ?? '2' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pending Payments -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Pending Payments</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_payments'] ?? '1' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Recent Transactions Chart -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Transaction Trends</h3>
                    <canvas id="transactionChart" height="200"></canvas>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-4">
                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'aggregator')
                            <a href="{{ route('transactions.create') }}" class="flex items-center p-4 bg-gradient-to-r from-grain-orange to-grain-green text-white rounded-lg hover:shadow-lg transition duration-300">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Record New Transaction
                            </a>
                            
                            <a href="{{ route('farmers.index') }}" class="flex items-center p-4 bg-white border-2 border-grain-green text-grain-green rounded-lg hover:bg-grain-green hover:text-white transition duration-300">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                Manage Farmers
                            </a>
                            
                            <a href="{{ route('payments.index') }}" class="flex items-center p-4 bg-white border-2 border-yellow-500 text-yellow-600 rounded-lg hover:bg-yellow-500 hover:text-white transition duration-300">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Process Payments
                            </a>
                        @endif
                        
                        <a href="{{ route('reports.index') }}" class="flex items-center p-4 bg-white border-2 border-blue-500 text-blue-600 rounded-lg hover:bg-blue-500 hover:text-white transition duration-300">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            View Reports
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Sample data - in real app this would be dynamic -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TXN20251019ABC123</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Mary Farmer</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">White Maize</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">K5,100.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Completed
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Oct 17, 2025</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TXN20251019XYZ456</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Peter Farmer</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Soya Beans</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">K3,900.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Oct 19, 2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Chart
        const ctx = document.getElementById('transactionChart').getContext('2d');
        const transactionChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Transactions',
                    data: [12, 19, 15, 25, 22, 30],
                    borderColor: '#FF8C00',
                    backgroundColor: 'rgba(255, 140, 0, 0.1)',
                    tension: 0.4
                }, {
                    label: 'Amount (K1000s)',
                    data: [8, 15, 12, 20, 18, 25],
                    borderColor: '#228B22',
                    backgroundColor: 'rgba(34, 139, 34, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>