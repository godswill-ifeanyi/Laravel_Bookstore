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
        <a class="nav-link" data-route="users" href="#users"><span class="icon">👥</span><span class="label">Users</span></a>
        <a class="nav-link" data-route="books" href="#books"><span class="icon">📚</span><span class="label">Books</span></a>
        <a class="nav-link" data-route="transactions" href="#transactions"><span class="icon">💳</span><span class="label">Transactions</span></a>
        <a class="nav-link" data-route="support" href="#support"><span class="icon">💬</span><span class="label">Support</span></a>
        <a class="nav-link" data-route="profile" href="#profile"><span class="icon">👤</span><span class="label">Profile</span></a>
        <a class="nav-link" data-route="settings" href="#settings"><span class="icon">⚙️</span><span class="label">Settings</span></a>
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
        <!-- Routes will render here -->
      </main>

      <footer class="footer">
        <div>AdminLite • Responsive Dashboard</div>
        <div class="muted">Made with ♥</div>
      </footer>
    </div>
  </div>

  <script src="assets/script.js"></script>
</body>
</html>
