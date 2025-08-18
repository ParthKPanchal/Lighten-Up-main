<?php

include 'connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}
// Get product ID from URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid product ID.");
}
$product_id = (int) $_GET['id'];

// Fetch product details
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Product not found.");
}
?>
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lighten Up - View Product</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="Gemplyte IT Solutions">
    <meta name="keywords" content="Lighten Up,Gemplyte,Sample Project">
    <meta name="description" content="Gemplyte Sample Project">
    <!-- Favicon -->
    <link rel="shortcut icon" href="image/logo/title.png" type="image/x-icon">

    <!-- Bootstrap Icons CDN (put this in <head> if not already added) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/loader.css">
    <link rel="stylesheet" type="text/css" href="css/home-banner.css">
    <link rel="stylesheet" type="text/css" href="css/home-product.css">
    <link rel="stylesheet" type="text/css" href="css/home-about.css">
    <link rel="stylesheet" type="text/css" href="css/home-contact.css">
    <link rel="stylesheet" type="text/css" href="css/home-categories.css">
    <link rel="stylesheet" type="text/css" href="css/home-view-product.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  </head>
  <body style="background-image: url('/image/bg/bg.jpg'); background-size: container;">
    
      <?php include "components/navbar.php"; ?>
      
      <!-- view product section start here -->
      <section class="view-product mt-5 py-5" id="white-view-product">
          <div class="container">
            <div class="row g-5 align-items-start">
              <!-- 🖼️ Product Image Carousel -->
              <div class="col-lg-6">
                <div id="mainCarousel" class="carousel slide main-carousel mb-3" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    <?php
                    $images = explode(",", $product['images']); // Assuming images stored as comma-separated list
                    foreach ($images as $index => $img) {
                        $active = $index === 0 ? "active" : "";
                        echo "<div class='carousel-item $active'>
                                <img src='$img' class='d-block w-100' alt='View " . ($index + 1) . "'>
                              </div>";
                    }
                    ?>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>

                <!-- Thumbnails -->
                <div class="d-flex justify-content-between thumb-carousel">
                  <?php
                  foreach ($images as $img) {
                      echo "<div class='thumb col-4 px-1'>
                              <img src='$img' class='img-fluid' alt='Thumbnail'>
                            </div>";
                  }
                  ?>
                </div>
              </div>

              <!-- 📄 Product Details -->
              <div class="col-lg-6">
                <h1 class="fw-bold mb-3"><?php echo htmlspecialchars($product['name']); ?></h1>
                <h4 class="text-muted">MRP: ₹<?php echo number_format($product['price'], 2); ?></h4>
                <p class="text-muted">Price inclusive of all taxes</p>

                <!-- Color Selection -->
                <h5 class="mt-4 mb-2 fw-semibold">Available Colors</h5>
                <div class="d-flex gap-2 mb-4">
                  <?php
                  $colors = explode(",", $product['colors']);
                  foreach ($colors as $color) {
                      echo "<div class='p-3 border rounded' style='background-color:$color;'></div>";
                  }
                  ?>
                </div>

                <!-- Sizes -->
                <h5 class="mt-4 mb-2 fw-semibold">Available Sizes</h5>
                <div class="d-flex flex-wrap gap-2 mb-4">
                  <?php
                  $sizes = explode(",", $product['sizes']);
                  foreach ($sizes as $index => $size) {
                      $active = $index === 0 ? "active" : "";
                      echo "<button class='btn btn-outline-dark size-option $active' data-size='$size'>$size</button>";
                  }
                  ?>
                </div>

                <!-- Buy Button -->
                <button class="btn btn-dark px-4 py-2">Buy Now</button>

                <!-- Features -->
                <h4 class="mt-4">Why You'll Love It</h4>
                <ul class="list-unstyled">
                  <?php
                  $features = explode("\n", $product['features']);
                  foreach ($features as $feature) {
                      echo "<li><i class='bi bi-check-circle-fill me-2'></i>" . htmlspecialchars($feature) . "</li>";
                  }
                  ?>
                </ul>

                <!-- Specifications -->
                <h4 class="mt-4">Product Specifications</h4>
                <ul class="list-unstyled">
                  <li><strong>Brand:</strong> <?php echo htmlspecialchars($product['brand']); ?></li>
                  <li><strong>Color:</strong> <?php echo htmlspecialchars($product['main_color']); ?></li>
                  <li><strong>Material:</strong> <?php echo htmlspecialchars($product['material']); ?></li>
                  <li><strong>Manufacturer:</strong> <?php echo htmlspecialchars($product['manufacturer']); ?></li>
                </ul>
              </div>
            </div>
          </div>
        </section>
        <!-- view product section end here -->
      <?php include "components/footer.php"; ?>
    
    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>             
    <!-- Custom JS -->
    <script src="js/script.js"></script>
    <script src="js/view-product.js"></script>
    <?php
    include 'components/message.php';
    ?>
  </body>
</html>