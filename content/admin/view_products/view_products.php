<!-- view product section -->
<section class="view-product py-5" id="white-view-product">
  <div class="container bg-light p-5 rounded-3 shadow-lg">
    <h1 class="text-center">Property Details</h1>
    <div class="row g-5 align-items-start">
      
      <?php
        $get_id = isset($_GET['get_id']) ? (int)$_GET['get_id'] : 0;
        $admin_id = $_COOKIE['user_id'] ?? 0; // fallback if not set

        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $select_products->execute([$get_id]);

        if ($select_products->rowCount() > 0) {
          while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
            $product_id = $fetch_product['id'];

            // fetch admin
            $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_user->execute([$fetch_product['admin_id']]);
            $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

            // fetch saved
            $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE product_id = ? AND user_id = ?");
            $select_saved->execute([$fetch_product['id'], $admin_id]);
      ?>

      <!-- 🖼️ Product Image Carousel -->
      <div class="col-lg-6">
        <div id="mainCarousel" class="carousel slide main-carousel mb-3" data-bs-ride="carousel">
          <div class="carousel-inner rounded-3">
            <div class="carousel-item active">
              <img src="../uploaded_files/<?= htmlspecialchars($fetch_product['image_01'] ?: 'default.png'); ?>" 
                   class="d-block w-100" alt="View 1">
            </div>
            <?php if (!empty($fetch_product['image_02'])): ?>
            <div class="carousel-item">
              <img src="../uploaded_files/<?= htmlspecialchars($fetch_product['image_02']); ?>" 
                   class="d-block w-100" alt="View 2">
            </div>
            <?php endif; ?>
            <?php if (!empty($fetch_product['image_03'])): ?>
            <div class="carousel-item">
              <img src="../uploaded_files/<?= htmlspecialchars($fetch_product['image_03']); ?>" 
                   class="d-block w-100" alt="View 3">
            </div>
            <?php endif; ?>
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
            <img src="../uploaded_files/<?= htmlspecialchars($fetch_product['image_01'] ?: 'default.png'); ?>" 
                 class="img-fluid rounded-3" alt="Thumbnail 1">
          </div>
          <?php if (!empty($fetch_product['image_02'])): ?>
          <div class="thumb col-4 px-1">
            <img src="../uploaded_files/<?= htmlspecialchars($fetch_product['image_02']); ?>" 
                 class="img-fluid rounded-3" alt="Thumbnail 2">
          </div>
          <?php endif; ?>
          <?php if (!empty($fetch_product['image_03'])): ?>
          <div class="thumb col-4 px-1">
            <img src="../uploaded_files/<?= htmlspecialchars($fetch_product['image_03']); ?>" 
                 class="img-fluid rounded-3" alt="Thumbnail 3">
          </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- 📄 Product Details -->
      <div class="col-lg-6">
        <h2 class="fw-bold mb-3"><?= htmlspecialchars($fetch_product['product_name']); ?></h2>
        <h4 class="text-muted">
          MRP: <i class="bi bi-currency-rupee"></i>
          <span><?= number_format((float)$fetch_product['product_price'], 2); ?></span>
        </h4>
        <p class="text-muted">Price inclusive of all taxes</p>

        <!-- 🎨 Colors -->
        <?php if (!empty($fetch_product['color'])): ?>
        <h5 class="mt-4 mb-2 fw-semibold">Available Colors</h5>
        <div class="d-flex gap-2 mb-4">
          <?php foreach (explode(',', $fetch_product['color']) as $color): ?>
            <?php $clr = trim($color); ?>
            <span class="rounded-circle border" 
                  style="width:35px; height:35px; background-color: <?= htmlspecialchars(strtolower($clr)); ?>;" 
                  title="<?= htmlspecialchars($clr); ?>"></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- 🔘 Sizes -->
        <?php if (!empty($fetch_product['size'])): ?>
        <h5 class="mt-4 mb-2 fw-semibold">Available Sizes</h5>
        <div class="d-flex gap-2 mb-4">
          <?php foreach (explode(',', $fetch_product['size']) as $size): ?>
            <span class="badge bg-light text-dark border px-3 py-2"><?= htmlspecialchars(trim($size)); ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- 🧾 Specifications -->
        <h4 class="mt-4">Product Specifications</h4>
        <ul class="list-unstyled">
          <li><strong>Brand:</strong> <?= htmlspecialchars($fetch_product['product_brand']); ?></li>
          <li><strong>Material:</strong> <?= htmlspecialchars($fetch_product['product_material']); ?></li>
          <li><strong>Manufacturer:</strong> <?= htmlspecialchars($fetch_product['product_manufacturer']); ?></li>
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
      </div>

      <?php
          } // end while
        } else {
          echo '<p class="empty">Property not found! <a href="post_property.php" class="btn mt-3">Add New</a></p>';
        }
      ?>
    </div>
  </div>
</section>
