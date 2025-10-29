<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Services\CouponService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function __construct(
        private readonly Cart $cart,
        private readonly CouponService $couponService
    ) {
    }

    public function apply(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string', 'max:50'],
        ]);

        $code = strtoupper(trim($request->input('code')));

        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return back()->withInput($request->only('code'))->with('coupon_error', 'Cupom não encontrado.');
        }

        $cart = $this->getCurrentCart();

        if (!$cart || $cart->cartProducts()->count() === 0) {
            return back()->withInput($request->only('code'))->with('coupon_error', 'Adicione itens ao carrinho antes de aplicar um cupom.');
        }

        $subtotal = max($cart->total_amount ?? 0, 0);

        $validation = $this->couponService->validateForCart($coupon, $subtotal);

        if (!$validation['valid']) {
            return back()->withInput($request->only('code'))->with('coupon_error', $validation['message'] ?? 'Cupom inválido.');
        }

        $discount = $this->couponService->calculateDiscount($coupon, $subtotal);

        if ($discount <= 0) {
            return back()->withInput($request->only('code'))->with('coupon_error', 'Não foi possível aplicar este cupom.');
        }

        $this->couponService->applyCoupon($coupon);

        return back()->with('coupon_success', 'Cupom aplicado com sucesso!');
    }

    public function remove(): RedirectResponse
    {
        $this->couponService->removeAppliedCoupon();

        return back()->with('coupon_success', 'Cupom removido.');
    }

    private function getCurrentCart(): ?Cart
    {
        $user = Auth::user();
        $token = session()->get('_token');

        if ($user) {
            return $this->cart->where(['user_id' => $user->id, 'status' => 'open'])->first();
        }

        return $this->cart->where(['unique_identifier' => $token, 'status' => 'open'])->first();
    }
}
