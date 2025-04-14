@extends('admin.app') <!-- Nếu bạn dùng layout -->

@section('content')
  <div class="container">
    <h1>Danh sách đơn hàng</h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tên khách hàng</th>
          <th>Tổng tiền</th>
          <th>Ngày đặt</th>
          <th>Trạng thái</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
          <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name ?? 'Không có user' }}</td>

            <td>{{ number_format($order->tongtien) }} VNĐ</td>
            <td>{{ $order->created_at->format('d/m/Y') }}</td>
            <td>{{$order->status}}</td>
            <td>
              <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                @csrf
                @method('PUT')
                <select name="status" class="form-control" onchange="this.form.submit()">
                  <option value="Chờ xác nhận" {{ $order->status == 'Chờ xác nhận' ? 'selected' : '' }}>Chờ xác nhận</option>
                  <option value="Đã xác nhận" {{ $order->status == 'Đã xác nhận' ? 'selected' : '' }}>Đã xác nhận</option>
                  <option value="Đang giao" {{ $order->status == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                  <option value="Đã hoàn thành" {{ $order->status == 'Đã hoàn thành' ? 'selected' : '' }}>Đã hoàn thành</option>
                  <option value="Hủy" {{ $order->status == 'Hủy' ? 'selected' : '' }}>Hủy</option>
                </select>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
