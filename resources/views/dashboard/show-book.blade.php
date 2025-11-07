<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bookstore Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/style.css')}}">
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
  
  <nav>
    <h2>📚 My Bookstore</h2>
    <form onsubmit="return confirm('Are you sure to logout?')" method="POST" action="{{ url('/logout-user') }}">
      @csrf

      <button type="submit" id="logoutBtn">Logout</button>
    </form>
  </nav>

  <div class="container">

    <div>
      <a href="{{ url('/dashboard/books') }}">Back</a>
    </div>
    
    <h3>Book</h3>
    <span>added by {{ $book->user->name }}</span>

    <h4>Title: {{ $book->title }}</h4>
    <p>Author: {{ $book->author }}</p>
    <p>Price: {{ $book->price }}</p>
    <p>Pages: {{ $book->pages }}</p>
    <p>Description: {{ $book->description }}</p>
    @if ($book->image !== null)
        <img width="200px" src="{{ asset('images/'.$book->image) }}" alt="">
    @else
        <p>No image uploaded</p>
    @endif

  </div>

  <script src="script.js"></script>
</body>
</html>