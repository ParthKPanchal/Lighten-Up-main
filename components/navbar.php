<!-- Navbar Section Start -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 sticky-top shadow">
  <div class="container-fluid">
    <!-- Logo aligned left -->
    <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php" aria-label="Ajay Infotech Home">
      <img src="asset/image/logo/logo.png" alt="Ajay Infotech Logo" width="100" class="me-2" />
    </a>

    <!-- Mobile Toggle Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
      aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Links aligned right -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">
        <li class="nav-item">
          <a class="nav-link fw-semibold px-3" href="index.php">Home</a>
        </li>
        <!-- Account Dropdown -->
        <li class="nav-item dropdown">
          <button class="nav-link fw-semibold px-3"
                  id="accountDropdown"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  style="border: none; background: transparent;">
            Shop <i class="fa-solid fa-chevron-down"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
            <li><a class="dropdown-item" href="shop.php">View all product</a></li>
            <li><a class="dropdown-item" href="search.php">Search product</a></li>
            <?php if($user_id != '') { ?>
              <li><a class="dropdown-item" href="my-product.php">My product</a></li>
              <li><a class="dropdown-item" href="add_product.php">Add product</a></li>
            <?php } ?>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold px-3" href="about.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold px-3" href="contact.php">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold px-3" href="saved.php">Saved</a>
        </li>

        <!-- Account Dropdown -->
        <li class="nav-item dropdown">
          <button class="nav-link fw-semibold px-3"
                  id="accountDropdown"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  style="border: none; background: transparent;">
            Account <i class="fa-solid fa-chevron-down"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
            <li><a class="dropdown-item" href="login.php">Login</a></li>
            <li><a class="dropdown-item" href="register.php">Register</a></li>
            <?php if($user_id != '') { ?>
              <li><a class="dropdown-item" href="update.php">Update</a></li>
              <li>
                <a class="dropdown-item" href="logout.php" onclick="return confirm('Logout from this website?');">
                  Logout
                </a>
              </li>
            <?php } ?>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Navbar Section Ends -->
