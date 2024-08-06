<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'address_id',
        'shipping_option',
        'shipping_company',
        'shipping_type',
        'shipping_price',
        'shipping_minimum_term',
        'shipping_deadline',
        'tracking_number',
        'status'
    ];
}
