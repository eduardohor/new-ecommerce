<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'weight',
        'units',
        'description',
        'in_stock',
        'product_code',
        'sku',
        'status',
        'regular_price',
        'sale_price',
        'meta_title',
        'meta_description',
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function statistics()
    {
        return $this->hasOne(ProductStatistic::class);
    }

    public function getProducts(string $search = null)
    {
        $products = $this->with('category', 'productImages')
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('title', 'LIKE', "%$search%");
                }
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return $products;
    }

    public function recordView()
    {
        // Carrega ou cria a instância de ProductStatistic associada ao produto
        $statistics = $this->statistics()->firstOrCreate();

        // Incrementa as visualizações
        $statistics->increment('views');
    }


    public function recordSale()
    {
        // Lógica para contabilizar venda do produto
        $this->statistics()->increment('sales');
    }

    public function getPopularProducts()
    {
        $products = $this->with(['statistics', 'category', 'productImages'])
            ->where('status', 'ativo')
            ->take(10)
            ->get();

        // Ordenar os produtos com base nas visualizações
        $products = $products->sortByDesc(function ($product) {
            return $product->statistics ? $product->statistics->views : 0;
        });

        return $products;
    }

    public function getTopSellingProducts()
    {
        $products = $this->with(['statistics', 'category', 'productImages'])
            ->where('status', 'ativo')
            ->take(3)
            ->get();

        // Ordenar os produtos com base nas vendas
        $products = $products->sortByDesc(function ($product) {
            return $product->statistics ? $product->statistics->sales : 0;
        });

        return $products;
    }

    public function allProductsWithFilters(int $perPage = 32, string $orderBy = "updated_at")
    {
        $orderDirection = '';

        $products = $this->with(['statistics', 'category', 'productImages'])
            ->where('status', 'ativo');

        switch ($orderBy) {
            case 'highlighted':
                // Ordenar os produtos com base nas visualizações
                $products = $products->leftJoin('product_statistics', 'products.id', '=', 'product_statistics.product_id')
                    ->orderByDesc('product_statistics.views')
                    ->select('products.*');
                break;

            case 'low_to_high':
                $orderBy = 'regular_price';
                $orderDirection = 'asc';
                $products->orderBy($orderBy, $orderDirection);
                break;

            case 'high_to_low':
                $orderBy = 'regular_price';
                $orderDirection = 'desc';
                $products->orderBy($orderBy, $orderDirection);
                break;

            case 'release_date':
                $orderBy = 'updated_at';
                $orderDirection = 'desc';
                $products->orderBy($orderBy, $orderDirection);
                break;

            default:
                // Ordenar os produtos com base nas visualizações
                $products = $products->leftJoin('product_statistics', 'products.id', '=', 'product_statistics.product_id')
                    ->orderByDesc('product_statistics.views')
                    ->select('products.*');
                break;
        }

        $products = $products->paginate($perPage);

        return $products;
    }
}
