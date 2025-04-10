<?php

// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $amount = $request->input('amount');

        $vnp_TmnCode = env('VNPAY_TMNCODE');
        $vnp_HashSecret = env('VNPAY_HASHSECRET');
        $vnp_Url = env('VNPAY_URL');
        $vnp_Returnurl = env('VNPAY_RETURN_URL');
        $vnp_TxnRef = time(); // Mã đơn hàng duy nhất
        $vnp_OrderInfo = 'Thanh toán đơn hàng test';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $amount * 100; // đơn vị: đồng, nhân 100 (VNP yêu cầu)
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = $request->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');

        if ($vnp_ResponseCode == '00') {
            // Lấy giỏ hàng từ session
            $cart = session('cart', []);

            if (empty($cart)) {
                return 'Không có sản phẩm trong giỏ hàng!';
            }

            // Tính tổng tiền
            $tong_tien = 0;
            foreach ($cart as $item) {
                $tong_tien += $item['soluong'] * $item['gia']; // ví dụ: mỗi món 100k
            }

            // Tạo đơn hàng
            $order = Order::create([
                'user_id' => Auth::id() ?? null,
                'tongtien' => $tong_tien,
            ]);

            // Tạo chi tiết đơn hàng
            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'food_id' => $id,
                    'soluong' => $item['soluong'],
                    'tongtien' => $item['gia']
                ]);
            }

            // Xóa giỏ hàng
            Session::forget('cart');

            return view('order.success', compact('order'));
        } else {
            return view('order.failed');
        }
    }
}
