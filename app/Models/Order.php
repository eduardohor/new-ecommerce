<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getStatistics()
    {
        $today = Carbon::today();
        $twoDaysAgo = Carbon::now()->subDays(2);
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfYear = Carbon::now()->startOfYear();

        $totalEarningsYear = $this->where('created_at', '>=', $startOfYear)
            ->sum('total_amount');

        $totalOrders = $this->count();

        $totalOrdersToday = $this->whereDate('created_at', $today)->count();

        $totalCustomers = User::count();

        $totalCustomersLastTwoDays = User::where('created_at', '>=', $twoDaysAgo)->count();

        return [
            'total_earnings_year' => $totalEarningsYear,
            'total_orders' => $totalOrders,
            'total_orders_today' => $totalOrdersToday,
            'total_customers' => $totalCustomers,
            'total_customers_last_two_days' => $totalCustomersLastTwoDays,
        ];
    }


    public function getYearsWithOrders()
    {
        return $this->selectRaw('YEAR(created_at) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');
    }

    public function getMonthlyRevenueByYear($year)
    {
        return $this->selectRaw('MONTH(created_at) as month, SUM(total_amount) as revenue')
            ->whereYear('created_at', $year)
            ->where('status', '<>', 'cancelled')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }
}
