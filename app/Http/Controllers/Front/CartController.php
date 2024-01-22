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
        $user = Auth::user();

        $cart = $this->getCart($user);

        return view('front.cart.index', compact('cart'));
    }

    public function addProductToCart(Request $request)
    {
        $user = Auth::user();
        $product = $this->product->find($request->product_id);
        $quantity = $request->quantity;
        $price = $product->sale_price > 0 ? $product->sale_price : $product->regular_price;

        $cart = $this->getOrCreateCart($user);

        $this->updateCart($cart, $product, $quantity, $price);

        return redirect()->route('cart.index');
    }

    public function deleteProductToCart(Request $request)
    {
        $user = Auth::user();
        $product = $this->product->find($request->product_id);
        $quantity = $request->quantity;
        $price = $product->sale_price > 0 ? $product->sale_price : $product->regular_price;
        $removeAll = $request->remove_all;

        $cart = $this->getCart($user);
        $cartProduct = $this->getCartProduct($cart, $product);

        $this->handleProductRemoval($cart, $cartProduct, $quantity, $removeAll);

        return redirect()->route('cart.index');
    }

    private function getCart($user = null)
    {
        $newSessionToken = session()->get('_token');
        return $user
            ? $this->cart->where(['user_id' => $user->id, 'status' => 'open'])->first()
            : $this->cart->where(['unique_identifier' => $newSessionToken, 'status' => 'open'])->first();
    }

    private function getOrCreateCart($user)
    {
        return $user
            ? $this->cart->updateOrCreate(['user_id' => $user->id], ['status' => 'open'])
            : $this->cart->updateOrCreate(['unique_identifier' => session()->get('_token')], ['status' => 'open']);
    }

    private function updateCart($cart, $product, $quantity, $price)
    {
        if ($cart->status == 'open') {
            $alreadyAddedProduct = $this->cartProduct->where(["product_id" => $product->id, 'cart_id' => $cart->id])->first();

            if ($alreadyAddedProduct) {
                $alreadyAddedProduct->quantity += $quantity;
                $alreadyAddedProduct->save();
            } else {
                $this->cartProduct->create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price
                ]);
            }

            $this->updateCartTotalAmount($cart);

            $cart->item_count = $this->cartProduct->where('cart_id', $cart->id)->sum('quantity');
            $cart->save();
        }
    }

    private function getCartProduct($cart, $product)
    {
        return $this->cartProduct->where(["product_id" => $product->id, 'cart_id' => $cart->id])->first();
    }

    private function handleProductRemoval($cart, $cartProduct, $quantity, $removeAll)
    {
        if ($removeAll) {
            $cart->item_count -= $cartProduct->quantity;
            $cartProduct->delete();
        } else {
            $cartProduct->quantity -= $quantity;
            $cartProduct->save();
            $cart->item_count -= $quantity;

            if ($cartProduct->quantity <= 0) {
                $cartProduct->delete();
            }
        }

        $this->updateCartTotalAmount($cart);

        if ($cart->item_count <= 0) {
            $cart->status = 'closed';
            $cart->save();
        }
    }

    private function updateCartTotalAmount($cart)
    {
        $cart->total_amount = $this->cartProduct->where('cart_id', $cart->id)
            ->sum(\DB::raw('quantity * price'));

        $cart->save();
    }
}
