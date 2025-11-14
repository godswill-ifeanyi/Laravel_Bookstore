<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin — Responsive Dashboard</title>
  <link rel="stylesheet" href="{{ asset('admin/style.css') }}" />
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
  <div class="app">
    <aside class="sidebar" id="sidebar" aria-label="Sidebar">
      <div class="brand">
        <div class="brand-left">
          <span class="logo">AL</span>
          <div class="brand-texts">
            <div class="brand-title">AdminLite</div>
            <div class="brand-sub">Dashboard</div>
          </div>
        </div>
        <button id="collapseBtn" class="icon-btn" aria-label="Toggle sidebar">◀</button>
      </div>

      <nav class="nav" role="navigation">
        <a class="nav-link" data-route="home" href="{{ url('admin/index') }}"><span class="icon">🏠</span><span class="label">Home</span></a>

        <a class="nav-link" data-route="users" href="{{ url('admin/users') }}"><span class="icon">👥</span><span class="label">Users</span></a>

        <a class="nav-link" data-route="books" href="{{ url('admin/books') }}"><span class="icon">📚</span><span class="label">Books</span></a>

        <a class="nav-link" data-route="transactions" href="{{ url('admin/transactions') }}"><span class="icon">💳</span><span class="label">Transactions</span></a>

        <a class="nav-link" data-route="support" href="{{ url('admin/support') }}"><span class="icon">💬</span><span class="label">Support</span></a>

        <a class="nav-link" data-route="profile" href="{{ url('admin/profile') }}"><span class="icon">👤</span><span class="label">Profile</span></a>

        <a class="nav-link" data-route="settings" href="{{ url('admin/books') }}"><span class="icon">⚙️</span><span class="label">Settings</span></a>
        
        <a class="nav-link logout" href="#logout">
          <form onsubmit="return confirm('Are you sure to logout?')" method="POST" action="{{ url('/logout-user') }}">
            @csrf

            <button type="submit" id="logoutBtn"><span class="icon">🚪</span><span class="label">Logout</span></button>
            </form>
          </a>
      </nav>

      <div class="sidebar-footer">
        <small>© <span id="year"></span> AdminLite</small>
      </div>
    </aside>

    <div class="main">
      <header class="topbar">
        <div class="left">
          <button id="menuBtn" class="icon-btn" aria-label="Open menu">☰</button>
          <div class="search-wrap">
            <input id="search" placeholder="Search users, books, transactions..." aria-label="Search" />
          </div>
        </div>
        <div class="right">
          <button id="themeToggle" class="icon-btn" title="Toggle theme">🌓</button>
          <div class="profile-sm" id="profileBtn" title="Open profile">AL</div>
        </div>
      </header>

      <main class="content" id="content" role="main">
        <div class="card">
      <div class="row" style="justify-content:space-between;align-items:center">
        <h3>Books</h3>
        <div class="row"><input placeholder="Search books" class="input" id="filterBooks"/><button class="btn primary" id="addBookBtn">+ Add</button></div>
      </div>
      <div class="table-wrap"><table class="table"><thead><tr><th>Title</th><th>Author</th><th>Status</th><th>Actions</th></tr></thead><tbody>
        @foreach($books as $book)
        <tr>
          <td>{{ $book->title }}</td>
          <td>{{ $book->author }}</td>
          <td>{{ $book->price }}</td>
          <td>{{ $book->status ? 'Available':'Unavailable' }}</td>
          <td>
            @if ($book->image !== null)
                <img src="{{ asset('images/'.$book->image) }}" width="100px" alt="">
            @else
                <p>Not uploaded</p>
            @endif
          </td>
          <td>
            <a href="{{ url('admin/books/'.$book->id) }}" class="btn secondary btn-sm">See more</a>

            <a href="{{ url('admin/'.$book->id.'/edit') }}" class="btn secondary btn-sm">Edit</a>

            <form onsubmit="return confirm('Are you sure to delete this book?')" method="POST" action="{{ url('admin/books/'.$book->id) }}">
              @csrf
              @method('DELETE')
              <button type="submit" style="color: red; cursor: pointer;">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody></table></div>
    </div>
      </main>

      <footer class="footer">
        <div>AdminLite • Responsive Dashboard</div>
        <div class="muted">Made with ♥</div>
      </footer>
    </div>
  </div>

  {{-- <script src="{{ asset('admin/script.js') }}"></script> --}}
</body>
</html>
