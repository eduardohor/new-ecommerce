<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SalesReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class SalesReportController extends Controller
{
    public function __construct(private SalesReportService $service)
    {
    }

    public function index(Request $request): View
    {
        $filters = $request->only(['start_date', 'end_date', 'status']);

        $orders = $this->service->getPaginatedOrders($filters, 15);
        $summary = $this->service->getSummary($filters);
        $statusOptions = $this->statusOptions();

        return view('admin.reports.sales', compact('orders', 'summary', 'filters', 'statusOptions'));
    }

    public function exportExcel(Request $request)
    {
        $filters = $request->only(['start_date', 'end_date', 'status']);
        $orders = $this->service->getAllOrders($filters);

        if ($orders->isEmpty()) {
            return redirect()->back()->with('warning', 'Não há dados para exportar com os filtros selecionados.');
        }

        $filename = 'relatorio_vendas_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = ['Pedido', 'Cliente', 'Status', 'Valor Total', 'Desconto', 'Data'];
        $statusOptions = $this->statusOptions();

        $callback = function () use ($orders, $columns, $statusOptions) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, $columns, ';');

            foreach ($orders as $order) {
                $statusLabel = $statusOptions[$order->status] ?? ucfirst($order->status);
                fputcsv($handle, [
                    $order->order_number,
                    $order->user?->name ?? 'Cliente convidado',
                    $statusLabel,
                    number_format($order->total_amount, 2, ',', '.'),
                    number_format($order->total_discount ?? 0, 2, ',', '.'),
                    $order->created_at->format('d/m/Y H:i'),
                ], ';');
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $filters = $request->only(['start_date', 'end_date', 'status']);
        $orders = $this->service->getAllOrders($filters);

        if ($orders->isEmpty()) {
            return redirect()->back()->with('warning', 'Não há dados para exportar com os filtros selecionados.');
        }

        $summary = $this->service->getSummary($filters);
        $statusOptions = $this->statusOptions();

        $pdf = Pdf::loadView('admin.reports.sales_pdf', [
            'orders' => $orders,
            'summary' => $summary,
            'filters' => $filters,
            'statusOptions' => $statusOptions,
        ])->setPaper('a4', 'portrait');

        $filename = 'relatorio_vendas_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }

    private function statusOptions(): array
    {
        return [
            '' => 'Todos',
            'pending' => 'Pendente',
            'processing' => 'Processando',
            'completed' => 'Concluído',
            'cancelled' => 'Cancelado',
        ];
    }
}
