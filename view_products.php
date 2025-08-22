<?php

include 'connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}
if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:index.php');
}
include 'components/save_send.php';
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
          <h1 class="text-center">Property Details</h1>
          <div class="row g-5 align-items-start">
            <!-- 🖼️ Product Image Carousel -->
            <div class="col-lg-6">
              <?php
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ? ORDER BY date DESC LIMIT 1");
                $select_products->execute([$get_id]);
                if($select_products->rowCount() > 0){
                  while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){

                  $product_id = $fetch_product['id'];

                  $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                  $select_user->execute([$fetch_product['user_id']]);
                  $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

                  $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE product_id = ? and user_id = ?");
                  $select_saved->execute([$fetch_product['id'], $user_id]);
              ?>
              <!-- Main Carousel -->
              <div id="mainCarousel" class="carousel slide main-carousel mb-3" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img id="carousel-img1" src="uploaded_files/<?= $fetch_product['image_01']; ?>" class="d-block w-100" alt="View 1">
                  </div>
                  <div class="carousel-item">
                    <?php if(!empty($fetch_product['image_02'])){ ?>
                    <img id="carousel-img2" src="uploaded_files/<?= $fetch_product['image_02']; ?>" class="d-block w-100" alt="View 2">
                    <?php } ?>
                  </div>
                  <div class="carousel-item">
                    <?php if(!empty($fetch_product['image_03'])){ ?>
                    <img id="carousel-img3" src="uploaded_files/<?= $fetch_product['image_03']; ?>" class="d-block w-100" alt="View 3">
                    <?php } ?>
                  </div>
                </div>
                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>

              <!-- 🔍 Thumbnail Images -->
              <div class="d-flex justify-content-between thumb-carousel">
                <div class="thumb col-4 px-1">
                  <img id="thumb-img1" src="uploaded_files/<?= $fetch_product['image_01']; ?>" class="img-fluid" alt="Thumbnail 1">
                </div>
                <div class="thumb col-4 px-1">
                  <?php if(!empty($fetch_product['image_02'])){ ?>
                  <img id="thumb-img2" src="uploaded_files/<?= $fetch_product['image_02']; ?>" class="img-fluid" alt="Thumbnail 2">
                  <?php } ?>
                </div>
                <div class="thumb col-4 px-1">
                  <?php if(!empty($fetch_product['image_03'])){ ?>
                  <img id="thumb-img3" src="uploaded_files/<?= $fetch_product['image_03']; ?>" class="img-fluid" alt="Thumbnail 3">
                  <?php } ?>
                </div>
              </div>
            </div>

            <!-- 📄 Product Details -->
            <div class="col-lg-6">
              <h1 class="fw-bold mb-3"><?= $fetch_product['product_name']; ?></h1>
              <h4 class="text-muted">MRP: <i class="fas fa-indian-rupee-sign"></i><span><?= $fetch_product['product_price']; ?></span></h4>
              <p class="text-muted">Price inclusive of all taxes</p>

              <!-- 🎨 Color Selection -->
              <h5 class="mt-4 mb-2 fw-semibold">Available Colors</h5>
              <div class="d-flex gap-2 mb-4">
                  <?php 
                  // Example DB value: "White,Steel Grey,Rich Brown"
                  $colors = explode(',', $fetch_product['color']); 
                  
                  foreach($colors as $color): 
                      $color = trim($color); // remove spaces
                  ?>
                      <a href="#!" 
                        class="rounded-circle border" 
                        style="width:35px; height:35px; display:inline-block; background-color: <?= strtolower($color); ?>;" 
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top" 
                        title="<?= htmlspecialchars($color); ?>">
                      </a>
                  <?php endforeach; ?>
              </div>


              <!-- 🔘 Size Selection -->
              <h5 class="mt-4 mb-2 fw-semibold">Available Sizes</h5>
              <div class="d-flex gap-2 mb-4">
                  <?php 
                  // explode comma-separated sizes from DB
                  $sizes = explode(',', $fetch_product['size']); 
                  
                  foreach($sizes as $size): 
                      $size = trim($size); // remove extra spaces
                  ?>
                      <h1 class="fw-bold mb-3"><?= $size; ?></h1>
                  <?php endforeach; ?>
              </div>

              <!-- 🛒 CTA -->
              <button class="btn btn-dark px-4 py-2">Buy Now</button>

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
                <li><i class="fas fa-<?php if($fetch_product['available'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i> Available both online and in-store</li>
                <li><i class="fas fa-<?php if($fetch_product['rated'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i> Highly rated by customers</li>
                <li><i class="fas fa-<?php if($fetch_product['installation'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i> Comes with a manufacturer warranty</li>
                <li><i class="fas fa-<?php if($fetch_product['warranty'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i> Includes installation and after-sales support</li>
              </ul>
              
            </div>
            <form action="" method="post" class="flex-btn">
            <input type="hidden" name="property_id" value="<?= $product_id; ?>">
            <?php
                if($select_saved->rowCount() > 0){
            ?>
            <button type="submit" name="save" class="save"><i class="fas fa-heart"></i><span>saved</span></button>
            <?php
                }else{ 
            ?>
            <button type="submit" name="save" class="save"><i class="far fa-heart"></i><span>save</span></button>
            <?php
                }
            ?>
            <input type="submit" value="send enquiry" name="send" class="btn">
          </form>
          <?php
                  } // <-- close while loop here
                }else{
                  echo '<p class="empty">property not found! <a href="post_property.php" style="margin-top:1.5rem;" class="btn">add new</a></p>';
                }
              ?>
      </section>

        <!-- view product section end here -->
      <?php include "components/footer.php"; ?>
    
    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>             
    <!-- Custom JS -->
    <script src="js/script.js"></script>
    <script>

      var swiper = new Swiper(".images-container", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        loop:true,
        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 200,
            modifier: 3,
            slideShadows: true,
        },
        pagination: {
            el: ".swiper-pagination",
        },
      });

    </script>
    <?php
    include 'components/message.php';
    ?>
  </body>
</html>