@extends('layouts.app')

@section('title', 'Pending Approvals - Tigula')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 to-orange-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                        <span class="text-3xl mr-3">⏳</span>
                        Pending Transaction Approvals
                    </h1>
                    <p class="text-gray-600 mt-2">Review and approve grain purchase transactions</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg font-semibold">
                        {{ $transactions->count() }} Pending
                    </div>
                </div>
            </div>
        </div>

        @if($transactions->count() > 0)
        <!-- Pending Transactions -->
        <div class="space-y-6">
            @foreach($transactions as $transaction)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">{{ $transaction->transaction_number }}</h3>
                            <p class="text-sm text-gray-500">Created {{ $transaction->created_at->diffForHumans() }} by {{ $transaction->creator->name }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                                ⏳ Awaiting Approval
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Farmer Details -->
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h4 class="font-bold text-blue-800 mb-3 flex items-center">
                                <span class="mr-2">👨‍🌾</span>
                                Farmer Information
                            </h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Name:</span>
                                    <span class="font-semibold">{{ $transaction->farmer->full_name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">NRC:</span>
                                    <span class="font-semibold">{{ $transaction->farmer->nrc_number }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Phone:</span>
                                    <span class="font-semibold">{{ $transaction->farmer->phone_number }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Location:</span>
                                    <span class="font-semibold">{{ $transaction->farmer->village }}, {{ $transaction->farmer->district }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Verified:</span>
                                    <span class="font-semibold {{ $transaction->farmer->is_verified ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $transaction->farmer->is_verified ? '✅ Yes' : '❌ No' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Transaction Details -->
                        <div class="bg-green-50 rounded-lg p-4">
                            <h4 class="font-bold text-green-800 mb-3 flex items-center">
                                <span class="mr-2">🌾</span>
                                Transaction Details
                            </h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Grain Type:</span>
                                    <span class="font-semibold">{{ $transaction->grainType->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Weight:</span>
                                    <span class="font-semibold">{{ number_format($transaction->weight_kg, 2) }} kg</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Unit Price:</span>
                                    <span class="font-semibold">K {{ number_format($transaction->unit_price, 2) }} per 25kg</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Depot:</span>
                                    <span class="font-semibold">{{ $transaction->depot->name }}</span>
                                </div>
                                <div class="flex justify-between border-t pt-2">
                                    <span class="text-gray-600 font-bold">Total Amount:</span>
                                    <span class="font-bold text-lg text-green-600">K {{ number_format($transaction->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($transaction->notes)
                    <div class="mt-4 bg-gray-50 rounded-lg p-4">
                        <h4 class="font-bold text-gray-800 mb-2">Notes:</h4>
                        <p class="text-gray-700 text-sm">{{ $transaction->notes }}</p>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="mt-6 flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            <span class="font-medium">Aggregator:</span> {{ $transaction->creator->name }}
                            <span class="mx-2">•</span>
                            <span class="font-medium">Created:</span> {{ $transaction->created_at->format('M d, Y h:i A') }}
                        </div>
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('transactions.show', $transaction) }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded-lg transition-colors">
                                View Details
                            </a>
                            <form method="POST" action="{{ route('transactions.approve', $transaction) }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-2 rounded-lg transition-colors flex items-center space-x-2"
                                        onclick="return confirm('Are you sure you want to approve this transaction? This will notify the farmer via SMS.')">
                                    <span>✅</span>
                                    <span>Approve Transaction</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($transactions->hasPages())
        <div class="mt-8">
            {{ $transactions->links() }}
        </div>
        @endif

        @else
        <!-- No Pending Transactions -->
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <div class="text-6xl mb-4">🎉</div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">All Caught Up!</h2>
            <p class="text-gray-600 mb-6">There are no transactions pending approval at the moment.</p>
            <a href="{{ route('transactions.index') }}" 
               class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-lg transition-colors inline-flex items-center space-x-2">
                <span>📊</span>
                <span>View All Transactions</span>
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
