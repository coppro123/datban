@extends('layouts.app')

@section('content')

<h1>Danh sách món ăn</h1>

<div class="row">
@foreach ($foods as $item)
    <div class="card m-3" style="width: 18rem;">
        @if ($item->image)
            <img class="card-img-top" src="{{ $item->image }}" alt="Ảnh món ăn" width="100">
        @else
            <div class="p-3 text-muted">Không có ảnh</div>
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $item->ten }}</h5>
            <p class="card-text">{{ $item->mota }}</p>
            <a href="/add-to-cart/{{ $item->id }}" class="btn btn-primary">Thêm vào giỏ hàng</a>
        </div>
    </div>
@endforeach
</div>

@endsection
