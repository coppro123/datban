<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>this is admin page</p>
    <div class="col-md-3 text-end">

        @guest
        <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">Đăng nhập</a>
        @endguest

        @auth
        <h2>Xin chào {{ auth()->user()->name }}</h2>
        <a class="btn btn-primary" href="{{ route('logout') }}">Đăng xuất</a>
        @endauth
    </div>
</body>

</html>