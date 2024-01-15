<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function categoryProducts(Request $request, $slug)
    {
        $perPage = $request->input('per_page', 32);
        $orderBy = $request->input('order_by', 'updated_at');

        $category = $this->category->where('slug', $slug)->firstOrFail();
        $nestedCategories = $this->category->nestedCategories();
        $products = $category->productsWithFilters($perPage, $orderBy);

        return view('front.category.index', compact('category', 'nestedCategories', 'products'));
    }
}
