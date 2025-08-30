<?php
include 'connect.php';

// Redirect if user is not logged in
if (!isset($_COOKIE['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_COOKIE['user_id'];

// Add to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity   = max(1, (int)$_POST['quantity']); // Ensure at least 1

    // Check if product already exists in cart
    $check_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $check_cart->execute([$user_id, $product_id]);

    if ($check_cart->rowCount() > 0) {
        $update = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
        $update->execute([$quantity, $user_id, $product_id]);
    } else {
        $insert = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $insert->execute([$user_id, $product_id, $quantity]);
    }
    header("Location: cart.php");
    exit;
}

// Delete item
if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $delete = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $delete->execute([$delete_id, $user_id]);
    header("Location: cart.php");
    exit;
}

// Fetch cart items
$select_cart = $conn->prepare("
    SELECT c.*, p.product_name, p.product_price, p.image_01 
    FROM cart c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = ?
");
$select_cart->execute([$user_id]);
$cart_items = $select_cart->fetchAll(PDO::FETCH_ASSOC);

// Calculate totals
$total_price = 0;
foreach ($cart_items as &$item) {
    $price       = (float)preg_replace('/[^\d.]/', '', (string)$item['product_price']);
    $qty         = (int)$item['quantity'];
    $line_total  = $price * $qty;

    $item['_price_num']  = $price;
    $item['_line_total'] = $line_total;

    $total_price += $line_total;
}
unset($item);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Lighten Up - My Cart</title>
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
  <?php include "components/navbar.php"; ?>

  <!-- Cart Section -->
  <section class="container-fluid p-5">
    <h2 class="mb-4 text-center fw-bold">🛒 My Cart</h2>

    <?php if (!empty($cart_items)): ?>
      <div class="table-responsive">
        <table class="table table-hover align-middle shadow-sm rounded-3 overflow-hidden">
          <thead class="table-dark">
            <tr>
              <th>Image</th>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($cart_items as $item): ?>
            <tr>
              <td>
                <img src="uploaded_files/<?= htmlspecialchars($item['image_01']) ?>" 
                     alt="<?= htmlspecialchars($item['product_name']) ?>" 
                     class="img-fluid rounded" 
                     style="width:70px; height:70px; object-fit:contain;">
              </td>
              <td class="fw-semibold"><?= htmlspecialchars($item['product_name']) ?></td>
              <td class="text-success fw-bold">₹<?= number_format($item['_price_num'], 2) ?></td>
              <td><?= (int)$item['quantity'] ?></td>
              <td class="fw-bold text-primary">₹<?= number_format($item['_line_total'], 2) ?></td>
              <td class="text-center">
                <a href="cart.php?delete=<?= (int)$item['id'] ?>" 
                   class="btn btn-sm btn-danger rounded-pill"
                   onclick="return confirm('Are you sure you want to remove this item?');">
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
      <!-- Empty Cart -->
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

  <?php include "components/footer.php"; ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <?php include 'components/message.php'; ?>
</body>
</html>
