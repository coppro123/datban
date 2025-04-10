@extends('admin.app')

@section('content')

<h1>Thêm món ăn</h1>
<form action="{{ url('/admin/food') }}" method="POST">
    <!-- CSRF token nếu dùng Laravel -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <label for="ten">Tên món ăn:</label><br>
    <input type="text" id="ten" name="ten" required><br><br>

    <label for="mota">Mô tả:</label><br>
    <textarea id="mota" name="mota"></textarea><br><br>

    <label for="image">URL ảnh:</label><br>
    <input type="text" id="image" name="image" placeholder="https://..."><br><br>

    <label for="gia">Gia tien</label><br>
    <input type="text" id="gia" name="gia"><br><br>

    <button type="submit">Thêm</button>
</form>
@endsection
