<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    protected $address;
    protected $cart;

    public function __construct(Address $address, Cart $cart)
    {
        $this->address = $address;
        $this->cart = $cart;

    }
    public function index(): View|RedirectResponse
    {
        $user = auth()->user();

        $addresses = $this->address->where('user_id', $user->id)->get();

        $cart = $this->cart->where(['user_id' => $user->id, 'status' => 'open'])->first();

        if (!$cart) {
            return redirect()->route('cart.show');
        }

        return view('front.checkout.index', compact('addresses', 'cart'));
    }
}
