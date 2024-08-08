<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function index(Request $request): View
    {
        $orders = $this->order->getOrders($request->get('search', ''), $request->get('status', ''));

        return view('admin.order.index', compact('orders'));
    }

    public function show(): View
    {
        return view('admin.order.show');
    }
}
