<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'order_number',
        'total_amount',
        'total_discount',
        'status',
        'notes'
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('quantity', 'price');
    }

    function generateOrderNumber()
    {
        return random_int(10000000, 99999999);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOrders(string $search = null, string $status = null)
    {
        $orders = $this->with(['user'])
            ->where(function ($query) use ($search, $status) {
                if ($search) {
                    $query->where('order_number', 'LIKE', "%$search%")
                        ->orWhere('total_amount', 'LIKE', "%$search%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'LIKE', "%$search%");
                        });
                }

                if ($status) {
                    $query->where('status', $status);
                }
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return $orders;
    }
}
