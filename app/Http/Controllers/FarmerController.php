<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\NotificationService;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farmers = \App\Models\Farmer::with(['transactions' => function($query) {
            $query->where('status', 'paid');
        }])
        ->orderBy('created_at', 'desc')
        ->paginate(12);

        return view('farmers.index', compact('farmers'));
    }

    /**
     * Search for farmers by NRC number
     */
    public function search(Request $request)
    {
        $nrc = $request->input('nrc');
        $farmer = \App\Models\Farmer::where('nrc_number', $nrc)->first();
        
        if ($farmer) {
            return response()->json([
                'found' => true,
                'farmer' => $farmer
            ]);
        }
        
        return response()->json(['found' => false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grainTypes = \App\Models\GrainType::where('is_active', true)->get();
        $depots = \App\Models\Depot::where('is_active', true)->get();
        
        return view('farmers.create', compact('grainTypes', 'depots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nrc_number' => 'required|unique:farmers,nrc_number',
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'village' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            // Grain transaction fields
            'grain_type_id' => 'nullable|exists:grain_types,id',
            'weight_kg' => 'nullable|numeric|min:0.1',
            'depot_id' => 'nullable|exists:depots,id',
        ]);

        try {
            \DB::beginTransaction();

            // Create farmer
            $farmer = \App\Models\Farmer::create($request->only([
                'nrc_number', 'full_name', 'phone_number', 
                'village', 'district', 'province'
            ]));

            $message = 'Farmer registered successfully!';

            // Send welcome SMS to new farmer
            try {
                $notifier = new NotificationService();
                $notifier->sendWelcomeSMS($farmer);
            } catch (\Exception $e) {
                \Log::error('Welcome SMS failed: ' . $e->getMessage());
            }

            // If grain transaction details are provided, create transaction
            if ($request->filled(['grain_type_id', 'weight_kg', 'depot_id'])) {
                $grainType = \App\Models\GrainType::find($request->grain_type_id);
                $totalAmount = $request->weight_kg * $grainType->current_price;

                $transaction = \App\Models\Transaction::create([
                    'farmer_id' => $farmer->id,
                    'grain_type_id' => $request->grain_type_id,
                    'depot_id' => $request->depot_id,
                    'weight_kg' => $request->weight_kg,
                    'unit_price' => $grainType->current_price,
                    'total_amount' => $totalAmount,
                    'status' => 'pending',
                    'created_by' => auth()->id(),
                    'transaction_number' => 'TXN-' . date('Y') . '-' . str_pad(\App\Models\Transaction::count() + 1, 6, '0', STR_PAD_LEFT),
                    'notes' => 'Initial registration transaction'
                ]);

                // Send specialized SMS for farmer registration with grain
                try {
                    $notifier = new NotificationService();
                    $notifier->sendFarmerRegistrationWithGrainSMS($farmer, $transaction);
                } catch (\Exception $e) {
                    \Log::error('Farmer registration SMS failed: ' . $e->getMessage());
                }
                
                $message = 'Farmer registered with grain delivery! Welcome SMS and transaction notifications sent.';
            } else {
                $message = 'Farmer registered successfully! Welcome SMS sent.';
            }

            \DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'farmer' => $farmer,
                    'message' => $message
                ]);
            }

            return redirect()->route('farmers.index')->with('success', $message);

        } catch (\Exception $e) {
            \DB::rollback();
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Registration failed: ' . $e->getMessage()
                ], 422);
            }

            return back()->withInput()->withErrors(['error' => 'Registration failed: ' . $e->getMessage()]);
        }
    }

    // SMS notifications now handled by App\Services\NotificationService

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
