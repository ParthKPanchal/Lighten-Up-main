<?php

include 'connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING); 
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING); 
   $c_pass = sha1($_POST['c_pass']);
   $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);   

   $select_users = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_users->execute([$email]);

   if($select_users->rowCount() > 0){
      $warning_msg[] = 'email already taken!';
   }else{
      if($pass != $c_pass){
         $warning_msg[] = 'Password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(id, name, number, email, password) VALUES(?,?,?,?,?)");
         $insert_user->execute([$id, $name, $number, $email, $c_pass]);
         
         if($insert_user){
            $verify_users = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
            $verify_users->execute([$email, $pass]);
            $row = $verify_users->fetch(PDO::FETCH_ASSOC);
         
            if($verify_users->rowCount() > 0){
               setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
               header('location:index.php');
            }else{
               $error_msg[] = 'something went wrong!';
            }
         }

      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lighten Up - Register</title>
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
    
      <?php include "components/navbar.php"; ?>
      <!-- register section start here -->
      <section class="register py-5 d-flex align-items-center">
        <div class="container d-flex justify-content-center">
          <div class="col-md-8">
            <div class="bg-white p-3 p-sm-4 p-md-5 rounded-4 shadow-sm form-card animate-fade-up">
              <form action="" method="POST">
                <h2 class="mb-4 text-center">Create an Account</h2>
                <div class="mb-3">
                  <label for="name" class="form-label fw-semibold">Full Name</label>
                  <input
                    type="text"
                    class="form-control form-control-lg"
                    id="name"
                    name="name"
                    placeholder="Your Full Name"
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
                    placeholder="you@example.com"
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
                    placeholder="Enter Mobile Number"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label fw-semibold">Password</label>
                  <input
                    type="password"
                    class="form-control form-control-lg"
                    id="password"
                    name="pass"
                    placeholder="Enter Password"
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
                  Register Now!
                </button>
              </form>
            </div>
          </div>
        </div>
      </section>
 
      <!-- register section end here -->
      <?php include "components/footer.php"; ?>
    
    
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
