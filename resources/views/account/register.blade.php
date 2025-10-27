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
    <form method="POST" action="{{ url('register-user') }}" id="registerForm">
        @csrf

      <input type="text" placeholder="Name" name="name" required>

      <input type="text" placeholder="Username" name="username" required>

      <input type="email" placeholder="Email" name="email" required>

      <input type="text" placeholder="Phone" name="phone" required>

      <input type="password"  placeholder="Password" name="password" required>

      <input type="password"  placeholder="Confirm Password" name="password_confirmation" required>

      <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="{{ url('/') }}">Login</a></p>
    <p id="registerMsg" class="message"></p>
  </div>

  <script src="script.js"></script>
</body>
</html>
