<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\Farmer;
use App\Models\Depot;
use App\Models\GrainType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display reports dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // Available reports based on user role
        $availableReports = $this->getAvailableReports($user->role);
        
        return view('reports.index', compact('availableReports'));
    }

    /**
     * Transaction Summary Report
     */
    public function transactionSummary(Request $request)
    {
        $this->authorize('viewAny', Transaction::class);

        $validated = $request->validate([
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'depot_id' => 'nullable|exists:depots,id',
            'grain_type_id' => 'nullable|exists:grain_types,id',
            'status' => 'nullable|string',
        ]);

        $query = Transaction::with(['farmer', 'grainType', 'depot', 'recordedBy']);

        // Apply filters
        if ($validated['date_from']) {
            $query->whereDate('transaction_date', '>=', $validated['date_from']);
        }
        if ($validated['date_to']) {
            $query->whereDate('transaction_date', '<=', $validated['date_to']);
        }
        if ($validated['depot_id']) {
            $query->where('depot_id', $validated['depot_id']);
        }
        if ($validated['grain_type_id']) {
            $query->where('grain_type_id', $validated['grain_type_id']);
        }
        if ($validated['status']) {
            $query->where('status', $validated['status']);
        }

        // Role-based filtering
        $user = Auth::user();
        if ($user->role === User::ROLE_AGGREGATOR && $user->depot) {
            $query->where('depot_id', $user->depot->id);
        } elseif ($user->role === User::ROLE_FARMER && $user->farmer) {
            $query->where('farmer_id', $user->farmer->id);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->get();

        // Summary statistics
        $summary = [
            'total_transactions' => $transactions->count(),
            'total_weight' => $transactions->sum('weight_kg'),
            'total_amount' => $transactions->sum('total_amount'),
            'average_price' => $transactions->avg('price_per_kg'),
            'completed_transactions' => $transactions->where('status', Transaction::STATUS_COMPLETED)->count(),
            'pending_transactions' => $transactions->where('status', Transaction::STATUS_PENDING)->count(),
            'cancelled_transactions' => $transactions->where('status', Transaction::STATUS_CANCELLED)->count(),
        ];

        // Group by grain type
        $grainTypeBreakdown = $transactions->groupBy('grain_type.name')->map(function ($group) {
            return [
                'count' => $group->count(),
                'weight' => $group->sum('weight_kg'),
                'amount' => $group->sum('total_amount'),
                'avg_price' => $group->avg('price_per_kg'),
            ];
        });

        // Group by depot
        $depotBreakdown = $transactions->groupBy('depot.name')->map(function ($group) {
            return [
                'count' => $group->count(),
                'weight' => $group->sum('weight_kg'),
                'amount' => $group->sum('total_amount'),
            ];
        });

        $depots = Depot::active()->get();
        $grainTypes = GrainType::active()->get();

        return view('reports.transaction-summary', compact(
            'transactions', 
            'summary', 
            'grainTypeBreakdown', 
            'depotBreakdown',
            'depots',
            'grainTypes',
            'validated'
        ));
    }

    /**
     * Farmer Analytics Report
     */
    public function farmerAnalytics(Request $request)
    {
        $this->authorize('viewAny', Farmer::class);

        $validated = $request->validate([
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'depot_id' => 'nullable|exists:depots,id',
            'verification_status' => 'nullable|in:verified,unverified,all',
        ]);

        $query = Farmer::with(['depot', 'user', 'transactions']);

        // Apply filters
        if ($validated['depot_id']) {
            $query->where('depot_id', $validated['depot_id']);
        }
        if ($validated['verification_status'] === 'verified') {
            $query->verified();
        } elseif ($validated['verification_status'] === 'unverified') {
            $query->unverified();
        }

        // Role-based filtering
        $user = Auth::user();
        if ($user->role === User::ROLE_AGGREGATOR && $user->depot) {
            $query->where('depot_id', $user->depot->id);
        }

        $farmers = $query->get();

        // Filter transactions by date if specified
        if ($validated['date_from'] || $validated['date_to']) {
            $farmers->each(function ($farmer) use ($validated) {
                $farmer->setRelation('transactions', 
                    $farmer->transactions->filter(function ($transaction) use ($validated) {
                        $date = Carbon::parse($transaction->transaction_date);
                        $valid = true;
                        
                        if ($validated['date_from']) {
                            $valid = $valid && $date->greaterThanOrEqualTo($validated['date_from']);
                        }
                        if ($validated['date_to']) {
                            $valid = $valid && $date->lessThanOrEqualTo($validated['date_to']);
                        }
                        
                        return $valid;
                    })
                );
            });
        }

        // Calculate farmer metrics
        $farmerMetrics = $farmers->map(function ($farmer) {
            $transactions = $farmer->transactions;
            return [
                'farmer' => $farmer,
                'total_transactions' => $transactions->count(),
                'total_weight' => $transactions->sum('weight_kg'),
                'total_earnings' => $transactions->where('status', Transaction::STATUS_COMPLETED)->sum('total_amount'),
                'pending_earnings' => $transactions->where('status', Transaction::STATUS_PENDING)->sum('total_amount'),
                'average_price' => $transactions->avg('price_per_kg'),
                'last_transaction' => $transactions->sortByDesc('transaction_date')->first()?->transaction_date,
            ];
        })->sortByDesc('total_earnings');

        // Summary statistics
        $summary = [
            'total_farmers' => $farmers->count(),
            'verified_farmers' => $farmers->where('is_verified', true)->count(),
            'unverified_farmers' => $farmers->where('is_verified', false)->count(),
            'active_farmers' => $farmerMetrics->where('total_transactions', '>', 0)->count(),
            'total_transactions' => $farmerMetrics->sum('total_transactions'),
            'total_weight' => $farmerMetrics->sum('total_weight'),
            'total_earnings' => $farmerMetrics->sum('total_earnings'),
        ];

        $depots = Depot::active()->get();

        return view('reports.farmer-analytics', compact(
            'farmerMetrics',
            'summary',
            'depots',
            'validated'
        ));
    }

    /**
     * Payment Reconciliation Report
     */
    public function paymentReconciliation(Request $request)
    {
        $this->authorize('viewAny', Payment::class);

        $validated = $request->validate([
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'payment_method' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $query = Payment::with(['transaction.farmer', 'transaction.depot', 'processedBy']);

        // Apply filters
        if ($validated['date_from']) {
            $query->whereDate('payment_date', '>=', $validated['date_from']);
        }
        if ($validated['date_to']) {
            $query->whereDate('payment_date', '<=', $validated['date_to']);
        }
        if ($validated['payment_method']) {
            $query->where('payment_method', $validated['payment_method']);
        }
        if ($validated['status']) {
            $query->where('status', $validated['status']);
        }

        // Role-based filtering
        $user = Auth::user();
        if ($user->role === User::ROLE_AGGREGATOR && $user->depot) {
            $query->whereHas('transaction', function ($q) use ($user) {
                $q->where('depot_id', $user->depot->id);
            });
        }

        $payments = $query->orderBy('payment_date', 'desc')->get();

        // Summary statistics
        $summary = [
            'total_payments' => $payments->count(),
            'completed_payments' => $payments->where('status', Payment::STATUS_COMPLETED)->count(),
            'pending_payments' => $payments->where('status', Payment::STATUS_PENDING)->count(),
            'failed_payments' => $payments->where('status', Payment::STATUS_FAILED)->count(),
            'total_amount' => $payments->where('status', Payment::STATUS_COMPLETED)->sum('amount'),
            'pending_amount' => $payments->where('status', Payment::STATUS_PENDING)->sum('amount'),
            'failed_amount' => $payments->where('status', Payment::STATUS_FAILED)->sum('amount'),
        ];

        // Payment method breakdown
        $methodBreakdown = $payments->where('status', Payment::STATUS_COMPLETED)
            ->groupBy('payment_method')->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'amount' => $group->sum('amount'),
                ];
            });

        // Daily payment trends
        $dailyTrends = $payments->where('status', Payment::STATUS_COMPLETED)
            ->groupBy(function ($payment) {
                return Carbon::parse($payment->payment_date)->format('Y-m-d');
            })->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'amount' => $group->sum('amount'),
                ];
            });

        return view('reports.payment-reconciliation', compact(
            'payments',
            'summary',
            'methodBreakdown',
            'dailyTrends',
            'validated'
        ));
    }

    /**
     * Depot Performance Report
     */
    public function depotPerformance(Request $request)
    {
        $this->authorize('viewAny', Depot::class);

        $validated = $request->validate([
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
        ]);

        $query = Depot::with(['transactions', 'farmers', 'users']);

        // Role-based filtering
        $user = Auth::user();
        if ($user->role === User::ROLE_AGGREGATOR && $user->depot) {
            $query->where('id', $user->depot->id);
        }

        $depots = $query->get();

        // Calculate depot metrics
        $depotMetrics = $depots->map(function ($depot) use ($validated) {
            $transactions = $depot->transactions;
            
            // Filter by date range if specified
            if ($validated['date_from'] || $validated['date_to']) {
                $transactions = $transactions->filter(function ($transaction) use ($validated) {
                    $date = Carbon::parse($transaction->transaction_date);
                    $valid = true;
                    
                    if ($validated['date_from']) {
                        $valid = $valid && $date->greaterThanOrEqualTo($validated['date_from']);
                    }
                    if ($validated['date_to']) {
                        $valid = $valid && $date->lessThanOrEqualTo($validated['date_to']);
                    }
                    
                    return $valid;
                });
            }

            return [
                'depot' => $depot,
                'total_farmers' => $depot->farmers->count(),
                'verified_farmers' => $depot->farmers->where('is_verified', true)->count(),
                'total_transactions' => $transactions->count(),
                'completed_transactions' => $transactions->where('status', Transaction::STATUS_COMPLETED)->count(),
                'total_weight' => $transactions->sum('weight_kg'),
                'total_revenue' => $transactions->where('status', Transaction::STATUS_COMPLETED)->sum('total_amount'),
                'average_transaction_value' => $transactions->where('status', Transaction::STATUS_COMPLETED)->avg('total_amount'),
                'capacity_utilization' => $depot->capacity > 0 ? ($transactions->sum('weight_kg') / $depot->capacity) * 100 : 0,
            ];
        })->sortByDesc('total_revenue');

        return view('reports.depot-performance', compact('depotMetrics', 'validated'));
    }

    /**
     * Export report data
     */
    public function export(Request $request)
    {
        $reportType = $request->get('report_type');
        $format = $request->get('format', 'csv');
        
        switch ($reportType) {
            case 'transaction_summary':
                return $this->exportTransactionSummary($request, $format);
            case 'farmer_analytics':
                return $this->exportFarmerAnalytics($request, $format);
            case 'payment_reconciliation':
                return $this->exportPaymentReconciliation($request, $format);
            case 'depot_performance':
                return $this->exportDepotPerformance($request, $format);
            default:
                abort(400, 'Invalid report type');
        }
    }

    /**
     * Get available reports based on user role
     */
    private function getAvailableReports(string $role): array
    {
        $reports = [
            'transaction_summary' => [
                'title' => 'Transaction Summary',
                'description' => 'Comprehensive overview of all grain transactions',
                'icon' => 'chart-bar',
                'roles' => [User::ROLE_ADMIN, User::ROLE_AGGREGATOR, User::ROLE_FARMER],
            ],
            'farmer_analytics' => [
                'title' => 'Farmer Analytics',
                'description' => 'Detailed farmer performance and engagement metrics',
                'icon' => 'users',
                'roles' => [User::ROLE_ADMIN, User::ROLE_AGGREGATOR],
            ],
            'payment_reconciliation' => [
                'title' => 'Payment Reconciliation',
                'description' => 'Payment processing and reconciliation report',
                'icon' => 'credit-card',
                'roles' => [User::ROLE_ADMIN, User::ROLE_AGGREGATOR],
            ],
            'depot_performance' => [
                'title' => 'Depot Performance',
                'description' => 'Depot operations and performance analysis',
                'icon' => 'warehouse',
                'roles' => [User::ROLE_ADMIN, User::ROLE_AGGREGATOR],
            ],
        ];

        return array_filter($reports, function ($report) use ($role) {
            return in_array($role, $report['roles']);
        });
    }

    /**
     * Export transaction summary (placeholder)
     */
    private function exportTransactionSummary(Request $request, string $format)
    {
        // Implementation for CSV/PDF export
        return response()->json(['message' => 'Transaction summary export will be implemented']);
    }

    /**
     * Export farmer analytics (placeholder)
     */
    private function exportFarmerAnalytics(Request $request, string $format)
    {
        // Implementation for CSV/PDF export
        return response()->json(['message' => 'Farmer analytics export will be implemented']);
    }

    /**
     * Export payment reconciliation (placeholder)
     */
    private function exportPaymentReconciliation(Request $request, string $format)
    {
        // Implementation for CSV/PDF export
        return response()->json(['message' => 'Payment reconciliation export will be implemented']);
    }

    /**
     * Export depot performance (placeholder)
     */
    private function exportDepotPerformance(Request $request, string $format)
    {
        // Implementation for CSV/PDF export
        return response()->json(['message' => 'Depot performance export will be implemented']);
    }
}