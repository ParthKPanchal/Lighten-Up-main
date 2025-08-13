<?php
include 'connect.php'; // Must define $conn = new PDO(...)

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = "";
}
//select_products
//fetch_products
//product_id

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
      <section class="shop py-5 bg-light">
        <h2 class="text-center mb-5 fw-bold">All Products</h2>
        <div class="container mx-5">
          <div class="row g-4">
            <?php
              $select_products = $conn->prepare("SELECT * FROM `products` WHERE user_id = ? ORDER BY date DESC");
              $select_products->execute([$user_id]);
              if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                  $product_id = $fetch_products['id'];
            ?>
            <div class="col-md-6 col-lg-4 col-xl-3">
              <form action="" method="POST" class="h-100">
                <input type="hidden" name="product_id" value="<?= $product_id; ?>">

                <div class="card shadow-sm h-100 border-0 product-card-hover">
                  <div class="position-relative">
                    <img src="uploaded_files/<?= $fetch_products['image_01']; ?>" 
                        class="card-img-top rounded-top" 
                        alt="<?= $fetch_products['product_name']; ?>" 
                        style="height: 220px; object-fit: cover;">
                    <span class="badge bg-dark position-absolute top-0 end-0 m-2">
                      ₹<?= $fetch_products['product_price']; ?>
                    </span>
                  </div>

                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold"><?= $fetch_products['product_name']; ?></h5>
                    <p class="mb-1 text-muted small">Brand: <?= $fetch_products['product_brand']; ?></p>
                    <p class="mb-1 text-muted small">Material: <?= $fetch_products['product_material']; ?></p>
                    <p class="mb-3 text-muted small">Manufacturer: <?= $fetch_products['product_manufacturer']; ?></p>

                    <div class="mt-auto d-flex justify-content-between gap-2">
                      <a href="update_property.php?get_id=<?= $product_id; ?>" class="btn btn-outline-dark btn-sm w-100">
                        <i class="bi bi-pencil-square me-1"></i> Update
                      </a>
                      <input type="submit" name="delete_product" value="Delete" 
                            class="btn btn-outline-danger btn-sm w-100" 
                            onclick="return confirm('Are you sure you want to delete this product?');">
                    </div>
                    <a href="view_property.php?get_id=<?= $product_id; ?>" 
                      class="btn btn-dark btn-sm mt-2 w-100">
                      <i class="bi bi-eye me-1"></i> View Product
                    </a>
                  </div>
                </div>
              </form>
            </div>
            <?php
                }
              } else {
                echo '<div class="col-12 text-center"><p class="text-muted">No products available!</p></div>';
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
