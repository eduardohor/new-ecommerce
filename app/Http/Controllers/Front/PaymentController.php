<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        return view('front.payment.index');
    }

    public function processPayment(Request $request)
    {
        dd($request->all());
    }
}
