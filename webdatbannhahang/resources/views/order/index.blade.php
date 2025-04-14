@extends('layouts.app')

@section('content')
<h2>Đơn hàng của bạn</h2>

@forelse ($orders as $order)
<div style="border:1px solid #ccc; padding:15px; margin-bottom:20px;">
    <strong>Mã đơn hàng:</strong> {{ $order->id }} <br>
    <strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }} <br>
    <strong>Tổng tiền:</strong> {{ number_format($order->tongtien) }} VNĐ <br>
    <strong>Trạng thái đơn hàng:</strong> {{$order-> status }} 

    <h4>Chi tiết đơn hàng:</h4>
    <table class="table" border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Tên món</th>
            <th>Ảnh</th>
            <th>Mô tả</th>
            <th>Số lượng</th>
            <th>Gia</th>
            <th>Tong</th>
        </tr>
        @foreach ($order->items as $item)
        <tr>
            <td>{{ $item->food->ten }}</td>
            <td><img src="{{$item->food->image }}" width="100"></td>
            <td>{{ $item->food->mota }}</td>
            <td>{{ $item->soluong }}</td>
            <td>{{ $item->food->gia }}</td>
            <td>{{ $item->food->gia * $item->soluong }}</td>
        </tr>
        @endforeach
    </table>
</div>
@empty
<p>Bạn chưa có đơn hàng nào.</p>
@endforelse
@endsection