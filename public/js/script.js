// ======== AUTH LOGIC ========

// Register user
const registerForm = document.getElementById("registerForm");
if (registerForm) {
  registerForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const username = document.getElementById("regUser").value.trim();
    const password = document.getElementById("regPass").value.trim();
    const users = JSON.parse(localStorage.getItem("users")) || [];

    if (users.find(u => u.username === username)) {
      document.getElementById("registerMsg").textContent = "Username already exists.";
      return;
    }

    users.push({ username, password });
    localStorage.setItem("users", JSON.stringify(users));
    document.getElementById("registerMsg").textContent = "Registered successfully!";
    setTimeout(() => window.location.href = "index.html", 1000);
  });
}

// Login user
const loginForm = document.getElementById("loginForm");
if (loginForm) {
  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const username = document.getElementById("loginUser").value.trim();
    const password = document.getElementById("loginPass").value.trim();
    const users = JSON.parse(localStorage.getItem("users")) || [];

    const user = users.find(u => u.username === username && u.password === password);
    if (!user) {
      document.getElementById("loginMsg").textContent = "Invalid credentials.";
      return;
    }

    localStorage.setItem("loggedInUser", username);
    window.location.href = "bookstore.html";
  });
}

// Logout
const logoutBtn = document.getElementById("logoutBtn");
if (logoutBtn) {
  logoutBtn.addEventListener("click", () => {
    localStorage.removeItem("loggedInUser");
    window.location.href = "index.html";
  });
}

// Redirect if not logged in
if (document.title.includes("Dashboard") && !localStorage.getItem("loggedInUser")) {
  window.location.href = "index.html";
}

// ======== CRUD LOGIC ========
const bookForm = document.getElementById("bookForm");
const bookList = document.getElementById("bookList");

function loadBooks() {
  const books = JSON.parse(localStorage.getItem("books")) || [];
  bookList.innerHTML = "";
  books.forEach((book, index) => {
    bookList.innerHTML += `
      <tr>
        <td>${book.title}</td>
        <td>${book.author}</td>
        <td>$${book.price}</td>
        <td>
          <button onclick="editBook(${index})">Edit</button>
          <button onclick="deleteBook(${index})">Delete</button>
        </td>
      </tr>
    `;
  });
}

if (bookForm) {
  loadBooks();

  bookForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const books = JSON.parse(localStorage.getItem("books")) || [];
    const id = document.getElementById("bookId").value;
    const newBook = {
      title: document.getElementById("title").value.trim(),
      author: document.getElementById("author").value.trim(),
      price: parseFloat(document.getElementById("price").value)
    };

    if (id) {
      books[id] = newBook; // update
    } else {
      books.push(newBook); // add new
    }

    localStorage.setItem("books", JSON.stringify(books));
    bookForm.reset();
    document.getElementById("bookId").value = "";
    loadBooks();
  });
}

function editBook(index) {
  const books = JSON.parse(localStorage.getItem("books")) || [];
  const book = books[index];
  document.getElementById("bookId").value = index;
  document.getElementById("title").value = book.title;
  document.getElementById("author").value = book.author;
  document.getElementById("price").value = book.price;
}

function deleteBook(index) {
  const books = JSON.parse(localStorage.getItem("books")) || [];
  if (confirm("Delete this book?")) {
    books.splice(index, 1);
    localStorage.setItem("books", JSON.stringify(books));
    loadBooks();
  }
}
