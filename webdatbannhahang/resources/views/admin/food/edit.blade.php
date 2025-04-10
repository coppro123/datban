@extends('admin.app')

@section('content')
    <h2>Chỉnh sửa món ăn</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/admin/food/edit/' . $food->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên món ăn</label>
            <input type="text" name="ten" value="{{ old('ten', $food->ten) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="mota" class="form-control" required>{{ old('mota', $food->mota) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh (URL)</label>
            <input type="text" name="image" value="{{ old('image', $food->image) }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ url('/admin/food') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
