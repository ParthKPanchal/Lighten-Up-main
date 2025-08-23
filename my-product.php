<?php
include 'connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = "";
    header('location:login.php');
    exit;
}
if(isset($_POST['delete_product'])){

   $delete_id = $_POST['product_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_delete = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $verify_delete->execute([$delete_id]);

   if($verify_delete->rowCount() > 0){
      $select_images = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_images->execute([$delete_id]);
      while($fetch_images = $select_images->fetch(PDO::FETCH_ASSOC)){
         $image_01 = $fetch_images['image_01'];
         $image_02 = $fetch_images['image_02'];
         $image_03 = $fetch_images['image_03'];
         if(!empty($image_01)){
            unlink('uploaded_files/'.$image_01);
         }
         if(!empty($image_02)){
            unlink('uploaded_files/'.$image_02);
         }
         if(!empty($image_03)){
            unlink('uploaded_files/'.$image_03);
         }
      }
      $delete_saved = $conn->prepare("DELETE FROM `saved` WHERE product_id = ?");
      $delete_saved->execute([$delete_id]);
      $delete_requests = $conn->prepare("DELETE FROM `requests` WHERE product_id = ?");
      $delete_requests->execute([$delete_id]);
      $delete_listing = $conn->prepare("DELETE FROM `products` WHERE id = ?");
      $delete_listing->execute([$delete_id]);
      $success_msg[] = 'Product deleted successfully!';
   }else{
      $warning_msg[] = 'Product already deleted!';
   }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lighten Up - My Product</title>
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
        <div class="container-fluid px-5">
          <!-- Page Title -->
          <div class="text-center mb-5">
            <h2 class="fw-bold display-6 text-dark">📦 My Products</h2>
            <p class="text-muted">Manage and update your listed products</p>
          </div>

          <div class="row g-4">
            <?php
              $select_products = $conn->prepare("SELECT * FROM `products` WHERE user_id = ? ORDER BY date DESC");
              $select_products->execute([$user_id]);
              if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                  $product_id = $fetch_products['id'];
            ?>
            <!-- Product Card -->
            <div class="col-md-6 col-lg-4 col-xl-3">
              <form action="" method="POST" class="h-100">
                <input type="hidden" name="product_id" value="<?= $product_id; ?>">

                <div class="card shadow-lg h-100 border-0 rounded-3 product-card-hover">
                  <div class="position-relative">
                    <img src="uploaded_files/<?= $fetch_products['image_01']; ?>" 
                        class="card-img-top rounded-top" 
                        alt="<?= $fetch_products['product_name']; ?>" 
                        style="height: 220px; object-fit: cover;">
                    
                    <!-- Price Badge -->
                    <span class="badge bg-dark position-absolute top-0 start-0 m-2 px-3 py-2 fs-6 shadow">
                      ₹<?= $fetch_products['product_price']; ?>
                    </span>
                  </div>

                  <div class="card-body d-flex flex-column">
                    <!-- Title -->
                    <h5 class="card-title fw-bold text-dark text-truncate">
                      <?= $fetch_products['product_name']; ?>
                    </h5>

                    <!-- Meta info -->
                    <p class="mb-1 text-muted small"><i class="bi bi-tags"></i> Brand: <?= $fetch_products['product_brand']; ?></p>
                    <p class="mb-1 text-muted small"><i class="bi bi-box"></i> Material: <?= $fetch_products['product_material']; ?></p>
                    <p class="mb-3 text-muted small"><i class="bi bi-building"></i> Manufacturer: <?= $fetch_products['product_manufacturer']; ?></p>

                    <!-- Buttons -->
                    <div class="mt-auto">
                      <div class="d-flex gap-2">
                        <a href="update_product.php?get_id=<?= $product_id; ?>" 
                          class="btn btn-outline-primary btn-sm w-100">
                          <i class="bi bi-pencil-square me-1"></i> Update
                        </a>
                        <button type="submit" name="delete_product" 
                          class="btn btn-outline-danger btn-sm w-100"
                          onclick="return confirm('Are you sure you want to delete this product?');">
                          <i class="bi bi-trash me-1"></i> Delete
                        </button>
                      </div>
                      <a href="view_products.php?get_id=<?= $product_id; ?>" 
                        class="btn btn-dark btn-sm mt-3 w-100">
                        <i class="bi bi-eye me-1"></i> View Product
                      </a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <?php
                }
              } else {
                echo '<div class="col-12"><h4 class="alert alert-secondary text-center shadow-sm">No products available!</h4></div>';
              }
            ?>
          </div>
        </div>
      </section>


      <!-- shop section end here -->
      <?php include "components/footer.php"; ?>

    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Custom JS -->
    <script src="js/script.js"></script>
    <script src="js/shop.js"></script>
    <?php
    include 'components/message.php';
    ?>
  </body>
</html>
