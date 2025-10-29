<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\StoreInfo;
use App\Models\User;
use App\Services\CouponService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CartController extends Controller
{
    private $product;
    private $cart;
    private $cartProduct;
    private $storeInfo;
    private $couponService;

    public function __construct(
        Product $product,
        Cart $cart,
        CartProduct $cartProduct,
        StoreInfo $storeInfo,
        CouponService $couponService
    )
    {
        $this->product = $product;
        $this->cart = $cart;
        $this->cartProduct = $cartProduct;
        $this->storeInfo = $storeInfo;
        $this->couponService = $couponService;
    }

    public function show(): View
    {
        $user = Auth::user();

        $cart = $this->getCart($user);

        $summary = [
            'coupon' => null,
            'discount' => 0.0,
        ];

        if ($cart) {
            foreach ($cart->cartProducts as $cartProduct) {
                $product = $cartProduct->product;
                $currentPrice = $product->hasActiveSale() ? $product->sale_price : $product->regular_price;

                if ($cartProduct->price != $currentPrice) {
                    $cartProduct->price = $currentPrice;
                    $cartProduct->save();
                }
            }

            $this->updateCartTotalAmount($cart);
            $summary = $this->couponService->syncCouponWithCart($cart);
        }

        $discount = $summary['discount'] ?? 0;
        $appliedCoupon = $summary['coupon'] ?? null;
        $cartTotal = $cart?->total_amount ?? 0;
        $finalSubtotal = max($cartTotal - $discount, 0);

        return view('front.cart.show', compact('cart', 'appliedCoupon', 'discount', 'finalSubtotal'));
    }

    public function addProductToCart(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'product_id' => ['required', 'integer', 'exists:products,id'],
                'quantity' => ['required', 'integer', 'min:1'],
            ]);

            DB::beginTransaction();

            $user = Auth::user();
            $product = $this->product->find($validated['product_id']);
            $quantity = (int) $validated['quantity'];
            // Verifica se a oferta está ativa antes de aplicar o preço promocional
            $price = $product->hasActiveSale() ? $product->sale_price : $product->regular_price;

            $cart = $this->getOrCreateCart($user);

            $this->updateCart($cart, $product, $quantity, $price);

            DB::commit();
        } catch (\Exception  $error) {
            DB::rollBack();

            Log::error('Erro ao adicionar produto ao carrinho:', [
                'message' => $error->getMessage(),
                'type' => get_class($error),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
                'trace' => $error->getTrace(),
            ]);

            return redirect()->back()->with('error', 'Erro ao adicionar produto ao carrinho.');
        }
        return redirect()->route('cart.show');
    }

    public function deleteProductToCart(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'product_id' => ['required', 'integer', 'exists:products,id'],
                'quantity' => ['required_without:remove_all', 'nullable', 'integer', 'min:1'],
                'remove_all' => ['nullable', 'boolean'],
            ]);

            DB::beginTransaction();

            $user = Auth::user();
            $product = $this->product->find($validated['product_id']);
            $quantity = isset($validated['quantity']) ? (int) $validated['quantity'] : null;
            $price = $product->sale_price > 0 ? $product->sale_price : $product->regular_price;
            $removeAll = $request->boolean('remove_all', false);

            $cart = $this->getCart($user);
            $cartProduct = $this->getCartProduct($cart, $product);

            $this->handleProductRemoval($cart, $cartProduct, $quantity, $removeAll);

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao remover produto do carrinho:', [
                'message' => $error->getMessage(),
                'type' => get_class($error),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
                'trace' => $error->getTrace(),
            ]);

            return redirect()->back()->with('error', 'Erro ao remover produto do carrinho.');
        }

        return redirect()->route('cart.show');
    }

    private function getCart(?User $user = null): ?Cart
    {
        $newSessionToken = session()->get('_token');
        return $user
            ? $this->cart->where(['user_id' => $user->id, 'status' => 'open'])->first()
            : $this->cart->where(['unique_identifier' => $newSessionToken, 'status' => 'open'])->first();
    }

    private function getOrCreateCart(?User $user): Cart
    {
        return $user
            ? $this->cart->updateOrCreate(['user_id' => $user->id], ['status' => 'open'])
            : $this->cart->updateOrCreate(['unique_identifier' => session()->get('_token')], ['status' => 'open']);
    }

    private function updateCart(Cart $cart, Product $product, int $quantity, float $price): void
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

    private function getCartProduct(Cart $cart, Product $product): ?CartProduct
    {
        return $this->cartProduct->where(["product_id" => $product->id, 'cart_id' => $cart->id])->first();
    }

    private function handleProductRemoval(Cart $cart, ?CartProduct $cartProduct, int $quantity = null, bool $removeAll = null): void
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

    private function updateCartTotalAmount(Cart $cart): void
    {
        $cart->total_amount = $this->cartProduct->where('cart_id', $cart->id)
            ->sum(DB::raw('quantity * price'));

        $cart->save();
        $this->couponService->syncCouponWithCart($cart);
    }
}
