@extends('layouts.app')

@section('content')

<h2>Giỏ hàng của bạn</h2>

<table class="table" border="1" cellpadding="10">
    <tr>
        <th>Tên món</th>
        <th>Mô tả</th>
        <th>Ảnh</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Tổng</th>
    </tr>
    @php $total = 0; @endphp
    @foreach ($cart as $id => $item)
        @php 
            $itemTotal = $item['gia'] * $item['soluong'];
            $total += $itemTotal;
        @endphp
        <tr>
            <td>{{ $item['ten'] }}</td>
            <td>{{ $item['mota'] }}</td>
            <td><img src="{{ $item['image'] }}" width="100"></td>
            <td>{{ number_format($item['gia'], 0, ',', '.') }} VND</td>
            <td>{{ $item['soluong'] }}</td>
            <td>{{ number_format($itemTotal, 0, ',', '.') }} VND</td>
        </tr>
    @endforeach
</table>

<h4>Tổng tiền: <strong>{{ number_format($total, 0, ',', '.') }} VND</strong></h4>

<form action="{{ route('vnpay.payment') }}" method="GET">
    <input type="hidden" name="amount" value="{{ $total }}">
    <button type="submit">Thanh toán qua VNPAY</button>
</form>

@endsection
