<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $data = $this->getOrderData($year);

        return view('admin.dashboard.index', $data);
    }

    public function getRevenues(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $data = $this->getOrderData($year);

        return response()->json($data);
    }

    private function getOrderData($year)
    {
        $statistics = $this->order->getStatistics();
        $years = $this->order->getYearsWithOrders();

        $monthlyRevenues = $this->order->getMonthlyRevenueByYear($year);
        $revenues = array_fill(1, 12, 0);
        foreach ($monthlyRevenues as $data) {
            $revenues[$data->month] = $data->revenue;
        }

        $orders = $this->order->limit(5)->orderByDesc('created_at')->get();

        $orderStats = $this->order->select('status', DB::raw('COUNT(*) as quantity'), DB::raw('SUM(total_amount) as total_value'))
            ->whereYear('created_at', $year)
            ->groupBy('status')
            ->get();

        $orderValues = $this->initializeOrderValues();
        $orderQuantities = $this->initializeOrderValues();

        foreach ($orderStats as $stat) {
            $this->updateOrderStats($stat, $orderValues, $orderQuantities);
        }

        return [
            'statistics' => $statistics,
            'revenues' => $revenues,
            'selectedYear' => $year,
            'years' => $years,
            'orders' => $orders,
            'orderValues' => $orderValues,
            'orderQuantities' => $orderQuantities,
        ];
    }

    private function initializeOrderValues()
    {
        return [
            'Pedidos Pendentes' => 0,
            'Pedidos Processando' => 0,
            'Pedidos Completos' => 0,
            'Pedidos Cancelados' => 0,
        ];
    }

    private function updateOrderStats($stat, &$orderValues, &$orderQuantities)
    {
        $statusMap = [
            'pending' => 'Pedidos Pendentes',
            'processing' => 'Pedidos Pendentes',
            'completed' => 'Pedidos Completos',
            'cancelled' => 'Pedidos Cancelados',
        ];

        $status = $statusMap[$stat->status] ?? null;

        if ($status) {
            $orderValues[$status] += $stat->total_value;
            $orderQuantities[$status] += $stat->quantity;
        }
    }
}
