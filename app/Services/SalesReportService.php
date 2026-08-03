<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class SalesReportService
{
    public function salesByMonth(?int $year = null): \Illuminate\Support\Collection
    {
        $year ??= now()->year;

        return Order::where('status', 'paid')
            ->whereYear('created_at', $year)
            ->select(
                DB::raw('strftime("%m", created_at) as month'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total) as total_sales')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    public function salesByClient(): \Illuminate\Support\Collection
    {
        return Order::where('status', 'paid')
            ->with('user:id,name,email')
            ->select(
                'user_id',
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total) as total_sales')
            )
            ->groupBy('user_id')
            ->orderByDesc('total_sales')
            ->get();
    }
}
