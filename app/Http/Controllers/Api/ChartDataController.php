<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartDataController extends Controller
{
    public function adminChartData()
    {
        // Return chart data for admin dashboard
        return response()->json([
            'transactionTrends' => [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                'data' => [12, 19, 3, 5, 2, 3]
            ],
            'paymentStats' => [65, 25, 10]
        ]);
    }
}
