<?php

namespace App\Services;

use App\Models\Cart;

class CartService
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function checkCart($user, $newSessionToken): void
    {
        $cartSession = $this->cart->where(['unique_identifier' => $newSessionToken, 'status' => 'open'])->first();

        if ($cartSession) {
            $cartUser = $this->cart->where('user_id', $user->id)->first();

            if ($cartUser) {
                $this->mergeSessionCartWithUserCart($cartSession, $cartUser);
            } else {
                $cartSession->user_id = $user->id;
                $cartSession->save();
            }
        }
    }

    public function mergeSessionCartWithUserCart($cartSession, $cartUser): void
    {
        $cartUser->unique_identifier = $cartSession->unique_identifier;
        $cartUser->total_amount += $cartSession->total_amount;
        $cartUser->item_count += $cartSession->item_count;
        $cartUser->status = 'open';
        $cartUser->save();

        foreach ($cartSession->cartProducts as $cartProduct) {
            $cartProduct->cart_id = $cartUser->id;
            $cartProduct->save();
        }

        $cartSession->delete();
    }
}
