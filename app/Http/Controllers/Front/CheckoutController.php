<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    protected $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }
    public function index(): View
    {
        $user = auth()->user();

        $addresses = $this->address->where('user_id', $user->id)->get();

        return view('front.checkout.index', compact('addresses'));
    }
}
