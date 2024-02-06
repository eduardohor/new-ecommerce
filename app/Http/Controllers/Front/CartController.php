<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\User;
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

    public function __construct(Product $product, Cart $cart, CartProduct $cartProduct)
    {
        $this->product = $product;
        $this->cart = $cart;
        $this->cartProduct = $cartProduct;
    }

    public function show(): View
    {
        $user = Auth::user();

        $cart = $this->getCart($user);

        return view('front.cart.show', compact('cart'));
    }

    public function addProductToCart(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $product = $this->product->find($request->product_id);
            $quantity = $request->quantity;
            $price = $product->sale_price > 0 ? $product->sale_price : $product->regular_price;

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
            DB::beginTransaction();

            $user = Auth::user();
            $product = $this->product->find($request->product_id);
            $quantity = $request->quantity;
            $price = $product->sale_price > 0 ? $product->sale_price : $product->regular_price;
            $removeAll = $request->remove_all;

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
    }

    public function calculateShipping(Request $request)
    {
        $data = $request->all();

        $baseUrl = 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/calculate';

        $tokenMelhorEnvio = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NTYiLCJqdGkiOiI5NTIwZWU3ZmU1MzZjOGU4ZmJiZDFjYWRlNjU0MTcwMjE5NDg1ZTkzMWFjNjgzMTkxZWU5Yzk3OTc3MDZhOWQ1NDhlMGQ2N2IwZDYwNzg3NSIsImlhdCI6MTcwNjU1ODEyMS4zMzQ2NDgsIm5iZiI6MTcwNjU1ODEyMS4zMzQ2NTEsImV4cCI6MTczODE4MDUyMS4zMjEyMjIsInN1YiI6IjliMzVlNWY1LWVkMjgtNDI1NC1iY2MxLTRkYzcwYjVkOWEwOSIsInNjb3BlcyI6WyJzaGlwcGluZy1jYWxjdWxhdGUiXX0.ZKKSzIotR7vScSX-SMuxZPcqdvd1pkeq8ATu90LvL_uyMKeaf9YTqfysDdlBJgWEfLVu9Sw6TJRHfHdoRuQeQWUMyxyOTCW8rQuu6H7vnew5wGP_MBQuWB-jVfqOFJQ-Zd2dNzK-i_wMHz4WiiTcnJ_ITBsaeg-iCiZ_HNpEeKxtV4fF91POpmMZApFUVlaoZhbfdZMJJ06xL08QhG0J62y0fIJcNSrMcOomnM90Kp8zfTuXIAVI-5cmy5WN6mTE3VrzZPFgyC82ehQ7l0pAnLOd7BkZACNAUunhTbg7tHgohveCa8hLLTkKNkKio5iIBq2JV_mzVCuIvONEduE3Gi0WjxEfaKYiCyYZp1Dw6N8kP-NoEgcetLOjUGQ2KzDEoxVdCkDqCLQZT8UWwvHR2_3236HvDr1OkPNJBSloI_BdI09fl4Jk227daCTlx3dLCRyMhrMkYQ7uzheL5_cyckhQYOWPGK613M6yGc0M4uA2JELRves3WN7QADyTbBPJlT96EW7WhoH2-TJhydulZmJ3VedqlBDG72HLSkdXfgOeT7KbGCwKmmVIYRMxbdDh-E1G5RZlk9OF8I7Bbr_9eDgVnao1qjKkfgPbI9zIziXULX7Y7sWj8Fv_XIw_9RUqESo9UX-hpoPfaKdYRldZPEnhSo9itoeCFFH2PSxI5Hk";

        $cart = $this->cart->find($request->cart_id);

        $products = [];

        foreach ($cart->cartProducts as $cartProduct) {
            $product = [
                'id' => $cartProduct->product_id,
                'width' => $cartProduct->product->width,
                'height' => $cartProduct->product->height,
                'length' => $cartProduct->product->length,
                'weight' => $cartProduct->product->weight,
                'quantity' => $cartProduct->quantity,
            ];

            $products[] = $product;
        }

        $body = [
            'from' => [
                'postal_code' => '96020360',
            ],
            'to' => [
                'postal_code' => $data['cep'],
            ],
            'products' => $products,

            "services" =>  "1,2"
        ];

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => "Bearer $tokenMelhorEnvio",
                'Content-Type' => 'application/json'
            ])->withOptions([
                'verify' => false,
            ])->post($baseUrl, $body)->json();

            return response()->json(['data' => $response]);
        } catch (\Exception $e) {
            Log::error('Erro ao calcular envio Melhor Envio: ' . $e->getMessage());

            return response()->json(['erro' => 'Erro ao calcular envio.' . $e->getMessage()]);
        }
    }
}
