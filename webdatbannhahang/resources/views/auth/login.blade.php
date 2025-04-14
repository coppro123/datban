<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('/images/black-friday-elements-assortment.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
      height: 100vh;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-form {
      background-color: rgba(255, 255, 255, 0.9); /* nền mờ */
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 400px;
    }

    .login-form h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .btn-primary {
      width: 100%;
    }

    .form-text {
      font-size: 0.875em;
    }

    a {
      display: block;
      text-align: center;
      margin-top: 15px;
    }
  </style>
</head>

<body>

  <form method="POST" action="{{ route('login') }}" class="login-form">
    @csrf
    <h2>Đăng nhập</h2>

    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email</label>
      <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập email">
      <div id="emailHelp" class="form-text">Chúng tôi sẽ không chia sẻ email của bạn.</div>
    </div>

    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
      <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Mật khẩu">
    </div>

    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Ghi nhớ đăng nhập</label>
    </div>

    <button type="submit" class="btn btn-primary">Đăng nhập</button>

    <a href="{{ route('register') }}">Chưa có tài khoản? Đăng ký</a>
  </form>

</body>

</html>
