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
  <title>Lighten Up - Activity</title>
  <!-- Meta -->
  <meta name="format-detection" content="telephone=no" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="author" content="Gemplyte IT Solutions" />
  <meta name="keywords" content="Lighten Up, Gemplyte, Sample Project" />
  <meta name="description" content="Gemplyte Sample Project" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="asset/image/logo/title.png" type="image/x-icon" />

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/loader.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/banner.css">
  <link rel="stylesheet" href="css/search.css">
  <link rel="stylesheet" href="css/categories.css">
  <link rel="stylesheet" href="css/show-product.css">
  <link rel="stylesheet" href="css/style.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <?php include "components/navbar.php"; ?>

    <!-- Dashboard section -->
    <section class="dashboard py-5">
        <div class="container-fluid px-5">
            <h1 class="text-center fw-bold text-dark">My Activity</h1>
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
