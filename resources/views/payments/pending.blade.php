@extends('layouts.app')

@section('title', 'Pending Payments - Tigula')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-orange-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                        <span class="text-3xl mr-3">⏳</span>
                        Pending Payment Approvals
                    </h1>
                    <p class="text-gray-600 mt-2">Review and approve payments to farmers</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('payments.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded-lg transition-all duration-200">
                        All Payments
                    </a>
                    <a href="{{ route('transactions.pending') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg transition-all duration-200">
                        Transaction Approvals
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Pending Payments List -->
        @forelse($pendingPayments as $payment)
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border-l-4 border-orange-500">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Payment Details -->
                    <div class="lg:col-span-2">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 flex items-center">
                                    💰 Payment Request #{{ $payment->id }}
                                    <span class="ml-3 bg-orange-100 text-orange-800 text-sm font-medium px-3 py-1 rounded-full">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </h3>
                                <p class="text-gray-600 mt-1">
                                    Initiated {{ $payment->created_at->format('M d, Y \a\t H:i') }} 
                                    by {{ $payment->initiator->name }}
                                </p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-green-600">K{{ number_format($payment->amount, 2) }}</div>
                                <div class="text-sm text-gray-500">{{ $payment->payment_method }}</div>
                            </div>
                        </div>

                        <!-- Farmer & Transaction Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-700 mb-2 flex items-center">
                                    👨‍🌾 Farmer Details
                                </h4>
                                <p class="text-sm"><strong>Name:</strong> {{ $payment->transaction->farmer->full_name }}</p>
                                <p class="text-sm"><strong>Phone:</strong> {{ $payment->transaction->farmer->phone_number }}</p>
                                <p class="text-sm"><strong>Village:</strong> {{ $payment->transaction->farmer->village }}, {{ $payment->transaction->farmer->district }}</p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-700 mb-2 flex items-center">
                                    📦 Transaction Details
                                </h4>
                                <p class="text-sm"><strong>Grain:</strong> {{ $payment->transaction->grainType->name }}</p>
                                <p class="text-sm"><strong>Weight:</strong> {{ $payment->transaction->weight_kg }} kg</p>
                                <p class="text-sm"><strong>Unit Price:</strong> K{{ number_format($payment->transaction->unit_price, 2) }}</p>
                                <p class="text-sm"><strong>Transaction:</strong> #{{ $payment->transaction->transaction_number }}</p>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h4 class="font-semibold text-blue-800 mb-2 flex items-center">
                                📱 Payment Information
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm">
                                <div>
                                    <strong>Method:</strong> {{ $payment->payment_method }}
                                </div>
                                <div>
                                    <strong>Phone:</strong> {{ $payment->phone_number }}
                                </div>
                                <div>
                                    <strong>Amount:</strong> K{{ number_format($payment->amount, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-lg font-semibold text-gray-700 mb-2">Action Required</div>
                            <div class="text-sm text-gray-600 mb-4">Review and approve this payment</div>
                            
                            <!-- Approve Button -->
                            <form action="{{ route('payments.approve', $payment) }}" method="POST" class="mb-3">
                                @csrf
                                <button type="submit" 
                                        onclick="return confirm('Approve payment of K{{ number_format($payment->amount, 2) }} to {{ $payment->transaction->farmer->full_name }}?')"
                                        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 flex items-center justify-center">
                                    <span class="mr-2">✅</span>
                                    Approve & Send Payment
                                </button>
                            </form>

                            <!-- Reject Button -->
                            <button type="button" 
                                    onclick="showRejectModal({{ $payment->id }})"
                                    class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 flex items-center justify-center">
                                <span class="mr-2">❌</span>
                                Reject Payment
                            </button>
                        </div>

                        <!-- Quick Info -->
                        <div class="bg-yellow-50 rounded-lg p-4 text-sm">
                            <div class="font-semibold text-yellow-800 mb-2">💡 Quick Info</div>
                            <ul class="text-yellow-700 space-y-1">
                                <li>• Payment will be sent via {{ $payment->payment_method }}</li>
                                <li>• Farmer will receive SMS confirmation</li>
                                <li>• Transaction will be marked as paid</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <div class="text-6xl mb-4">🎉</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">All Caught Up!</h3>
                <p class="text-gray-600">No pending payment approvals at the moment.</p>
                <a href="{{ route('dashboard') }}" 
                   class="inline-block mt-4 bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200">
                    Back to Dashboard
                </a>
            </div>
        @endforelse

        <!-- Pagination -->
        @if($pendingPayments->hasPages())
            <div class="bg-white rounded-xl shadow-lg p-6 mt-8">
                {{ $pendingPayments->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Reject Payment Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Reject Payment</h3>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">
                        Reason for Rejection
                    </label>
                    <textarea name="rejection_reason" 
                              id="rejection_reason" 
                              rows="4" 
                              required
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                              placeholder="Explain why this payment is being rejected..."></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="button" 
                            onclick="hideRejectModal()"
                            class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200">
                        Reject Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showRejectModal(paymentId) {
    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    form.action = `/payments/${paymentId}/reject`;
    modal.classList.remove('hidden');
}

function hideRejectModal() {
    const modal = document.getElementById('rejectModal');
    modal.classList.add('hidden');
    document.getElementById('rejection_reason').value = '';
}

// Close modal when clicking outside
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideRejectModal();
    }
});
</script>
@endsection