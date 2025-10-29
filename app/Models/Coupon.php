<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'max_uses',
        'used_count',
        'is_active',
        'starts_at',
        'ends_at',
        'min_order_value',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'value' => 'decimal:2',
        'min_order_value' => 'decimal:2',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function isCurrentlyValid(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = Carbon::now();

        if ($this->starts_at && $now->lt($this->starts_at)) {
            return false;
        }

        if ($this->ends_at && $now->gt($this->ends_at)) {
            return false;
        }

        if (!is_null($this->max_uses) && $this->used_count >= $this->max_uses) {
            return false;
        }

        return true;
    }

    public function remainingUses(): ?int
    {
        if (is_null($this->max_uses)) {
            return null;
        }

        return max($this->max_uses - $this->used_count, 0);
    }

    public function hasUnlimitedUses(): bool
    {
        return is_null($this->max_uses);
    }

    public function calculateDiscount(float $subtotal): float
    {
        if ($subtotal <= 0) {
            return 0.0;
        }

        if ($this->type === 'fixed') {
            return round(min($this->value, $subtotal), 2);
        }

        return round($subtotal * ($this->value / 100), 2);
    }
}
