<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductStatistic;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $category;
    private $product;

    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function home()
    {
        $categories = $this->category->all();
        $popularProducts = $this->product->getPopularProducts();
        $topSellingProducts = $this->product->getTopSellingProducts();

        return view('front.store.home', compact('categories', 'popularProducts', 'topSellingProducts'));
    }

    public function store()
    {
        return view('front.store.store');
    }

    public function wishlist()
    {
        return view('front.store.wishlist');
    }

    public function pageNotFound()
    {
        return view('front.store.404-error');
    }

    public function addViewProduct($idProduct)
    {
        $this->addPreviewProduct($idProduct);
    }


    public function addPreviewProduct($idProduct)
    {
        $product = $this->product->find($idProduct);

        $product->recordView();
    }
}
