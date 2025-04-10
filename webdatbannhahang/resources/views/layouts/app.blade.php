<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Website của tôi')</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    {{-- HEADER --}}
    @include('partials.header')

    {{-- Hiển thị thông báo thành công --}}
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- Hiển thị thông báo lỗi nếu có --}}
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    {{-- NỘI DUNG TRANG --}}
    <div class="container">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    @include('partials.footer')

</body>
</html>
