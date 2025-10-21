<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'address',
        'zip_code',
        'city',
        'state',
        'email',
        'contact_number',
        'pickup_address',
        'pickup_hours',
        'pickup_instructions',
        'cnpj',
        'facebook_url',
        'x_url',
        'instagram_url'
    ];
}
