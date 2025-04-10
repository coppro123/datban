
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
            <use xlink:href="#bootstrap"></use>
        </svg>
    </a>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/food" class="nav-link px-2 link-dark">Món Ăn</a></li>
        <li><a href="/cart" class="nav-link px-2 link-dark">Giỏ Hàng</a></li>
        <li><a href="/don-hang-cua-toi" class="nav-link px-2 link-dark">Đơn Hàng Của Tôi</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
    </ul>

    <div class="col-md-3 text-end">

        @guest
        <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">Đăng nhập</a>
        @endguest

        @auth
        <h2>Xin chào {{ auth()->user()->name }}</h2>
        <a class="btn btn-primary" href="{{ route('logout') }}">Đăng xuất</a>
        @endauth
    </div>
</header>