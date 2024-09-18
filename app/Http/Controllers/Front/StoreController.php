<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductStatistic;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    private $category;
    private $product;

    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function home(): View
    {
        $categories = $this->category->all()->take(10);
        $popularProducts = $this->product->getPopularProducts();
        $topSellingProducts = $this->product->getTopSellingProducts();

        return view('front.store.home', compact('categories', 'popularProducts', 'topSellingProducts'));
    }

    public function store(Request $request): View
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

    public function wishlist(): View
    {
        $user = auth()->user();

        $favorites = $user->favorites()->with('productImages')->get();

        return view('front.store.wishlist', compact('favorites'));
    }

    public function pageNotFound(): View
    {
        return view('front.store.404-error');
    }

    public function addViewProduct($idProduct): void
    {
        $this->addPreviewProduct($idProduct);
    }


    public function addPreviewProduct($idProduct): void
    {
        $product = $this->product->find($idProduct);

        $product->recordView();
    }

    public function email()
    {
        return view('emails.tracking-number');
    }
}
