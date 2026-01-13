<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AdvancedReportService
{
    public function getTopSellingProducts(array $filters, int $limit = 20): Collection
    {
        $totals = DB::table('order_products')
            ->select('product_id')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->selectRaw('SUM(quantity * price) as total_revenue')
            ->join('orders', 'orders.id', '=', 'order_products.order_id')
            ->where('orders.status', 'completed')
            ->groupBy('product_id');

        $this->applyDateFilters($totals, $filters, 'orders.created_at');

        return Product::query()
            ->select('products.*', 'totals.total_quantity', 'totals.total_revenue')
            ->joinSub($totals, 'totals', 'products.id', '=', 'totals.product_id')
            ->with('category')
            ->where('products.status', 'ativo')
            ->orderByDesc('totals.total_quantity')
            ->limit($limit)
            ->get();
    }

    public function getLowStockProducts(int $threshold = 5): Collection
    {
        return Product::query()
            ->where('status', 'ativo')
            ->where(function ($query) use ($threshold) {
                $query->where('in_stock', false)
                    ->orWhere('quantity', '<=', $threshold);
            })
            ->orderBy('in_stock')
            ->orderBy('quantity')
            ->get();
    }

    public function getTopCustomers(array $filters, int $limit = 20): Collection
    {
        $totals = DB::table('orders')
            ->select('user_id')
            ->selectRaw('SUM(total_amount) as total_spent')
            ->selectRaw('COUNT(*) as total_orders')
            ->where('status', 'completed')
            ->whereNotNull('user_id')
            ->groupBy('user_id');

        $this->applyDateFilters($totals, $filters, 'orders.created_at');

        return User::query()
            ->select('users.*', 'totals.total_spent', 'totals.total_orders')
            ->joinSub($totals, 'totals', 'users.id', '=', 'totals.user_id')
            ->orderByDesc('totals.total_spent')
            ->limit($limit)
            ->get();
    }

    private function applyDateFilters($query, array $filters, string $column): void
    {
        if (!empty($filters['start_date'])) {
            $start = Carbon::parse($filters['start_date'])->startOfDay();
            $query->where($column, '>=', $start);
        }

        if (!empty($filters['end_date'])) {
            $end = Carbon::parse($filters['end_date'])->endOfDay();
            $query->where($column, '<=', $end);
        }
    }
}
