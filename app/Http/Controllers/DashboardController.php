<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Farmer;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\Depot;
use App\Models\GrainType;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display role-based dashboard
     */
    public function index()
    {
        $user = Auth::user();

        switch ($user->role) {
            case User::ROLE_ADMIN:
                return $this->adminDashboard();
            case User::ROLE_AGGREGATOR:
                return $this->aggregatorDashboard();
            case User::ROLE_FARMER:
                return $this->farmerDashboard();
            default:
                abort(403, 'Unauthorized access');
        }
    }

    /**
     * Admin Dashboard with comprehensive system overview
     */
    private function adminDashboard()
    {
        // Key Statistics
        $stats = [
            'total_farmers' => Farmer::count(),
            'verified_farmers' => Farmer::verified()->count(),
            'total_transactions' => Transaction::count(),
            'pending_transactions' => Transaction::where('status', Transaction::STATUS_PENDING)->count(),
            'total_payments' => Payment::where('status', Payment::STATUS_COMPLETED)->sum('amount'),
            'pending_payments' => Payment::where('status', Payment::STATUS_PENDING)->count(),
            'active_depots' => Depot::active()->count(),
            'total_depots' => Depot::count(),
        ];

        // Monthly Transaction Trends (Last 6 months)
        $monthlyTrends = Transaction::select(
            DB::raw('strftime("%Y-%m", transaction_date) as month'),
            DB::raw('COUNT(*) as transaction_count'),
            DB::raw('SUM(total_amount) as total_amount')
        )
        ->where('transaction_date', '>=', now()->subMonths(6))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Top Performing Depots
        $topDepots = Depot::withCount('transactions')
            ->with(['transactions' => function ($query) {
                $query->select('depot_id', DB::raw('SUM(total_amount) as total_revenue'));
            }])
            ->orderBy('transactions_count', 'desc')
            ->limit(5)
            ->get();

        // Recent Activities
        $recentActivities = AuditLog::with(['user', 'auditable'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Grain Type Performance
        $grainPerformance = GrainType::withCount('transactions')
            ->with(['transactions' => function ($query) {
                $query->select('grain_type_id', DB::raw('SUM(weight_kg) as total_weight'), DB::raw('SUM(total_amount) as total_value'));
            }])
            ->orderBy('transactions_count', 'desc')
            ->get();

        // Payment Method Distribution
        $paymentMethods = Payment::where('status', Payment::STATUS_COMPLETED)
            ->select('payment_method', DB::raw('COUNT(*) as count'), DB::raw('SUM(amount) as total'))
            ->groupBy('payment_method')
            ->get();

        return view('dashboard.admin', compact(
            'stats', 
            'monthlyTrends', 
            'topDepots', 
            'recentActivities', 
            'grainPerformance',
            'paymentMethods'
        ));
    }

    /**
     * Aggregator Dashboard with depot-focused metrics
     */
    private function aggregatorDashboard()
    {
        $user = Auth::user();
        $depot = $user->depot;

        if (!$depot) {
            return redirect()->route('profile.edit')
                           ->with('error', 'Please contact admin to assign you to a depot.');
        }

        // Depot Statistics
        $stats = [
            'depot_farmers' => $depot->farmers()->count(),
            'verified_farmers' => $depot->farmers()->verified()->count(),
            'today_transactions' => $depot->transactions()->whereDate('transaction_date', today())->count(),
            'pending_transactions' => $depot->transactions()->where('status', Transaction::STATUS_PENDING)->count(),
            'today_revenue' => $depot->transactions()->whereDate('transaction_date', today())->sum('total_amount'),
            'month_revenue' => $depot->transactions()->whereMonth('transaction_date', now()->month)->sum('total_amount'),
            'pending_payments' => Payment::whereHas('transaction', function ($query) use ($depot) {
                $query->where('depot_id', $depot->id);
            })->where('status', Payment::STATUS_PENDING)->count(),
        ];

        // Recent Transactions
        $recentTransactions = $depot->transactions()
            ->with(['farmer', 'grainType', 'recordedBy'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Daily Transaction Trends (Last 30 days)
        $dailyTrends = $depot->transactions()
            ->select(
                DB::raw('DATE(transaction_date) as date'),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(total_amount) as amount')
            )
            ->where('transaction_date', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top Farmers by Volume
        $topFarmers = $depot->farmers()
            ->withCount('transactions')
            ->with(['transactions' => function ($query) {
                $query->select('farmer_id', DB::raw('SUM(weight_kg) as total_weight'), DB::raw('SUM(total_amount) as total_earnings'));
            }])
            ->orderBy('transactions_count', 'desc')
            ->limit(10)
            ->get();

        // Grain Type Distribution
        $grainDistribution = Transaction::where('depot_id', $depot->id)
            ->with('grainType')
            ->select('grain_type_id', DB::raw('COUNT(*) as count'), DB::raw('SUM(weight_kg) as total_weight'))
            ->groupBy('grain_type_id')
            ->get();

        return view('dashboard.aggregator', compact(
            'depot',
            'stats',
            'recentTransactions',
            'dailyTrends',
            'topFarmers',
            'grainDistribution'
        ));
    }

    /**
     * Farmer Dashboard with personal metrics
     */
    private function farmerDashboard()
    {
        $user = Auth::user();
        $farmer = $user->farmer;

        if (!$farmer) {
            return redirect()->route('farmers.create')
                           ->with('info', 'Please complete your farmer profile.');
        }

        // Farmer Statistics
        $stats = [
            'total_transactions' => $farmer->transactions()->count(),
            'pending_transactions' => $farmer->transactions()->where('status', Transaction::STATUS_PENDING)->count(),
            'completed_transactions' => $farmer->transactions()->where('status', Transaction::STATUS_COMPLETED)->count(),
            'total_earnings' => $farmer->transactions()->where('status', Transaction::STATUS_COMPLETED)->sum('total_amount'),
            'pending_earnings' => $farmer->transactions()->where('status', Transaction::STATUS_PENDING)->sum('total_amount'),
            'total_weight_sold' => $farmer->transactions()->sum('weight_kg'),
            'average_price' => $farmer->transactions()->avg('price_per_kg'),
        ];

        // Recent Transactions
        $recentTransactions = $farmer->transactions()
            ->with(['grainType', 'depot', 'payments'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Monthly Earnings (Last 12 months)
        $monthlyEarnings = $farmer->transactions()
            ->select(
                DB::raw('strftime("%Y-%m", transaction_date) as month'),
                DB::raw('SUM(total_amount) as earnings'),
                DB::raw('SUM(weight_kg) as weight')
            )
            ->where('transaction_date', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Grain Type Performance
        $grainPerformance = $farmer->transactions()
            ->with('grainType')
            ->select(
                'grain_type_id',
                DB::raw('COUNT(*) as transaction_count'),
                DB::raw('SUM(weight_kg) as total_weight'),
                DB::raw('SUM(total_amount) as total_earnings'),
                DB::raw('AVG(price_per_kg) as avg_price')
            )
            ->groupBy('grain_type_id')
            ->get();

        // Payment Status
        $paymentStatus = Payment::whereHas('transaction', function ($query) use ($farmer) {
            $query->where('farmer_id', $farmer->id);
        })
        ->select('status', DB::raw('COUNT(*) as count'), DB::raw('SUM(amount) as total'))
        ->groupBy('status')
        ->get();

        return view('dashboard.farmer', compact(
            'farmer',
            'stats',
            'recentTransactions',
            'monthlyEarnings',
            'grainPerformance',
            'paymentStatus'
        ));
    }

    /**
     * Real-time statistics API endpoint
     */
    public function realTimeStats()
    {
        $user = Auth::user();

        $stats = [
            'timestamp' => now()->toISOString(),
        ];

        switch ($user->role) {
            case User::ROLE_ADMIN:
                $stats = array_merge($stats, [
                    'total_transactions_today' => Transaction::whereDate('transaction_date', today())->count(),
                    'total_amount_today' => Transaction::whereDate('transaction_date', today())->sum('total_amount'),
                    'pending_payments' => Payment::where('status', Payment::STATUS_PENDING)->count(),
                    'active_users' => User::whereDate('last_login_at', '>=', now()->subDays(7))->count(),
                ]);
                break;

            case User::ROLE_AGGREGATOR:
                $depot = $user->depot;
                if ($depot) {
                    $stats = array_merge($stats, [
                        'depot_transactions_today' => $depot->transactions()->whereDate('transaction_date', today())->count(),
                        'depot_revenue_today' => $depot->transactions()->whereDate('transaction_date', today())->sum('total_amount'),
                        'pending_transactions' => $depot->transactions()->where('status', Transaction::STATUS_PENDING)->count(),
                    ]);
                }
                break;

            case User::ROLE_FARMER:
                $farmer = $user->farmer;
                if ($farmer) {
                    $stats = array_merge($stats, [
                        'total_transactions' => $farmer->transactions()->count(),
                        'pending_transactions' => $farmer->transactions()->where('status', Transaction::STATUS_PENDING)->count(),
                        'total_earnings' => $farmer->transactions()->where('status', Transaction::STATUS_COMPLETED)->sum('total_amount'),
                    ]);
                }
                break;
        }

        return response()->json($stats);
    }

    /**
     * Export dashboard data
     */
    public function export(Request $request)
    {
        $user = Auth::user();
        $format = $request->get('format', 'csv');
        
        // Implementation for exporting dashboard data
        // This would generate CSV/PDF exports based on user role and permissions
        
        return response()->json(['message' => 'Export functionality will be implemented based on requirements']);
    }
}