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
                'sale_end_date' => $data['sale_end_date'] ?? null,
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
                'sale_end_date' => $data['sale_end_date'] ?? null,
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

    public function destroyImage(Request $request, Product $product, ProductImage $image)
    {
        if ($image->product_id !== $product->id) {
            return response()->json(['message' => 'Imagem não encontrada para este produto.'], 404);
        }

        try {
            if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }

            $image->delete();

            return response()->json(['message' => 'Imagem removida com sucesso.']);
        } catch (\Exception $error) {
            Log::error('Erro ao remover imagem do produto:', [
                'product_id' => $product->id,
                'image_id' => $image->id,
                'message' => $error->getMessage(),
            ]);

            return response()->json(['message' => 'Erro ao remover a imagem do produto.'], 500);
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

    public function duplicate(string|int $id): RedirectResponse
    {
        $originalProduct = $this->findProductOrFail($id);

        try {
            DB::beginTransaction();

            $newProductData = $originalProduct->replicate([
                'slug',
            ])->toArray();

            $newProductData['title'] = $originalProduct->title . ' (Cópia)';
            $newProductData['slug'] = $this->generateUniqueSlug($originalProduct->slug);
            $newProductData['status'] = 'desabilitado';
            $newProductData['product_code'] = $originalProduct->product_code
                ? $originalProduct->product_code . '-copy'
                : null;
            $newProductData['sku'] = $originalProduct->sku
                ? $originalProduct->sku . '-copy'
                : null;

            $newProduct = $this->product->create($newProductData);

            foreach ($originalProduct->productImages as $productImage) {
                if (!$productImage->image_path) {
                    continue;
                }

                $newImagePath = $this->duplicateImageFile($productImage->image_path);

                $this->productImage->create([
                    'product_id' => $newProduct->id,
                    'image_path' => $newImagePath,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('products.index')
                ->with('success', 'Produto duplicado com sucesso! Atualize as informações antes de publicar.');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao duplicar produto:', [
                'product_id' => $originalProduct->id,
                'message' => $error->getMessage(),
                'type' => get_class($error),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
            ]);

            return redirect()
                ->route('products.index')
                ->with('error', 'Erro ao duplicar produto. Por favor, tente novamente.');
        }
    }

    protected function generateUniqueSlug(string $baseSlug): string
    {
        $slug = $baseSlug . '-copia';
        $counter = 1;

        while ($this->product->where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-copia-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected function duplicateImageFile(string $originalPath): string
    {
        $storage = Storage::disk('public');

        if (!$storage->exists($originalPath)) {
            throw new \RuntimeException("Arquivo de imagem original não encontrado: {$originalPath}");
        }

        $extension = pathinfo($originalPath, PATHINFO_EXTENSION);
        $newPath = 'products/' . uniqid('product_', true) . '.' . $extension;

        $storage->copy($originalPath, $newPath);

        return $newPath;
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
