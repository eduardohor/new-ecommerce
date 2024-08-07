<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Carbon\Carbon;
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
        return view('front.order.index');
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
                'status' => 'pending'
            ]);

            $order->payment()->create([
                'payment_type' => $validatedData['payment']['payment_method']['type'] ?? 'unknown',
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

            if ($statusPayment == 'completed') {
                $order->shipping()->create([
                    'address_id' => $shipping['address_id'],
                    'shipping_option' => $shipping['shipping_option'],
                    'shipping_company' => $shipping['shipping_company'],
                    'shipping_type' => $shipping['shipping_type'],
                    'shipping_price' => $shipping['shipping_price'],
                    'shipping_minimum_term' => $shipping['shipping_minimum_term'],
                    'shipping_deadline' => $shipping['shipping_deadline'],
                    'status' => 'pending'
                ]);
            }

            DB::commit();

            return response()->json(['message' => 'Pedido criado com sucesso!', 'order' => $order], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar pedido: ', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Erro ao criar pedido, tente novamente mais tarde.'], 500);
        }
    }

    public function detail($order_number)
    {
        $order = $this->order->where('order_number', $order_number)->with('products')->first();

        if (!$order) {
            return redirect()->route('home');
        }

        Carbon::setLocale('pt_BR');
        $formattedDate = Carbon::parse($order->created_at)->translatedFormat('d \d\e F \d\e Y');
        $order->formatted_created_at = $formattedDate;

        if ($order->payment->payment_type === 'credit_card') {
            $order->payment_type = 'Cartão de Crédito';
        }

        $subtotal = $order->products->reduce(function ($carry, $product) {
            return $carry + ($product->pivot->price * $product->pivot->quantity);
        }, 0);

        $total = $subtotal;

        return view('front.order.detail', compact('order', 'subtotal', 'total'));
    }
}
