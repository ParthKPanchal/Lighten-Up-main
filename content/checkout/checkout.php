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