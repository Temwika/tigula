<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\AuditLog;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Display a listing of payments
     */
    public function index(Request $request)
    {
        $query = Payment::with(['transaction.farmer', 'transaction.grainType']);

        // Search by payment reference or farmer name
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('payment_reference', 'like', "%{$search}%")
                  ->orWhere('mobile_money_reference', 'like', "%{$search}%")
                  ->orWhereHas('transaction.farmer', function ($farmer) use ($search) {
                      $farmer->where('full_name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment method
        if ($request->has('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        // Filter by date range
        if ($request->has('date_from')) {
            $query->whereDate('payment_date', '>=', $request->date_from);
        }
        if ($request->has('date_to')) {
            $query->whereDate('payment_date', '<=', $request->date_to);
        }

        $payments = $query->orderBy('payment_date', 'desc')->paginate(20);
        
        $statuses = Payment::getStatuses();
        $paymentMethods = Payment::getPaymentMethods();

        return view('payments.index', compact('payments', 'statuses', 'paymentMethods'));
    }

    /**
     * Show the form for creating a new payment
     */
    public function create(Request $request)
    {
        $transaction = null;
        if ($request->has('transaction_id')) {
            $transaction = Transaction::with(['farmer', 'grainType'])->find($request->transaction_id);
        }

        return view('payments.create', compact('transaction'));
    }

    /**
     * Store a newly created payment
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|in:' . implode(',', array_keys(Payment::getPaymentMethods())),
            'mobile_number' => 'required_if:payment_method,airtel_money,mtn_money,zamtel_money|string|max:20',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
        ]);

        $transaction = Transaction::find($validated['transaction_id']);
        
        // Check if payment amount doesn't exceed transaction total
        $existingPayments = $transaction->payments()->where('status', Payment::STATUS_COMPLETED)->sum('amount');
        if (($existingPayments + $validated['amount']) > $transaction->total_amount) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Payment amount exceeds remaining balance.');
        }

        $payment = Payment::create([
            ...$validated,
            'status' => Payment::STATUS_PENDING,
            'processed_by' => Auth::id(),
        ]);

        // Log the payment creation
        AuditLog::log('created', $payment);

        // Send SMS notification to farmer
        $this->sendPaymentNotification($payment, 'initiated');

        return redirect()->route('payments.show', $payment)
                        ->with('success', 'Payment initiated successfully! Reference: ' . $payment->payment_reference);
    }

    /**
     * Display the specified payment
     */
    public function show(Payment $payment)
    {
        $payment->load(['transaction.farmer', 'transaction.grainType', 'processedBy']);
        
        return view('payments.show', compact('payment'));
    }

    /**
     * Process mobile money payment
     */
    public function process(Payment $payment)
    {
        if ($payment->status !== Payment::STATUS_PENDING) {
            return redirect()->back()
                           ->with('error', 'Only pending payments can be processed.');
        }

        // Simulate mobile money gateway processing
        $gatewayResponse = $this->processWithGateway($payment);

        $oldValues = $payment->toArray();
        
        if ($gatewayResponse['success']) {
            $payment->update([
                'status' => Payment::STATUS_COMPLETED,
                'mobile_money_reference' => $gatewayResponse['reference'],
                'gateway_response' => json_encode($gatewayResponse),
                'processed_at' => now(),
            ]);

            $this->sendPaymentNotification($payment, 'completed');
            $message = 'Payment processed successfully! Mobile Money Reference: ' . $gatewayResponse['reference'];
        } else {
            $payment->update([
                'status' => Payment::STATUS_FAILED,
                'gateway_response' => json_encode($gatewayResponse),
                'failure_reason' => $gatewayResponse['message'],
            ]);

            $this->sendPaymentNotification($payment, 'failed');
            $message = 'Payment failed: ' . $gatewayResponse['message'];
        }

        // Log the payment processing
        AuditLog::log('processed', $payment, $oldValues, $payment->fresh()->toArray());

        return redirect()->back()->with($gatewayResponse['success'] ? 'success' : 'error', $message);
    }

    /**
     * Cancel a payment
     */
    public function cancel(Payment $payment)
    {
        if ($payment->status !== Payment::STATUS_PENDING) {
            return redirect()->back()
                           ->with('error', 'Only pending payments can be cancelled.');
        }

        $oldValues = $payment->toArray();
        $payment->update(['status' => Payment::STATUS_CANCELLED]);

        // Log the payment cancellation
        AuditLog::log('cancelled', $payment, $oldValues, $payment->fresh()->toArray());

        $this->sendPaymentNotification($payment, 'cancelled');

        return redirect()->back()
                        ->with('success', 'Payment cancelled successfully!');
    }

    /**
     * Retry a failed payment
     */
    public function retry(Payment $payment)
    {
        if ($payment->status !== Payment::STATUS_FAILED) {
            return redirect()->back()
                           ->with('error', 'Only failed payments can be retried.');
        }

        $oldValues = $payment->toArray();
        $payment->update([
            'status' => Payment::STATUS_PENDING,
            'gateway_response' => null,
            'failure_reason' => null,
        ]);

        // Log the payment retry
        AuditLog::log('retried', $payment, $oldValues, $payment->fresh()->toArray());

        return redirect()->back()
                        ->with('success', 'Payment queued for retry!');
    }

    /**
     * Simulate mobile money gateway processing
     */
    private function processWithGateway(Payment $payment)
    {
        // Simulate gateway processing delay
        sleep(1);

        // Simulate 90% success rate
        $success = rand(1, 10) <= 9;

        if ($success) {
            return [
                'success' => true,
                'reference' => 'MM' . time() . rand(1000, 9999),
                'message' => 'Payment processed successfully',
                'gateway' => strtoupper(str_replace('_', ' ', $payment->payment_method)),
                'timestamp' => now()->toISOString(),
            ];
        } else {
            return [
                'success' => false,
                'reference' => null,
                'message' => 'Insufficient funds or network error',
                'gateway' => strtoupper(str_replace('_', ' ', $payment->payment_method)),
                'timestamp' => now()->toISOString(),
            ];
        }
    }

    /**
     * Send payment notification to farmer
     */
    private function sendPaymentNotification(Payment $payment, string $status)
    {
        $farmer = $payment->transaction->farmer;
        
        $messages = [
            'initiated' => "Dear {$farmer->full_name}, your payment of K{$payment->amount} for Transaction #{$payment->transaction->transaction_number} has been initiated. Reference: {$payment->payment_reference}",
            'completed' => "Dear {$farmer->full_name}, your payment of K{$payment->amount} has been completed successfully! Reference: {$payment->mobile_money_reference}. Thank you for choosing our service.",
            'failed' => "Dear {$farmer->full_name}, your payment of K{$payment->amount} could not be processed. Please contact support with reference: {$payment->payment_reference}",
            'cancelled' => "Dear {$farmer->full_name}, your payment of K{$payment->amount} has been cancelled. Reference: {$payment->payment_reference}",
        ];

        if (isset($messages[$status]) && $farmer->phone_number) {
            $this->notificationService->sendSMS(
                $farmer->phone_number,
                $messages[$status]
            );
        }
    }

    /**
     * Payment statistics dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_payments' => Payment::count(),
            'completed_payments' => Payment::where('status', Payment::STATUS_COMPLETED)->count(),
            'pending_payments' => Payment::where('status', Payment::STATUS_PENDING)->count(),
            'failed_payments' => Payment::where('status', Payment::STATUS_FAILED)->count(),
            'total_amount' => Payment::where('status', Payment::STATUS_COMPLETED)->sum('amount'),
            'today_amount' => Payment::where('status', Payment::STATUS_COMPLETED)
                                   ->whereDate('payment_date', today())->sum('amount'),
        ];

        $recentPayments = Payment::with(['transaction.farmer'])
                                ->orderBy('created_at', 'desc')
                                ->limit(10)
                                ->get();

        return view('payments.dashboard', compact('stats', 'recentPayments'));
    }
}