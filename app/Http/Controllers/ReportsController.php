<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\Farmer;
use App\Models\Payment;
use App\Models\GrainType;
use App\Models\Depot;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display reports dashboard
     */
    public function index(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
        $depotId = $request->get('depot_id');
        $grainTypeId = $request->get('grain_type_id');

        $reports = [
            'summary' => $this->getSummaryReport($startDate, $endDate, $depotId, $grainTypeId),
            'charts' => $this->getChartData($startDate, $endDate, $depotId, $grainTypeId),
            'top_farmers' => $this->getTopFarmers($startDate, $endDate, $depotId),
            'grain_type_performance' => $this->getGrainTypePerformance($startDate, $endDate, $depotId),
            'depot_performance' => $this->getDepotPerformance($startDate, $endDate),
            'payment_status' => $this->getPaymentStatusDistribution($startDate, $endDate, $depotId)
        ];

        $filters = [
            'depots' => Depot::active()->get(),
            'grain_types' => GrainType::active()->get(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'depot_id' => $depotId,
            'grain_type_id' => $grainTypeId
        ];

        return view('reports.index', compact('reports', 'filters'));
    }

    /**
     * Generate PDF report
     */
    public function export(Request $request, $type = 'pdf')
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
        $depotId = $request->get('depot_id');
        $grainTypeId = $request->get('grain_type_id');

        $reports = [
            'summary' => $this->getSummaryReport($startDate, $endDate, $depotId, $grainTypeId),
            'details' => $this->getDetailedReport($startDate, $endDate, $depotId, $grainTypeId),
            'period' => ['start' => $startDate, 'end' => $endDate]
        ];

        // For now, return JSON - PDF generation can be added later
        return response()->json($reports);
    }

    private function getSummaryReport($startDate, $endDate, $depotId = null, $grainTypeId = null)
    {
        $query = Transaction::whereBetween('created_at', [$startDate, $endDate]);

        if ($depotId) {
            $query->where('depot_id', $depotId);
        }

        if ($grainTypeId) {
            $query->where('grain_type_id', $grainTypeId);
        }

        $transactions = $query->get();

        return [
            'total_transactions' => $transactions->count(),
            'total_weight' => $transactions->sum('weight_kg'),
            'total_amount' => $transactions->sum('total_amount'),
            'paid_amount' => $transactions->where('status', 'paid')->sum('total_amount'),
            'pending_amount' => $transactions->whereIn('status', ['pending', 'approved'])->sum('total_amount'),
            'total_farmers' => $transactions->pluck('farmer_id')->unique()->count(),
            'avg_transaction_value' => $transactions->avg('total_amount') ?? 0,
            'paid_percentage' => $transactions->count() > 0 ?
                ($transactions->where('status', 'paid')->count() / $transactions->count()) * 100 : 0
        ];
    }

    private function getChartData($startDate, $endDate, $depotId = null, $grainTypeId = null)
    {
        $query = Transaction::selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(total_amount) as amount')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date');

        if ($depotId) {
            $query->where('depot_id', $depotId);
        }

        if ($grainTypeId) {
            $query->where('grain_type_id', $grainTypeId);
        }

        $dailyData = $query->get();

        return [
            'daily_transactions' => $dailyData,
            'status_distribution' => $this->getStatusDistribution($startDate, $endDate, $depotId, $grainTypeId),
            'grain_type_distribution' => $this->getGrainTypeDistribution($startDate, $endDate, $depotId, $grainTypeId)
        ];
    }

    private function getStatusDistribution($startDate, $endDate, $depotId = null, $grainTypeId = null)
    {
        $query = Transaction::selectRaw('status, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($depotId) {
            $query->where('depot_id', $depotId);
        }

        if ($grainTypeId) {
            $query->where('grain_type_id', $grainTypeId);
        }

        return $query->groupBy('status')->get();
    }

    private function getGrainTypeDistribution($startDate, $endDate, $depotId = null, $grainTypeId = null)
    {
        $query = Transaction::with('grainType')
            ->selectRaw('grain_type_id, COUNT(*) as count, SUM(weight_kg) as weight, SUM(total_amount) as amount')
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($depotId) {
            $query->where('depot_id', $depotId);
        }

        if ($grainTypeId) {
            $query->where('grain_type_id', $grainTypeId);
        }

        return $query->groupBy('grain_type_id')->get();
    }

    private function getTopFarmers($startDate, $endDate, $depotId = null)
    {
        $query = Transaction::with('farmer')
            ->selectRaw('farmer_id, COUNT(*) as transaction_count, SUM(weight_kg) as total_weight, SUM(total_amount) as total_amount')
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($depotId) {
            $query->where('depot_id', $depotId);
        }

        return $query->groupBy('farmer_id')
            ->orderBy('total_amount', 'desc')
            ->limit(10)
            ->get();
    }

    private function getGrainTypePerformance($startDate, $endDate, $depotId = null)
    {
        $query = Transaction::with('grainType')
            ->selectRaw('grain_type_id, COUNT(*) as transaction_count, SUM(weight_kg) as total_weight, SUM(total_amount) as total_amount')
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($depotId) {
            $query->where('depot_id', $depotId);
        }

        return $query->groupBy('grain_type_id')
            ->orderBy('total_weight', 'desc')
            ->get();
    }

    private function getDepotPerformance($startDate, $endDate)
    {
        return Transaction::with('depot')
            ->selectRaw('depot_id, COUNT(*) as transaction_count, SUM(weight_kg) as total_weight, SUM(total_amount) as total_amount')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('depot_id')
            ->orderBy('total_amount', 'desc')
            ->get();
    }

    private function getPaymentStatusDistribution($startDate, $endDate, $depotId = null)
    {
        $query = Payment::selectRaw('status, COUNT(*) as count, SUM(amount) as amount')
            ->whereHas('transaction', function($q) use ($startDate, $endDate, $depotId) {
                $q->whereBetween('created_at', [$startDate, $endDate]);
                if ($depotId) {
                    $q->where('depot_id', $depotId);
                }
            });

        return $query->groupBy('status')->get();
    }

    private function getDetailedReport($startDate, $endDate, $depotId = null, $grainTypeId = null)
    {
        return Transaction::with(['farmer', 'grainType', 'depot', 'creator'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($depotId, fn($q) => $q->where('depot_id', $depotId))
            ->when($grainTypeId, fn($q) => $q->where('grain_type_id', $grainTypeId))
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
