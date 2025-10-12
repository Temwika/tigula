<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotificationService;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $payments = \App\Models\Payment::with(['transaction.farmer', 'initiator'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('payments.index', compact('payments'));
    }

    /**
     * Initiate payment for a transaction
     */
    public function initiate(\App\Models\Transaction $transaction, Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        if (!$transaction->canInitiatePayment()) {
            return back()->with('error', 'Payment cannot be initiated for this transaction.');
        }

        $request->validate([
            'payment_method' => 'required|in:Airtel Money,MTN Money,Zamtel',
            'phone_number' => 'required|string|regex:/^(\+260|0)?[79][0-9]{8}$/',
        ]);

        $payment = \App\Models\Payment::create([
            'transaction_id' => $transaction->id,
            'amount' => $transaction->total_amount,
            'phone_number' => $request->phone_number,
            'payment_method' => $request->payment_method,
            'status' => 'processing',
            'initiated_by' => auth()->id(),
            'initiated_at' => now(),
        ]);

        // Mock payment gateway integration
        $this->processPayment($payment);

        return redirect()->route('transactions.show', $transaction)
            ->with('success', 'Payment initiated successfully!');
    }

    /**
     * Mark payment as completed
     */
    public function complete(\App\Models\Payment $payment)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $payment->markAsCompleted();
        $payment->transaction->markAsPaid();

        // Send SMS notification via NotificationService
        try {
            $notifier = new NotificationService();
            $notifier->sendPaymentCompletionSMS($payment);
        } catch (\Exception $e) {
            \Log::error('Payment SMS failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Payment completed and SMS sent to farmer!');
    }

    /**
     * Show pending payments for approval
     */
    public function pending()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $pendingPayments = \App\Models\Payment::with(['transaction.farmer', 'transaction.grainType', 'initiator'])
            ->where('status', 'processing')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('payments.pending', compact('pendingPayments'));
    }

    /**
     * Approve and process payment
     */
    public function approve(\App\Models\Payment $payment, Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        if ($payment->status !== 'processing') {
            return back()->with('error', 'Payment cannot be approved in current status.');
        }

        // Simulate mobile money processing
        $success = $this->processPayment($payment);

        if ($success) {
            $payment->update([
                'status' => 'completed',
                'completed_at' => now(),
                'approved_by' => auth()->id(),
                'reference_number' => 'TIG-' . date('YmdHis') . rand(100, 999)
            ]);

            $payment->transaction->update(['status' => 'paid']);

            // Send SMS notification
            try {
                $notifier = new NotificationService();
                $notifier->sendPaymentCompletionSMS($payment);
            } catch (\Exception $e) {
                \Log::error('Payment SMS failed: ' . $e->getMessage());
            }

            return back()->with('success', '✅ Payment approved and sent! Farmer will receive SMS confirmation.');
        } else {
            $payment->update([
                'status' => 'failed',
                'failed_at' => now()
            ]);

            return back()->with('error', '❌ Payment processing failed. Please try again.');
        }
    }

    /**
     * Reject payment
     */
    public function reject(\App\Models\Payment $payment, Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $payment->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejected_by' => auth()->id(),
            'rejection_reason' => $request->rejection_reason
        ]);

        return back()->with('success', 'Payment rejected with reason provided.');
    }

    /**
     * Mock payment processing with mobile money gateway
     */
    private function processPayment($payment)
    {
        try {
            // This would integrate with actual mobile money gateway (Airtel, MTN, Zamtel)
            // For demo purposes, we'll simulate the API call
            
            $gatewayResponse = $this->simulateMobileMoneyGateway($payment);
            
            $payment->update([
                'gateway_response' => $gatewayResponse
            ]);

            \Log::info("Payment processed: {$payment->payment_method} K{$payment->amount} to {$payment->phone_number}");
            
            return $gatewayResponse['status'] === 'success';
            
        } catch (\Exception $e) {
            \Log::error("Payment processing failed: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Simulate mobile money gateway response
     */
    private function simulateMobileMoneyGateway($payment)
    {
        // Simulate different mobile money providers
        $providers = [
            'Airtel Money' => ['prefix' => 'AM', 'success_rate' => 95],
            'MTN Money' => ['prefix' => 'MTN', 'success_rate' => 90],
            'Zamtel' => ['prefix' => 'ZT', 'success_rate' => 85]
        ];
        
        $provider = $providers[$payment->payment_method] ?? $providers['Airtel Money'];
        $success = (rand(1, 100) <= $provider['success_rate']);
        
        if ($success) {
            return [
                'status' => 'success',
                'reference' => $provider['prefix'] . date('YmdHis') . rand(100, 999),
                'transaction_id' => 'TXN' . rand(1000000, 9999999),
                'timestamp' => now()->toISOString(),
                'provider' => $payment->payment_method,
                'message' => 'Payment sent successfully'
            ];
        } else {
            return [
                'status' => 'failed',
                'error_code' => 'INSUFFICIENT_BALANCE',
                'message' => 'Mobile money transaction failed',
                'timestamp' => now()->toISOString()
            ];
        }
    }

    /**
     * Send payment confirmation SMS
     */
    private function sendPaymentSMS($payment)
    {
        $transaction = $payment->transaction;
        $farmer = $transaction->farmer;
        
        $message = "Dear {$farmer->full_name}, payment of K{$payment->amount} has been sent to {$payment->phone_number}. Reference: {$payment->reference_number}";
        
        \Log::info("Payment SMS to {$farmer->phone_number}: " . $message);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
