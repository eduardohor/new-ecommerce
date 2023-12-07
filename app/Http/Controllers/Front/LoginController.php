<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function register()
    {
        return view('front.login.register');
    }

    public function login()
    {
        return view('front.login.login');
    }

    public function forgotPassword()
    {
        return view('front.login.forgot-password');
    }
}
