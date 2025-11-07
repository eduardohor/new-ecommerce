<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\StatusUpdateEmailJob;
use App\Jobs\TrackingNumberEmailJob;
use App\Models\Order;
use App\Models\StoreInfo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function index(Request $request): View
    {
        $orders = $this->order->getOrders($request->get('search', ''), $request->get('status', ''));

        return view('admin.order.index', compact('orders'));
    }

    public function show($order_number): View
    {
        $order = $this->order->where('order_number', $order_number)->first();
        return view('admin.order.show', compact('order'));
    }

    public function updateStatus(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required',
            'order_id' => 'required',
        ]);

        $order = $this->order->findOrFail($validatedData['order_id']);

        if (!$order) {
            return redirect()->route('orders.index');
        }

        $order->update(['status' => $validatedData['status']]);

        $emailUser = $order->user->email;

        StatusUpdateEmailJob::dispatch($emailUser, $order->id)->onQueue('default');

        return redirect()
            ->route('orders.show', $order->order_number)
            ->with('success', 'Status do Pedido atualizado com sucesso!');
    }

    public function updateNotes(Request $request)
    {
        $validatedData = $request->validate([
            'notes' => 'required',
            'order_id' => 'required',
        ]);

        $order = $this->order->findOrFail($validatedData['order_id']);

        if (!$order) {
            return redirect()->route('orders.index');
        }

        $order->update(['notes' => $validatedData['notes']]);

        return redirect()
            ->route('orders.show', $order->order_number)
            ->with('success', 'Anotações do Pedido atualizadas com sucesso!');
    }

    public function downloadInvoice($order_number)
    {
        $order = $this->order->where('order_number', $order_number)->first();

        $pdf = Pdf::loadView('admin.order.invoice', compact('order'));

        return $pdf->download('fatura_' . $order_number . ".pdf");
    }

    public function downloadShippingLabel($order_number)
    {
        $order = $this->order->where('order_number', $order_number)->first();
        $storeInfo = StoreInfo::first();

        // Define o tamanho A5 (metade de A4) para etiqueta
        $pdf = Pdf::loadView('admin.order.shipping-label', compact('order', 'storeInfo'))
            ->setPaper('a5', 'landscape'); // A5 paisagem (21x14.8cm)

        return $pdf->download('etiqueta_' . $order_number . ".pdf");
    }

    public function addTrackingCode(Request $request)
    {
        $validatedData = $request->validate([
            'tracking_number' => 'required',
            'order_id' => 'required',
        ]);

        $order = $this->order->findOrFail($validatedData['order_id']);

        if (!$order) {
            return redirect()->route('orders.index');
        }

        $order->shipping->update([
            'tracking_number' => $validatedData['tracking_number'],
            'status' => 'shipped',
        ]);

        $emailUser = $order->user->email;

        TrackingNumberEmailJob::dispatch($emailUser, $order->order_number)->onQueue('default');

        return redirect()
            ->route('orders.show', $order->order_number)
            ->with('success', 'Código de rastreio adicionado com sucesso!');
    }
}
