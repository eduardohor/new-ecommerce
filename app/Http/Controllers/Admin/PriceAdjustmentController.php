<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PriceAdjustmentController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.product.price-adjustment', compact('categories'));
    }

    public function preview(Request $request)
    {
        $validated = $request->validate([
            'scope' => 'required|in:all,category',
            'category_ids' => 'required_if:scope,category|array',
            'category_ids.*' => 'exists:categories,id',
            'adjustment_type' => 'required|in:increase,decrease',
            'percentage' => 'required|numeric|min:0.01|max:100',
        ]);

        $products = $this->getProducts($validated['scope'], $validated['category_ids'] ?? []);

        $percentage = $validated['percentage'];
        $isIncrease = $validated['adjustment_type'] === 'increase';

        $preview = $products->map(function ($product) use ($percentage, $isIncrease) {
            $multiplier = $isIncrease ? (1 + $percentage / 100) : (1 - $percentage / 100);

            return [
                'id' => $product->id,
                'title' => $product->title,
                'old_regular_price' => $product->regular_price,
                'new_regular_price' => $product->regular_price * $multiplier,
                'old_sale_price' => $product->sale_price,
                'new_sale_price' => $product->sale_price ? $product->sale_price * $multiplier : null,
            ];
        });

        return response()->json([
            'success' => true,
            'preview' => $preview,
            'total_products' => $preview->count(),
        ]);
    }

    public function apply(Request $request)
    {
        $validated = $request->validate([
            'scope' => 'required|in:all,category',
            'category_ids' => 'required_if:scope,category|array',
            'category_ids.*' => 'exists:categories,id',
            'adjustment_type' => 'required|in:increase,decrease',
            'percentage' => 'required|numeric|min:0.01|max:100',
        ]);

        $products = $this->getProducts($validated['scope'], $validated['category_ids'] ?? []);

        $percentage = $validated['percentage'];
        $isIncrease = $validated['adjustment_type'] === 'increase';
        $multiplier = $isIncrease ? (1 + $percentage / 100) : (1 - $percentage / 100);

        $updatedCount = 0;

        DB::transaction(function () use ($products, $multiplier, &$updatedCount) {
            foreach ($products as $product) {
                $product->regular_price = $product->regular_price * $multiplier;

                if ($product->sale_price) {
                    $product->sale_price = $product->sale_price * $multiplier;
                }

                $product->save();
                $updatedCount++;
            }
        });

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Reajuste aplicado com sucesso em {$updatedCount} produto(s)!",
                'updated_count' => $updatedCount,
            ]);
        }

        return redirect()
            ->route('products.price-adjustment.index')
            ->with('success', "Reajuste aplicado com sucesso em {$updatedCount} produto(s)!");
    }

    private function getProducts($scope, $categoryIds = [])
    {
        $query = Product::query();

        if ($scope === 'category' && !empty($categoryIds)) {
            $query->whereIn('category_id', $categoryIds);
        }

        return $query->get();
    }
}
