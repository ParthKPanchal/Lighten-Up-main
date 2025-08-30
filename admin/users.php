<?php
// Secure include
include '../connect.php';

// Check if admin is logged in
if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE['admin_id'];
} else {
    header('location: login.php');
    exit;
}

if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'] ?? '';
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

    $verify_delete = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0) {
        // Delete user images
        $select_images = $conn->prepare("SELECT * FROM `products` WHERE user_id = ?");
        $select_images->execute([$delete_id]);

        while ($fetch_images = $select_images->fetch(PDO::FETCH_ASSOC)) {
            if (!empty($fetch_images['image_01']) && file_exists('../uploaded_files/' . $fetch_images['image_01'])) {
                unlink('../uploaded_files/' . $fetch_images['image_01']);
            }
            if (!empty($fetch_images['image_02']) && file_exists('../uploaded_files/' . $fetch_images['image_02'])) {
                unlink('../uploaded_files/' . $fetch_images['image_02']);
            }
            if (!empty($fetch_images['image_03']) && file_exists('../uploaded_files/' . $fetch_images['image_03'])) {
                unlink('../uploaded_files/' . $fetch_images['image_03']);
            }
        }

        // Cascade delete
        $conn->prepare("DELETE FROM `products` WHERE user_id = ?")->execute([$delete_id]);
        $conn->prepare("DELETE FROM `requests` WHERE sender = ? OR receiver = ?")->execute([$delete_id, $delete_id]);
        $conn->prepare("DELETE FROM `saved` WHERE user_id = ?")->execute([$delete_id]);
        $conn->prepare("DELETE FROM `users` WHERE id = ?")->execute([$delete_id]);

        $success_msg[] = 'User deleted!';
    } else {
        $warning_msg[] = 'User already deleted!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lighten Up - Admin Users</title>
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
  <link rel="stylesheet" href="../css/search.css">
  <link rel="stylesheet" href="../css/admin_navbar.css">
  <link rel="stylesheet" href="../css/categories.css">
  <link rel="stylesheet" href="../css/show-product.css">
  <link rel="stylesheet" href="../css/style.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>
<?php include __DIR__ . '/../components/admin_navbar.php'; ?>
<?php include __DIR__ . '/../content/admin/users/users.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include '../components/message.php'; ?>
</body>
</html>
