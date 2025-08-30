<?php
include '../connect.php';

// Check if admin is logged in
if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location: login.php');
    exit;
}

if (isset($_POST['add_product'])) {
  
  $id = create_unique_id();
  
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
         move_uploaded_file($image_02_tmp_name, $image_02_folder);
      }
   }else{
      $rename_image_02 = '';
   }

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
         move_uploaded_file($image_03_tmp_name, $image_03_folder);
      }
   }else{
      $rename_image_03 = '';
   }

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_01_ext = pathinfo($image_01, PATHINFO_EXTENSION);
   $rename_image_01 = create_unique_id().'.'.$image_01_ext;
   $image_01_tmp_name = $_FILES['image_01']['tmp_name'];
   $image_01_size = $_FILES['image_01']['size'];
   $image_01_folder = '../uploaded_files/'.$rename_image_01;

   if(!empty($image_01)){
   if($image_01_size > 2000000){
      $warning_msg[] = 'Image 01 size too large!';
   }else{
      move_uploaded_file($image_01_tmp_name, $image_01_folder); // ✅ Missing in your code

      $insert_product = $conn->prepare("INSERT INTO `products` 
        (id, admin_id, product_name, product_price, color, size, product_brand, product_material, product_manufacturer, available, rated, installation, warranty, category, image_01, image_02, image_03) 
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

      $insert_product->execute([
        $id, $admin_id, $product_name, $product_price, $color, $size, 
        $product_brand, $product_material, $product_manufacturer, 
        $available, $rated, $installation, $warranty, $category, 
        $rename_image_01, $rename_image_02, $rename_image_03
      ]);

      $success_msg[] = 'Product posted successfully!';
   }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Lighten Up - Add Product</title>

<!-- Meta -->
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
<?php include __DIR__ . '/../content/admin/add_product/add_product.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
 <?php
    include '../components/message.php';
    ?>
</body>
</html>
