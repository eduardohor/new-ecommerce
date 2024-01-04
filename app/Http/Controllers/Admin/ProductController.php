<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $product;
    private $category;
    private $productImage;


    public function __construct(Product $product, Category $category, ProductImage $productImage)
    {
        $this->product = $product;
        $this->category = $category;
        $this->productImage = $productImage;
    }

    public function index(Request $request)
    {
        $products = $this->product->getProducts($request->get('search', ''));

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->category->nestedCategories();

        return view('admin.product.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $images = $request->file('images');

        $path = [];

        foreach ($images as $image) {
            $path[] = $image->store('products');
        }

        $product = $this->product->create([
            'title' => $data['title'],
            'category_id' => $data['category_id'],
            'weight' => $data['weight'],
            'units' => $data['units'],
            'description' => $data['description'],
            'in_stock' => $data['in_stock'],
            'product_code' => $data['product_code'],
            'sku' => $data['sku'],
            'status' => $data['status'],
            'regular_price' => $data['regular_price'],
            'sale_price' => $data['sale_price'],
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description']
        ]);

        foreach ($path as $imagePath) {
            $this->productImage->create([
                'product_id' => $product->id,
                'image_path' => $imagePath
            ]);
        }

        return redirect()->route('products.index')->with('status', 'product-created');
    }


    public function edit($id)
    {
        $product = $this->findPoductOrFail($id);
        $allCategories = $this->category->nestedCategories();

        $product->regular_price_formatted = number_format($product->regular_price / 100, 2, ',', '.');

        return view('admin.product.edit', compact('product', 'allCategories'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = $this->findPoductOrFail($id);

        $data = $request->all();

        if ($request->has('images')) {
            $images = $request->file('images');
            $path = [];

            foreach ($images as $image) {
                $path[] = $image->store('products');
            }

            foreach ($path as $imagePath) {
                $this->productImage->create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath
                ]);
            }
        }

        $product->update([
            'title' => $data['title'],
            'category_id' => $data['category_id'],
            'weight' => $data['weight'],
            'units' => $data['units'],
            'description' => $data['description'],
            'in_stock' => $data['in_stock'],
            'product_code' => $data['product_code'],
            'sku' => $data['sku'],
            'status' => $data['status'],
            'regular_price' => $data['regular_price'],
            'sale_price' => $data['sale_price'],
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description']
        ]);

        if (!$product->wasChanged()) {
            return redirect()->route('products.index')->with('warning', 'Nenhuma alteração detectada no produto');
        }

        return redirect()->route('products.index')->with('status', 'product-updated');
    }

    private function findPoductOrFail(string|int $id): Model
    {
        try {
            return $this->product->with('category', 'productImages')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $redirectResponse = redirect()->route('products.index')->with('error', 'Produto não encontrado');
            $redirectResponse->send();  // Encerra a execução imediatamente
        }
    }
}
