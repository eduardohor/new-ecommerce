<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unique_identifier',
        'status',
        'total_amount',
        'item_count'
    ];

    public function cartProducts()
    {
        return $this->hasMany(CartProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_products');
    }
}
