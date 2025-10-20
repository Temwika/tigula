<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions - Grain Trading System</title>
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
                    <a href="{{ route('dashboard') }}" class="text-white hover:text-grain-light-orange transition duration-300">
                        Dashboard
                    </a>
                    <span class="text-white">{{ Auth::user()->name }}</span>
                    <span class="px-3 py-1 bg-white bg-opacity-20 rounded-full text-sm text-white">
                        {{ ucfirst(Auth::user()->role) }}
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
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">All Transactions</h2>
                <p class="mt-2 text-gray-600">Manage grain trading transactions</p>
            </div>
            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'aggregator')
                <a 
                    href="{{ route('transactions.create') }}" 
                    class="px-6 py-3 bg-gradient-to-r from-grain-orange to-grain-green text-white rounded-lg hover:from-grain-dark-green hover:to-grain-orange transition duration-300 shadow-lg"
                >
                    + New Transaction
                </a>
            @endif
        </div>

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

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <form method="GET" action="{{ route('transactions.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="farmer" class="block text-sm font-medium text-gray-700 mb-1">Farmer</label>
                    <input 
                        type="text" 
                        id="farmer" 
                        name="farmer" 
                        value="{{ request('farmer') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent"
                        placeholder="Search farmer..."
                    >
                </div>
                <div>
                    <label for="grain_type" class="block text-sm font-medium text-gray-700 mb-1">Grain Type</label>
                    <select 
                        id="grain_type" 
                        name="grain_type"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent"
                    >
                        <option value="">All Types</option>
                        <option value="1" {{ request('grain_type') == '1' ? 'selected' : '' }}>White Maize</option>
                        <option value="2" {{ request('grain_type') == '2' ? 'selected' : '' }}>Soya Beans</option>
                        <option value="3" {{ request('grain_type') == '3' ? 'selected' : '' }}>Wheat</option>
                    </select>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select 
                        id="status" 
                        name="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent"
                    >
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button 
                        type="submit" 
                        class="w-full px-4 py-2 bg-grain-orange text-white rounded-lg hover:bg-grain-dark-green transition duration-300"
                    >
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Transactions Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction #</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Farmer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grain Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight (kg)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price/kg</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($transactions ?? [] as $transaction)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $transaction->transaction_number ?? 'TXN' . str_pad($loop->index + 1, 8, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $transaction->farmer->full_name ?? 'John Mwansa' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $transaction->grainType->name ?? 'White Maize' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($transaction->weight_kg ?? 500, 0) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    K{{ number_format($transaction->price_per_kg ?? 10.20, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    K{{ number_format($transaction->total_amount ?? 5100, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $status = $transaction->status ?? ($loop->odd ? 'completed' : 'pending');
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800'
                                        ];
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ ($transaction->transaction_date ?? now())->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('transactions.show', $transaction->id ?? 1) }}" class="text-grain-orange hover:text-grain-green">View</a>
                                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'aggregator')
                                        <a href="{{ route('transactions.edit', $transaction->id ?? 1) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                        @if(($transaction->status ?? 'pending') === 'pending')
                                            <form method="POST" action="{{ route('transactions.complete', $transaction->id ?? 1) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900">Complete</button>
                                            </form>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <!-- Demo Transactions -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TXN20251020001</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">John Mwansa</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">White Maize</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">500</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">K10.20</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">K5,100.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Completed
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Oct 18, 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="#" class="text-grain-orange hover:text-grain-green">View</a>
                                    <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TXN20251020002</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Mary Tembo</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Soya Beans</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">300</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">K13.20</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">K3,960.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Oct 19, 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="#" class="text-grain-orange hover:text-grain-green">View</a>
                                    <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                                    <button class="text-green-600 hover:text-green-900">Complete</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TXN20251020003</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Peter Banda</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Wheat</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">200</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">K15.50</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">K3,100.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Completed
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Oct 20, 2025</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="#" class="text-grain-orange hover:text-grain-green">View</a>
                                    <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if(isset($transactions) && method_exists($transactions, 'links'))
            <div class="mt-6">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</body>
</html>