<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\User;
use App\Models\Depot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FarmerController extends Controller
{
    /**
     * Display a listing of farmers
     */
    public function index(Request $request)
    {
        $query = Farmer::with(['user', 'depot']);

        // Search functionality
        if ($request->has('search')) {
            $query->search($request->search);
        }

        // Filter by verification status
        if ($request->has('verified')) {
            $query->where('is_verified', $request->verified);
        }

        // Filter by depot
        if ($request->has('depot_id')) {
            $query->where('depot_id', $request->depot_id);
        }

        $farmers = $query->paginate(20);
        $depots = Depot::active()->get();

        return view('farmers.index', compact('farmers', 'depots'));
    }

    /**
     * Show the form for creating a new farmer
     */
    public function create()
    {
        $depots = Depot::active()->get();
        return view('farmers.create', compact('depots'));
    }

    /**
     * Store a newly created farmer
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nrc_number' => 'required|unique:farmers',
            'full_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'village' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'depot_id' => 'required|exists:depots,id',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'farming_experience_years' => 'nullable|integer|min:0',
            'land_size_hectares' => 'nullable|numeric|min:0',
            'bank_account_number' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'mobile_money_number' => 'nullable|string',
            'email' => 'nullable|email|unique:users',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Create user account if email and password provided
        $user = null;
        if ($request->filled(['email', 'password'])) {
            $user = User::create([
                'name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'phone' => $validated['phone_number'],
                'role' => User::ROLE_FARMER,
                'depot_id' => $validated['depot_id'],
            ]);
        }

        $farmer = Farmer::create([
            ...$validated,
            'user_id' => $user?->id,
        ]);

        return redirect()->route('farmers.show', $farmer)
                        ->with('success', 'Farmer registered successfully!');
    }

    /**
     * Display the specified farmer
     */
    public function show(Farmer $farmer)
    {
        $farmer->load(['user', 'depot', 'transactions.grainType', 'transactions.payments']);
        
        $stats = [
            'total_transactions' => $farmer->transactions()->count(),
            'total_grain_sold' => $farmer->total_grain_sold,
            'total_earnings' => $farmer->total_earnings,
        ];

        return view('farmers.show', compact('farmer', 'stats'));
    }

    /**
     * Show the form for editing the farmer
     */
    public function edit(Farmer $farmer)
    {
        $depots = Depot::active()->get();
        return view('farmers.edit', compact('farmer', 'depots'));
    }

    /**
     * Update the specified farmer
     */
    public function update(Request $request, Farmer $farmer)
    {
        $validated = $request->validate([
            'nrc_number' => 'required|unique:farmers,nrc_number,' . $farmer->id,
            'full_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'village' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'depot_id' => 'required|exists:depots,id',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'farming_experience_years' => 'nullable|integer|min:0',
            'land_size_hectares' => 'nullable|numeric|min:0',
            'bank_account_number' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'mobile_money_number' => 'nullable|string',
            'is_verified' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $farmer->update($validated);

        return redirect()->route('farmers.show', $farmer)
                        ->with('success', 'Farmer updated successfully!');
    }

    /**
     * Verify a farmer
     */
    public function verify(Farmer $farmer)
    {
        $farmer->update([
            'is_verified' => true,
            'verification_date' => now(),
        ]);

        return redirect()->back()
                        ->with('success', 'Farmer verified successfully!');
    }

    /**
     * Remove the specified farmer
     */
    public function destroy(Farmer $farmer)
    {
        $farmer->delete();

        return redirect()->route('farmers.index')
                        ->with('success', 'Farmer deleted successfully!');
    }
}