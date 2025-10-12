@extends('layouts.app')

@section('title', 'Transactions - Tigula')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-orange-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                        <span class="text-3xl mr-3">📊</span>
                        Transaction Management
                    </h1>
                    <p class="text-gray-600 mt-2">Track and manage all grain trading transactions</p>
                </div>
                @if(auth()->user()->isAggregator() || auth()->user()->isAdmin())
                <a href="{{ route('transactions.create') }}" 
                   class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all duration-200 flex items-center space-x-2">
                    <span>➕</span>
                    <span>New Transaction</span>
                </a>
                @endif
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <div class="text-3xl mb-2">⏳</div>
                <div class="text-2xl font-bold text-orange-600">{{ $transactions->where('status', 'pending')->count() }}</div>
                <div class="text-gray-500">Pending Approval</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <div class="text-3xl mb-2">✅</div>
                <div class="text-2xl font-bold text-blue-600">{{ $transactions->where('status', 'approved')->count() }}</div>
                <div class="text-gray-500">Approved</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <div class="text-3xl mb-2">💰</div>
                <div class="text-2xl font-bold text-green-600">{{ $transactions->where('status', 'paid')->count() }}</div>
                <div class="text-gray-500">Paid</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <div class="text-3xl mb-2">📈</div>
                <div class="text-2xl font-bold text-gray-800">K {{ number_format($transactions->where('status', 'paid')->sum('total_amount'), 2) }}</div>
                <div class="text-gray-500">Total Value</div>
            </div>
        </div>

        <!-- Transactions List -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800">Recent Transactions</h2>
                    <div class="flex items-center space-x-4">
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                            <option>All Status</option>
                            <option>Pending</option>
                            <option>Approved</option>
                            <option>Paid</option>
                        </select>
                        <input type="text" placeholder="Search transactions..." 
                               class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction #</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Farmer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grain Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ $transaction->transaction_number }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ $transaction->farmer->full_name }}</div>
                                <div class="text-sm text-gray-500">{{ $transaction->farmer->phone_number }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ $transaction->grainType->name }}</div>
                                <div class="text-sm text-gray-500">K {{ number_format($transaction->unit_price, 2) }} per 25kg</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ number_format($transaction->weight_kg, 2) }} kg</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-bold text-green-600">K {{ number_format($transaction->total_amount, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($transaction->status == 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        ⏳ Pending
                                    </span>
                                @elseif($transaction->status == 'approved')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        ✅ Approved
                                    </span>
                                @elseif($transaction->status == 'paid')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        💰 Paid
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $transaction->created_at->format('M d, Y') }}
                                <div class="text-xs">{{ $transaction->created_at->format('h:i A') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('transactions.show', $transaction) }}" 
                                   class="text-green-600 hover:text-green-900 mr-3">View</a>
                                @if(auth()->user()->isAdmin() && $transaction->canBeApproved())
                                    <form method="POST" action="{{ route('transactions.approve', $transaction) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-blue-600 hover:text-blue-900 mr-3"
                                                onclick="return confirm('Approve this transaction?')">
                                            Approve
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center">
                                <div class="text-gray-500">
                                    <div class="text-4xl mb-4">📊</div>
                                    <div class="text-lg font-medium mb-2">No transactions found</div>
                                    <div class="text-sm">Start by creating your first grain purchase transaction.</div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($transactions->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t">
                {{ $transactions->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection