// Responsive Admin Dashboard JS (vanilla)
const ROUTES = ['home','users','books','transactions','support','profile','settings','logout'];
const el = id => document.getElementById(id);
const content = el('content');
const year = el('year');
const sidebar = document.getElementById('sidebar');
const menuBtn = document.getElementById('menuBtn');
const collapseBtn = document.getElementById('collapseBtn');
const themeToggle = document.getElementById('themeToggle');
const searchInput = document.getElementById('search');

year.textContent = new Date().getFullYear();

// Demo data
const users = [
  {name:'Ada Lovelace', email:'ada@example.com', role:'Admin', status:'Active', joined:'2024-10-11'},
  {name:'Grace Hopper', email:'grace@example.com', role:'Support', status:'Active', joined:'2025-02-04'},
  {name:'Linus Torvalds', email:'linus@example.com', role:'User', status:'Suspended', joined:'2023-08-22'}
];
const books = [
  {title:'Atomic Habits', author:'James Clear', status:'Available'},
  {title:'Deep Work', author:'Cal Newport', status:'Checked out'},
  {title:'Clean Code', author:'Robert C. Martin', status:'Available'}
];
const tx = [
  {id:'#1001', user:'Ada Lovelace', amount:120.5, status:'Success', date:'2025-08-20'},
  {id:'#1002', user:'Grace Hopper', amount:12.99, status:'Pending', date:'2025-08-22'},
  {id:'#1003', user:'Linus Torvalds', amount:250.0, status:'Failed', date:'2025-08-21'}
];
const tickets = [
  {id:'#501', subject:'Login issue', user:'Linus', priority:'High', status:'Open'},
  {id:'#502', subject:'Payment query', user:'Grace', priority:'Low', status:'Open'}
];

// Helpers
function makeBadge(text){ const cls = text.toLowerCase().includes('success') ? 'Success' : text.toLowerCase().includes('fail') ? 'Failed' : 'Pending'; return `<span class="badge ${cls}">${text}</span>`; }
function navActivate(route){ document.querySelectorAll('.nav-link').forEach(a=> a.classList.toggle('active', a.dataset.route===route)); }
// Renderers
function renderHome(){
  document.title = 'Home - AdminLite';
  return `
    <div class="grid">
      <div class="card"><h3>Total Users</h3><div class="metrics"><div class="metric-value">${users.length}</div><div class="muted">registered</div></div></div>
      <div class="card"><h3>Total Books</h3><div class="metrics"><div class="metric-value">${books.length}</div><div class="muted">catalogued</div></div></div>
      <div class="card"><h3>Transactions (30d)</h3><div class="metrics"><div class="metric-value">$${tx.filter(t=>t.status==='Success').reduce((a,b)=>a+ (b.amount||0),0).toFixed(2)}</div><div class="muted">completed</div></div></div>
    </div>
    <div class="card">
      <h3>Recent Activity</h3>
      <div class="table-wrap"><table class="table"><thead><tr><th>Time</th><th>User</th><th>Action</th><th>Status</th></tr></thead><tbody>
        <tr><td>Just now</td><td>Ada Lovelace</td><td>Added a book</td><td>Success</td></tr>
        <tr><td>5 min ago</td><td>Grace Hopper</td><td>Resolved a ticket</td><td>Success</td></tr>
        <tr><td>12 min ago</td><td>Linus</td><td>Payment failed</td><td>Failed</td></tr>
      </tbody></table></div>
    </div>
  `;
}

function renderUsers(){
  document.title = 'Users - AdminLite';
  return `
    <div class="card">
      <div class="row" style="justify-content:space-between;align-items:center">
        <h3>Users</h3>
        <div class="row"><input placeholder="Filter users" class="input" id="filterUsers"/><button class="btn primary" id="addUserBtn">+ New</button></div>
      </div>
      <div class="table-wrap"><table class="table"><thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Joined</th></tr></thead><tbody>
        ${users.map(u=>`<tr><td>${u.name}</td><td>${u.email}</td><td>${u.role}</td><td>${u.status}</td><td>${u.joined}</td></tr>`).join('')}
      </tbody></table></div>
    </div>
  `;
}

function renderBooks(){
  document.title = 'Books - AdminLite';
  return `
    <div class="card">
      <div class="row" style="justify-content:space-between;align-items:center">
        <h3>Books</h3>
        <div class="row"><input placeholder="Search books" class="input" id="filterBooks"/><button class="btn primary" id="addBookBtn">+ Add</button></div>
      </div>
      <div class="table-wrap"><table class="table"><thead><tr><th>Title</th><th>Author</th><th>Status</th></tr></thead><tbody>
        ${books.map(b=>`<tr><td>${b.title}</td><td>${b.author}</td><td>${b.status}</td></tr>`).join('')}
      </tbody></table></div>
    </div>
  `;
}

function renderTransactions(){
  document.title = 'Transactions - AdminLite';
  return `
    <div class="card">
      <h3>Transactions</h3>
      <div class="table-wrap"><table class="table"><thead><tr><th>ID</th><th>User</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead><tbody>
        ${tx.map(t=>`<tr><td>${t.id}</td><td>${t.user}</td><td>$${t.amount.toFixed(2)}</td><td>${t.status}</td><td>${t.date}</td></tr>`).join('')}
      </tbody></table></div>
    </div>
  `;
}

function renderSupport(){
  document.title = 'Support - AdminLite';
  return `
    <div class="card">
      <h3>Support Tickets</h3>
      <div class="table-wrap"><table class="table"><thead><tr><th>ID</th><th>Subject</th><th>User</th><th>Priority</th><th>Status</th></tr></thead><tbody>
        ${tickets.map(t=>`<tr><td>${t.id}</td><td>${t.subject}</td><td>${t.user}</td><td>${t.priority}</td><td>${t.status}</td></tr>`).join('')}
      </tbody></table></div>
    </div>
  `;
}

function renderProfile(){
  document.title = 'Profile - AdminLite';
  const u = users[0];
  return `
    <div class="profile-grid">
      <div class="profile-card card">
        <img src="https://via.placeholder.com/320x200.png?text=Avatar" class="profile-avatar" alt="avatar"/>
        <h3 class="profile-name">${u.name}</h3>
        <div class="muted">${u.role}</div>
        <div style="margin-top:12px"><button class="btn">Message</button></div>
      </div>

      <form id="profileForm" class="profile-form card">
        <h3>Account Details</h3>
        <div style="display:grid;gap:12px;margin-top:8px">
          <label>Full name<input class="input" id="pfName" value="${u.name}"></label>
          <label>Email<input class="input" id="pfEmail" value="${u.email}"></label>
          <label>Role<select class="input" id="pfRole"><option>Admin</option><option>Support</option><option>User</option></select></label>
          <div class="row" style="justify-content:flex-end"><button class="btn primary" type="submit">Save changes</button></div>
        </div>
      </form>
    </div>
  `;
}

function renderSettings(){
  document.title = 'Settings - AdminLite';
  return `
    <div class="card">
      <h3>Preferences</h3>
      <div style="display:grid;gap:12px;margin-top:12px">
        <label><input type="checkbox" id="optEmail" checked/> Email notifications</label>
        <label><input type="checkbox" id="optSms" /> SMS alerts</label>
        <label>Default currency<select class="input" id="optCurrency"><option>USD</option><option selected>NGN</option></select></label>
        <div class="row" style="justify-content:flex-end"><button class="btn primary" id="saveSettings">Save</button></div>
      </div>
    </div>
  `;
}

function renderLogout(){
  document.title = 'Logout - AdminLite';
  return `
    <div class="card">
      <h3>Logged out</h3>
      <p class="muted">You have been signed out. Close the tab or sign in again to continue.</p>
      <div style="margin-top:12px"><a href="#home" class="btn">Return to Home</a></div>
    </div>
  `;
}

// Router
function routeTo(r){
  if(!ROUTES.includes(r)) r = 'home';
  navActivate(r);
  const renderMap = {
    home: renderHome,
    users: renderUsers,
    books: renderBooks,
    transactions: renderTransactions,
    support: renderSupport,
    profile: renderProfile,
    settings: renderSettings,
    logout: renderLogout
  };
  content.innerHTML = renderMap[r]();
  // post-render hooks
  if(r==='profile'){
    const form = document.getElementById('profileForm');
    form.addEventListener('submit', e=>{
      e.preventDefault();
      const name = document.getElementById('pfName').value;
      const email = document.getElementById('pfEmail').value;
      alert('Profile saved\\nName: '+name+'\\nEmail: '+email);
    });
  }
  if(r==='users'){
    const filter = document.getElementById('filterUsers');
    if(filter) filter.addEventListener('input', e=>{
      const q = e.target.value.toLowerCase();
      const tbody = document.querySelector('.table-wrap table tbody');
      tbody.innerHTML = users.filter(u=> (u.name+u.email+u.role).toLowerCase().includes(q)).map(u=>`<tr><td>${u.name}</td><td>${u.email}</td><td>${u.role}</td><td>${u.status}</td><td>${u.joined}</td></tr>`).join('');
    });
  }
  if(r==='books'){
    const filter = document.getElementById('filterBooks');
    if(filter) filter.addEventListener('input', e=>{
      const q = e.target.value.toLowerCase();
      const tbody = document.querySelector('.table-wrap table tbody');
      tbody.innerHTML = books.filter(b=> (b.title+b.author).toLowerCase().includes(q)).map(b=>`<tr><td>${b.title}</td><td>${b.author}</td><td>${b.status}</td></tr>`).join('');
    });
  }
}

// Init
window.addEventListener('DOMContentLoaded', ()=>{
  // attach nav links
  document.querySelectorAll('.nav-link').forEach(a=>{
    a.addEventListener('click', (e)=>{
      const route = a.dataset.route || a.getAttribute('href').replace('#','');
      if(window.innerWidth < 700) sidebar.classList.remove('open');
      history.pushState(null,'', '#'+route);
      routeTo(route);
    });
  });

  // menu toggle for mobile
  menuBtn.addEventListener('click', ()=> sidebar.classList.toggle('open'));
  collapseBtn.addEventListener('click', ()=> {
    if(document.documentElement.clientWidth > 1100){
      if(sidebar.style.width === '88px') sidebar.style.width = '260px';
      else sidebar.style.width = '88px';
    } else {
      sidebar.classList.toggle('open');
    }
  });

  // theme
  themeToggle.addEventListener('click', ()=> document.body.classList.toggle('light'));

  // search (simple)
  searchInput.addEventListener('input', (e)=>{
    const q = e.target.value.toLowerCase();
    if(location.hash.includes('users')){
      const tbody = document.querySelector('.table-wrap table tbody');
      if(tbody) tbody.innerHTML = users.filter(u=> (u.name+u.email+u.role).toLowerCase().includes(q)).map(u=>`<tr><td>${u.name}</td><td>${u.email}</td><td>${u.role}</td><td>${u.status}</td><td>${u.joined}</td></tr>`).join('');
    }
  });

  // initial route
  const start = location.hash.replace('#','') || 'home';
  routeTo(start);
  window.addEventListener('popstate', ()=> routeTo(location.hash.replace('#','') || 'home'));
});
