<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private $product;
    private $cart;
    private $cartProduct;


    public function __construct(Product $product, Cart $cart, CartProduct $cartProduct)
    {
        $this->product = $product;
        $this->cart = $cart;
        $this->cartProduct = $cartProduct;
    }
    public function index()
    {
        return view('front.cart.index');
    }

    public function postAddToCart(Request $request)
    {
        $user = Auth::user();
        $newSessionToken = session()->get('_token');
        $product = $this->product->find($request->product_id);
        $quantity = $request->quantity;
        $price = $product->regular_price;

        if ($product->sale_price > 0) {
            $price = $product->sale_price;
        }

        if ($user) {
            $cart = $this->cart->updateOrCreate(['user_id' => $user->id], [
                'status' => 'open'
            ]);
        } else {
            $cart = $this->cart->updateOrCreate(['unique_identifier' => $newSessionToken], [
                'status' => 'open'
            ]);
        }

        if ($cart->status == 'open') {
            $alreadyAddedProduct = $this->cartProduct->where(["product_id" => $product->id, 'cart_id' => $cart->id])->first();

            if ($alreadyAddedProduct) {
                $alreadyAddedProduct->quantity += $quantity;
                $alreadyAddedProduct->save();
            } else {
                $cartProduct = $this->cartProduct->create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price
                ]);
            }

            $this->updateCartTotalAmount($cart);

            $cart->item_count = $this->cartProduct->where('cart_id', $cart->id)->sum('quantity');
            $cart->save();
            return redirect()->route('cart.index');
        } else {
            return redirect()->route('home');
        }
    }

    private function updateCartTotalAmount($cart)
    {
        $cart->total_amount = $this->cartProduct->where('cart_id', $cart->id)
            ->sum(\DB::raw('quantity * price'));

        $cart->save();
    }
}
