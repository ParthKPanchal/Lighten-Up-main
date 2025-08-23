<?php
include 'connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = "";
}
include 'components/save_send.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lighten Up - Save</title>
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

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/loader.css" />
  <link rel="stylesheet" type="text/css" href="css/home-banner.css" />
  <link rel="stylesheet" type="text/css" href="css/home-product.css" />
  <link rel="stylesheet" type="text/css" href="css/home-about.css" />
  <link rel="stylesheet" type="text/css" href="css/home-contact.css" />
  <link rel="stylesheet" type="text/css" href="css/home-categories.css" />
  <link rel="stylesheet" type="text/css" href="css/home-view-product.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body>
  <?php include "components/navbar.php"; ?>

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
                LEFT JOIN users u ON p.user_id = u.id
                WHERE s.user_id = ?
                ORDER BY p.date DESC
            ");
            $select_saved_products->execute([$user_id]);

            if ($select_saved_products->rowCount() > 0) {
                while ($fetch = $select_saved_products->fetch(PDO::FETCH_ASSOC)) {
                    
                    // Handle images count
                    $image_count_02 = !empty($fetch['image_02']) ? 1 : 0;
                    $image_count_03 = !empty($fetch['image_03']) ? 1 : 0;
                    $total_images = (1 + $image_count_02 + $image_count_03);

                    // Instead of another query: just check that row exists (it does, since we joined "saved")
                    $is_saved = !empty($fetch['saved_user_id']);
            ?>
                    <div class="col-md-6 col-lg-4">
                    <form action="" method="POST" class="h-100">
                        <input type="hidden" name="product_id" value="<?= $fetch['id']; ?>">
                        <div class="card shadow-sm border-0 h-100">

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
                            <?php if ($is_saved): ?>
                            <button class="btn btn-danger position-absolute top-0 end-0 m-2 rounded-2" type="submit" name="save">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                            <?php else: ?>
                            <button class="btn btn-light position-absolute top-0 end-0 m-2 rounded-2" type="submit" name="save">
                                <i class="bi bi-heart"></i>
                            </button>
                            <?php endif; ?>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                            <?php if (!empty($fetch['user_name'])): ?>
                                <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width:40px; height:40px; font-weight:bold;">
                                <?= substr($fetch['user_name'], 0, 1); ?>
                                </div>
                                <div class="ms-2">
                                <p class="mb-0 fw-semibold"><?= $fetch['user_name']; ?></p>
                                <small class="text-muted"><?= $fetch['date']; ?></small>
                                </div>
                            <?php else: ?>
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:40px; height:40px; font-weight:bold;">?</div>
                                <div class="ms-2">
                                <p class="mb-0 fw-semibold">Unknown</p>
                                <small class="text-muted"><?= $fetch['date']; ?></small>
                                </div>
                            <?php endif; ?>
                            </div>

                            <h5 class="card-title fw-bold"><?= $fetch['product_name']; ?></h5>
                            <p class="text-dark h5 mb-3"><i class="fas fa-indian-rupee-sign"></i> <?= $fetch['product_price']; ?></p>

                            <ul class="list-unstyled text-muted small mb-4">
                            <li>Brand: <?= $fetch['product_brand']; ?></li>
                            <li>Material: <?= $fetch['product_material']; ?></li>
                            <li>Manufacturer: <?= $fetch['product_manufacturer']; ?></li>
                            </ul>

                            <!-- Action Buttons -->
                            <div class="mt-auto d-flex gap-2">
                            <a href="view_products.php?get_id=<?= $fetch['id']; ?>" class="btn btn-outline-dark flex-fill">View</a>
                            <input type="submit" value="Enquiry" name="send" class="btn btn-dark flex-fill">
                            </div>
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

  <?php include "components/footer.php"; ?>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Custom JS -->
  <script src="js/script.js"></script>
  <script src="js/save.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <?php include 'components/message.php'; ?>
</body>
</html>
