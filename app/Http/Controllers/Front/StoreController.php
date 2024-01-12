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

    public function store(Request $request)
    {
        $categories = $this->category->nestedCategories();
        $perPage = $request->input('per_page', 32);
        $orderBy = $request->input('order_by', 'updated_at');

        $products = $this->product->allProductsWithFilters(
            $perPage,
            $orderBy
        );

        return view('front.store.store', compact('categories', 'products'));
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
