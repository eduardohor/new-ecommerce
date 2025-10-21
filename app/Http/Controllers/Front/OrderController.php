<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Jobs\OrderSuccessEmailJob;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $order;
    protected $cart;

    public function __construct(Order $order, Cart $cart)
    {
        $this->order = $order;
        $this->cart = $cart;
    }

    public function index(): View
    {
        $userId = auth()->user()->id;
        $orders = $this->order->where('user_id', $userId)->orderByDesc('created_at')->get();

        return view('front.order.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'payment' => 'required',
            'total_amount' => 'required',
            'cart_id' => 'required',
        ]);

        $user = auth()->user();
        $shipping = session('shipping');
        $cart = $this->cart->find($validatedData['cart_id']);

        $status = $validatedData['payment']['status'];
        $statusPayment = '';
        $statusOrder = 'pending';

        if ($validatedData['payment']['status'] == 'approved') {
            $statusOrder = 'processing';
        }

        switch ($status) {
            case 'approved':
                $statusPayment = 'completed';
                break;
            case 'pending':
                $statusPayment = 'pending';
                break;
            case 'pending':
                $statusPayment = 'pending';
                break;

            default:
                $statusPayment = 'pending';
                break;
        }

        $orderNumber = $this->order->generateOrderNumber();

        DB::beginTransaction();
        try {

            $order = $this->order->create([
                'user_id' => $user->id,
                'address_id' => $shipping['address_id'],
                'order_number' => $orderNumber,
                'total_amount' => $validatedData['total_amount'],
                'total_discount' => $validatedData['total_discount'] ?? 0,
                'status' => $statusOrder
            ]);

            $order->payment()->create([
                'payment_type' => $validatedData['payment']['payment_type_id'] ?? 'unknown',
                'transaction_id' => $validatedData['payment']['id'],
                'amount' => $validatedData['total_amount'],
                'status' => $statusPayment,
                'installments' => $validatedData['payment']['installments'] ?? 'unknown',
                'payment_method' => $validatedData['payment']['payment_method']['id'] ?? 'unknown'
            ]);

            foreach ($cart->cartProducts as $cartProduct) {
                $order->products()->attach($cartProduct->product->id, [
                    'quantity' => $cartProduct->quantity,
                    'price' => $cartProduct->price
                ]);
            }

            $order->shipping()->create([
                'address_id' => $shipping['address_id'],
                'shipping_option' => $shipping['shipping_option'],
                'shipping_company' => $shipping['shipping_company'],
                'shipping_type' => $shipping['shipping_type'],
                'shipping_price' => $shipping['shipping_price'],
                'shipping_minimum_term' => $shipping['shipping_minimum_term'],
                'shipping_deadline' => $shipping['shipping_deadline'],
                'pickup_address' => $shipping['pickup_address'] ?? null,
                'pickup_hours' => $shipping['pickup_hours'] ?? null,
                'pickup_instructions' => $shipping['pickup_instructions'] ?? null,
                'status' => 'pending'
            ]);

            $cart->cartProducts()->delete();

            $cart->delete();

            DB::commit();

            OrderSuccessEmailJob::dispatch($user->email, $order->order_number)->onQueue('default');

            return response()->json(['message' => 'Pedido criado com sucesso!', 'order' => $order, 'payment' => $order->payment], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar pedido: ', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Erro ao criar pedido, tente novamente mais tarde.'], 500);
        }
    }

    public function show($order_number)
    {
        $order = $this->order->where('order_number', $order_number)->first();

        if (!$order) {
            return redirect()->route('orders.index.customers');
        }

        return view('front.order.show', compact('order'));
    }
}
