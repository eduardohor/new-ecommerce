<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function productImage()
    {
        return $this->hasMany(Product::class);
    }
}
