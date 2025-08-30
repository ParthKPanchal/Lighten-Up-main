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
// select from admins table
$select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ? LIMIT 1");
$select_profile->execute([$admin_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

// update user details
if (isset($_POST['submit'])) {

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

    if (!empty($name)) {
        $update_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
        $update_name->execute([$name, $admin_id]);
        $success_msg[] = 'Name updated successfully!';
    }

    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $c_pass   = $_POST['c_pass'];

    // Only run password update if all 3 fields are filled
    if (!empty($old_pass) && !empty($new_pass) && !empty($c_pass)) {

        $prev_pass = $fetch_profile['password']; // hashed password from DB

        if (!password_verify($old_pass, $prev_pass)) {
            $warning_msg[] = 'Old password is incorrect!';
        } elseif ($new_pass !== $c_pass) {
            $warning_msg[] = 'Confirm password does not match!';
        } else {
            $hashed_new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $update_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
            $update_pass->execute([$hashed_new_pass, $admin_id]);
            $success_msg[] = 'Password updated successfully!';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lighten Up - Admin update</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Gemlyte IT Solutions" />
    <meta name="keywords" content="Lighten Up, Gemlyte, Sample Project" />
    <meta name="description" content="Gemlyte Sample Project" />
    <!-- Favicon -->
    <link
      rel="shortcut icon"
      href="../image/logo/title.png"
      type="image/x-icon"
    />
    <!-- Bootstrap Icons & CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Swiper -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
    />
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../css/loader.css" />
    <link rel="stylesheet" type="text/css" href="../css/home-banner.css" />
    <link rel="stylesheet" type="text/css" href="../css/home-product.css" />
    <link rel="stylesheet" type="text/css" href="../css/home-about.css" />
    <link rel="stylesheet" type="text/css" href="../css/home-contact.css" />
    <link rel="stylesheet" type="text/css" href="../css/home-categories.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="../css/home-view-product.css"
    />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&family=Spectral:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <?php include __DIR__ . '/../components/admin_navbar.php'; ?>
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
                    class="form-control"
                    id="name"
                    name="name"
                    placeholder="<?php echo $fetch_profile['name']; ?>"
                  />
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label fw-semibold">Old Password</label>
                  <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="old_pass"
                    placeholder="Enter Old Password"
                  />
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label fw-semibold">New Password</label>
                  <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="new_pass"
                    placeholder="Enter New Password"
                  />
                </div>
                <div class="mb-3">
                  <label for="c_password" class="form-label fw-semibold">Confirm New Password</label>
                  <input
                    type="password"
                    class="form-control"
                    id="c_password"
                    name="c_pass"
                    placeholder="Enter Confirm Password"
                  />
                </div>
                <button type="submit" class="btn btn-dark w-100 btn-lg shadow-sm" name="submit" >
                  Update Now!
                </button>
              </form>
            </div>
          </div>
        </div>
      </section>
    <!-- update section end here -->
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../js/script.js"></script>
    <!-- Scripts -->
    <?php include '../components/message.php'; ?>
  </body>
</html>
