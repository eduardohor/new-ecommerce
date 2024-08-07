<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use Illuminate\Console\View\Components\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class PaymentController extends Controller
{
    protected $cart;
    public function __construct(Cart $cart)
    {
        MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));

        // Define o ambiente de execução
        $environment = config('mercadopago.environment') === 'local'
            ? MercadoPagoConfig::LOCAL
            : MercadoPagoConfig::SERVER;

        MercadoPagoConfig::setRuntimeEnviroment($environment);

        $this->cart = $cart;
    }

    public function index(): View
    {
        return view('front.payment.index');
    }

    public function processPayment(Request $request)
    {
        if ($request->payment_method_id != 'pix') {
            try {
                $payment = $this->createPaymentCart($request->all());
                Log::info('Payment Response: ' . json_encode($payment));
                return response()->json($payment);
            } catch (MPApiException $e) {
                Log::error('API Error: ', ['exception' => $e]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Erro na API'
                ], 500);
            } catch (\Exception $e) {
                Log::error('General Error: ', ['exception' => $e]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Erro inesperado'
                ], 500);
            }
        }
    }


    public function createPaymentCart($dataPayment)
    {
        $client = new PaymentClient();
        $request_options = new RequestOptions();
        $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

        $cart = $this->cart->find($dataPayment['cart_id']);
        $user = auth()->user();
        $addressDefault = $user->addresses->where('is_default', 1)->first();
        $shipping = session('shipping');
        $addressShipping = Address::find($shipping['address_id']);

        $items = [];

        foreach ($cart->cartProducts as $cartProduct) {
            $item = [
                "id" => $cartProduct->product->id,
                "title" => $cartProduct->product->title,
                "category_id" => $cartProduct->product->category->name,
                "quantity" => $cartProduct->quantity,
                "unit_price" => $cartProduct->product->regular_price
            ];

            $items[] = $item;
        }

        try {
            $payment = $client->create([
                "transaction_amount" => (float) $dataPayment['transaction_amount'],
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
                            "zip_code" => $addressDefault->zip_code,
                            "street_name" => $addressDefault->street,
                            "street_number" => $addressDefault->number
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
            Log::error('API Error: ', ['exception' => $e, 'response' => $e->getResponse()]);
            throw $e;
        }
    }


    public function success()
    {
        return view('front.payment.success');
    }
}
