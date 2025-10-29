<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;

class CouponService
{
    public function getAppliedCoupon(): ?Coupon
    {
        $data = Session::get('coupon');

        if (!$data || !isset($data['id'])) {
            return null;
        }

        return Coupon::find($data['id']);
    }

    public function applyCoupon(Coupon $coupon): void
    {
        Session::put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
        ]);
    }

    public function removeAppliedCoupon(): void
    {
        Session::forget('coupon');
    }

    public function calculateDiscount(Coupon $coupon, float $subtotal): float
    {
        return $coupon->calculateDiscount($subtotal);
    }

    public function validateForCart(Coupon $coupon, float $subtotal): array
    {
        if (!$coupon->is_active) {
            return ['valid' => false, 'message' => 'Este cupom está inativo.'];
        }

        $now = now();

        if ($coupon->starts_at && $now->lt($coupon->starts_at)) {
            return ['valid' => false, 'message' => 'Este cupom ainda não está disponível.'];
        }

        if ($coupon->ends_at && $now->gt($coupon->ends_at)) {
            return ['valid' => false, 'message' => 'Este cupom expirou.'];
        }

        if (!is_null($coupon->max_uses) && $coupon->used_count >= $coupon->max_uses) {
            return ['valid' => false, 'message' => 'Este cupom já atingiu o limite de usos.'];
        }

        if ($subtotal <= 0) {
            return ['valid' => false, 'message' => 'Não há itens elegíveis no carrinho.'];
        }

        if (!is_null($coupon->min_order_value) && $subtotal < $coupon->min_order_value) {
            return ['valid' => false, 'message' => 'Valor mínimo para uso do cupom não atingido.'];
        }

        return ['valid' => true];
    }

    /**
     * Sincroniza o cupom aplicado com o estado atual do carrinho e retorna os dados.
     *
     * @return array{coupon:Coupon|null, discount:float}
     */
    public function syncCouponWithCart(?Cart $cart): array
    {
        $result = ['coupon' => null, 'discount' => 0.0];

        $coupon = $this->getAppliedCoupon();

        if (!$cart || !$coupon) {
            if (!$cart) {
                $this->removeAppliedCoupon();
            }
            return $result;
        }

        $subtotal = max($cart->total_amount ?? 0, 0);

        $validation = $this->validateForCart($coupon, $subtotal);

        if (!$validation['valid']) {
            $this->removeAppliedCoupon();
            Session::flash('coupon_warning', $validation['message'] ?? 'Cupom indisponível.');
            return $result;
        }

        $discount = $this->calculateDiscount($coupon, $subtotal);

        if ($discount <= 0) {
            $this->removeAppliedCoupon();
            return $result;
        }

        $result['coupon'] = $coupon;
        $result['discount'] = $discount;

        return $result;
    }
}
