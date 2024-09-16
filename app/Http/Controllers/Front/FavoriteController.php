<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function add($productId)
    {
        $user = Auth::user();

        if (!$user->favorites()->where('product_id', $productId)->exists()) {
            $user->favorites()->attach($productId);
        }

        return response()->json(['success' => true]);
    }

    public function remove($productId)
    {
        $user = Auth::user();

        $user->favorites()->detach($productId);

        return response()->json(['success' => true]);
    }
}
