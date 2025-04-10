@extends('layouts.app')

@section('content')
<h2>Register</h2>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="text" name="name" placeholder="Họ tên" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Mật khẩu" required><br>
    <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" required><br>
    <button type="submit">Đăng ký</button>
</form>
<a href="{{ route('login') }}">Đã có tài khoản? Đăng nhập</a>
@endsection
