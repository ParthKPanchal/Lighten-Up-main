<?php
include 'connect.php'; // Must define $conn = new PDO(...)

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = "";
}
include 'components/save_send.php';

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
      <section class="shop-product py-5">
        <div class="container-fluid px-5">
          <h1 class="text-center mb-5 fw-bold">All Products</h1>
          <div class="row g-4">
            <?php
              $total_images = 0;
              $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY date DESC");
              $select_products->execute();
              if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

                  $select_admins = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
                  $select_admins->execute([$fetch_products['admin_id']]);
                  $fetch_user = $select_admins->fetch(PDO::FETCH_ASSOC);

                  $image_count_02 = !empty($fetch_products['image_02']) ? 1 : 0;
                  $image_count_03 = !empty($fetch_products['image_03']) ? 1 : 0;
                  $total_images = (1 + $image_count_02 + $image_count_03);

                  $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE product_id = ? AND user_id = ?");
                  $select_saved->execute([$fetch_products['id'], $user_id]);
            ?>
            <div class="col-md-6 col-lg-4 col-xl-3">
              <form action="" method="POST" class="h-100">
                <input type="hidden" name="product_id" value="<?= ($fetch_products['id']); ?>">
                
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                  
                  <!-- Product Image -->
                  <div class="position-relative overflow-hidden" style="height:250px;">
                    <?php if(!empty($fetch_products['image_01'])): ?>
                      <img src="uploaded_files/<?= ($fetch_products['image_01']); ?>" 
                          class="w-100 h-100 object-fit-cover transition" 
                          alt="">
                    <?php else: ?>
                      <img src="asset/image/no-image.png" 
                          class="w-100 h-100 object-fit-cover transition" 
                          alt="No image available">
                    <?php endif; ?>

                    <!-- Image Count -->
                    <span class="badge bg-dark position-absolute top-0 start-0 m-2 rounded-pill px-2">
                      <i class="bi bi-images"></i> <?= $total_images; ?>
                    </span>

                    <!-- Wishlist Button -->
                    <?php if($select_saved->rowCount()>0){ ?>
                      <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 rounded-circle" type="submit" name="save">
                        <i class="bi bi-heart-fill"></i>
                      </button>
                    <?php } else { ?>
                      <button class="btn btn-light btn-sm position-absolute top-0 end-0 m-2 rounded-circle shadow-sm" type="submit" name="save">
                        <i class="bi bi-heart"></i>
                      </button>
                    <?php } ?>
                  </div>

                  <!-- Card Body -->
                  <div class="card-body d-flex flex-column p-3">
                    
                    <!-- Seller Info -->
                    <div class="d-flex align-items-center mb-3">
                      <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" 
                          style="width:40px; height:40px; font-weight:bold;">
                        <?= ($fetch_user ? substr($fetch_user['name'], 0, 1) : "?"); ?>
                      </div>
                      <div class="ms-2">
                        <p class="mb-0 fw-semibold small"><?= ($fetch_user['name'] ?? "Unknown"); ?></p>
                        <small class="text-muted"><?= ($fetch_products['date']); ?></small>
                      </div>
                    </div>

                    <!-- Product Name -->
                    <h6 class="card-title fw-bold text-truncate"><?= ($fetch_products['product_name']); ?></h6>
                    
                    <!-- Price -->
                    <p class="h5 fw-bold text-success mb-2">
                      ₹ <?= number_format($fetch_products['product_price']); ?>
                    </p>

                    <!-- Product Specs -->
                    <ul class="list-unstyled small text-muted mb-3">
                      <li><span class="fw-semibold">Brand:</span> <?= ($fetch_products['product_brand']); ?></li>
                      <li><span class="fw-semibold">Material:</span> <?= ($fetch_products['product_material']); ?></li>
                      <li><span class="fw-semibold">Manufacturer:</span> <?= ($fetch_products['product_manufacturer']); ?></li>
                    </ul>

                    <!-- Action Buttons -->
                    <div class="mt-auto d-flex gap-2">
                      <a href="view_products.php?get_id=<?= ($fetch_products['id']); ?>" 
                        class="btn btn-outline-dark btn-sm flex-fill rounded-3">
                        View
                      </a>
                      <button type="submit" name="add_to_cart" 
                              class="btn btn-warning btn-sm flex-fill rounded-3 text-dark fw-bold">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                      </button>
                      <button type="submit" name="buy_now" 
                              class="btn btn-success btn-sm flex-fill rounded-3 fw-bold">
                        Buy Now
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <?php
                }
              }else{
                echo '<div class="col-12"><h4 class="alert alert-secondary text-center shadow-sm">No products added yet!</h4></div>';
              }
            ?>
          </div>

          
        </div>
      </section>
      <!-- shop product end here -->


      <!-- shop section end here -->
      <?php include "components/footer.php"; ?>

    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
    <script src="js/shop.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php
    include 'components/message.php';
    ?>
  </body>
</html>
