<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin — Responsive Dashboard</title>
  <link rel="stylesheet" href="{{ asset('admin/style.css') }}" />
</head>
<body>
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
        <a class="nav-link" data-route="home" href="#home"><span class="icon">🏠</span><span class="label">Home</span></a>

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
        <h3>Users</h3>
        <div class="row"><input placeholder="Filter users" class="input" id="filterUsers"/><button class="btn primary" id="addUserBtn">+ New</button></div>
      </div>
      <div class="table-wrap"><table class="table"><thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Username</th><th>Status</th><th>Joined</th></tr></thead><tbody>
        @forelse ($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->status ? 'Active':'Restricted' }}</td>
            <td>{{ $user->created_at->format('M d, Y') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="5">No user found.</td>
          </tr>
        @endforelse  
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
