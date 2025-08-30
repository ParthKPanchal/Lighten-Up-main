<!-- Save Section Start -->
  <section class="save-product py-5">
    <div class="container-fluid px-5">
      <h1 class="text-center mb-5 fw-bold">Saved Products</h1>
      <div class="row g-4">
        <?php
            $select_saved_products = $conn->prepare("
                SELECT 
                    p.*, 
                    u.name AS user_name, 
                    s.user_id AS saved_user_id
                FROM saved s
                INNER JOIN products p ON s.product_id = p.id
                LEFT JOIN users u ON s.user_id = u.id
                WHERE s.user_id = ?
                ORDER BY p.id DESC
            ");
            $select_saved_products->execute([$user_id]);

            if ($select_saved_products->rowCount() > 0) {
              while ($fetch = $select_saved_products->fetch(PDO::FETCH_ASSOC)) {
                    
                    $image_count_02 = !empty($fetch['image_02']) ? 1 : 0;
                    $image_count_03 = !empty($fetch['image_03']) ? 1 : 0;
                    $total_images = 1 + $image_count_02 + $image_count_03;
            ?>
            <div class="col-md-6 col-lg-4">
              <form action="" method="POST" class="h-100">
                <input type="hidden" name="product_id" value="<?= ($fetch['id']); ?>">
                <input type="hidden" name="quantity" value="1">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden position-relative product-card">       
                  <!-- Product Image -->
                  <div class="position-relative">
                    <?php if (!empty($fetch['image_01'])): ?>
                      <img src="uploaded_files/<?= $fetch['image_01']; ?>" class="card-img-top rounded-top" alt="">
                    <?php else: ?>
                      <img src="asset/image/no-image.png" class="card-img-top rounded-top" alt="No image available">
                    <?php endif; ?>

                    <!-- Total Images Badge -->
                    <span class="badge bg-dark position-absolute top-0 start-0 m-2">
                      <i class="bi bi-image"></i> <?= $total_images; ?>
                    </span>

                    <!-- Save Button -->
                    <button class="btn btn-danger position-absolute top-0 end-0 m-2 rounded-2" type="submit" name="save">
                      <i class="bi bi-heart-fill"></i>
                    </button>
                  </div>

                  <!-- Card Body -->
                  <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                      <?php if (!empty($fetch['user_name'])): ?>
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; font-weight:bold;">
                          <?= substr($fetch['user_name'], 0, 1); ?>
                        </div>
                        <div class="ms-2">
                          <p class="mb-0 fw-semibold"><?= $fetch['user_name']; ?></p>
                          <small class="text-muted"><?= $fetch['date'] ?? ''; ?></small>
                        </div>
                      <?php else: ?>
                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; font-weight:bold;">?</div>
                        <div class="ms-2">
                          <p class="mb-0 fw-semibold">Unknown</p>
                          <small class="text-muted"><?= $fetch['date'] ?? ''; ?></small>
                        </div>
                      <?php endif; ?>
                    </div>

                    <h5 class="card-title fw-bold"><?= $fetch['product_name']; ?></h5>
                    <p class="text-success fw-bold h5 mb-3"><i class="bi bi-currency-rupee"></i> <?= $fetch['product_price']; ?></p>
                    <ul class="list-unstyled text-muted small mb-4">
                      <li><strong>Brand:</strong> <?= ($fetch['product_brand']); ?></li>
                      <li><strong>Material:</strong> <?= ($fetch['product_material']); ?></li>
                      <li><strong>Manufacturer:</strong> <?= ($fetch['product_manufacturer']); ?></li>
                    </ul>

                    <!-- Action Buttons -->
                    <div class="mt-auto d-flex gap-2">
                      <a href="view_products.php?get_id=<?= ($fetch['id']); ?>" 
                                class="btn btn-outline-dark flex-fill rounded-3">👁 View</a>
                      <input type="submit" value="📩 Enquiry" name="send" class="btn btn-dark flex-fill rounded-3">
                    </div>

                    <!-- Add to Cart -->
                    <button type="submit" name="add_to_cart" 
                              class="btn btn-warning w-100 mt-3 fw-semibold shadow-sm rounded-3">
                      <i class="bi bi-cart me-1"></i> Add to Cart
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <?php
                }
          } else {
              echo '<div class="col-12"><h4 class="alert alert-secondary text-center shadow-sm">Nothing saved yet!</h4></div>';
          }
        ?>
      </div>
    </div>
  </section>
  <!-- Save Section End -->