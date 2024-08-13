<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    protected $customer;

    public function __construct(User $customer)
    {
        $this->customer = $customer;
    }

    public function index(Request $request): View
    {
        $customers = $this->customer->getcustomers($request->get('search', ''));

        return view('admin.customer.index', compact('customers'));
    }
}
