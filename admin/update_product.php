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

if(isset($_POST['update_product'])) {

  $update_id = $_POST['product_id'];
  $update_id= filter_var($update_id, FILTER_SANITIZE_STRING);
  $product_name  = $_POST['product_name'];
  $product_name  = filter_var($product_name , FILTER_SANITIZE_STRING);
  $product_price = $_POST['product_price'];
  $product_price = filter_var($product_price, FILTER_SANITIZE_STRING);
  $category = $_POST['category'];
  $category = filter_var($category, FILTER_SANITIZE_STRING);
  $color  = $_POST['color'];
  $color  = filter_var($color , FILTER_SANITIZE_STRING);
  $size = $_POST['size'];
  $size = filter_var($size, FILTER_SANITIZE_STRING);
  $product_brand = $_POST['product_brand'];
  $product_brand = filter_var($product_brand, FILTER_SANITIZE_STRING);
  $product_material = $_POST['product_material'];
  $product_material = filter_var($product_material, FILTER_SANITIZE_STRING);
  $product_manufacturer = $_POST['product_manufacturer'];
  $product_manufacturer = filter_var($product_manufacturer, FILTER_SANITIZE_STRING);

  if(isset($_POST['available'])){
      $available = $_POST['available'];
      $available = filter_var($available, FILTER_SANITIZE_STRING);
  }else{
      $available = 'off';
  }
  if(isset($_POST['rated'])){
      $rated = $_POST['rated'];
      $rated = filter_var($rated, FILTER_SANITIZE_STRING);
  }else{
      $rated = 'off';
  }
  if(isset($_POST['installation'])){
      $installation = $_POST['installation'];
      $installation = filter_var($installation, FILTER_SANITIZE_STRING);
  }else{
      $installation = 'off';
  }
  if(isset($_POST['warranty'])){
      $warranty = $_POST['warranty'];
      $warranty = filter_var($warranty, FILTER_SANITIZE_STRING);
  }else{
      $warranty = 'off';
  }

  $old_image_01 = $_POST['old_image_01'];
  $old_image_01 = filter_var($old_image_01, FILTER_SANITIZE_STRING);
  $image_01 = $_FILES['image_01']['name'];
  $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
  $image_01_ext = pathinfo($image_01, PATHINFO_EXTENSION);
  $rename_image_01 = create_unique_id().'.'.$image_01_ext;
  $image_01_tmp_name = $_FILES['image_01']['tmp_name'];
  $image_01_size = $_FILES['image_01']['size'];
  $image_01_folder = '../uploaded_files/'.$rename_image_01;

  if(!empty($image_01)){
    if($image_01_size > 2000000){
      $warning_msg[] = 'image 01 size is too large!';
    }else{
      $update_image_01 = $conn->prepare("UPDATE `products` SET image_01 = ? WHERE id = ?");
      $update_image_01->execute([$rename_image_01, $update_id]);
      move_uploaded_file($image_01_tmp_name, $image_01_folder);
      if($old_image_01 != ''){
        unlink('../uploaded_files/'.$old_image_01);
      }
    }
  }

  $old_image_02 = $_POST['old_image_02'];
  $old_image_02 = filter_var($old_image_02, FILTER_SANITIZE_STRING);
  $image_02 = $_FILES['image_02']['name'];
  $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
  $image_02_ext = pathinfo($image_02, PATHINFO_EXTENSION);
  $rename_image_02 = create_unique_id().'.'.$image_02_ext;
  $image_02_tmp_name = $_FILES['image_02']['tmp_name'];
  $image_02_size = $_FILES['image_02']['size'];
  $image_02_folder = '../uploaded_files/'.$rename_image_02;

  if(!empty($image_02)){
    if($image_02_size > 2000000){
      $warning_msg[] = 'image 02 size is too large!';
    }else{
      $update_image_02 = $conn->prepare("UPDATE `products` SET image_02 = ? WHERE id = ?");
      $update_image_02->execute([$rename_image_02, $update_id]);
      move_uploaded_file($image_02_tmp_name, $image_02_folder);
      if($old_image_02 != ''){
        unlink('../uploaded_files/'.$old_image_02);
      }
    }
  }

  $old_image_03 = $_POST['old_image_03'];
  $old_image_03 = filter_var($old_image_03, FILTER_SANITIZE_STRING);
  $image_03 = $_FILES['image_03']['name'];
  $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
  $image_03_ext = pathinfo($image_03, PATHINFO_EXTENSION);
  $rename_image_03 = create_unique_id().'.'.$image_03_ext;
  $image_03_tmp_name = $_FILES['image_03']['tmp_name'];
  $image_03_size = $_FILES['image_03']['size'];
  $image_03_folder = '../uploaded_files/'.$rename_image_03;

  if(!empty($image_03)){
    if($image_03_size > 2000000){
      $warning_msg[] = 'image 03 size is too large!';
    }else{
      $update_image_03 = $conn->prepare("UPDATE `products` SET image_03 = ? WHERE id = ?");
      $update_image_03->execute([$rename_image_03, $update_id]);
      move_uploaded_file($image_03_tmp_name, $image_03_folder);
      if($old_image_03 != ''){
        unlink('../uploaded_files/'.$old_image_03);
      }
    }
  }

  $update_product = $conn->prepare("UPDATE `products` SET product_name = ?, product_price = ?, color = ?, size = ?, product_brand = ?, product_material = ?, product_manufacturer = ?, available = ?, rated = ?, installation = ?, warranty = ?, category = ? WHERE id = ?");
  $update_product->execute([$product_name, $product_price, $color, $size, $product_brand, $product_material, $product_manufacturer, $available, $rated, $installation, $warranty, $category, $update_id]);
  $success_msg[] = 'Product updated successfully!';

}
if(isset($_POST['delete_image_01'])){

   $old_image_01 = $_POST['old_image_01'];
   $old_image_01 = filter_var($old_image_01, FILTER_SANITIZE_STRING);
   $update_image_01 = $conn->prepare("UPDATE `products` SET image_01 = ? WHERE id = ?");
   $update_image_01->execute(['', $get_id]);
   if($old_image_01 != ''){
      unlink('../uploaded_files/'.$old_image_01);
      $success_msg[] = 'image 01 deleted!';
   }
}
if(isset($_POST['delete_image_02'])){

   $old_image_02 = $_POST['old_image_02'];
   $old_image_02 = filter_var($old_image_02, FILTER_SANITIZE_STRING);
   $update_image_02 = $conn->prepare("UPDATE `products` SET image_02 = ? WHERE id = ?");
   $update_image_02->execute(['', $get_id]);
   if($old_image_02 != ''){
      unlink('../uploaded_files/'.$old_image_02);
      $success_msg[] = 'image 02 deleted!';
   }
}
if(isset($_POST['delete_image_03'])){

   $old_image_03 = $_POST['old_image_03'];
   $old_image_03 = filter_var($old_image_03, FILTER_SANITIZE_STRING);
   $update_image_03 = $conn->prepare("UPDATE `products` SET image_03 = ? WHERE id = ?");
   $update_image_03->execute(['', $get_id]);
   if($old_image_03 != ''){
      unlink('../uploaded_files/'.$old_image_03);
      $success_msg[] = 'image 03 deleted!';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Lighten Up - Update Product</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="../image/logo/title.png" type="image/x-icon">

  <!-- Bootstrap Icons & CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="../css/loader.css">
  <link rel="stylesheet" type="text/css" href="../css/home-banner.css">
  <link rel="stylesheet" type="text/css" href="../css/home-product.css">
  <link rel="stylesheet" type="text/css" href="../css/home-about.css">
  <link rel="stylesheet" type="text/css" href="../css/home-contact.css">
  <link rel="stylesheet" type="text/css" href="../css/home-categories.css">
  <link rel="stylesheet" type="text/css" href="../css/home-view-product.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/../components/admin_navbar.php'; ?>
<!-- update product section start here -->
<section class="update-product py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm form-card animate-fade-up">
          <?php
            $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
            $select_product->execute([$get_id]);
            if($select_product->rowCount() > 0){
              while($fetch_product=$select_product->fetch(PDO::FETCH_ASSOC)){
                $product_id = $fetch_product['id'];
          ?>

          <form action="" method="POST" enctype="multipart/form-data">
            <h2 class="mb-4 text-center fw-bold">Update Product</h2>
            <input type="hidden" name="product_id" value="<?= $product_id; ?>">
            <input type="hidden" name="old_image_01" value="<?= $fetch_product['image_01']; ?>">
            <input type="hidden" name="old_image_02" value="<?= $fetch_product['image_02']; ?>">
            <input type="hidden" name="old_image_03" value="<?= $fetch_product['image_03']; ?>">

            <!-- Images Section -->
            <h4 class="mb-3 text-center">Product Images</h4>
            <div class="row g-4">
              <!-- Image 01 -->
              <div class="col-md-4">
                <label class="form-label fw-semibold">Main Image 1</label>
                <img src="../uploaded_files/<?= $fetch_product['image_01'];?>" class="img-fluid rounded mb-2" style="max-height:200px; object-fit:cover;">
                <input type="submit" name="delete_image_01" class="btn btn-sm btn-outline-danger w-100 mb-2" value="Delete">
                <input type="file" class="form-control" name="image_01" accept="image/*">
              </div>

              <!-- Image 02 -->
              <div class="col-md-4">
                <label class="form-label fw-semibold">Main Image 2</label>
                <?php if(!empty($fetch_product['image_02'])): ?>
                  <img src="../uploaded_files/<?= $fetch_product['image_02'];?>" class="img-fluid rounded mb-2" style="max-height:200px; object-fit:cover;">
                <?php endif; ?>
                <input type="submit" name="delete_image_02" class="btn btn-sm btn-outline-danger w-100 mb-2" value="Delete">
                <input type="file" class="form-control" name="image_02" accept="image/*">
              </div>

              <!-- Image 03 -->
              <div class="col-md-4">
                <label class="form-label fw-semibold">Main Image 3</label>
                <?php if(!empty($fetch_product['image_03'])): ?>
                  <img src="../uploaded_files/<?= $fetch_product['image_03'];?>" class="img-fluid rounded mb-2" style="max-height:200px; object-fit:cover;">
                <?php endif; ?>
                <input type="submit" name="delete_image_03" class="btn btn-sm btn-outline-danger w-100 mb-2" value="Delete">
                <input type="file" class="form-control" name="image_03" accept="image/*">
              </div>
            </div>

            <!-- Product Details -->
            <h4 class="mt-5 mb-3 text-center">Product Details</h4>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold">Product Name</label>
                <input type="text" class="form-control" name="product_name" value="<?=$fetch_product['product_name']?>">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Product Price</label>
                <input type="text" class="form-control" name="product_price" value="<?=$fetch_product['product_price']?>">
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold">Select Category</label>
                <select class="form-select" name="category">
                  <option value="<?=$fetch_product['category']?>" selected><?=$fetch_product['category']?></option>
                  <option disabled>Select Category</option>
                  <option value="Fan">Fan</option>
                  <option value="Light">Light</option>
                  <option value="Switch">Switch</option>
                  <option value="Wire">Wire</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold">Select Color</label>
                <select class="form-select" name="color">
                  <option value="<?=$fetch_product['color']?>" selected><?=$fetch_product['color']?></option>
                  <option disabled>Color</option>
                  <option>Red</option><option>Blue</option><option>Yellow</option><option>Brown</option>
                  <option>Green</option><option>Black</option><option>White</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold">Select Size</label>
                <select class="form-select" name="size">
                  <option value="<?=$fetch_product['size']?>" selected><?=$fetch_product['size']?></option>
                  <option disabled>Select Size</option>
                  <option>48</option><option>56</option><option>60</option>
                </select>
              </div>
            </div>

            <!-- Specifications -->
            <h4 class="mt-5 mb-3 text-center">Product Specifications</h4>
            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label fw-semibold">Brand</label>
                <input type="text" class="form-control" name="product_brand" value="<?=$fetch_product['product_brand']?>">
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold">Material</label>
                <input type="text" class="form-control" name="product_material" value="<?=$fetch_product['product_material']?>">
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold">Manufacturer</label>
                <input type="text" class="form-control" name="product_manufacturer" value="<?=$fetch_product['product_manufacturer']?>">
              </div>
            </div>

            <!-- Features -->
            <h4 class="mt-5 mb-3 text-center">Why You'll Love It</h4>
            <div class="row g-2">
              <div class="col-md-6">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="available" <?php if($fetch_product['available'] == 'on') echo 'checked'; ?>>
                  <label class="form-check-label">Available both online and in-store</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="rated" <?php if($fetch_product['rated'] == 'on') echo 'checked'; ?>>
                  <label class="form-check-label">Highly rated by customers</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="installation" <?php if($fetch_product['installation'] == 'on') echo 'checked'; ?>>
                  <label class="form-check-label">Includes installation and support</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="warranty" <?php if($fetch_product['warranty'] == 'on') echo 'checked'; ?>>
                  <label class="form-check-label">Comes with warranty</label>
                </div>
              </div>
            </div>

            <div class="mt-5">
              <button type="submit" class="btn btn-dark w-100 btn-lg shadow-sm" name="update_product">
                Update Product Now!
              </button>
            </div>
          </form>

          <?php } } else { echo '<p class="text-center text-danger">Product not found!</p>'; } ?>
        </div>
      </div>
    </div>
  </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <?php
    include '../components/message.php';
    ?>
</body>
</html>
