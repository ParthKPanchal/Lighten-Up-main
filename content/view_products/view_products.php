<!-- view product section -->
  <section class="view-product py-5" id="white-view-product">
    <div class="container">
      <h1 class="text-center fw-bold">Property Details</h1>
      <div class="row g-5 align-items-start">
        
        <!-- 🖼️ Product Image Carousel -->
        <div class="col-lg-6">
          <?php
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ? ORDER BY date DESC LIMIT 1");
            $select_products->execute([$get_id]);

            if ($select_products->rowCount() > 0) {
              while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                $product_id = $fetch_product['id'];

                $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_user->execute([$fetch_product['admin_id']]);
                $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

                $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE product_id = ? and user_id = ?");
                $select_saved->execute([$fetch_product['id'], $user_id]);
          ?>
          <!-- Main Carousel -->
          <div id="mainCarousel" class="carousel slide main-carousel mb-3" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="uploaded_files/<?= $fetch_product['image_01']; ?>" class="d-block w-100 rounded-4" alt="View 1">
              </div>
              <?php if (!empty($fetch_product['image_02'])) { ?>
              <div class="carousel-item">
                <img src="uploaded_files/<?= $fetch_product['image_02']; ?>" class="d-block w-100 rounded-4" alt="View 2">
              </div>
              <?php } ?>
              <?php if (!empty($fetch_product['image_03'])) { ?>
              <div class="carousel-item">
                <img src="uploaded_files/<?= $fetch_product['image_03']; ?>" class="d-block w-100 rounded-4" alt="View 3">
              </div>
              <?php } ?>
            </div>
            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

          <!-- 🔍 Thumbnails -->
          <div class="d-flex justify-content-between thumb-carousel">
            <div class="thumb col-4 px-1">
              <img src="uploaded_files/<?= $fetch_product['image_01']; ?>" class="img-fluid rounded-4" alt="Thumbnail 1">
            </div>
            <?php if (!empty($fetch_product['image_02'])) { ?>
            <div class="thumb col-4 px-1">
              <img src="uploaded_files/<?= $fetch_product['image_02']; ?>" class="img-fluid rounded-4" alt="Thumbnail 2">
            </div>
            <?php } ?>
            <?php if (!empty($fetch_product['image_03'])) { ?>
            <div class="thumb col-4 px-1">
              <img src="uploaded_files/<?= $fetch_product['image_03']; ?>" class="img-fluid rounded-4" alt="Thumbnail 3">
            </div>
            <?php } ?>
          </div>
        </div>

        <!-- 📄 Product Details -->
        <div class="col-lg-6">
          <h2 class="fw-bold mb-3"><?= $fetch_product['product_name']; ?></h2>
          <h4 class="text-muted">MRP: <i class="bi bi-currency-rupee"></i><span><?= $fetch_product['product_price']; ?></span></h4>
          <p class="text-muted">Price inclusive of all taxes</p>

          <!-- 🎨 Colors -->
          <h5 class="mt-4 mb-2 fw-semibold">Available Colors</h5>
          <div class="d-flex gap-2 mb-4">
            <?php foreach (explode(',', $fetch_product['color']) as $color): ?>
              <span class="rounded-circle border" style="width:35px; height:35px; background-color: <?= strtolower(trim($color)); ?>;" title="<?= htmlspecialchars(trim($color)); ?>"></span>
            <?php endforeach; ?>
          </div>

          <!-- 🔘 Sizes -->
          <h5 class="mt-4 mb-2 fw-semibold">Available Sizes</h5>
          <div class="d-flex gap-2 mb-4">
            <?php foreach (explode(',', $fetch_product['size']) as $size): ?>
              <span class="badge bg-light border px-3 py-2"><?= trim($size); ?></span>
            <?php endforeach; ?>
          </div>

          <!-- 🧾 Specifications -->
          <h4 class="mt-4">Product Specifications</h4>
          <ul class="list-unstyled">
            <li><strong>Brand:</strong> <?= $fetch_product['product_brand']; ?></li>
            <li><strong>Material:</strong> <?= $fetch_product['product_material']; ?></li>
            <li><strong>Manufacturer:</strong> <?= $fetch_product['product_manufacturer']; ?></li>
          </ul>

          <!-- ⭐ Features -->
          <h4 class="mt-4">Why You'll Love It</h4>
          <ul class="list-unstyled">
            <li>
              <i class="bi <?= $fetch_product['available'] == 'on' ? 'bi-check-circle text-success' : 'bi-x-circle text-danger'; ?>"></i>
              Available both online and in-store
            </li>
            <li>
              <i class="bi <?= $fetch_product['rated'] == 'on' ? 'bi-check-circle text-success' : 'bi-x-circle text-danger'; ?>"></i>
              Highly rated by customers
            </li>
            <li>
              <i class="bi <?= $fetch_product['installation'] == 'on' ? 'bi-check-circle text-success' : 'bi-x-circle text-danger'; ?>"></i>
              Comes with a manufacturer warranty
            </li>
            <li>
              <i class="bi <?= $fetch_product['warranty'] == 'on' ? 'bi-check-circle text-success' : 'bi-x-circle text-danger'; ?>"></i>
              Includes installation and after-sales support
            </li>
          </ul>
          <form action="" method="post" class="d-flex gap-2 flex-shrink-0">
              <input type="hidden" name="product_id" value="<?= $product_id; ?>">
              <?php if ($select_saved->rowCount() > 0) { ?>
                <button type="submit" name="save" class="btn btn-dark px-4 py-2">
                  Saved
                </button>
              <?php } else { ?>
                <button type="submit" name="save" class="btn btn-dark px-4 py-2">
                  Save
                </button>
              <?php } ?>
              <button type="submit" name="send" class="btn btn-dark px-4 py-2">
                Enquiry
              </button>
            </form>
        </div>
        <?php
              } // end while
            } else {
              echo '<p class="empty">property not found! <a href="post_property.php" class="btn mt-3">Add New</a></p>';
            }
          ?>
      </div>
    </div>
  </section>
