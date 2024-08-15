<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\StoreInfo;
use App\Services\ShippingService;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    protected $shippingService;
    protected $cart;
    protected $storeInfo;

    public function __construct(ShippingService $shippingService, Cart $cart, StoreInfo $storeInfo)
    {
        $this->shippingService = $shippingService;
        $this->cart = $cart;
        $this->storeInfo = $storeInfo;
    }

    public function calculateShipping(Request $request)
    {
        $data = $request->validate([
            'cep' => 'required',
            'cart_id' => 'required',
        ]);

        $cart = $this->cart->find($request->cart_id);
        $storeInfo = $this->storeInfo->first();

        $postalCodeFrom = $storeInfo ? $storeInfo->zip_code : '96020360';
        $postalCodeTo = $data['cep'];

        $products = $cart->cartProducts->map(function ($cartProduct) {
            return [
                'id' => $cartProduct->product_id,
                'width' => $cartProduct->product->width,
                'height' => $cartProduct->product->height,
                'length' => $cartProduct->product->length,
                'weight' => $cartProduct->product->weight,
                'quantity' => $cartProduct->quantity,
            ];
        })->toArray();

        try {
            $response = $this->shippingService->calculateShipping($postalCodeFrom, $postalCodeTo, $products);
            return response()->json(['data' => $response]);
        } catch (\Exception $e) {
            return response()->json(['erro' => $e->getMessage()]);
        }
    }
}
