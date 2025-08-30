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
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="image/logo/title.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php include "components/navbar.php"; ?>
<section class="container-fulid p-5">

  <h2 class="mb-4 fw-bold text-center">🛍️ Checkout</h2>

  <?php if($cart_items): ?>
    <!-- Order Summary Card -->
    <div class="card shadow-sm border-0 mb-4">
      <div class="card-header bg-dark text-white fw-bold">
        Order Summary
      </div>
      <ul class="list-group list-group-flush">
        <?php foreach($cart_items as $item): ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span><?= htmlspecialchars($item['product_name']) ?> <small class="text-muted">(x<?= $item['quantity'] ?>)</small></span>
            <span class="fw-semibold text-success">₹<?= number_format($item['_line_total'], 2) ?></span>
          </li>
        <?php endforeach; ?>
        <li class="list-group-item d-flex justify-content-between fw-bold">
          <span>Total</span>
          <span class="text-primary">₹<?= number_format($total_price, 2) ?></span>
        </li>
      </ul>
    </div>

    <!-- Checkout Form -->
    <div class="card shadow-sm border-0 p-4">
      <h5 class="fw-bold mb-3">Delivery Details</h5>
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Delivery Address</label>
          <textarea name="address" class="form-control" rows="3" placeholder="Enter your full delivery address..." required></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Payment Method</label>
          <select name="payment" class="form-select" required>
            <option value="COD">💵 Cash on Delivery</option>
            <option value="UPI">📱 UPI</option>
            <option value="Card">💳 Credit/Debit Card</option>
          </select>
        </div>

        <div class="text-center mt-4">
          <button type="submit" name="place_order" class="btn btn-lg btn-dark px-5 shadow-sm rounded-3">
            <i class="bi bi-check-circle"></i> Place Order
          </button>
        </div>
      </form>
    </div>

  <?php else: ?>
    <!-- Empty Checkout -->
    <div class="text-center py-5">
      <img src="asset/image/empty-cart.png" alt="No Items" class="img-fluid mb-4" style="max-width:220px;">
      <h4 class="fw-bold mb-3">No items to checkout</h4>
      <p class="text-muted mb-4">Your cart is empty. Add some products before proceeding to checkout.</p>
      <a href="index.php" class="btn btn-lg btn-warning shadow-sm rounded-pill">
        <i class="bi bi-shop"></i> Start Shopping
      </a>
    </div>
  <?php endif; ?>
</section>


<?php include "components/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'components/message.php'; ?>
</body>
</html>
