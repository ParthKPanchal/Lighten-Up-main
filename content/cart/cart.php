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
        <a href="checkout.php" class="btn btn-dark mt-3 rounded-3 shadow-sm">
          <i class="bi bi-bag-check"></i> Proceed to Buy
        </a>
      </div>

    <?php else: ?>
      <!-- Empty Cart -->
      <div class="text-center py-5">
        <img src="asset/image/empty-cart.png" alt="Empty Cart" class="img-fluid mb-4" style="max-width:220px;">
        <h4 class="fw-bold mb-3">Your Cart is Empty!</h4>
        <p class="text-muted mb-4">Looks like you haven’t added anything to your cart yet.</p>
        <a href="index.php" class="btn btn-warning shadow-sm rounded-pill">
          <i class="bi bi-shop"></i> Start Shopping
        </a>
      </div>
    <?php endif; ?>
  </section>
