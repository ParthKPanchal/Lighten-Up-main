<?php
include 'connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
   exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lighten Up - Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Favicon -->
  <link rel="shortcut icon" href="image/logo/title.png" type="image/x-icon">

  <!-- Bootstrap Icons & CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-image: url('/image/bg/bg.jpg'); background-size: cover; background-attachment: fixed;">

    <?php include "components/navbar.php"; ?>

    <!-- Dashboard section -->
    <section class="dashboard py-5">
        <div class="container-fluid px-5">
            <h1 class="text-center fw-bold text-dark">My Dashboard</h1>
            <div class="row g-4">

            <!-- User Welcome -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 h-100 d-flex">
                <div class="card-body d-flex flex-column text-center p-4">
                    <?php
                    $select_user=$conn->prepare("SELECT * FROM `users` WHERE id=? LIMIT 1");
                    $select_user->execute([$user_id]);
                    $fetch_user=$select_user->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <i class="bi bi-person-circle fs-1 text-dark mb-3"></i>
                    <h3 class="fw-bold">Welcome!</h3>
                    <p class="text-muted border rounded-2 mb-3"><?= $fetch_user['name']; ?></p>
                    <div class="mt-auto">
                    <a href="update.php" class="btn btn-dark w-100">Update Profile</a>
                    </div>
                </div>
                </div>
            </div>

            <!-- Filter Search -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 h-100 d-flex">
                <div class="card-body d-flex flex-column text-center p-4">
                    <i class="bi bi-search fs-1 text-dark mb-3"></i>
                    <h3 class="fw-bold">Filter Search</h3>
                    <p class="text-muted border rounded-2 mb-3">Search your product easily</p>
                    <div class="mt-auto">
                    <a href="search.php" class="btn btn-dark w-100">Search Now</a>
                    </div>
                </div>
                </div>
            </div>

            <!-- Products Listed -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 h-100 d-flex">
                <div class="card-body d-flex flex-column text-center p-4">
                    <?php
                    $count_products = $conn->prepare("SELECT * FROM `products` WHERE user_id = ?");
                    $count_products->execute([$user_id]);
                    $total_products = $count_products->rowCount();
                    ?>
                    <i class="bi bi-box-seam fs-1 text-dark mb-3"></i>
                    <h3 class="fw-bold"><?= $total_products; ?></h3>
                    <p class="text-muted border rounded-2">Products Listed</p>
                    <div class="mt-auto">
                    <a href="my-product.php" class="btn btn-dark w-100">My Products</a>
                    </div>
                </div>
                </div>
            </div>

            <!-- Requests Received -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 h-100 d-flex">
                <div class="card-body d-flex flex-column text-center p-4">
                    <?php
                    $count_requests_received = $conn->prepare("SELECT * FROM `requests` WHERE receiver = ?");
                    $count_requests_received->execute([$user_id]);
                    $total_requests_received = $count_requests_received->rowCount();
                    ?>
                    <i class="bi bi-inbox-fill fs-1 text-dark mb-3"></i>
                    <h3 class="fw-bold"><?= $total_requests_received; ?></h3>
                    <p class="text-muted border rounded-2">Requests Received</p>
                    <div class="mt-auto">
                    <a href="requests.php" class="btn btn-dark w-100">View Requests</a>
                    </div>
                </div>
                </div>
            </div>

            <!-- Requests Sent -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 h-100 d-flex">
                <div class="card-body d-flex flex-column text-center p-4">
                    <?php
                    $count_requests_sent = $conn->prepare("SELECT * FROM `requests` WHERE sender = ?");
                    $count_requests_sent->execute([$user_id]);
                    $total_requests_sent = $count_requests_sent->rowCount();
                    ?>
                    <i class="bi bi-send-check-fill fs-1 text-dark mb-3"></i>
                    <h3 class="fw-bold"><?= $total_requests_sent; ?></h3>
                    <p class="text-muted border rounded-2">Requests Sent</p>
                    <div class="mt-auto">
                    <a href="saved.php" class="btn btn-dark w-100">View Sent</a>
                    </div>
                </div>
                </div>
            </div>

            <!-- Saved Products -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 h-100 d-flex">
                <div class="card-body d-flex flex-column text-center p-4">
                    <?php
                    $count_saved_products = $conn->prepare("SELECT * FROM `saved` WHERE user_id = ?");
                    $count_saved_products->execute([$user_id]);
                    $total_saved_products = $count_saved_products->rowCount();
                    ?>
                    <i class="bi bi-heart-fill fs-1 text-dark mb-3"></i>
                    <h3 class="fw-bold"><?= $total_saved_products; ?></h3>
                    <p class="text-muted border rounded-2">Saved Products</p>
                    <div class="mt-auto">
                    <a href="saved.php" class="btn btn-dark w-100">View Saved</a>
                    </div>
                </div>
                </div>
            </div>

            </div>
        </div>
    </section>
    <!-- End Dashboard -->

    <?php include "components/footer.php"; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
