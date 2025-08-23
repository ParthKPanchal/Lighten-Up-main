<?php
include 'connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
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

  <?php include "components/footer.php"; ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="js/script.js"></script>

  <?php include 'components/message.php'; ?>
</body>
</html>
