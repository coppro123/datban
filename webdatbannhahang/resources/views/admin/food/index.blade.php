@extends('admin.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Danh sách đồ gia dụng</h3>
        <a href="/admin/food/create" class="btn btn-primary">+ Thêm</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Mô tả</th>
                <th>Ảnh</th>
                <th>Gia</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            @foreach($foods as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->ten }}</td>
                    <td>{{ $item->mota }}</td>
                    <td>
                        <img src="{{$item->image}}" width="100" class="img-thumbnail" alt="ảnh món ăn">
                    </td>
                    <td>{{$item->gia}}</td>
                    <td>
                    <a href="{{ url('/admin/food/edit/' . $item->id) }}" class="btn btn-sm btn-warning mb-1">Sửa</a>

                        <form action="{{ url('/admin/food/' . $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn chắc muốn xoá?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
