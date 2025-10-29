<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Services\CouponService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class PaymentController extends Controller
{
    protected $cart;
    protected $order;
    protected $mercadoPagoPublicKey;
    protected $couponService;

    public function __construct(Cart $cart, Order $order, CouponService $couponService)
    {
        MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));

        // Define o ambiente de execução
        $environment = config('mercadopago.environment') === 'local'
            ? MercadoPagoConfig::LOCAL
            : MercadoPagoConfig::SERVER;

        MercadoPagoConfig::setRuntimeEnviroment($environment);

        $this->cart = $cart;
        $this->order = $order;
        $this->mercadoPagoPublicKey = config('mercadopago.public_key');
        $this->couponService = $couponService;
    }

    public function index(): View
    {
        return view('front.payment.index');
    }

    public function processPayment(Request $request)
    {
        try {
            if ($request->payment_method_id == 'pix') {
                $payment = $this->createPaymentPix($request->all());
            } else {
                $payment = $this->createPaymentCart($request->all());
            }

            Log::info('Payment Response: ' . json_encode($payment));
            return response()->json($payment);
        } catch (MPApiException $e) {
            Log::error('API Error: ', ['exception' => $e]);
            return response()->json([
                'status' => 'error',
                'message' => 'Erro na API'
            ], 500);
        } catch (\Exception $e) {
            Log::error('General Error: ', ['exception' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Erro inesperado'
            ], 500);
        }
    }



    public function createPaymentCart($dataPayment)
    {
        $client = new PaymentClient();
        $request_options = new RequestOptions();
        $request_options->setCustomHeaders(["X-Idempotency-Key: " . uniqid()]);

        $cart = $this->cart->find($dataPayment['cart_id']);
        if (!$cart) {
            throw new \RuntimeException('Carrinho não encontrado.');
        }
        $user = auth()->user();
        $shipping = session('shipping');
        $addressShipping = Address::find($shipping['address_id']);

        $items = [];

        foreach ($cart->cartProducts as $cartProduct) {
            $item = [
                "id" => $cartProduct->product->id,
                "title" => $cartProduct->product->title,
                "category_id" => $cartProduct->product->category->name,
                "quantity" => $cartProduct->quantity,
                "unit_price" => $cartProduct->price
            ];

            $items[] = $item;
        }

        $totals = $this->calculateTotals($cart, $shipping);

        try {
            $payment = $client->create([
                "transaction_amount" => (float) $totals['total'],
                "token" => $dataPayment['token'],
                "installments" => $dataPayment['installments'],
                "payment_method_id" => $dataPayment['payment_method_id'],
                "issuer_id" => $dataPayment['issuer_id'],
                "payer" => [
                    "email" => $dataPayment['payer']['email'],
                    "identification" => [
                        "type" => $dataPayment['payer']['identification']['type'],
                        "number" => $dataPayment['payer']['identification']['number']
                    ]
                ],
                "additional_info" => [
                    "items" => $items,
                    "payer" => [
                        "first_name" => $user->name,
                        "address" => [
                            "zip_code" => $addressShipping->zip_code,
                            "street_name" => $addressShipping->street,
                            "street_number" => $addressShipping->number
                        ]
                    ], "shipments" => [
                        "receiver_address" => [
                            "zip_code" => $addressShipping['zip_code'],
                            "state_name" => $addressShipping['state'],
                            "city_name" => $addressShipping['city'],
                            "street_name" => $addressShipping['street'],
                            "street_number" => $addressShipping['number']
                        ]
                    ]
                ]
            ], $request_options);

            return $payment;
        } catch (MPApiException $e) {
            Log::error('API Error: ', [
                'exception' => $e->getMessage(),
                'status_code' => $e->getCode()
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('General Error: ', [
                'exception' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function createPaymentPix($dataPayment)
    {
        $client = new PaymentClient();
        $request_options = new RequestOptions();
        $request_options->setCustomHeaders(["X-Idempotency-Key: " . uniqid()]);

        $cart = $this->cart->find($dataPayment['cart_id']);
        if (!$cart) {
            throw new \RuntimeException('Carrinho não encontrado.');
        }

        $shipping = session('shipping');
        $totals = $this->calculateTotals($cart, $shipping);

        try {
            $payment = $client->create([
                "transaction_amount" => (float) $totals['total'],
                "payment_method_id" => $dataPayment['payment_method_id'],
                "payer" => [
                    "email" => $dataPayment['payer']['email'],
                ]
            ], $request_options);

            return $payment;
        } catch (MPApiException $e) {
            Log::error('API Error', [
                'message'   => $e->getMessage(),
                'status'    => $e->getCode(),
                'response'  => $e->getApiResponse(),
                'request'   => $dataPayment,
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('General Error: ', [
                'exception' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function showPaymentSuccess($order_number)
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
        } elseif ($order->payment->payment_type === 'bank_transfer'){
            $order->payment_type = 'Pix';
        }

        $subtotal = $order->products->reduce(function ($carry, $product) {
            return $carry + ($product->pivot->price * $product->pivot->quantity);
        }, 0);

        $discount = max($order->coupon_discount ?? 0, 0);
        $itemsTotal = max($subtotal - $discount, 0);
        $shippingPrice = optional($order->shipping)->shipping_price ?? 0;
        $grandTotal = $order->total_amount ?? ($itemsTotal + $shippingPrice);

        $mercadoPagoPublicKey = $this->mercadoPagoPublicKey;

        return view('front.payment.success', compact(
            'order',
            'subtotal',
            'discount',
            'itemsTotal',
            'shippingPrice',
            'grandTotal',
            'mercadoPagoPublicKey'
        ));
    }

    public function showPaymentFailed($transaction_id)
    {
        $mercadoPagoPublicKey = $this->mercadoPagoPublicKey;

        return view('front.payment.failure', compact('transaction_id', 'mercadoPagoPublicKey'));
    }

    private function calculateTotals(Cart $cart, ?array $shipping): array
    {
        $summary = $this->couponService->syncCouponWithCart($cart);
        $discount = $summary['discount'] ?? 0;
        $subtotal = max($cart->total_amount ?? 0, 0);
        $shippingPrice = $shipping['shipping_price'] ?? 0;
        $total = max($subtotal - $discount, 0) + $shippingPrice;

        return [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'shipping' => $shippingPrice,
            'total' => $total,
        ];
    }
}
