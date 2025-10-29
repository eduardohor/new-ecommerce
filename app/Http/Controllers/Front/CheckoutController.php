<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Services\CouponService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use MercadoPago\MercadoPagoConfig;

class CheckoutController extends Controller
{
    protected $address;
    protected $cart;
    protected $mercadoPagoPublicKey;
    protected $couponService;

    public function __construct(Address $address, Cart $cart, CouponService $couponService)
    {
        $this->address = $address;
        $this->cart = $cart;
        $this->couponService = $couponService;
        $this->mercadoPagoPublicKey = config('mercadopago.public_key');

        MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));

        // Define o ambiente de execução
        $environment = config('mercadopago.environment') === 'LOCAL'
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

        $summary = $this->couponService->syncCouponWithCart($cart);
        $appliedCoupon = $summary['coupon'] ?? null;
        $discount = $summary['discount'] ?? 0;
        $finalSubtotal = max(($cart->total_amount ?? 0) - $discount, 0);

        return view('front.checkout.address', compact('addresses', 'cart', 'appliedCoupon', 'discount', 'finalSubtotal'));
    }

    public function processCheckout(Request $request): RedirectResponse
    {
        $shipping = $request->validate([
            'address_id' => 'required|integer',
            'shipping_option' => 'required|string',
            'shipping_company' => 'required|string',
            'shipping_type' => 'required|string',
            'shipping_price' => 'required|numeric',
            'shipping_minimum_term' => 'required|numeric',
            'shipping_deadline' => 'required|numeric',
            'is_pickup' => 'required|boolean',
            'pickup_address' => 'nullable|string|max:255',
            'pickup_hours' => 'nullable|string|max:255',
            'pickup_instructions' => 'nullable|string|max:500',
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

        $summary = $this->couponService->syncCouponWithCart($cart);
        $appliedCoupon = $summary['coupon'] ?? null;
        $discount = $summary['discount'] ?? 0;
        $finalSubtotal = max(($cart->total_amount ?? 0) - $discount, 0);

        return view('front.checkout.payment', compact('cart', 'mercadoPagoPublicKey', 'shipping', 'appliedCoupon', 'discount', 'finalSubtotal'));
    }

}
