<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function register()
    {
        return view('login.register');
    }

    public function login()
    {
        return view('login.login');
    }

    public function forgotPassword()
    {
        return view('login.forgot-password');
    }
}
