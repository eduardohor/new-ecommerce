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
        'contact_number'
    ];
}
