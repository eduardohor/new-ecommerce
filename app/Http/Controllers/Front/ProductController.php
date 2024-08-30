<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function show(string $slug): View
    {
        $product = $this->product->where('slug', $slug)->firstOrFail();


        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(5)
            ->get();

        if (isset($relatedProducts)) {
            $relatedProducts = Product::inRandomOrder()
                ->where('id', '!=', $product->id)
                ->take(5)
                ->get();
        }


        return view('front.product.show', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (strlen($query) >= 3) {
            $products = $this->product->with('productImages')
                ->where('title', 'like', "%{$query}%")
                ->get();

            return response()->json($products);
        }

        return response()->json([]);
    }
}
