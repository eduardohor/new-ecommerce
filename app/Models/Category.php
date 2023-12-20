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

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
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
}
