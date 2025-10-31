<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bookstore | Register</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <div class="container auth">
    <h1>Create an Account</h1>
    <form method="POST" action="{{ url('/register-user') }}" id="registerForm">
      @csrf

      <input type="text" placeholder="Name" name="name" required>
      @error('name') <small style="color: red">{{$message}}</small> @enderror

      <input type="text" placeholder="Username" name="username" required>
      @error('username') <small style="color: red">{{$message}}</small> @enderror

      <input type="email" placeholder="Email" name="email" required>
      @error('email') <small style="color: red">{{$message}}</small> @enderror

      <input type="text" placeholder="Phone" name="phone" required>
      @error('phone') <small style="color: red">{{$message}}</small> @enderror

      <input type="password"  placeholder="Password" name="password" required>
      @error('password') <small style="color: red">{{$message}}</small> @enderror

      <input type="password"  placeholder="Confirm Password" name="password_confirmation" required>

      <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
    <p id="registerMsg" class="message"></p>
  </div>

  <script src="script.js"></script>
</body>
</html>
