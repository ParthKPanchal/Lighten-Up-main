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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Favicon -->
  <link rel="shortcut icon" href="../image/logo/title.png" type="image/x-icon">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<?php include __DIR__ . '/../components/admin_navbar.php'; ?>

<!-- Users Section -->
<section class="users container-fluid px-5 my-5">
  <h1 class="heading text-center fw-bold mb-4">
  <i class="bi bi-people-fill text-dark"></i> Users
</h1>



  <!-- Search Form -->
  <form action="" method="POST" class="d-flex justify-content-center mb-4">
    <input type="text" name="search_box" placeholder="Search users..." maxlength="100" class="form-control w-50 me-2" required>
    <button type="submit" class="btn btn-dark" name="search_btn">
      <i class="bi bi-search"></i>
    </button>
  </form>

  <div class="row g-4">
    <?php
    if (isset($_POST['search_box']) || isset($_POST['search_btn'])) {
        $search_box = $_POST['search_box'] ?? '';
        $search_box = "%$search_box%";

        $select_users = $conn->prepare("SELECT * FROM `users` WHERE name LIKE ? OR number LIKE ? OR email LIKE ?");
        $select_users->execute([$search_box, $search_box, $search_box]);
    } else {
        $select_users = $conn->prepare("SELECT * FROM `users`");
        $select_users->execute();
    }

    if ($select_users->rowCount() > 0) {
        while ($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)) {
            $count_products = $conn->prepare("SELECT * FROM `products` WHERE admin_id = ?");
            $count_products->execute([$fetch_users['id']]);
            $total_products = $count_products->rowCount();
    ?>
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <p><strong>Name:</strong> <?= htmlspecialchars($fetch_users['name']); ?></p>
          <p><strong>Number:</strong> <a class="text-dark text-decoration-none" href="tel:<?= htmlspecialchars($fetch_users['number']); ?>"><?= htmlspecialchars($fetch_users['number']); ?></a></p>
          <p><strong>Email:</strong> <a class="text-dark text-decoration-none" href="mailto:<?= htmlspecialchars($fetch_users['email']); ?>"><?= htmlspecialchars($fetch_users['email']); ?></a></p>

          <form action="" method="POST" onsubmit="return confirm('Delete this user?');">
            <input type="hidden" name="delete_id" value="<?= $fetch_users['id']; ?>">
            <button type="submit" name="delete" class="btn btn-dark w-100">Delete User</button>
          </form>
        </div>
      </div>
    </div>
    <?php
        }
    } elseif (isset($_POST['search_box']) || isset($_POST['search_btn'])) {
        echo '<p class="text-center text-muted">Results not found!</p>';
    } else {
        echo '<p class="text-center text-muted">No user accounts added yet!</p>';
    }
    ?>
  </div>
</section>
<!-- End Users Section -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include '../components/message.php'; ?>
</body>
</html>
