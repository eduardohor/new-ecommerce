<?php

namespace App\Http\Composers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartComposer
{
  private $cart;

  public function __construct(Cart $cart)
  {
    $this->cart = $cart;
  }

  public function compose(View $view)
  {
    $user = Auth::user();
    $newSessionToken = session()->get('_token');

    $cartProvider = $this->cart->where('unique_identifier', $newSessionToken)->first();

    if ($user) {
      $cartProvider = $this->cart->where('user_id', $user->id)->first();
    }

    $view->with('cartProvider', $cartProvider);
  }
}
