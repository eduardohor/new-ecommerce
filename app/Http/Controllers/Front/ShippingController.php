<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\StoreInfo;
use App\Services\ShippingService;
use App\Services\FreeShippingService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ShippingController extends Controller
{
    protected $shippingService;
    protected $freeShippingService;
    protected $cart;
    protected $storeInfo;

    public function __construct(
        ShippingService $shippingService,
        FreeShippingService $freeShippingService,
        Cart $cart,
        StoreInfo $storeInfo
    ) {
        $this->shippingService = $shippingService;
        $this->freeShippingService = $freeShippingService;
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
        } catch (\Exception $e) {
            report($e);
            $response = [];
        }

        $options = collect($response ?? [])->filter(function ($option) {
            return !Arr::has($option, 'error');
        })->map(function ($option) {
            $company = data_get($option, 'company.name', 'Entrega');
            $service = data_get($option, 'name', 'Convencional');
            $identifier = data_get($option, 'id');

            if (!$identifier) {
                $identifier = Str::slug($company . '-' . $service . '-' . Str::random(6), '_');
            }

            $option['identifier'] = (string) $identifier;

            return $option;
        })->values();

        if ($storeInfo) {
            $pickupAddress = $storeInfo->pickup_address ?: $storeInfo->address;
            $pickupHours = $storeInfo->pickup_hours;
            $pickupInstructions = $storeInfo->pickup_instructions;

            $options->push([
                'identifier' => 'pickup',
                'company' => [
                    'name' => $storeInfo->name ?? 'Retirada na loja',
                    'picture' => null,
                ],
                'name' => 'Retirada na loja',
                'custom_price' => 0,
                'delivery_range' => [
                    'min' => 0,
                    'max' => 0,
                ],
                'is_pickup' => true,
                'pickup_address' => $pickupAddress,
                'pickup_hours' => $pickupHours,
                'pickup_instructions' => $pickupInstructions,
            ]);
        }

        if ($this->freeShippingService->isFreeShippingEnabled()) {
            $cartTotal = $cart->cartProducts->sum(function ($cartProduct) {
                $product = $cartProduct->product;
                $price = $product->hasActiveSale() ? $product->sale_price : $product->regular_price;
                return $price * $cartProduct->quantity;
            });

            if ($this->freeShippingService->shouldApplyFreeShipping($postalCodeTo, $cartTotal)) {
                $shippingOptions = $options->filter(function ($option) {
                    return !data_get($option, 'is_pickup', false);
                });

                $pickupOptions = $options->filter(function ($option) {
                    return data_get($option, 'is_pickup', false);
                });

                if ($shippingOptions->isNotEmpty()) {
                    $fastestOption = $shippingOptions->sortBy(function ($option) {
                        return data_get($option, 'delivery_range.min', 999);
                    })->first();

                    $fastestOption['original_company'] = data_get($fastestOption, 'company.name', 'Transportadora');
                    $fastestOption['original_type'] = data_get($fastestOption, 'name', 'Convencional');
                    $fastestOption['original_price'] = data_get($fastestOption, 'custom_price', data_get($fastestOption, 'price', 0));

                    $fastestOption['company'] = [
                        'name' => 'Frete Grátis',
                        'picture' => null,
                    ];
                    $fastestOption['name'] = 'Frete Grátis';
                    $fastestOption['custom_price'] = 0;
                    $fastestOption['is_free_shipping'] = true;
                    $fastestOption['free_shipping_badge'] = 'FRETE GRÁTIS';

                    $options = collect([$fastestOption])->merge($pickupOptions);
                } else {
                    $options = $pickupOptions;
                }
            } else {
                $amountToFreeShipping = $this->freeShippingService->calculateAmountToFreeShipping($cartTotal);

                if ($amountToFreeShipping !== null) {
                    $options = $options->map(function ($option) use ($amountToFreeShipping) {
                        if (!data_get($option, 'is_pickup', false)) {
                            $option['amount_to_free_shipping'] = $amountToFreeShipping;
                        }
                        return $option;
                    });
                }
            }
        }

        return response()->json(['data' => $options]);
    }
}
