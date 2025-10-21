@extends('layouts.app')

@section('title', 'Admin Dashboard - TENGELO')

@section('content')
<!-- Dashboard Header -->
<div class="mb-8">
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                <i class="fas fa-tachometer-alt text-tengelo-orange mr-3"></i>
                Admin Dashboard
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Welcome back, {{ Auth::user()->name }}! Here's what's happening with TENGELO today.
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <button class="bg-tengelo-green hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-download mr-2"></i>Export Report
            </button>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Farmers -->
    <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-tengelo-green">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-tengelo-green text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 truncate">Total Farmers</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalFarmers ?? '0' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Transactions -->
    <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-tengelo-orange">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-exchange-alt text-tengelo-orange text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 truncate">Total Transactions</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalTransactions ?? '0' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Payments -->
    <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-blue-500">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-credit-card text-blue-500 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 truncate">Total Payments</p>
                    <p class="text-2xl font-bold text-gray-900">K{{ number_format($totalPaymentAmount ?? 0, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Depots -->
    <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-purple-500">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-warehouse text-purple-500 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 truncate">Active Depots</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalDepots ?? '0' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Recent Activity Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Transaction Chart -->
    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                <i class="fas fa-chart-line text-tengelo-orange mr-2"></i>
                Transaction Trends
            </h3>
        </div>
        <div class="p-6">
            <canvas id="transactionChart" width="400" height="200"></canvas>
        </div>
    </div>

    <!-- Payment Status Chart -->
    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                <i class="fas fa-pie-chart text-tengelo-green mr-2"></i>
                Payment Status
            </h3>
        </div>
        <div class="p-6">
            <canvas id="paymentChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">
            <i class="fas fa-clock text-tengelo-orange mr-2"></i>
            Recent Transactions
        </h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Transaction ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Farmer
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Grain Type
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Quantity
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Amount
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($recentTransactions ?? [] as $transaction)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $transaction->transaction_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $transaction->farmer->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $transaction->grainType->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $transaction->quantity }} kg
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            K{{ number_format($transaction->total_amount, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                {{ $transaction->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                   ($transaction->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $transaction->created_at->format('M d, Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            No transactions found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-lg font-medium text-gray-900">Add New Farmer</h4>
                    <p class="text-sm text-gray-500">Register a new farmer in the system</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-user-plus text-tengelo-green text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('farmers.create') }}" 
                   class="bg-tengelo-green hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium inline-block">
                    Add Farmer
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-lg font-medium text-gray-900">Create Transaction</h4>
                    <p class="text-sm text-gray-500">Record a new grain transaction</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-plus-circle text-tengelo-orange text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('transactions.create') }}" 
                   class="bg-tengelo-orange hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium inline-block">
                    New Transaction
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-lg rounded-lg">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-lg font-medium text-gray-900">View Reports</h4>
                    <p class="text-sm text-gray-500">Access comprehensive analytics</p>
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-chart-bar text-blue-500 text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('reports.index') }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium inline-block">
                    View Reports
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Chart data will be passed via data attributes -->
<div id="chart-data" 
     data-transaction-labels="{{ json_encode($transactionTrends['labels'] ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) }}"
     data-transaction-data="{{ json_encode($transactionTrends['data'] ?? [12, 19, 3, 5, 2, 3]) }}"
     data-payment-stats="{{ json_encode($paymentStats ?? [65, 25, 10]) }}"
     style="display: none;">
</div>
@vite('resources/js/admin-dashboard.js')
@endpush
@endsection