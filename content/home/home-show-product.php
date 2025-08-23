<!-- show product start here -->
<section class="show-product py-5">
  <div class="container-fluid px-5">
    <h1 class="text-center mb-5 fw-bold">Latest Products</h1>
    <div class="row g-4">
      <?php
        $total_images = 0;
        $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY date DESC LIMIT 6");
        $select_products->execute();
        if($select_products->rowCount() > 0){
          while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

            $select_users = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_users->execute([$fetch_products['user_id']]);
            $fetch_user = $select_users->fetch(PDO::FETCH_ASSOC);

            $image_count_02 = !empty($fetch_products['image_02']) ? 1 : 0;
            $image_count_03 = !empty($fetch_products['image_03']) ? 1 : 0;
            $total_images = (1 + $image_count_02 + $image_count_03);

            $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE product_id = ? and user_id = ?");
            $select_saved->execute([$fetch_products['id'], $user_id]);
      ?>
      <div class="col-md-6 col-lg-4">
        <form action="" method="POST" class="h-100">
          <input type="hidden" name="product_id" value="<?= ($fetch_products['id']); ?>">
          <div class="card shadow-sm border-0 h-100">
            
            <!-- Product Image -->
            <div class="position-relative">
              <?php if(!empty($fetch_products['image_01'])): ?>
                <img src="uploaded_files/<?= ($fetch_products['image_01']); ?>" class="card-img-top rounded-top" alt="">
              <?php else: ?>
                <img src="asset/image/no-image.png" class="card-img-top rounded-top" alt="No image available">
              <?php endif; ?>

              <!-- Total Images Badge -->
              <span class="badge bg-dark position-absolute top-0 start-0 m-2">
                <i class="bi bi-image"></i> <?= $total_images; ?>
              </span>

              <!-- Save Button -->
              <?php if($select_saved->rowCount()>0){ ?>
                <button class="btn btn-danger position-absolute top-0 end-0 m-2 rounded-2" type="submit" name="save">
                  <i class="bi bi-heart-fill"></i>
                </button>
              <?php } else { ?>
                <button class="btn btn-light position-absolute top-0 end-0 m-2 rounded-2" type="submit" name="save">
                  <i class="bi bi-heart"></i>
                </button>
              <?php } ?>
            </div>

            <!-- Card Body -->
            <div class="card-body d-flex flex-column">
              <div class="d-flex align-items-center mb-3">
                <?php if($fetch_user): ?>
                  <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width:40px; height:40px; font-weight:bold;">
                    <?= (substr($fetch_user['name'], 0, 1)); ?>
                  </div>
                  <div class="ms-2">
                    <p class="mb-0 fw-semibold"><?= ($fetch_user['name']); ?></p>
                    <small class="text-muted"><?= ($fetch_products['date']); ?></small>
                  </div>
                <?php else: ?>
                  <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:40px; height:40px; font-weight:bold;">?</div>
                  <div class="ms-2">
                    <p class="mb-0 fw-semibold">Unknown</p>
                    <small class="text-muted"><?= ($fetch_products['date']); ?></small>
                  </div>
                <?php endif; ?>
              </div>

              <h5 class="card-title fw-bold"><?= ($fetch_products['product_name']); ?></h5>
              <p class="text-dark h5 mb-3"><i class="fas fa-indian-rupee-sign"></i> <?= ($fetch_products['product_price']); ?></p>

              <ul class="list-unstyled text-muted small mb-4">
                <li>Brand: <?= ($fetch_products['product_brand']); ?></li>
                <li>Material: <?= ($fetch_products['product_material']); ?></li>
                <li>Manufacturer: <?= ($fetch_products['product_manufacturer']); ?></li>
              </ul>

              <!-- Action Buttons -->
              <div class="mt-auto d-flex gap-2">
                <a href="view_products.php?get_id=<?= ($fetch_products['id']); ?>" class="btn btn-outline-dark flex-fill">View</a>
                <input type="submit" value="Enquiry" name="send" class="btn btn-dark flex-fill">
              </div>
            </div>
          </div>
        </form>
      </div>
      <?php
          }
        }else{
          echo '<div class="col-12"><h4 class="alert alert-secondary text-center shadow-sm">No products added yet!</h4></div>';
          
        }
      ?>
    </div>

    <!-- View All -->
    <div class="mt-5 text-center">
      <a href="listings.php" class="btn btn-lg btn-dark px-5">View All</a>
    </div>
  </div>
</section>
<!-- show product end here -->
