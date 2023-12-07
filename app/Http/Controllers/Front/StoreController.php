<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function home()
    {
        return view('front.store.home');
    }

    public function store()
    {
        return view('front.store.store');
    }

    public function wishlist()
    {
        return view('front.store.wishlist');
    }
}
