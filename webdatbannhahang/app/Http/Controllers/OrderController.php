<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function myOrders()
    {
        $orders = Order::with(['items.food'])->where('user_id', Auth::id())->get();
        return view('order.index', compact('orders'));
    }
}
