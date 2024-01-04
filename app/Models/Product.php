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

    public function getProducts(string $search = null): LengthAwarePaginator
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
}
