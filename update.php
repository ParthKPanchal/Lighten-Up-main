<?php

include 'connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}

$select_account = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
$select_account->execute([$user_id]);
$fetch_account = $select_account->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lighten Up - Update</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="author" content="Gemplyte IT Solutions" />
    <meta name="keywords" content="Lighten Up,Gemplyte,Sample Project" />
    <meta name="description" content="Gemplyte Sample Project" />
    <!-- Favicon -->
    <link
      rel="shortcut icon"
      href="asset/image/logo/title.png"
      type="image/x-icon"
    />
    <!-- Bootstrap Icons CDN (put this in <head> if not already added) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/loader.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  </head>
  <body>
    <!-- loader section start here -->
    <div class="loading-screen">
      <div class="loader">
        <span>&lt;</span>
        <span>Gemlyte IT Solutions</span>
        <span>/&gt;</span>
      </div>
    </div>
    <!-- loader section end here -->
    <div id="main-content" style="display: none">
      <?php include "components/navbar.php"; ?>
      <!-- update section start here -->
      <section class="update py-5 d-flex align-items-center">
        <div class="container d-flex justify-content-center">
          <div class="col-md-8">
            <div class="bg-white p-3 p-sm-4 p-md-5 rounded-4 shadow-sm form-card animate-fade-up">
              <form action="" method="POST">
                <h2 class="mb-4 text-center">Update your Account</h2>
                <div class="mb-3">
                  <label for="name" class="form-label fw-semibold">Full Name</label>
                  <input
                    type="text"
                    class="form-control form-control-lg"
                    id="name"
                    name="name"
                    placeholder="<?php echo $fetch_account['name']; ?>"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label fw-semibold">Email</label>
                  <input
                    type="email"
                    class="form-control form-control-lg"
                    id="email"
                    name="email"
                    placeholder="<?php echo $fetch_account['email']; ?>"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="number" class="form-label fw-semibold">Mobile Number</label>
                  <input
                    type="number"
                    class="form-control form-control-lg"
                    id="number"
                    name="number"
                    min="0"
                    max="9999999999"
                    maxlength="10"
                    placeholder="<?php echo $fetch_account['number']; ?>"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label fw-semibold">Old Password</label>
                  <input
                    type="password"
                    class="form-control form-control-lg"
                    id="password"
                    name="old_pass"
                    placeholder="Enter Old Password"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label fw-semibold">New Password</label>
                  <input
                    type="password"
                    class="form-control form-control-lg"
                    id="password"
                    name="new_pass"
                    placeholder="Enter New Password"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="c_password" class="form-label fw-semibold">Confirm Password</label>
                  <input
                    type="password"
                    class="form-control form-control-lg"
                    id="c_password"
                    name="c_pass"
                    placeholder="Enter Confirm Password"
                    required
                  />
                </div>
                <p class="text-center">Already have an account? <a href="login.php">Login Now!</a></p>
                <button type="submit" class="btn btn-dark w-100 btn-lg shadow-sm" name="submit" >
                  Update Now!
                </button>
              </form>
            </div>
          </div>
        </div>
      </section>
 
      <!-- update section end here -->
      <?php include "components/footer.php"; ?>
    </div>
    <script src="js/loader.js"></script>
    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
    <?php
    include 'components/message.php';
    ?>
  </body>
</html>
