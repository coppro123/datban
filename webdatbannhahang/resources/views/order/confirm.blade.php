@extends('layouts.app')

@section('content')
<h3>Xác nhận thông tin giao hàng</h3>

<form action="{{ route('vnpay.payment') }}" method="GET">
    @csrf
    <div class="mb-3">
        <label for="address" class="form-label">Địa chỉ</label>
        <input type="text" class="form-control" id="address" name="address" value="{{ $shipping_info['address'] }}" required readonly>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Số điện thoại</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $shipping_info['phone'] }}" required readonly>
    </div>

    <div class="mb-3">
        <label for="note" class="form-label">Ghi chú</label>
        <textarea class="form-control" id="note" name="note" readonly>{{ $shipping_info['note'] }}</textarea>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Tổng tiền</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $shipping_info['amount'] }}" required readonly>
    </div>

    <button type="submit" class="btn btn-primary">Xác nhận và tiếp tục thanh toán</button>
</form>

@endsection
