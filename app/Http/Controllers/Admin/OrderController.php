<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\StatusUpdateEmailJob;
use App\Jobs\TrackingNumberEmailJob;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\StoreInfo;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public function create($customerId)
    {
        $customer = User::find($customerId);

        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Cliente não encontrado.');
        }

        $addresses = $customer->addresses()->orderByDesc('updated_at')->get();
        $products = Product::where('status', 'ativo')->orderBy('title')->get();

        return view('admin.order.create', compact('customer', 'addresses', 'products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'address_id' => 'required|exists:addresses,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_type' => 'required|in:credit_card,bank_transfer,manual',
            'payment_status' => 'required|in:pending,completed,failed',
            'notes' => 'nullable|string',
        ]);

        $customer = User::find($validatedData['customer_id']);

        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Cliente não encontrado.');
        }

        $address = Address::where('id', $validatedData['address_id'])
            ->where('user_id', $customer->id)
            ->first();

        if (!$address) {
            return redirect()->back()->withInput()->with('error', 'Endereço inválido para o cliente.');
        }

        $normalizedItems = [];
        foreach ($validatedData['items'] as $item) {
            $productId = (int) $item['product_id'];
            $quantity = (int) $item['quantity'];

            if ($productId <= 0 || $quantity <= 0) {
                continue;
            }

            if (!isset($normalizedItems[$productId])) {
                $normalizedItems[$productId] = 0;
            }
            $normalizedItems[$productId] += $quantity;
        }

        if (empty($normalizedItems)) {
            return redirect()->back()->withInput()->with('error', 'Informe ao menos um produto válido.');
        }

        $products = Product::whereIn('id', array_keys($normalizedItems))->get()->keyBy('id');

        if ($products->count() !== count($normalizedItems)) {
            return redirect()->back()->withInput()->with('error', 'Um ou mais produtos não foram encontrados.');
        }

        $subtotal = 0;

        foreach ($normalizedItems as $productId => $quantity) {
            $product = $products->get($productId);
            $price = $product->getFinalPrice();
            $subtotal += $price * $quantity;
        }

        $shippingPrice = 0;
        $totalAmount = $subtotal;
        $orderNumber = $this->order->generateOrderNumber();

        DB::beginTransaction();
        try {
            $order = $this->order->create([
                'user_id' => $customer->id,
                'address_id' => $address->id,
                'order_number' => $orderNumber,
                'total_amount' => $totalAmount,
                'total_discount' => 0,
                'coupon_code' => null,
                'coupon_discount' => 0,
                'status' => 'pending',
                'notes' => $validatedData['notes'] ?? null,
            ]);

            foreach ($normalizedItems as $productId => $quantity) {
                $product = $products->get($productId);
                $order->products()->attach($productId, [
                    'quantity' => $quantity,
                    'price' => $product->getFinalPrice(),
                ]);
            }

            $order->payment()->create([
                'payment_type' => $validatedData['payment_type'],
                'transaction_id' => 'admin-' . $orderNumber,
                'amount' => $totalAmount,
                'status' => $validatedData['payment_status'],
                'installments' => null,
                'payment_method' => $validatedData['payment_type'],
            ]);

            $order->shipping()->create([
                'address_id' => $address->id,
                'shipping_option' => 'pickup',
                'shipping_company' => 'Retirada',
                'shipping_type' => 'Retirada',
                'shipping_price' => $shippingPrice,
                'shipping_minimum_term' => '0',
                'shipping_deadline' => '0',
                'status' => 'pending',
            ]);

            DB::commit();

            return redirect()
                ->route('orders.show', $order->order_number)
                ->with('success', 'Pedido criado com sucesso!');
        } catch (\Exception $error) {
            DB::rollBack();
            Log::error('Erro ao criar pedido manual:', [
                'message' => $error->getMessage(),
            ]);

            return redirect()->back()->withInput()->with('error', 'Erro ao criar pedido. Tente novamente.');
        }
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
