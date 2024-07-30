<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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

    public function index(Request $request): View
    {
        $products = $this->product->getProducts($request->get('search', ''));

        return view('admin.product.index', compact('products'));
    }

    public function create(): View
    {
        $categories = $this->category->nestedCategories();

        return view('admin.product.create', compact('categories'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->all();

            $images = $request->file('images');

            $path = [];

            foreach ($images as $image) {
                $path[] = $image->store('products', 'public');
            }

            $product = $this->product->create([
                'title' => $data['title'],
                'category_id' => $data['category_id'],
                'weight' => $data['weight'],
                'quantity' => $data['quantity'],
                'width' => $data['width'],
                'height' => $data['height'],
                'length' => $data['length'],
                'description' => $data['description'],
                'in_stock' => $data['in_stock'],
                'product_code' => $data['product_code'],
                'sku' => $data['sku'],
                'slug' => $data['slug'],
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

            DB::commit();

            return redirect()->route('products.index')->with('status', 'product-created');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao criar produto:', [
                'message' => $error->getMessage(),
                'type' => get_class($error),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
                'trace' => $error->getTrace(),
            ]);

            return redirect()->route('products.index')->with('error', 'Erro ao criar produto. Por favor, tente novamente.');
        }
    }


    public function edit(string|int $id): View
    {
        $product = $this->findProductOrFail($id);
        $allCategories = $this->category->nestedCategories();

        $product->regular_price_formatted = number_format($product->regular_price / 100, 2, ',', '.');

        return view('admin.product.edit', compact('product', 'allCategories'));
    }

    public function update(ProductRequest $request, string|int $id): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $product = $this->findProductOrFail($id);

            $data = $request->all();

            if ($request->has('images')) {
                $images = $request->file('images');
                $path = [];

                foreach ($images as $image) {
                    $path[] = $image->store('products', 'public');
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
                'quantity' => $data['quantity'],
                'width' => $data['width'],
                'height' => $data['height'],
                'length' => $data['length'],
                'description' => $data['description'],
                'in_stock' => $data['in_stock'],
                'product_code' => $data['product_code'],
                'sku' => $data['sku'],
                'slug' => $data['slug'],
                'status' => $data['status'],
                'regular_price' => $data['regular_price'],
                'sale_price' => $data['sale_price'],
                'meta_title' => $data['meta_title'],
                'meta_description' => $data['meta_description']
            ]);

            DB::commit();

            return redirect()->route('products.index')->with('status', 'product-updated');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao editar produto:', [
                'message' => $error->getMessage(),
                'type' => get_class($error),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
                'trace' => $error->getTrace(),
            ]);

            return redirect()->route('products.index')->with('error', 'Erro ao editar produto. Por favor, tente novamente.');
        }
    }

    public function destroy(string|int $id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $product = $this->findProductOrFail($id);

            $productImages = $product->productImages;

            foreach ($productImages as $productImage) {
                Storage::delete($productImage->image_path);
            }

            $productImage->delete();

            $product->delete();

            DB::commit();

            return redirect()->route('products.index')->with('status', 'product-deleted');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao excluir produto:', [
                'message' => $error->getMessage(),
                'type' => get_class($error),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
                'trace' => $error->getTrace(),
            ]);

            return redirect()->route('products.index')->with('error', 'Erro ao excluir produto. Por favor, tente novamente.');
        }
    }

    private function findProductOrFail(string|int $id): Model
    {
        try {
            return $this->product->with('category', 'productImages')->findOrFail($id);
        } catch (ModelNotFoundException $error) {
            $errorMessage = 'Produto não encontrado. Detalhes: ' . $error->getMessage();
            Log::error($errorMessage);

            $redirectResponse = redirect()->route('products.index')->with('error', 'Produto não encontrado');
            $redirectResponse->send();  // Encerra a execução imediatamente
        }
    }
}
