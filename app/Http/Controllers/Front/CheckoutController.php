<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Resources\Preference;
use MercadoPago\Resources\Preference\Item;

class CheckoutController extends Controller
{
    protected $address;
    protected $cart;
    protected $mercadoPagoPublicKey;

    public function __construct(Address $address, Cart $cart)
    {
        $this->address = $address;
        $this->cart = $cart;
        $this->mercadoPagoPublicKey = config('mercadopago.public_key');

        MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));

        // Define o ambiente de execução
        $environment = config('mercadopago.environment') === 'local'
            ? MercadoPagoConfig::LOCAL
            : MercadoPagoConfig::SERVER;

        MercadoPagoConfig::setRuntimeEnviroment($environment);
    }
    public function address(): View|RedirectResponse
    {
        $user = auth()->user();

        $addresses = $this->address->where('user_id', $user->id)->orderByDesc('created_at')->get();

        $cart = $this->cart->where(['user_id' => $user->id, 'status' => 'open'])->first();

        if (!$cart) {
            return redirect()->route('cart.show');
        }

        return view('front.checkout.address', compact('addresses', 'cart'));
    }

    public function processCheckout(Request $request): RedirectResponse
    {
        $shipping = $request->validate([
            'address_id' => 'required|integer',
            'shipping_option' => 'required|numeric',
            'shipping_company' => 'required|string',
            'shipping_type' => 'required|string',
            'shipping_price' => 'required|numeric',
            'shipping_minimum_term' => 'required|numeric',
            'shipping_deadline' => 'required|numeric',
        ]);

        session()->put('shipping', $shipping);

        return redirect()->route('checkout.payment');
    }

    public function showPaymentPage(): View|RedirectResponse
    {
        $user = auth()->user();

        $mercadoPagoPublicKey = $this->mercadoPagoPublicKey;

        $cart = $this->cart->where(['user_id' => $user->id, 'status' => 'open'])->first();

        $shipping = session('shipping');

        if (!$cart || !$shipping) {
            return redirect()->route('checkout.address');
        }

        return view('front.checkout.payment', compact('cart', 'mercadoPagoPublicKey', 'shipping'));
    }

}
