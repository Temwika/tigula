<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Farmer;
use App\Models\GrainType;
use App\Models\Depot;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['farmer', 'grainType', 'depot', 'recordedBy']);

        // Search by transaction number or farmer name
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('transaction_number', 'like', "%{$search}%")
                  ->orWhereHas('farmer', function ($farmer) use ($search) {
                      $farmer->where('full_name', 'like', "%{$search}%")
                             ->orWhere('nrc_number', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by depot
        if ($request->has('depot_id')) {
            $query->where('depot_id', $request->depot_id);
        }

        // Filter by grain type
        if ($request->has('grain_type_id')) {
            $query->where('grain_type_id', $request->grain_type_id);
        }

        // Filter by date range
        if ($request->has('date_from')) {
            $query->whereDate('transaction_date', '>=', $request->date_from);
        }
        if ($request->has('date_to')) {
            $query->whereDate('transaction_date', '<=', $request->date_to);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->paginate(20);
        
        $depots = Depot::active()->get();
        $grainTypes = GrainType::active()->get();
        $statuses = Transaction::getStatuses();

        return view('transactions.index', compact('transactions', 'depots', 'grainTypes', 'statuses'));
    }

    /**
     * Show the form for creating a new transaction
     */
    public function create(Request $request)
    {
        $farmers = Farmer::verified()->with('depot')->get();
        $grainTypes = GrainType::active()->get();
        $depots = Depot::active()->get();

        $selectedFarmer = null;
        if ($request->has('farmer_id')) {
            $selectedFarmer = Farmer::find($request->farmer_id);
        }

        return view('transactions.create', compact('farmers', 'grainTypes', 'depots', 'selectedFarmer'));
    }

    /**
     * Store a newly created transaction
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'grain_type_id' => 'required|exists:grain_types,id',
            'depot_id' => 'required|exists:depots,id',
            'weight_kg' => 'required|numeric|min:0.01',
            'price_per_kg' => 'required|numeric|min:0.01',
            'quality_grade' => 'nullable|string|max:50',
            'moisture_content' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string|max:1000',
            'transaction_date' => 'required|date',
        ]);

        $transaction = Transaction::create([
            ...$validated,
            'recorded_by' => Auth::id(),
            'status' => Transaction::STATUS_PENDING,
        ]);

        // Log the transaction creation
        AuditLog::log('created', $transaction);

        return redirect()->route('transactions.show', $transaction)
                        ->with('success', 'Transaction recorded successfully! Transaction Number: ' . $transaction->transaction_number);
    }

    /**
     * Display the specified transaction
     */
    public function show(Transaction $transaction)
    {
        $transaction->load(['farmer', 'grainType', 'depot', 'recordedBy', 'payments']);
        
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the transaction
     */
    public function edit(Transaction $transaction)
    {
        // Only allow editing pending transactions
        if ($transaction->status !== Transaction::STATUS_PENDING) {
            return redirect()->route('transactions.show', $transaction)
                           ->with('error', 'Only pending transactions can be edited.');
        }

        $farmers = Farmer::verified()->get();
        $grainTypes = GrainType::active()->get();
        $depots = Depot::active()->get();

        return view('transactions.edit', compact('transaction', 'farmers', 'grainTypes', 'depots'));
    }

    /**
     * Update the specified transaction
     */
    public function update(Request $request, Transaction $transaction)
    {
        // Only allow updating pending transactions
        if ($transaction->status !== Transaction::STATUS_PENDING) {
            return redirect()->route('transactions.show', $transaction)
                           ->with('error', 'Only pending transactions can be updated.');
        }

        $validated = $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'grain_type_id' => 'required|exists:grain_types,id',
            'depot_id' => 'required|exists:depots,id',
            'weight_kg' => 'required|numeric|min:0.01',
            'price_per_kg' => 'required|numeric|min:0.01',
            'quality_grade' => 'nullable|string|max:50',
            'moisture_content' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string|max:1000',
            'transaction_date' => 'required|date',
        ]);

        $oldValues = $transaction->toArray();
        $transaction->update($validated);

        // Log the transaction update
        AuditLog::log('updated', $transaction, $oldValues, $transaction->fresh()->toArray());

        return redirect()->route('transactions.show', $transaction)
                        ->with('success', 'Transaction updated successfully!');
    }

    /**
     * Complete a transaction
     */
    public function complete(Transaction $transaction)
    {
        if ($transaction->status !== Transaction::STATUS_PENDING) {
            return redirect()->back()
                           ->with('error', 'Only pending transactions can be completed.');
        }

        $oldValues = $transaction->toArray();
        $transaction->update(['status' => Transaction::STATUS_COMPLETED]);

        // Log the status change
        AuditLog::log('completed', $transaction, $oldValues, $transaction->fresh()->toArray());

        return redirect()->back()
                        ->with('success', 'Transaction completed successfully!');
    }

    /**
     * Cancel a transaction
     */
    public function cancel(Transaction $transaction)
    {
        if ($transaction->status !== Transaction::STATUS_PENDING) {
            return redirect()->back()
                           ->with('error', 'Only pending transactions can be cancelled.');
        }

        $oldValues = $transaction->toArray();
        $transaction->update(['status' => Transaction::STATUS_CANCELLED]);

        // Log the status change
        AuditLog::log('cancelled', $transaction, $oldValues, $transaction->fresh()->toArray());

        return redirect()->back()
                        ->with('success', 'Transaction cancelled successfully!');
    }

    /**
     * Quick create transaction for existing farmer
     */
    public function quickCreate(Farmer $farmer)
    {
        $grainTypes = GrainType::active()->get();
        
        return view('transactions.quick-create', compact('farmer', 'grainTypes'));
    }

    /**
     * Remove the specified transaction
     */
    public function destroy(Transaction $transaction)
    {
        // Only allow deleting pending transactions
        if ($transaction->status !== Transaction::STATUS_PENDING) {
            return redirect()->back()
                           ->with('error', 'Only pending transactions can be deleted.');
        }

        AuditLog::log('deleted', $transaction, $transaction->toArray());
        $transaction->delete();

        return redirect()->route('transactions.index')
                        ->with('success', 'Transaction deleted successfully!');
    }
}