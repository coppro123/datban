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


    public function store(Request $request)
    {
        // Lưu thông tin giao hàng vào session
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string',
            'note' => 'nullable|string',
            'total_amount' => 'nullable|string'
        ]);

        // Lưu thông tin vào session
        session([
            'shipping_info' => [
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'note' => $request->input('note'),
                'amount' => $request->input('total_amount')
            ]
        ]);

        // Lấy thông tin giao hàng từ session
        $shipping_info = session('shipping_info');

        // Chuyển hướng đến trang xác nhận thông tin giao hàng
        return view('order.confirm', compact('shipping_info'));
    }
}
