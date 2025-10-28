<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
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
        $categories = $this->category
            ->newQuery()
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->latest()
            ->take(10)
            ->get();

        $heroBanners = Banner::active()
            ->forPosition('home.hero')
            ->orderBy('sort_order')
            ->get();

        $featuredBanners = Banner::active()
            ->forPosition('home.featured')
            ->orderBy('sort_order')
            ->take(2)
            ->get();

        $dealBanner = Banner::active()
            ->forPosition('home.deal')
            ->orderBy('sort_order')
            ->first();

        $popularProducts = $this->product->getPopularProducts();
        $topSellingProducts = $this->product->getTopSellingProducts();

        return view('front.store.home', compact('categories', 'heroBanners', 'featuredBanners', 'dealBanner', 'popularProducts', 'topSellingProducts'));
    }

    public function store(Request $request): View
    {
        $categories = $this->category->nestedCategories();
        $perPage = $request->integer('per_page');
        $perPage = $perPage && $perPage > 0 ? $perPage : 32;

        $orderBy = $request->input('order_by', 'updated_at');
        $allowedOrderings = ['highlighted', 'low_to_high', 'high_to_low', 'release_date', 'updated_at'];
        if (!in_array($orderBy, $allowedOrderings, true)) {
            $orderBy = 'updated_at';
        }

        $products = $this->product->allProductsWithFilters(
            $perPage,
            $orderBy
        );

        $sidebarBanner = Banner::active()
            ->forPosition('store.sidebar')
            ->orderBy('sort_order')
            ->first();

        return view('front.store.store', compact('categories', 'products', 'sidebarBanner'));
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
