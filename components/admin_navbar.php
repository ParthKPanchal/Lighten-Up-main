<style>
    body { overflow-x: hidden; }

    /* Sidebar */
    #sidebar {
      width: 250px;
      position: fixed;
      top: 0;
      left: -250px;
      height: 100%;
      background: #212529;
      opacity: 0.95;
      transition: all 0.3s ease;
      padding: 15px;
      z-index: 1050;
    }
    #sidebar.active { left: 0; }

    /* Sidebar Links */
    #sidebar .nav-link {
      color: #adb5bd;
      margin: 5px 0;
      border-radius: 8px;
      padding: 10px 15px;
      transition: all 0.3s ease-in-out;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    #sidebar .nav-link:hover {
      background: rgba(255, 255, 255, 0.1);
      color: #ffffff;
      transform: translateX(5px);
    }
    #sidebar .nav-link.active {
      background: #0d6efd;
      color: #fff;
    }

    /* Content shift on large screens */
    #content {
      transition: margin-left 0.3s ease;
      margin-left: 0;
    }
    @media (min-width: 992px) {
      #sidebar.active + #content { margin-left: 250px; }
    }
  </style>

  <!-- Navbar -->
<nav class="navbar navbar-light bg-light shadow">
  <div class="container-fluid">
    <button class="btn btn-outline-dark" id="sidebarToggle">
      <i class="bi bi-list"></i>
    </button>
    <span class="navbar-brand mb-0 h1">Lighten Up - Admin Panel</span>
  </div>
</nav>

<!-- Sidebar -->
<div id="sidebar">
  <div class="d-flex justify-content-between align-items-center mb-3 text-white">
    <h4 class="mb-0">Menu</h4>
    <i class="bi bi-x-lg" id="closeSidebar" style="cursor:pointer;"></i>
  </div>

  <ul class="nav flex-column">
    <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="bi bi-speedometer2"></i> Home</a></li>
    <li class="nav-item"><a href="add_product.php" class="nav-link"><i class="bi bi-box"></i> Add Product</a></li>
    <li class="nav-item"><a href="my_product.php" class="nav-link"><i class="bi bi-bag"></i> My Product</a></li>
    <li class="nav-item"><a href="users.php" class="nav-link"><i class="bi bi-people"></i> Users</a></li>
    <li class="nav-item"><a href="admins.php" class="nav-link"><i class="bi bi-shield-lock"></i> Admins</a></li>
    <li class="nav-item"><a href="messages.php" class="nav-link"><i class="bi bi-envelope"></i> Messages</a></li>
  </ul>

  <hr class="bg-light">

  <a href="update.php" class="btn btn-outline-light w-100 mb-2">Update Profile</a>
  <a href="login.php" class="btn btn-outline-light w-100 mb-2">Login</a>
  <a href="register.php" class="btn btn-outline-light w-100 mb-2">Register</a>
  <a href="admin_logout.php" class="btn btn-danger w-100" onclick="return confirm('Logout from this website?')">Logout</a>
</div>

<script>
  const sidebar = document.getElementById('sidebar');
  const toggleBtn = document.getElementById('sidebarToggle');
  const closeBtn = document.getElementById('closeSidebar');

  toggleBtn.addEventListener('click', () => sidebar.classList.toggle('active'));
  closeBtn.addEventListener('click', () => sidebar.classList.remove('active'));
</script>