<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bookstore | Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/style.css')}}">
</head>
<body>
  <nav>
    <h2>📚 My Bookstore</h2>
    <button id="logoutBtn">Logout</button>
  </nav>

  <div class="container">
    <h3>Add / Edit Book</h3>
    <form id="bookForm">
      <input type="hidden">
      <input type="text" placeholder="Book Title" required>
      <input type="text" placeholder="Author" required>
      <input type="number" placeholder="Price" required>
      <input type="number" placeholder="Pages" required>
      <input type="file" placeholder="Image" required>
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
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="bookList"></tbody>
    </table>
  </div>

  <script src="script.js"></script>
</body>
</html>
