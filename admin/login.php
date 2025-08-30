<?php
include '../connect.php';
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $name=filter_var($name,FILTER_SANITIZE_STRING);
    
    $pass=$_POST['pass'];
    $pass=filter_var($pass,FILTER_SANITIZE_STRING);
    
    $verify_admin=$conn->prepare("SELECT * From `admins` WHERE name=? AND password=? LIMIT 1");
    $verify_admin->execute([$name,$pass]);
    $row=$verify_admin->fetch(PDO::FETCH_ASSOC);

    if($verify_admin->rowCount()>0){
        setcookie('admin_id',$row['id'],time()+60*60*24*30,'/');
        header('location:dashboard.php');
    }else{
        $warning_msg[]='Incorrect name or password!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lighten Up - Admin Login</title>
  <!-- Meta -->
  <meta name="format-detection" content="telephone=no" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="author" content="Gemplyte IT Solutions" />
  <meta name="keywords" content="Lighten Up, Gemplyte, Sample Project" />
  <meta name="description" content="Gemplyte Sample Project" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="../asset/image/logo/title.png" type="image/x-icon" />

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../css/loader.css">
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/banner.css">
  <link rel="stylesheet" href="../css/admin_navbar.css">
  <link rel="stylesheet" href="../css/search.css">
  <link rel="stylesheet" href="../css/categories.css">
  <link rel="stylesheet" href="../css/show-product.css">
  <link rel="stylesheet" href="../css/style.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>
    <!-- login section start here -->
    <section class="login min-vh-100 d-flex justify-content-center align-items-center">
        <div class="container d-flex justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="bg-white p-3 p-sm-4 p-md-5 rounded-4 shadow-sm form-card animate-fade-up">
                    <form action="" method="POST">
                        <h2 class="mb-4 text-center">Welcome back!</h2>
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
                        
                        <button type="submit" class="btn btn-dark w-100 btn-lg shadow-sm" name="submit">
                            Login Now!
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- login section end here -->
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Scripts -->
     <?php
    include '../components/message.php';
    ?>
    </body>
</html>
