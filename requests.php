<?php
include 'connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}
if(isset($_POST['delete'])){
  $delete_id=$_POST['request_id'];
  $delete_id=filter_var($delete_id,FILTER_SANITIZE_STRING);

  $verify_request = $conn->prepare("SELECT * FROM `requests` WHERE id=?");
  $verify_request->execute([$delete_id]);

  if($verify_request->rowCount()>0){
    $delete_request = $conn->prepare("DELETE FROM `requests` WHERE id=?");
    $delete_request->execute([$delete_id]);
    $success_msg[] = 'Request Deleted!';
  }else{
    $warning_msg[] = 'Request deleted already!';
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lighten Up - View Product</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="author" content="Gemplyte IT Solutions">
  <meta name="keywords" content="Lighten Up,Gemplyte,Sample Project">
  <meta name="description" content="Gemplyte Sample Project">

  <!-- Favicon -->
  <link rel="shortcut icon" href="image/logo/title.png" type="image/x-icon">

  <!-- Bootstrap Icons & CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/loader.css">
  <link rel="stylesheet" type="text/css" href="css/home-banner.css">
  <link rel="stylesheet" type="text/css" href="css/home-product.css">
  <link rel="stylesheet" type="text/css" href="css/home-about.css">
  <link rel="stylesheet" type="text/css" href="css/home-contact.css">
  <link rel="stylesheet" type="text/css" href="css/home-categories.css">
  <link rel="stylesheet" type="text/css" href="css/home-view-product.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body style="background-image: url('/image/bg/bg.jpg'); background-size: cover;">

  <?php include "components/navbar.php"; ?>
  <!-- request section start here -->
  <section class="request py-5">
    <div class="container-fluid px-5">
      <h1 class="text-center mb-5 fw-bold">
        <i class="bi bi-envelope-paper-heart me-2"></i> Request Received
      </h1>
      <div class="row g-4">
        <?php
          $select_requests=$conn->prepare("SELECT * FROM `requests` WHERE receiver =? ORDER BY date DESC");
          $select_requests->execute([$user_id]);
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

  <?php include "components/footer.php"; ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="js/script.js"></script>

  <?php include 'components/message.php'; ?>
</body>
</html>
