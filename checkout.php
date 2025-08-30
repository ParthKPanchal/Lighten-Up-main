<?php
include 'connect.php';

if(!isset($_COOKIE['user_id'])){
    header("location:login.php");
    exit;
}

$user_id = $_COOKIE['user_id'];

// Fetch cart items
$select_cart = $conn->prepare("SELECT c.*, p.product_name, p.product_price 
                               FROM cart c 
                               JOIN products p ON c.product_id = p.id 
                               WHERE c.user_id = ?");
$select_cart->execute([$user_id]);
$cart_items = $select_cart->fetchAll(PDO::FETCH_ASSOC);

// Calculate total safely
$total_price = 0;
foreach($cart_items as &$item){
    // Clean price: remove commas, symbols etc. and cast to float
    $price = (float)preg_replace('/[^\d.]/', '', (string)$item['product_price']);
    $qty   = (int)$item['quantity'];

    $line_total = $price * $qty;

    $item['_price_num']  = $price;
    $item['_line_total'] = $line_total;

    $total_price += $line_total;
}
unset($item);

if(isset($_POST['place_order'])){
    $address = $_POST['address'] ?? '';
    $payment = $_POST['payment'] ?? '';

    // Insert into orders
    $insert_order = $conn->prepare("INSERT INTO orders(user_id, total_amount, payment_method, address) VALUES(?,?,?,?)");
    $insert_order->execute([$user_id, $total_price, $payment, $address]);

    $order_id = $conn->lastInsertId();

    // Insert order items
    foreach($cart_items as $item){
        $insert_items = $conn->prepare("INSERT INTO order_items(order_id, product_id, quantity, price) VALUES(?,?,?,?)");
        $insert_items->execute([
            $order_id,
            $item['product_id'],
            $item['quantity'],
            $item['_price_num']
        ]);
    }

    // Clear cart
    $clear = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $clear->execute([$user_id]);

    header("location: order_success.php?id=".$order_id);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Lighten Up - Checkout</title>
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

  <!-- categories section here -->
  <?php include "content/checkout/checkout.php"; ?>

  <!-- Footer section here -->
  <?php include "components/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'components/message.php'; ?>
</body>
</html>
