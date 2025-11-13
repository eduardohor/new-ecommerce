<?php

namespace App\Services;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class SalesReportService
{
    public function getPaginatedOrders(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        return $this->applyFilters(Order::with('user'), $filters)
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function getAllOrders(array $filters): Collection
    {
        return $this->applyFilters(Order::with('user'), $filters)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getSummary(array $filters): array
    {
        $query = $this->applyFilters(Order::query(), $filters);

        $totalOrders = (clone $query)->count();
        $totalRevenue = (clone $query)->sum('total_amount');
        $totalDiscount = (clone $query)->sum('total_discount');

        return [
            'total_orders' => $totalOrders,
            'total_revenue' => (float) $totalRevenue,
            'total_discount' => (float) $totalDiscount,
            'average_ticket' => $totalOrders > 0 ? (float) $totalRevenue / $totalOrders : 0.0,
        ];
    }

    private function applyFilters(Builder $query, array $filters): Builder
    {
        if (!empty($filters['start_date'])) {
            $start = Carbon::parse($filters['start_date'])->startOfDay();
            $query->where('created_at', '>=', $start);
        }

        if (!empty($filters['end_date'])) {
            $end = Carbon::parse($filters['end_date'])->endOfDay();
            $query->where('created_at', '<=', $end);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query;
    }
}
