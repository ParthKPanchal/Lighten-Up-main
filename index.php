<?php
include 'connect.php';

if(isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = "";
}

include 'components/save_send.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lighten Up - Home</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="author" content="Gemplyte IT Solutions" />
    <meta name="keywords" content="Lighten Up,Gemplyte,Sample Project" />
    <meta name="description" content="Gemplyte Sample Project" />
    <!-- Favicon -->
    <link
      rel="shortcut icon"
      href="asset/image/logo/title.png"
      type="image/x-icon"
    />
    <!-- Bootstrap Icons CDN (put this in <head> if not already added) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/loader.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/banner.css">
    <link rel="stylesheet" type="text/css" href="css/categories.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  </head>
  <body>
    
      <?php include "components/navbar.php"; ?>
      <?php include "content/home/home-banner.php"; ?>
      <!-- search section start here -->
      <section class="search-product py-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
              <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                  <h2 class="text-center mb-4 fw-bold text-dark">
                    Tell me what do you want?
                  </h2>
                  <form action="search.php" method="POST">
                    
                    <!-- Product Name -->
                    <div class="mb-3">
                      <label class="form-label fw-semibold">Product Brand</label>
                      <input type="text" class="form-control form-control-lg" 
                        name="h_product_brand" placeholder="Enter product brand" required>
                    </div>

                    <!-- Price, Color, Size -->
                    <div class="row g-3">
                      <div class="col-md-6 col-lg-3">
                        <label class="form-label fw-semibold">Min Price</label>
                        <select name="h_min" class="form-select">
                          <option value="" disabled selected>Select Min</option>
                          <option value="0">0</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                          <option value="500">500</option>
                          <option value="1000">1000</option>
                          <option value="1500">1500</option>
                          <option value="2000">2000</option>
                          <option value="5000">5000</option>
                          <option value="10000">10000</option>
                          <option value="15000">15000</option>
                          <option value="20000">20000</option>
                          <option value="30000">30000</option>
                        </select>
                      </div>
                      
                      <div class="col-md-6 col-lg-3">
                        <label class="form-label fw-semibold">Max Price</label>
                        <select name="h_max" class="form-select">
                          <option value="" disabled selected>Select Max</option>
                          <option value="0">0</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                          <option value="500">500</option>
                          <option value="1000">1000</option>
                          <option value="1500">1500</option>
                          <option value="2000">2000</option>
                          <option value="5000">5000</option>
                          <option value="10000">10000</option>
                          <option value="15000">15000</option>
                          <option value="20000">20000</option>
                          <option value="30000">30000</option>
                        </select>
                      </div>
                      
                      <div class="col-md-6 col-lg-3">
                        <label class="form-label fw-semibold">Select Color</label>
                        <select class="form-select" name="h_color">
                          <option value="" disabled selected>Select Color</option>
                          <option>Red</option>
                          <option>Blue</option>
                          <option>Yellow</option>
                          <option>Brown</option>
                          <option>Green</option>
                          <option>Black</option>
                          <option>White</option>
                        </select>
                      </div>
                      
                      <div class="col-md-6 col-lg-3">
                        <label class="form-label fw-semibold">Select Size</label>
                        <select class="form-select" name="h_size">
                          <option value="" disabled selected>Select Size</option>
                          <option>48</option>
                          <option>56</option>
                          <option>60</option>
                        </select>
                      </div>
                    </div>

                    <!-- Search Button -->
                    <div class="d-grid mt-4">
                      <button type="submit" name="h_search" 
                        class="btn btn-dark btn-lg rounded-3">
                        🔍 Search Product
                      </button>
                    </div>
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- search section end here -->

      <?php include "content/home/home-categories.php";?>
      <?php include "content/home/home-show-product.php";?>
      <?php include "components/footer.php"; ?>
    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
    <?php
    include 'components/message.php';
    ?>
  </body>
</html>
 