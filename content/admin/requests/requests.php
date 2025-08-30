<!-- request section start here -->
  <section class="request py-5">
    <div class="container-fluid px-5">
      <h1 class="text-center mb-5 fw-bold">
        <i class="bi bi-envelope-paper-heart me-2"></i> Request Received
      </h1>
      <div class="row g-4">
        <?php
          $select_requests=$conn->prepare("SELECT * FROM `requests` WHERE receiver =? ORDER BY date DESC");
          $select_requests->execute([$admin_id]);
          if($select_requests->rowCount()>0){
              while($fetch_requests=$select_requests->fetch(PDO::FETCH_ASSOC)){
                  $select_sender=$conn->prepare("SELECT * FROM `users` WHERE id=?");
                  $select_sender->execute([$fetch_requests['sender']]);
                  $fetch_sender=$select_sender->fetch(PDO::FETCH_ASSOC);

                  $select_products=$conn->prepare("SELECT * FROM `products` WHERE id=?");
                  $select_products->execute([$fetch_requests['product_id']]);
                  $fetch_product=$select_products->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="col-md-6 col-lg-3">
          <div class="card shadow-lg border-0 h-100">
            <div class="card-body">
              <h5 class="card-title text-dark fw-bold">
                <i class="bi bi-person-circle me-2"></i><?= htmlspecialchars($fetch_sender['name']); ?>
              </h5>
              <p class="mb-2">
                <i class="bi bi-telephone me-2 text-dark"></i>
                <a href="tel:<?= htmlspecialchars($fetch_sender['number']); ?>" class="text-decoration-none text-dark">
                  <?= htmlspecialchars($fetch_sender['number']); ?>
                </a>
              </p>
              <p class="mb-2">
                <i class="bi bi-envelope-at me-2 text-dark"></i>
                <a href="mailto:<?= htmlspecialchars($fetch_sender['email']); ?>" class="text-decoration-none text-dark">
                  <?= htmlspecialchars($fetch_sender['email']); ?>
                </a>
              </p>
              <p class="mb-3">
                <i class="bi bi-box-seam me-2 text-dark"></i>
                Enquiry for: 
                <a href="view_products.php?get_id=<?= htmlspecialchars($fetch_product['product_name']); ?>" 
                  class="fw-semibold text-decoration-none text-dark">
                  <?= htmlspecialchars($fetch_product['product_name']); ?>
                </a>
              </p>

            </div>
            <div class="card-footer bg-light border-0 d-flex justify-content-between">
              <small class="text-muted">
                <i class="bi bi-clock-history me-1"></i><?= htmlspecialchars($fetch_requests['date']); ?>
              </small>
              <form action="" method="POST" class="m-0">
                <input type="hidden" name="request_id" value="<?= htmlspecialchars($fetch_requests['id']); ?>">
                <button type="submit" name="delete" 
                  onclick="return confirm('Delete this request?')" 
                  class="btn btn-sm btn-dark">
                  <i class="bi bi-trash3"></i> Delete
                </button>
              </form>
            </div>
          </div>
        </div>
        <?php
              }
          }else{
              echo '<div class="col-12"><h4 class="alert alert-dark text-center shadow-sm">You have no requests!</h4></div>';
          }
        ?>
      </div>
    </div>
  </section>
  <!-- request section end here -->