<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('front.home');
    }

    public function store()
    {
        return view('front.store');
    }
}
