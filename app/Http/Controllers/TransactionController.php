<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotificationService;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = \App\Models\Transaction::with(['farmer', 'grainType', 'depot', 'creator']);
        
        // Role-based filtering
        if (auth()->user()->isAggregator()) {
            $query->where('created_by', auth()->id());
        }
        
        $transactions = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show pending transactions for admin approval
     */
    public function pending()
    {
        // Only admins can access this
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $transactions = \App\Models\Transaction::with(['farmer', 'grainType', 'depot', 'creator'])
            ->pending()
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('transactions.pending', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grainTypes = \App\Models\GrainType::active()->get();
        $depots = \App\Models\Depot::active()->get();
        
        return view('transactions.create', compact('grainTypes', 'depots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'grain_type_id' => 'required|exists:grain_types,id',
            'depot_id' => 'required|exists:depots,id',
            'weight_kg' => 'required|numeric|min:1',
            'notes' => 'nullable|string|max:1000',
        ]);

        $grainType = \App\Models\GrainType::findOrFail($request->grain_type_id);
        $totalAmount = $request->weight_kg * ($grainType->current_price / 25); // Convert to per kg price

        $transaction = \App\Models\Transaction::create([
            'farmer_id' => $request->farmer_id,
            'grain_type_id' => $request->grain_type_id,
            'depot_id' => $request->depot_id,
            'weight_kg' => $request->weight_kg,
            'unit_price' => $grainType->current_price,
            'total_amount' => $totalAmount,
            'notes' => $request->notes,
            'created_by' => auth()->id(),
        ]);

        // Send SMS notification (mock implementation)
        $this->sendSMSNotification($transaction, 'created');

        return redirect()->route('transactions.show', $transaction)
            ->with('success', 'Transaction created successfully! SMS sent to farmer and admin.');
    }

    /**
     * Approve a transaction (Admin only)
     */
    public function approve(\App\Models\Transaction $transaction)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        if (!$transaction->canBeApproved()) {
            return back()->with('error', 'Transaction cannot be approved.');
        }

        $transaction->approve(auth()->id());
        
        // Send SMS notification
        $this->sendSMSNotification($transaction, 'approved');

        return redirect()->route('transactions.pending')
            ->with('success', 'Transaction approved successfully!');
    }

    /**
     * Send SMS notification (mock implementation)
     */
    private function sendSMSNotification($transaction, $type)
    {
        // This would integrate with actual SMS gateway
        $farmer = $transaction->farmer;
        
        $messages = [
            'created' => "Dear {$farmer->full_name}, your grain sale of {$transaction->weight_kg}kg {$transaction->grainType->name} for K{$transaction->total_amount} has been recorded. Transaction: {$transaction->transaction_number}",
            'approved' => "Dear {$farmer->full_name}, your grain sale (#{$transaction->transaction_number}) has been approved. Payment will be processed soon.",
            'paid' => "Dear {$farmer->full_name}, payment of K{$transaction->total_amount} has been sent to {$farmer->phone_number}. Transaction: {$transaction->transaction_number}"
        ];

        // Log the SMS for now (in production, this would send actual SMS)
        \Log::info("SMS to {$farmer->phone_number}: " . $messages[$type]);
        
        // Update SMS sent timestamp
        $transaction->update(['sms_sent_at' => now()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Transaction $transaction)
    {
        // Load relationships
        $transaction->load(['farmer', 'grainType', 'depot', 'creator', 'approver', 'payments.initiator']);
        
        // Check permissions
        if (auth()->user()->isAggregator() && $transaction->created_by !== auth()->id()) {
            abort(403);
        }
        
        return view('transactions.show', compact('transaction'));
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
     * Show the quick grain purchase form
     */
    public function quickCreate()
    {
        if (!auth()->user()->isAggregator() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $grainTypes = \App\Models\GrainType::active()->get();
        $depots = \App\Models\Depot::active()->get();
        
        return view('transactions.quick-create', compact('grainTypes', 'depots'));
    }

    /**
     * Process quick grain purchase with instant payment
     */
    public function quickStore(Request $request)
    {
        if (!auth()->user()->isAggregator() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'farmer_phone' => 'required|string',
            'grain_type_id' => 'required|exists:grain_types,id',
            'depot_id' => 'required|exists:depots,id',
            'weight_kg' => 'required|numeric|min:0.1',
            'payment_method' => 'required|in:Airtel Money,MTN Money,Zamtel',
            'payment_phone' => 'required|string',
            'farmer_name' => 'required_without:farmer_id|string',
            'farmer_village' => 'required_without:farmer_id|string',
            'farmer_id' => 'nullable|exists:farmers,id',
        ]);

        // Find or create farmer
        $farmer = null;
        if ($request->farmer_id) {
            $farmer = \App\Models\Farmer::findOrFail($request->farmer_id);
        } else {
            // Create new farmer
            $farmer = \App\Models\Farmer::create([
                'name' => $request->farmer_name,
                'phone_number' => $request->farmer_phone,
                'village' => $request->farmer_village,
                'district' => 'Sinda',
                'province' => 'Eastern Province',
                'created_by' => auth()->id(),
            ]);
        }

        $grainType = \App\Models\GrainType::findOrFail($request->grain_type_id);
        $totalAmount = $request->weight_kg * $grainType->current_price;

        // Create transaction
        $transaction = \App\Models\Transaction::create([
            'farmer_id' => $farmer->id,
            'grain_type_id' => $request->grain_type_id,
            'depot_id' => $request->depot_id,
            'weight_kg' => $request->weight_kg,
            'unit_price' => $grainType->current_price,
            'total_amount' => $totalAmount,
            'status' => 'approved', // Auto-approve for quick purchases
            'created_by' => auth()->id(),
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        // Create payment request (requires admin approval)
        $payment = \App\Models\Payment::create([
            'transaction_id' => $transaction->id,
            'amount' => $totalAmount,
            'phone_number' => $request->payment_phone,
            'payment_method' => $request->payment_method,
            'status' => 'processing', // Requires approval
            'initiated_by' => auth()->id(),
            'initiated_at' => now(),
        ]);

        // Keep transaction as approved, payment will update to paid when approved
        // $transaction->update(['status' => 'paid']); // Removed - will be set when payment approved

        // Send SMS notifications via NotificationService
        try {
            $notifier = new NotificationService();
            // send farmer SMS about their payment
            $notifier->sendFarmerTransactionSMS($transaction);
            // notify admins about the completed purchase/payment
            $notifier->sendAdminPaymentNotification($transaction);
        } catch (\Exception $e) {
            \Log::error('NotificationService failed: ' . $e->getMessage());
        }

        return redirect()->route('payments.pending')
            ->with('success', '📝 Transaction recorded! Payment of K' . number_format($totalAmount, 2) . ' is pending admin approval. Farmer will receive SMS once approved.');
    }

    // Notifications are handled by App\Services\NotificationService

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
