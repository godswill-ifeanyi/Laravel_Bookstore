<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bookstore | Login</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  @if (session('success'))
    <script>
      alert("{{ session('success') }}");
    </script>
  @elseif (session('error'))
    <script>
      alert("{{ session('error') }}");
    </script>
  @endif
  
  <div class="container auth">
    <h1>Bookstore Login</h1>
    <form method="POST" action="{{ url('/login-user') }}" id="loginForm">
      @csrf

      <input type="email" placeholder="Email" name="email" required>
      @error('email') <small style="color: red">{{$message}}</small> @enderror

      <input type="password" placeholder="Password" name="password" required>
      @error('password') <small style="color: red">{{$message}}</small> @enderror

      <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
    <p id="loginMsg" class="message"></p>
  </div>

  <script src="script.js"></script>
</body>
</html>
