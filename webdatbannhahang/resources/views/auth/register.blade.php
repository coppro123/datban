<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
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

    .register-form {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 400px;
    }

    .register-form h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .btn-primary {
      width: 100%;
    }

    a {
      display: block;
      text-align: center;
      margin-top: 15px;
    }
  </style>
</head>

<body>

  <form method="POST" action="{{ route('register') }}" class="register-form">
    @csrf
    <h2>Đăng ký</h2>

    <div class="mb-3">
      <label for="name" class="form-label">Họ tên</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Nhập họ tên" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="Nhập email" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Mật khẩu</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu" required>
    </div>

    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
      <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Nhập lại mật khẩu" required>
    </div>

    <button type="submit" class="btn btn-primary">Đăng ký</button>

    <a href="{{ route('login') }}">Đã có tài khoản? Đăng nhập</a>
  </form>

</body>

</html>
