<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\LengthAwarePaginator;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_admin',
        'is_super_admin',
        'profile_image',
        'birthdate'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getUsers(string $search = null): LengthAwarePaginator
    {
        $users = $this->where(function ($query) use ($search) {
            if ($search) {
                $query->where('email', $search);
                $query->orWhere('name', 'LIKE', "%$search%");
            }
        })
            ->where('id', '!=', auth()->id())
            ->where('is_admin', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $users;
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function defaultAddress()
    {
        return $this->hasOne(Address::class)->where('is_default', true);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Order::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites');
    }


    public function getTotalSpentAttribute()
    {
        return $this->payments()
            ->where('payments.status', 'completed')
            ->sum('amount');
    }

    public function getCustomers(string $search = null): LengthAwarePaginator
    {
        $customers = $this->where(function ($query) use ($search) {
            if ($search) {
                $query->where('email', $search);
                $query->orWhere('name', 'LIKE', "%$search%");
            }
        })
            ->where('is_super_admin', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $customers;
    }
}
