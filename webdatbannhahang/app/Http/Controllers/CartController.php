<?php

namespace App\Http\Controllers;

use App\Models\BanAn;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $food = Food::findOrFail($id);

        $cart = session()->get('cart', []);

        // Nếu món đã có trong giỏ thì tăng số lượng
        if (isset($cart[$id])) {
            $cart[$id]['soluong']++;
        } else {
            // Nếu chưa có, thêm mới
            $cart[$id] = [
                'ten' => $food->ten,
                'mota' => $food->mota,
                'image' => $food->image,
                'gia' => $food->gia,
                'soluong' => 1
            ];
        }

        session(['cart' => $cart]);

        return redirect('/cart');
    }

    public function viewCart()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function checkout(Request $request)
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => Auth::id() ?? null,
            'tong_tien' => 0, // sẽ cập nhật sau
        ]);

        $tongTien = 0;

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'food_id' => $id,
                'ten' => $item['ten'],
                'mota' => $item['mota'],
                'image' => $item['image'],
                'so_luong' => $item['soluong'],
            ]);

            $tongTien += $item['soluong'] * 1; // giá cố định, bạn có thể thêm cột `gia` nếu muốn
        }

        // Cập nhật tổng tiền
        $order->update(['tong_tien' => $tongTien]);

        // Xóa giỏ hàng sau khi thanh toán
        Session::forget('cart');

        return redirect()->route('home')->with('success', 'Đặt hàng thành công!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['soluong'] = $request->input('soluong');
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Cập nhật số lượng thành công');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Xóa món thành công');
    }
    //
}
