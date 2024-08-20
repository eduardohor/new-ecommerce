<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Svg\Tag\Rect;

class DashboardController extends Controller
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $year = $request->input('year', date('Y'));
            $monthlyRevenues = $this->order->getMonthlyRevenueByYear($year);

            $revenues = array_fill(1, 12, 0);
            foreach ($monthlyRevenues as $data) {
                $revenues[$data->month] = $data->revenue;
            }

            return response()->json([
                'revenues' => $revenues,
                'selectedYear' => $year,
            ]);
        }

        $statistics = $this->order->getStatistics();
        $years = $this->order->getYearsWithOrders();

        if ($years->isEmpty()) {
            $years->push(date('Y'));
        }

        $year = $request->input('year', $years->first());

        $monthlyRevenues = $this->order->getMonthlyRevenueByYear($year);

        $revenues = array_fill(1, 12, 0);
        foreach ($monthlyRevenues as $data) {
            $revenues[$data->month] = $data->revenue;
        }

        return view('admin.dashboard.index',  [
            'statistics' => $statistics,
            'revenues' => $revenues,
            'selectedYear' => $year,
            'years' => $years,
        ]);
    }
}
