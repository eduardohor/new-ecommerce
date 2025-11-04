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
        'instagram_url',
        'free_shipping_enabled',
        'free_shipping_type',
        'free_shipping_minimum_value',
        'free_shipping_minimum_order'
    ];

    protected $casts = [
        'free_shipping_enabled' => 'boolean',
        'free_shipping_minimum_value' => 'decimal:2',
        'free_shipping_minimum_order' => 'decimal:2',
    ];

    /**
     * Relacionamento com faixas de CEP para frete grátis
     */
    public function freeShippingZipRanges()
    {
        return $this->hasMany(FreeShippingZipRange::class);
    }

    /**
     * Verifica se o frete grátis está habilitado
     */
    public function hasFreeShippingEnabled(): bool
    {
        return $this->free_shipping_enabled === true;
    }

    /**
     * Verifica se está usando regra de faixa de CEP
     */
    public function usesZipRangeRule(): bool
    {
        return in_array($this->free_shipping_type, ['zip_range', 'both']);
    }

    /**
     * Verifica se está usando regra de valor mínimo
     */
    public function usesMinimumValueRule(): bool
    {
        return in_array($this->free_shipping_type, ['minimum_value', 'both']);
    }
}
