<?php

include 'connect.php';

echo create_unique_id();

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
    <title>Lighten Up - Login</title>
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
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  </head>
  <body>
    
        <?php include "components/navbar.php"; ?>
        <!-- search section start here -->
        <section class="filter-product py-5">
            <div class="container-fluid">
                <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm form-card animate-fade-up">
                    <form action="" method="POST" enctype="multipart/form-data">
                        
                        <h2 class="text-center fw-bold mb-4">Filter search</h2>
                        <div class="row g-3">
                        
                        <!-- Product Name -->
                        <div class="col-lg-4 col-md-6">
                            <label class="form-label fw-semibold">Product Name</label>
                            <input type="text" class="form-control" name="h_product_name" placeholder="Enter product name">
                        </div>
                        
                        <!-- Min Price -->
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label fw-semibold">Min Price</label>
                            <select name="h_min" class="form-select">
                            <option value="" disabled selected>Select Min</option>
                            <option value="0">0</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                            <option value="1000">1k</option>
                            <option value="1500">1.5k</option>
                            <option value="2000">2k</option>
                            <option value="5000">5k</option>
                            <option value="10000">10k</option>
                            <option value="15000">15k</option>
                            <option value="20000">20k</option>
                            <option value="30000">30k</option>
                        </select>
                        </div>
                        
                        <!-- Max Price -->
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label fw-semibold">Max Price</label>
                            <select name="h_max" class="form-select">
                            <option value="" disabled selected>Select Max</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                            <option value="1000">1k</option>
                            <option value="1500">1.5k</option>
                            <option value="2000">2k</option>
                            <option value="5000">5k</option>
                            <option value="10000">10k</option>
                            <option value="15000">15k</option>
                            <option value="20000">20k</option>
                            <option value="30000">30k</option>
                            </select>
                        </div>
                        
                        <!-- Select Color -->
                        <div class="col-lg-2 col-md-6">
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
                        
                        <!-- Select Size -->
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label fw-semibold">Select Size</label>
                            <select class="form-select" name="h_size">
                            <option value="" disabled selected>Select Size</option>
                            <option>48</option>
                            <option>56</option>
                            <option>60</option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <label class="form-label fw-semibold">Brand</label>
                            <input type="text" class="form-control" name="h_product_brand" placeholder="e.g. Philips">
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <label class="form-label fw-semibold">Material</label>
                            <input type="text" class="form-control" name="h_product_material" placeholder="e.g. Plastic">
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <label class="form-label fw-semibold">Manufacturer</label>
                            <input type="text" class="form-control" name="h_product_manufacturer" placeholder="e.g. Bajaj">
                        </div>
                        </div>

                        <div class="mt-5">
                        <button type="submit" class="btn btn-dark w-100 btn-lg shadow-sm" name="filter_search">
                            Search
                        </button>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>
        </section>

        <!-- search section start here -->
         <div id="filter-btn" class="fas fa-filter"></div>
        <?php
        if(isset($_POST['h_search'])) {
            $h_product_name=$_POST['h_product_name'];
            $h_product_name=filter_var($h_product_name,FILTER_SANITIZE_STRING);

            $h_min=$_POST['h_min'];
            $h_min=filter_var($h_min,FILTER_SANITIZE_STRING);

            $h_max=$_POST['h_max'];
            $h_max=filter_var($h_max,FILTER_SANITIZE_STRING);

            $h_color=$_POST['h_color'];
            $h_color=filter_var($h_color,FILTER_SANITIZE_STRING);

            $h_size=$_POST['h_size'];
            $h_size=filter_var($h_size,FILTER_SANITIZE_STRING);

            $h_size=$_POST['h_size'];
            $h_size=filter_var($h_size,FILTER_SANITIZE_STRING);

            $h_product_brand=$_POST['h_product_brand'];
            $h_product_brand=filter_var($h_product_brand,FILTER_SANITIZE_STRING);
            
            $h_product_material=$_POST['h_product_material'];
            $h_product_material=filter_var($h_product_material,FILTER_SANITIZE_STRING);
            
            $h_product_manufacturer=$_POST['h_product_manufacturer'];
            $h_product_manufacturer=filter_var($h_product_manufacturer,FILTER_SANITIZE_STRING);

             $select_products = $conn->prepare("SELECT * FROM `products` WHERE product_name LIKE '%{$h_product_name}%' AND color LIKE '%{$h_color}%' AND size LIKE '%{$h_size}%' AND product_brand LIKE '%{$h_product_brand}%' AND product_manufacturer LIKE '%{$h_product_manufacturer}%' AND product_price BETWEEN $h_min AND $h_max ORDER BY date DESC");
             $select_products->execute();
            }elseif(isset($_POST['filter_search'])){
                $product_name=$_POST['h_product_name'];
                $product_name=filter_var($product_name,FILTER_SANITIZE_STRING);

                $min=$_POST['h_min'];
                $min=filter_var($min,FILTER_SANITIZE_STRING);

                $max=$_POST['h_max'];
                $max=filter_var($max,FILTER_SANITIZE_STRING);

                $color=$_POST['h_color'];
                $color=filter_var($color,FILTER_SANITIZE_STRING);

                $size=$_POST['h_size'];
                $size=filter_var($size,FILTER_SANITIZE_STRING);

                $product_brand=$_POST['h_product_brand'];
                $product_brand=filter_var($product_brand,FILTER_SANITIZE_STRING);
                
                $product_material=$_POST['h_product_material'];
                $product_material=filter_var($product_material,FILTER_SANITIZE_STRING);
                
                $product_manufacturer=$_POST['h_product_manufacturer'];
                $product_manufacturer=filter_var($product_manufacturer,FILTER_SANITIZE_STRING);

                $select_products = $conn->prepare("SELECT * FROM `products` WHERE product_name LIKE '%{$product_name}%' AND color LIKE '%{$color}%' AND size LIKE '%{$size}%' AND product_brand LIKE '%{$product_brand}%' AND product_manufacturer LIKE '%{$product_manufacturer}%' AND product_price BETWEEN $min AND $max ORDER BY date DESC");
                $select_products->execute();
            }else{
                $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY date DESC LIMIT 6");
            }
           
          
        ?>
        <!-- search section end here -->
        
        <!-- show product start here -->
        <section class="filter-product py-5">
            <?php 
                if(isset($_POST['h_search']) or isset($_POST['filter_search'])){
                    echo '<h1 class="heading">search results</h1>';
                }else{
                    echo '<h1 class="heading">latest listings</h1>';
                }
            ?>
            <div class="container">
                <h1 class="text-center mb-5 fw-bold">Filter Products</h1>
                <div class="row g-4">
                    <?php
                        $total_images = 0;
                        if($select_products->rowCount() > 0){
                            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){

                            $select_users = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                            $select_users->execute([$fetch_product['user_id']]);
                            $fetch_user = $select_users->fetch(PDO::FETCH_ASSOC);

                            $image_count_02 = !empty($fetch_product['image_02']) ? 1 : 0;
                            $image_count_03 = !empty($fetch_product['image_03']) ? 1 : 0;
                            $total_images = (1 + $image_count_02 + $image_count_03);

                            $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE product_id = ? and user_id = ?");
                            $select_saved->execute([$fetch_product['id'], $user_id]);
                    ?>
                    <form action="" method="POST" class="h-100">
                        <div class="card shadow-sm border-0 h-100">
                            <input type="hidden" name="product_id" value="<?= ($fetch_product['id']); ?>">
                            <?php
                                if($select_saved->rowCount() > 0){
                            ?>
                            <button class="btn btn-danger position-absolute top-0 end-0 m-2 rounded-2" type="submit" name="save">
                            <i class="bi bi-heart-fill"></i>
                            </button>
                            <?php
                                }else{ 
                            ?>
                            <button class="btn btn-light position-absolute top-0 end-0 m-2 rounded-2" type="submit" name="save">
                                <i class="bi bi-heart"></i>
                            </button>
                           
                            <?php } ?>
                            <div class="thumb">
                                <p class="total-images"><i class="bi bi-image"></i><span><?= $total_images; ?></span></p> 
                                <img src="uploaded_files/<?= $fetch_property['image_01']; ?>" alt="">
                            </div>
                            <div class="admin">
                                <h3><?= substr($fetch_user['name'], 0, 1); ?></h3>
                                <div>
                                    <p><?= $fetch_user['name']; ?></p>
                                    <span><?= $fetch_property['date']; ?></span>
                                </div>
                            </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <h5 class="card-title fw-bold"><?= ($fetch_product['product_name']); ?></h5>
                            <p class="text-dark h5 mb-3"><i class="fas fa-indian-rupee-sign"></i> <?= ($fetch_product['product_price']); ?></p>

                            <ul class="list-unstyled text-muted small mb-4">
                                <li>Brand: <?= ($fetch_product['product_brand']); ?></li>
                                <li>Material: <?= ($fetch_product['product_material']); ?></li>
                                <li>Manufacturer: <?= ($fetch_product['product_manufacturer']); ?></li>
                            </ul>
                            </div>

                           

                            <!-- Action Buttons -->
                            <div class="mt-auto d-flex gap-2">
                                <a href="view_products.php?get_id=<?= ($fetch_product['id']); ?>" class="btn btn-outline-dark flex-fill">View</a>
                                <input type="submit" value="Enquiry" name="send" class="btn btn-dark flex-fill">
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                    }
                    }else{
                    echo '<p class="empty text-center">No results found!</p>';
                    }
                ?>
                </div>

            </div>
        </section>
        <!-- show product end here -->
         
        <?php include "components/footer.php"; ?>
        
    <!-- SweetAlert2 CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
    <?php
    include 'components/message.php';
    ?>
    <script>
        let range = document.querySelector("#range");
        range.oninput = () =>{
            document.querySelector('#output').innerHTML = range.value;
        }
    </script>
  </body>
</html>
