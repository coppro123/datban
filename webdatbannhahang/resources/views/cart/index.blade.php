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
        <th>Hành động</th>
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
        <td>
            <form action="{{ route('cart.update', $id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="number" name="soluong" value="{{ $item['soluong'] }}" min="1" style="width: 60px;" onchange="this.form.submit()">
            </form>
        </td>
        <td>{{ number_format($itemTotal, 0, ',', '.') }} VND</td>
        <td>
            <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                @csrf
                @method('DELETE')
                <button type="submit">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<h4>Tổng tiền: <strong>{{ number_format($total, 0, ',', '.') }} VND</strong></h4>

<hr>

<h3>Thông tin giao hàng</h3>
<form action="{{ route('order.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="address" class="form-label">Địa chỉ</label>
        <input type="text" class="form-control" id="address" name="address" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Số điện thoại</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
    </div>
    <div class="mb-3">
        <label for="note" class="form-label">Ghi chú</label>
        <textarea class="form-control" id="note" name="note"></textarea>
    </div>
    <input type="hidden" name="total_amount" value="{{ $total }}">
    <button type="submit" class="btn btn-primary">Xác nhận và tiếp tục thanh toán</button>
</form>

@endsection
