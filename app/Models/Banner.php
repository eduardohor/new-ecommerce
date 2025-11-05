<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'image_path',
        'mobile_image',
        'link_url',
        'open_new_tab',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'open_new_tab' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeForPosition(Builder $query, string $position): Builder
    {
        return $query->where('position', $position);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : null;
    }

    public function getMobileImageUrlAttribute(): ?string
    {
        return $this->mobile_image
            ? asset('storage/' . $this->mobile_image)
            : null;
    }

    public function getLinkTargetAttribute(): string
    {
        return $this->open_new_tab ? '_blank' : '_self';
    }
}
