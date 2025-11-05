<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/dasboard.css')}}" />
</head>
<body>
  <div class="dashboard">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2 class="logo">MyDashboard</h2>
      <nav class="nav">
        <a href="#" class="active">🏠 Home</a>
        <a href="{{ url('dashboard/books')}}">📚 Books</a>
        <a href="#">👤 Profile</a>
        <a href="#">
            <form onsubmit="return confirm('Are you sure to logout?')" method="POST" action="{{ url('/logout-user') }}">
            @csrf

            <button type="submit" id="logoutBtn">Logout</button>
            </form>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <header class="header">
        <h1>Dashboard Overview</h1>
      </header>

      <!-- Cards Section -->
      <section class="cards">
        <div class="card">
          <h3>Total Users</h3>
          <p>1,250</p>
        </div>
        <div class="card">
          <h3>Books Sold</h3>
          <p>780</p>
        </div>
        <div class="card">
          <h3>Revenue</h3>
          <p>$12,340</p>
        </div>
        <div class="card">
          <h3>Pending Orders</h3>
          <p>24</p>
        </div>
      </section>

      <!-- Table Section -->
      <section class="table-section">
        <h2>Recent Transactions</h2>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Book Title</th>
              <th>Buyer</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>The Great Gatsby</td>
              <td>John Doe</td>
              <td>2025-11-01</td>
              <td>Completed</td>
            </tr>
            <tr>
              <td>2</td>
              <td>1984</td>
              <td>Jane Smith</td>
              <td>2025-11-02</td>
              <td>Pending</td>
            </tr>
            <tr>
              <td>3</td>
              <td>To Kill a Mockingbird</td>
              <td>Michael Brown</td>
              <td>2025-11-02</td>
              <td>Completed</td>
            </tr>
            <tr>
              <td>4</td>
              <td>Harry Potter</td>
              <td>Sara Johnson</td>
              <td>2025-11-03</td>
              <td>Shipped</td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>
  </div>
</body>
</html>
