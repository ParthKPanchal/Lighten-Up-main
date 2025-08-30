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
if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:index.php');
    exit; // ✅ always exit after header redirect
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lighten Up - Admin View Product</title>
  <meta name="format-detection" content="telephone=no" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="author" content="Gemplyte IT Solutions" />
  <meta name="keywords" content="Lighten Up, Gemplyte, Sample Project" />
  <meta name="description" content="Gemplyte Sample Project" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="../asset/image/logo/title.png" type="image/x-icon" />

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../css/loader.css">
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/admin_navbar.css">
  <link rel="stylesheet" href="../css/banner.css">
  <link rel="stylesheet" href="../css/search.css">
  <link rel="stylesheet" href="../css/categories.css">
  <link rel="stylesheet" href="../css/show-product.css">
  <link rel="stylesheet" href="../css/style.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <?php include __DIR__ . '/../components/admin_navbar.php'; ?>

  <!-- view product section -->
  <section class="view-product py-5" id="white-view-product">
    <div class="container bg-light p-5 rounded-3 shadow-lg">
      <h1 class="text-center">Property Details</h1>
      <div class="row g-5 align-items-start">
        
        <!-- 🖼️ Product Image Carousel -->
        <div class="col-lg-6">
          <?php
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ? ORDER BY date DESC LIMIT 1");
            $select_products->execute([$get_id]);

            if ($select_products->rowCount() > 0) {
              while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                $product_id = $fetch_product['id'];

                $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_user->execute([$fetch_product['admin_id']]);
                $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

                $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE product_id = ? and user_id = ?");
                $select_saved->execute([$fetch_product['id'], $admin_id]);
          ?>
          <!-- Main Carousel -->
          <div id="mainCarousel" class="carousel slide main-carousel mb-3" data-bs-ride="carousel">
            <div class="carousel-inner rounded-3">
              <div class="carousel-item active">
                <img src="../uploaded_files/<?= $fetch_product['image_01']; ?>" class="d-block w-100" alt="View 1">
              </div>
              <?php if (!empty($fetch_product['image_02'])) { ?>
              <div class="carousel-item">
                <img src="../uploaded_files/<?= $fetch_product['image_02']; ?>" class="d-block w-100" alt="View 2">
              </div>
              <?php } ?>
              <?php if (!empty($fetch_product['image_03'])) { ?>
              <div class="carousel-item">
                <img src="../uploaded_files/<?= $fetch_product['image_03']; ?>" class="d-block w-100" alt="View 3">
              </div>
              <?php } ?>
            </div>
            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

          <!-- 🔍 Thumbnails -->
          <div class="d-flex justify-content-between thumb-carousel">
            <div class="thumb col-4 px-1">
              <img src="../uploaded_files/<?= $fetch_product['image_01']; ?>" class="img-fluid rounded-3" alt="Thumbnail 1">
            </div>
            <?php if (!empty($fetch_product['image_02'])) { ?>
            <div class="thumb col-4 px-1">
              <img src="../uploaded_files/<?= $fetch_product['image_02']; ?>" class="img-fluid rounded-3" alt="Thumbnail 2">
            </div>
            <?php } ?>
            <?php if (!empty($fetch_product['image_03'])) { ?>
            <div class="thumb col-4 px-1">
              <img src="../uploaded_files/<?= $fetch_product['image_03']; ?>" class="img-fluid rounded-3" alt="Thumbnail 3">
            </div>
            <?php } ?>
          </div>
        </div>

        <!-- 📄 Product Details -->
        <div class="col-lg-6">
          <h1 class="fw-bold mb-3"><?= $fetch_product['product_name']; ?></h1>
          <h4 class="text-muted">MRP: <i class="bi bi-currency-rupee"></i><span><?= $fetch_product['product_price']; ?></span></h4>
          <p class="text-muted">Price inclusive of all taxes</p>

          <!-- 🎨 Colors -->
          <h5 class="mt-4 mb-2 fw-semibold">Available Colors</h5>
          <div class="d-flex gap-2 mb-4">
            <?php foreach (explode(',', $fetch_product['color']) as $color): ?>
              <span class="rounded-circle border" style="width:35px; height:35px; background-color: <?= strtolower(trim($color)); ?>;" title="<?= htmlspecialchars(trim($color)); ?>"></span>
            <?php endforeach; ?>
          </div>

          <!-- 🔘 Sizes -->
          <h5 class="mt-4 mb-2 fw-semibold">Available Sizes</h5>
          <div class="d-flex gap-2 mb-4">
            <?php foreach (explode(',', $fetch_product['size']) as $size): ?>
              <span class="badge bg-light text-dark border px-3 py-2"><?= trim($size); ?></span>
            <?php endforeach; ?>
          </div>

          <!-- 🛒 Buttons -->
          <div class="d-flex gap-3 my-4 flex-wrap">
            <button class="btn btn-dark px-4 py-2">
              Buy Now
            </button>
          </div>

          <!-- 🧾 Specifications -->
          <h4 class="mt-4">Product Specifications</h4>
          <ul class="list-unstyled">
            <li><strong>Brand:</strong> <?= $fetch_product['product_brand']; ?></li>
            <li><strong>Material:</strong> <?= $fetch_product['product_material']; ?></li>
            <li><strong>Manufacturer:</strong> <?= $fetch_product['product_manufacturer']; ?></li>
          </ul>

          <!-- ⭐ Features -->
          <h4 class="mt-4">Why You'll Love It</h4>
          <ul class="list-unstyled">
            <li>
              <i class="bi <?= $fetch_product['available'] == 'on' ? 'bi-check-circle text-success' : 'bi-x-circle text-danger'; ?>"></i>
              Available both online and in-store
            </li>
            <li>
              <i class="bi <?= $fetch_product['rated'] == 'on' ? 'bi-check-circle text-success' : 'bi-x-circle text-danger'; ?>"></i>
              Highly rated by customers
            </li>
            <li>
              <i class="bi <?= $fetch_product['installation'] == 'on' ? 'bi-check-circle text-success' : 'bi-x-circle text-danger'; ?>"></i>
              Comes with a manufacturer warranty
            </li>
            <li>
              <i class="bi <?= $fetch_product['warranty'] == 'on' ? 'bi-check-circle text-success' : 'bi-x-circle text-danger'; ?>"></i>
              Includes installation and after-sales support
            </li>
          </ul>

          
        </div>
        <?php
              } // end while
            } else {
              echo '<p class="empty">property not found! <a href="post_property.php" class="btn mt-3">Add New</a></p>';
            }
          ?>
      </div>
    </div>
  </section>


  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="js/script.js"></script>

  <?php include '../components/message.php'; ?>
</body>
</html>
