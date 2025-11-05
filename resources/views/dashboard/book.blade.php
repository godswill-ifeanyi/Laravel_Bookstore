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
      <a href="{{ url('/dashboard/index') }}">Back</a>
    </div>
    
    <h3>Add Book</h3>

    <form method="POST" action="{{ url('/dashboard/books') }}" enctype="multipart/form-data" id="bookForm">
      @csrf

      <input type="hidden">
      <input type="text" placeholder="Book Title" name="title" >
      @error('title') <small style="color: red">{{$message}}</small> @enderror

      <input type="text" placeholder="Author" name="author" >
      @error('author') <small style="color: red">{{$message}}</small> @enderror

      <input type="number" placeholder="Price" name="price" >
      @error('price') <small style="color: red">{{$message}}</small> @enderror

      <input type="number" placeholder="Pages" name="pages" >
      @error('pages') <small style="color: red">{{$message}}</small> @enderror
      <br><br>

      <textarea placeholder="Description" name="description" cols="30" rows="10"></textarea>
      @error('dsecription') <small style="color: red">{{$message}}</small> @enderror

      <input type="file" placeholder="Image" name="image" >
      @error('image') <small style="color: red">{{$message}}</small> @enderror
      
      <button type="submit">Save Book</button>
    </form>

    <h3>Book List</h3>
    <table>
      <thead>
        <tr>
          <th>Title</th>
          <th>Author</th>
          <th>Price</th>
          <th>Pages</th>
          <th>Images</th>
          <th>Added By</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="bookList">
        
          @forelse ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->price }}</td>
                <td>{{ $book->pages }}</td>
                
                <td>
                  @if ($book->image !== null)
                      <img width="100px" src="{{ asset('images/'.$book->image) }}" alt="">
                  @else
                      <p>Not uploaded</p>
                  @endif
                </td>

                <td>{{ $book->user->name }}</td>

                <td>
                  <button>Edit</button>
                  <br><br>
                  <form method="POST" action="{{ url('/dashboard/books/'.$book->id) }}" onsubmit="return confirm('Are you sure to delete this book?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit" style="background-color:red;">Delete</button>
                  </form>
                </td>
            </tr>
          @empty
            <td colspan="7"><p>No available book</p></td>
          @endforelse
      </tbody>
    </table>
  </div>

  <script src="script.js"></script>
</body>
</html>
