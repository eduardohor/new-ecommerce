<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdvancedReportService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdvancedReportController extends Controller
{
    public function __construct(private AdvancedReportService $service)
    {
    }

    public function index(Request $request): View
    {
        $activeTab = $request->input('tab', 'top-selling');
        $filters = $request->only(['start_date', 'end_date']);
        $threshold = (int) $request->input('threshold', 5);
        $perPage = 15;

        $products = collect();
        $lowStockProducts = collect();
        $customers = collect();

        if ($activeTab === 'top-selling') {
            $products = $this->service->getTopSellingProducts($filters, $perPage);
        }

        if ($activeTab === 'low-stock') {
            $lowStockProducts = $this->service->getLowStockProducts($threshold, $perPage);
        }

        if ($activeTab === 'top-customers') {
            $customers = $this->service->getTopCustomers($filters, $perPage);
        }

        return view('admin.reports.advanced', compact(
            'activeTab',
            'filters',
            'threshold',
            'products',
            'lowStockProducts',
            'customers'
        ));
    }
}
