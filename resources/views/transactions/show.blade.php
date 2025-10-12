@extends('layouts.app')

@section('title', 'Transaction Details - Tigula')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-green-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                        <span class="text-3xl mr-3">📄</span>
                        Transaction Details
                    </h1>
                    <p class="text-gray-600 mt-2">{{ $transaction->transaction_number }}</p>
                </div>
                <div class="flex items-center space-x-4">
                    @if($transaction->status == 'pending')
                        <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg font-semibold">
                            ⏳ Pending Approval
                        </span>
                    @elseif($transaction->status == 'approved')
                        <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-lg font-semibold">
                            ✅ Approved
                        </span>
                    @elseif($transaction->status == 'paid')
                        <span class="px-4 py-2 bg-green-100 text-green-800 rounded-lg font-semibold">
                            💰 Paid
                        </span>
                    @endif
                    <a href="{{ route('transactions.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded-lg transition-colors">
                        ← Back
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Farmer Information -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <span class="text-2xl mr-3">👨‍🌾</span>
                        Farmer Information
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label>
                            <div class="text-lg font-semibold text-gray-800">{{ $transaction->farmer->full_name }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">NRC Number</label>
                            <div class="text-lg font-semibold text-gray-800">{{ $transaction->farmer->nrc_number }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Phone Number</label>
                            <div class="text-lg font-semibold text-gray-800">{{ $transaction->farmer->phone_number }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Location</label>
                            <div class="text-lg font-semibold text-gray-800">
                                {{ $transaction->farmer->village }}, {{ $transaction->farmer->district }}, {{ $transaction->farmer->province }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Verification Status</label>
                            <div class="flex items-center">
                                @if($transaction->farmer->is_verified)
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                                        ✅ Verified
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                                        ❌ Not Verified
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transaction Details -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <span class="text-2xl mr-3">🌾</span>
                        Transaction Details
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Grain Type</label>
                            <div class="text-lg font-semibold text-gray-800">{{ $transaction->grainType->name }}</div>
                            <div class="text-sm text-gray-500">{{ $transaction->grainType->description }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Depot Location</label>
                            <div class="text-lg font-semibold text-gray-800">{{ $transaction->depot->name }}</div>
                            <div class="text-sm text-gray-500">{{ $transaction->depot->full_location }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Weight</label>
                            <div class="text-lg font-semibold text-gray-800">{{ number_format($transaction->weight_kg, 2) }} kg</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Unit Price</label>
                            <div class="text-lg font-semibold text-gray-800">K {{ number_format($transaction->unit_price, 2) }}</div>
                            <div class="text-sm text-gray-500">per 25kg bag</div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-500 mb-1">Total Amount</label>
                            <div class="text-3xl font-bold text-green-600">K {{ number_format($transaction->total_amount, 2) }}</div>
                        </div>
                    </div>
                    
                    @if($transaction->notes)
                    <div class="mt-6 border-t pt-4">
                        <label class="block text-sm font-medium text-gray-500 mb-1">Notes</label>
                        <div class="text-gray-800 bg-gray-50 p-3 rounded-lg">{{ $transaction->notes }}</div>
                    </div>
                    @endif
                </div>

                <!-- Payment Information -->
                @if($transaction->payments->count() > 0)
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <span class="text-2xl mr-3">💰</span>
                        Payment Information
                    </h2>
                    @foreach($transaction->payments as $payment)
                    <div class="border rounded-lg p-4 {{ $loop->last ? '' : 'mb-4' }}">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Reference Number</label>
                                <div class="font-semibold text-gray-800">{{ $payment->reference_number }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Payment Method</label>
                                <div class="font-semibold text-gray-800">{{ $payment->payment_method }} Mobile Money</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Amount</label>
                                <div class="font-bold text-green-600">{{ $payment->formatted_amount }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Phone Number</label>
                                <div class="font-semibold text-gray-800">{{ $payment->phone_number }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                                <div>
                                    @if($payment->status == 'completed')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                                            ✅ Completed
                                        </span>
                                    @elseif($payment->status == 'processing')
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                                            ⏳ Processing
                                        </span>
                                    @elseif($payment->status == 'failed')
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                                            ❌ Failed
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Date</label>
                                <div class="font-semibold text-gray-800">
                                    @if($payment->completed_at)
                                        {{ $payment->completed_at->format('M d, Y h:i A') }}
                                    @elseif($payment->initiated_at)
                                        {{ $payment->initiated_at->format('M d, Y h:i A') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        @if(auth()->user()->isAdmin() && $payment->status == 'processing')
                        <div class="mt-4 pt-4 border-t">
                            <form method="POST" action="{{ route('payments.complete', $payment) }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-lg transition-colors"
                                        onclick="return confirm('Mark this payment as completed?')">
                                    Mark as Completed
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Sidebar Actions -->
            <div class="space-y-6">
                <!-- Status & Actions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Actions</h3>
                    
                    @if(auth()->user()->isAdmin() && $transaction->canBeApproved())
                    <form method="POST" action="{{ route('transactions.approve', $transaction) }}" class="mb-4">
                        @csrf
                        <button type="submit" 
                                class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg transition-colors flex items-center justify-center space-x-2"
                                onclick="return confirm('Approve this transaction? This will send SMS notification to the farmer.')">
                            <span>✅</span>
                            <span>Approve Transaction</span>
                        </button>
                    </form>
                    @endif

                    @if(auth()->user()->isAdmin() && $transaction->canInitiatePayment())
                    <button type="button" 
                            onclick="document.getElementById('paymentModal').classList.remove('hidden')"
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transition-colors flex items-center justify-center space-x-2 mb-4">
                        <span>💰</span>
                        <span>Initiate Payment</span>
                    </button>
                    @endif

                    <a href="{{ route('transactions.index') }}" 
                       class="w-full bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-lg transition-colors flex items-center justify-center space-x-2">
                        <span>📊</span>
                        <span>All Transactions</span>
                    </a>
                </div>

                <!-- Transaction Timeline -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Transaction Timeline</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm font-bold">✓</div>
                            <div>
                                <div class="font-semibold text-gray-800">Transaction Created</div>
                                <div class="text-sm text-gray-500">{{ $transaction->created_at->format('M d, Y h:i A') }}</div>
                                <div class="text-sm text-gray-500">by {{ $transaction->creator->name }}</div>
                            </div>
                        </div>
                        
                        @if($transaction->sms_sent_at)
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-bold">📱</div>
                            <div>
                                <div class="font-semibold text-gray-800">SMS Sent</div>
                                <div class="text-sm text-gray-500">{{ $transaction->sms_sent_at->format('M d, Y h:i A') }}</div>
                                <div class="text-sm text-gray-500">to {{ $transaction->farmer->phone_number }}</div>
                            </div>
                        </div>
                        @endif

                        @if($transaction->approved_at)
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm font-bold">✓</div>
                            <div>
                                <div class="font-semibold text-gray-800">Transaction Approved</div>
                                <div class="text-sm text-gray-500">{{ $transaction->approved_at->format('M d, Y h:i A') }}</div>
                                <div class="text-sm text-gray-500">by {{ $transaction->approver->name ?? 'Admin' }}</div>
                            </div>
                        </div>
                        @endif

                        @foreach($transaction->payments as $payment)
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-white text-sm font-bold">💰</div>
                            <div>
                                <div class="font-semibold text-gray-800">Payment {{ ucfirst($payment->status) }}</div>
                                <div class="text-sm text-gray-500">
                                    @if($payment->completed_at)
                                        {{ $payment->completed_at->format('M d, Y h:i A') }}
                                    @elseif($payment->initiated_at)
                                        {{ $payment->initiated_at->format('M d, Y h:i A') }}
                                    @endif
                                </div>
                                <div class="text-sm text-gray-500">{{ $payment->formatted_amount }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
@if(auth()->user()->isAdmin() && $transaction->canInitiatePayment())
<div id="paymentModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <h3 class="text-lg font-bold text-gray-900 mb-4">💰 Instant Mobile Money Payment</h3>
        <p class="text-sm text-gray-600 mb-4">Send payment directly to farmer's phone - safer than cash!</p>
        <form method="POST" action="{{ route('payments.initiate', $transaction) }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">📱 Choose Mobile Money Provider</label>
                <select name="payment_method" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500">
                    <option value="">Select Mobile Money Provider</option>
                    <option value="Airtel Money">🟠 Airtel Money</option>
                    <option value="MTN Money">🟡 MTN Money</option>
                    <option value="Zamtel">🔵 Zamtel Kwacha</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">📞 Farmer's Phone Number</label>
                <input type="text" name="phone_number" value="{{ $transaction->farmer->phone_number }}" required 
                       placeholder="+260971234567"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500">
                <p class="text-xs text-gray-500 mt-1">Payment will be sent to this mobile money account</p>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">💰 Payment Amount</label>
                <div class="text-2xl font-bold text-green-600">K {{ number_format($transaction->total_amount, 2) }}</div>
                <p class="text-xs text-gray-500">No cash handling required - instant digital transfer</p>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" 
                        onclick="document.getElementById('paymentModal').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Cancel
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 font-semibold">
                    💸 Send Mobile Money Payment
                </button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection
