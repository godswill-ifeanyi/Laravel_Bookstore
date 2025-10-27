<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bookstore | Login</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <div class="container auth">
    <h1>Bookstore | Login</h1>
    <form id="loginForm">
      <input type="email" placeholder="Email" required>
      <input type="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="{{ url('/register') }}">Register</a></p>
    <p id="loginMsg" class="message"></p>
  </div>

  <script src="script.js"></script>
</body>
</html>
