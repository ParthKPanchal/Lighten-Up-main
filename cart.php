<?php
include 'connect.php';

if(!isset($_COOKIE['user_id'])){
    header("location:login.php");
    exit;
}

$user_id = $_COOKIE['user_id'];

// Add to cart
if(isset($_POST['add_to_cart'])){
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if product already exists in cart
    $check_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $check_cart->execute([$user_id, $product_id]);

    if($check_cart->rowCount() > 0){
        $update = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
        $update->execute([$quantity, $user_id, $product_id]);
    } else {
        $insert = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $insert->execute([$user_id, $product_id, $quantity]);
    }
    header("location: cart.php");
    exit;
}

// Delete item
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $delete->execute([$delete_id, $user_id]);
    header("location: cart.php");
    exit;
}

// Fetch cart
$select_cart = $conn->prepare("SELECT c.*, p.product_name, p.product_price, p.image_01 
                               FROM cart c 
                               JOIN products p ON c.product_id = p.id 
                               WHERE c.user_id = ?");
$select_cart->execute([$user_id]);
$cart_items = $select_cart->fetchAll(PDO::FETCH_ASSOC);

$total_price = 0;
foreach($cart_items as &$item){
    // Clean price: remove anything that is not digit or decimal point
    $price = (float)preg_replace('/[^\d.]/', '', (string)$item['product_price']);
    $qty   = (int)$item['quantity'];
    $line_total = $price * $qty;

    // Store computed for use in the table
    $item['_price_num'] = $price;
    $item['_line_total'] = $line_total;

    $total_price += $line_total;
}
unset($item);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Lighten Up - My Cart</title>
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
    <!-- cart section start here -->
    <section class="container-fluid p-5">
  <h2 class="mb-4 text-center fw-bold">🛒 My Cart</h2>

  <?php if($cart_items): ?>
    <div class="table-responsive">
      <table class="table table-hover align-middle shadow-sm rounded-3 overflow-hidden">
        <thead class="table-dark">
          <tr>
            <th scope="col-lg-1">Image</th>
            <th scope="col-lg-4">Product</th>
            <th scope="col-lg-2">Price</th>
            <th scope="col-lg-1">Quantity</th>
            <th scope="col-lg-2">Total</th>
            <th scope="col-lg-2" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($cart_items as $item): ?>
          <tr>
            <td>
              <img src="uploaded_files/<?= $item['image_01'] ?>" 
                   alt="<?= $item['product_name'] ?>" 
                   class="img-fluid rounded" style="width:70px; height:70px; object-fit:contain;">
            </td>
            <td class="fw-semibold"><?= $item['product_name'] ?></td>
            <td class="text-success fw-bold">₹<?= $item['product_price'] ?></td>
            <td><?= $item['quantity'] ?></td>
            <td class="fw-bold text-primary">₹<?= number_format($item['_price_num'], 2) ?></td>
            <td class="text-center">
              <a href="cart.php?delete=<?= $item['id'] ?>" class="btn btn-sm btn-danger rounded-pill">
                <i class="bi bi-trash"></i> Remove
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Cart Summary -->
    <div class="card shadow-sm border-0 mt-4 p-4 text-center">
      <h4 class="fw-bold">Grand Total: <span class="text-success">₹<?= number_format($total_price, 2) ?></span></h4>
      <a href="checkout.php" class="btn btn-lg btn-dark mt-3 rounded-3 shadow-sm">
        <i class="bi bi-bag-check"></i> Proceed to Buy
      </a>
    </div>

  <?php else: ?>
    <!-- Empty Cart Section -->
    <div class="text-center py-5">
      <img src="asset/image/empty-cart.png" alt="Empty Cart" class="img-fluid mb-4" style="max-width:220px;">
      <h4 class="fw-bold mb-3">Your Cart is Empty!</h4>
      <p class="text-muted mb-4">Looks like you haven’t added anything to your cart yet.</p>
      <a href="index.php" class="btn btn-lg btn-warning shadow-sm rounded-pill">
        <i class="bi bi-shop"></i> Start Shopping
      </a>
    </div>
  <?php endif; ?>
</section>
>
    <!-- cart section end here -->
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

