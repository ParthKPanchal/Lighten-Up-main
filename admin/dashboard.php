<?php
// Secure include
include '../connect.php';

// Check if admin is logged in
if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lighten Up - Admin Dashboard</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="author" content="Gemlyte IT Solutions">
  <meta name="keywords" content="Lighten Up, Gemlyte, Sample Project">
  <meta name="description" content="Gemlyte Sample Project">

  <!-- Favicon -->
  <link rel="shortcut icon" href="../image/logo/title.png" type="image/x-icon">

  <!-- Bootstrap Icons & CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="../css/loader.css">
  <link rel="stylesheet" type="text/css" href="../css/home-banner.css">
  <link rel="stylesheet" type="text/css" href="../css/home-product.css">
  <link rel="stylesheet" type="text/css" href="../css/home-about.css">
  <link rel="stylesheet" type="text/css" href="../css/home-contact.css">
  <link rel="stylesheet" type="text/css" href="../css/home-categories.css">
  <link rel="stylesheet" type="text/css" href="../css/home-view-product.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>
<body>
    <?php include __DIR__ . '/../components/admin_navbar.php'; ?>
    <!-- dashboard section start here -->
    <section class="dashboard py-5">
        <div class="container-fluid px-5">
        <div class="row g-4">

            <!-- Profile Card -->
            <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                <?php
                $select_profile=$conn->prepare("SELECT * FROM `admins` WHERE id=? LIMIT 1");
                $select_profile->execute([$admin_id]);
                $fetch_profile=$select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="mb-3"><i class="bi bi-person-circle display-4 text-primary"></i></div>
                <h3 class="card-title"><?= $fetch_profile['name']; ?></h3>
                <p class="text-muted">Welcome!</p>
                <a href="update.php" class="btn btn-outline-primary btn-sm">Update Profile</a>
                </div>
            </div>
            </div>

            <!-- Products Card -->
            <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                <?php
                $count_select_products=$conn->prepare("SELECT * FROM `products`");
                $count_select_products->execute();
                $total_products=$count_select_products->rowCount();
                ?>
                <div class="mb-3"><i class="bi bi-bag-check-fill display-4 text-success"></i></div>
                <h3><?= $total_products; ?></h3>
                <p class="text-muted">Total Products</p>
                <a href="admin/my_product.php" class="btn btn-outline-success btn-sm">My Products</a>
                </div>
            </div>
            </div>

            <!-- Users Card -->
            <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                <?php
                $count_select_users=$conn->prepare("SELECT * FROM `users`");
                $count_select_users->execute();
                $total_users=$count_select_users->rowCount();
                ?>
                <div class="mb-3"><i class="bi bi-people-fill display-4 text-info"></i></div>
                <h3><?= $total_users; ?></h3>
                <p class="text-muted">Total Customers</p>
                <a href="admin/users.php" class="btn btn-outline-info btn-sm">View Users</a>
                </div>
            </div>
            </div>

            <!-- Admins Card -->
            <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                <?php
                $count_select_admins=$conn->prepare("SELECT * FROM `admins`");
                $count_select_admins->execute();
                $total_admins=$count_select_admins->rowCount();
                ?>
                <div class="mb-3"><i class="bi bi-shield-lock-fill display-4 text-warning"></i></div>
                <h3><?= $total_admins; ?></h3>
                <p class="text-muted">Total Admins</p>
                <a href="admin/admins.php" class="btn btn-outline-warning btn-sm">View Admins</a>
                </div>
            </div>
            </div>

            <!-- Messages Card -->
            <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">
                <?php
                $count_select_messages=$conn->prepare("SELECT * FROM `messages`");
                $count_select_messages->execute();
                $total_messages=$count_select_messages->rowCount();
                ?>
                <div class="mb-3"><i class="bi bi-envelope-fill display-4 text-danger"></i></div>
                <h3><?= $total_messages; ?></h3>
                <p class="text-muted">Total Messages</p>
                <a href="admin/messages.php" class="btn btn-outline-danger btn-sm">View Messages</a>
                </div>
            </div>
            </div>

        </div>
        </div>
    </section>
    <!-- dashboard section end here -->
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../js/script.js"></script>
    <!-- Scripts -->
    </body>
</html>
