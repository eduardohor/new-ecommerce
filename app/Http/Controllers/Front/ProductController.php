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
    public function show(string|int $id): View
    {
        if (!$product = $this->product->find($id)) {
            return redirect()->route('home');
        }

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
}
