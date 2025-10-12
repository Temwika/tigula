<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [];

        // Admin dashboard data
        if (auth()->user()->isAdmin()) {
            // Today's buyer activity
            $data['todaysBuyerActivity'] = \App\Models\User::where('role', 'aggregator')
                ->withCount(['transactions as todays_transactions' => function($query) {
                    $query->whereDate('created_at', today());
                }])
                ->withSum(['transactions as todays_total' => function($query) {
                    $query->whereDate('created_at', today());
                }], 'total_amount')
                ->orderBy('todays_total', 'desc')
                ->get();

            // Recent transactions
            $data['recentTransactions'] = \App\Models\Transaction::with(['farmer', 'creator', 'grainType'])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            // Statistics
            $data['stats'] = [
                'total_transactions_today' => \App\Models\Transaction::whereDate('created_at', today())->count(),
                'total_amount_today' => \App\Models\Transaction::whereDate('created_at', today())->sum('total_amount'),
                'active_buyers' => \App\Models\User::where('role', 'aggregator')->count(),
                'farmers_served_today' => \App\Models\Transaction::whereDate('created_at', today())->distinct('farmer_id')->count(),
            ];
        }

        return view('dashboard', $data);
    }
}
