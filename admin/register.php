<?php
// Secure include
include '../connect.php';

// Check if admin is logged in
if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    $admin_id = '';
    header('location: login.php');
    exit;
}
if(isset($_POST['submit'])){

    $id=create_unique_id();
    $name=$_POST['name'];
    $name=filter_var($name,FILTER_SANITIZE_STRING);
    
    $pass=$_POST['pass'];
    $pass=filter_var($pass,FILTER_SANITIZE_STRING);

    $c_pass=$_POST['c_pass'];
    $c_pass=filter_var($c_pass,FILTER_SANITIZE_STRING);
    
    $verify_admin=$conn->prepare("SELECT * From `admins` WHERE name=? LIMIT 1");
    $verify_admin->execute([$name]);

    if($verify_admin->rowCount()>0){
        $warning_msg[]='Name already taken!';
    }else{
        if($c_pass!=$pass){
            $warning_msg[]='Password not matched!';
        }else{
            $insert_admin=$conn->prepare("INSERT INTO `admins`(id,name,password) VALUES(?,?,?)");
            $insert_admin->execute([$id,$name,$c_pass]);
            $success_msg[]="New Admin Registed!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lighten Up - Admin Register</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="author" content="Gemlyte IT Solutions">
  <meta name="keywords" content="Lighten Up, Gemlyte, Sample Project">
  <meta name="description" content="Gemlyte Sample Project">

  <!-- Favicon -->
  <link rel="shortcut icon" href="../image/logo/title.png" type="image/x-icon">

  <!-- Bootstrap Icons & CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="../css/loader.css">
  <link rel="stylesheet" type="text/css" href="../css/home-banner.css">
  <link rel="stylesheet" type="text/css" href="../css/home-product.css">
  <link rel="stylesheet" type="text/css" href="../css/home-about.css">
  <link rel="stylesheet" type="text/css" href="../css/home-contact.css">
  <link rel="stylesheet" type="text/css" href="../css/home-categories.css">
  <link rel="stylesheet" type="text/css" href="../css/home-view-product.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>
<body>
    <?php include __DIR__ . '/../components/admin_navbar.php'; ?>
    <!-- register section start here -->
    <section class="login min-vh-100 d-flex justify-content-center align-items-center">
        <div class="container d-flex justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="bg-white p-3 p-sm-4 p-md-5 rounded-4 shadow-sm form-card animate-fade-up">
                    <form action="" method="POST">
                        <h2 class="mb-4 text-center">Create new account</h2>
                        <p class="text-center">Default name = ajayinfo | Password = Ajayinfo@123</p>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Your name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder="Enter your name"
                                maxlength="20"
                                oninput="this.value=this.value.replace(/\s/g,'')"
                                required                          
                            />
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="pass"
                                placeholder="Enter Password"
                                maxlength="20"
                                oninput="this.value=this.value.replace(/\s/g,'')"
                                required
                            />
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Confirm Password</label>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="c_pass"
                                placeholder="Enter Confirm Password"
                                maxlength="20"
                                oninput="this.value=this.value.replace(/\s/g,'')"
                                required
                            />
                        </div>
                        
                        <button type="submit" class="btn btn-dark w-100 btn-lg shadow-sm" name="submit">
                            Register Now!
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- register section end here -->
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../js/script.js"></script>
    <!-- Scripts -->
      <!-- Scripts -->
    <?php
    include '../components/message.php';
    ?>
    </body>
</html>
