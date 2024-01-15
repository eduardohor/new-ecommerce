<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'status',
        'metatitle',
        'meta_description',
        'image',
        'date'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function nestedCategories()
    {
        return $this->with('children')->whereNull('parent_id')->get();
    }

    public function getCategories(string $search = null): LengthAwarePaginator
    {
        $categories = $this->where(function ($query) use ($search) {
            if ($search) {
                $query->where('name', 'LIKE', "%$search%");
            }
        })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return $categories;
    }

    public function productsWithFilters(int $perPage = 32, string $orderBy = "updated_at")
    {
        $products = $this->products()
            ->with(['statistics', 'productImages'])
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
