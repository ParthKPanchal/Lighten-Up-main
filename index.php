<?php
include 'connect.php';

// Check if user is logged in
$user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : "";

// Handle save/send/cart functionality
include 'components/save_send.php';

// Fetch latest products
$select_products = $conn->prepare("SELECT * FROM `products` ORDER BY id DESC LIMIT 12");
$select_products->execute();
// --- Handle Add to Cart
if (isset($_POST['add_to_cart'])) {
    if ($user_id == "") {
        // user not logged in
        $warning_msg[] = 'Please login to add items to your cart.';
    } else {
        $product_id = $_POST['product_id'];
        $quantity   = $_POST['quantity'];

        // check if product already in cart
        $check_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
        $check_cart->execute([$user_id, $product_id]);

        if ($check_cart->rowCount() > 0) {
            // already in cart, just update qty
            $update_cart = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
            $update_cart->execute([$quantity, $user_id, $product_id]);
            $success_msg[] = 'Product quantity updated in your cart!';
        } else {
            // insert new
            $insert_cart = $conn->prepare("INSERT INTO cart(user_id, product_id, quantity) VALUES(?,?,?)");
            $insert_cart->execute([$user_id, $product_id, $quantity]);
            $success_msg[] = 'Product added to cart!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lighten Up - Home</title>

  <!-- Meta -->
  <meta name="format-detection" content="telephone=no" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="author" content="Gemplyte IT Solutions" />
  <meta name="keywords" content="Lighten Up, Gemplyte, Sample Project" />
  <meta name="description" content="Gemplyte Sample Project" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="asset/image/logo/title.png" type="image/x-icon" />

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/loader.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/banner.css">
  <link rel="stylesheet" href="css/search.css">
  <link rel="stylesheet" href="css/categories.css">
  <link rel="stylesheet" href="css/show-product.css">
  <link rel="stylesheet" href="css/style.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <!-- Navbar section here  -->
  <?php include "components/navbar.php"; ?>

  <!-- Banner section here -->
  <?php include "content/home/home-banner.php"; ?>
  <!-- search section here -->
  <?php include "content/home/home-search.php"; ?>
  <!-- categories section here -->
  <?php include "content/home/home-categories.php"; ?>
  <!-- categories section here -->
  <?php include "content/home/home-show-product.php"; ?>

  <!-- Footer section here -->
  <?php include "components/footer.php"; ?>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>

  <?php include 'components/message.php'; ?>
</body>
</html>
