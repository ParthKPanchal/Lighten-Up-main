<?php
include 'connect.php'; // Must define $conn = new PDO(...)

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = "";
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lighten Up - Shop</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="author" content="Gemplyte IT Solutions" />
    <meta name="keywords" content="Lighten Up,Gemplyte,Sample Project" />
    <meta name="description" content="Gemplyte Sample Project" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="image/logo/title.png" type="image/x-icon" />

    <!-- Bootstrap Icons CDN (put this in <head> if not already added) -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
    />
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/loader.css" />
    <link rel="stylesheet" type="text/css" href="css/home-banner.css" />
    <link rel="stylesheet" type="text/css" href="css/home-product.css" />
    <link rel="stylesheet" type="text/css" href="css/home-about.css" />
    <link rel="stylesheet" type="text/css" href="css/home-contact.css" />
    <link rel="stylesheet" type="text/css" href="css/home-categories.css" />
    <link rel="stylesheet" type="text/css" href="css/home-view-product.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Google font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&family=Spectral:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
      <?php include "components/navbar.php"; ?>
      <!-- shop section start here -->
      <section class="shop py-5">
        <div class="container my-5">
            <h2 class="text-center mb-4">All Categories</h2>
            <div class="product-grid">
            <?php
              $select_categories = $conn->prepare("SELECT * FROM `products` WHERE user_id = ? ORDER BY date DESC");
              $select_categories->execute([$user_id]);
              if($select_categories->rowCount()>0){
                while($fetch_categories=$select_categories->fetch(PDO::FETCH_ASSOC)){
              $product_id = $fetch_categories['id'];
              if(!empty($fetch_categories['image_02'])) {
                $image_02 = 1;
              } else {
                $image = 'uploaded_img/default.png';
              }
            ?>
            <?php
                }
              }else{
                  echo '<p class="empty">No products available!</p>';
                }
            ?>
            </div>
        </div>
      </section>

      <!-- shop section end here -->
      <?php include "components/footer.php"; ?>

    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
    <script src="js/shop.js"></script>
    <?php
    include 'components/message.php';
    ?>
  </body>
</html>
