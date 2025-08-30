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

// Delete product
if (isset($_POST['delete_product'])) {
    $delete_id = $_POST['product_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

    $verify_delete = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0) {
        $select_images = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $select_images->execute([$delete_id]);
        while ($fetch_images = $select_images->fetch(PDO::FETCH_ASSOC)) {
            foreach (['image_01', 'image_02', 'image_03'] as $img) {
                if (!empty($fetch_images[$img]) && file_exists("uploaded_files/".$fetch_images[$img])) {
                    unlink("uploaded_files/".$fetch_images[$img]);
                }
            }
        }
        $conn->prepare("DELETE FROM `saved` WHERE product_id = ?")->execute([$delete_id]);
        $conn->prepare("DELETE FROM `requests` WHERE product_id = ?")->execute([$delete_id]);
        $conn->prepare("DELETE FROM `products` WHERE id = ?")->execute([$delete_id]);
        $success_msg[] = 'Product deleted successfully!';
    } else {
        $warning_msg[] = 'Product already deleted!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lighten Up - Admin My Products</title>
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

<section class="my-product container-fluid px-5 py-4">
    <h1 class="mb-4 text-center fw-bold">
  <i class="bi bi-bag-check-fill text-dark"></i> My Products
</h1>
    <!-- Search -->
    <!-- <form action="" method="POST" class="d-flex mb-4">
        <input type="text" name="search_box" class="form-control" placeholder="Search product..."
               value="<?= isset($_POST['search_box']) ? htmlspecialchars($_POST['search_box']) : '' ?>">
        <button type="submit" name="search_btn" class="btn btn-dark ms-2">
            <i class="bi bi-search"></i>
        </button>
    </form> -->
    <form action="" method="POST" class="row g-2 mb-4 justify-content-center">
        <div class="col">
            <input type="text" name="search_box" class="form-control" placeholder="Search product..."
                value="<?= isset($_POST['search_box']) ? htmlspecialchars($_POST['search_box']) : '' ?>">
        </div>
        <div class="col-auto">
            <button type="submit" name="search_btn" class="btn btn-dark w-100">
            <i class="bi bi-search"></i> Search
            </button>
        </div>
    </form>

    <div class="row g-4">
        <?php
        $search_box = isset($_POST['search_box']) ? filter_var($_POST['search_box'], FILTER_SANITIZE_STRING) : '';

        if (!empty($search_box)) {
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE ? OR address LIKE ? ORDER BY date DESC");
            $select_products->execute(["%$search_box%", "%$search_box%"]);
        } else {
            $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY date DESC");
            $select_products->execute();
        }

        if ($select_products->rowCount() > 0) {
            while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                $product_id = $fetch_product['id'];
        ?>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <form action="" method="POST" class="h-100">
                <input type="hidden" name="product_id" value="<?= $product_id; ?>">

                <div class="card shadow-lg h-100 border-0 rounded-3">
                    <div class="position-relative">
                        <img src="../uploaded_files/<?= htmlspecialchars($fetch_product['image_01'] ?? 'default.png'); ?>"
                        class="card-img-top rounded-top"
                        alt="<?= htmlspecialchars($fetch_product['name'] ?? 'No Name'); ?>"
                        style="height: 220px; object-fit: cover;">

                        <span class="badge bg-dark position-absolute top-0 start-0 m-2 px-3 py-2 fs-6 shadow">
                            ₹<?= $fetch_product['product_price']; ?>
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark text-truncate">
                            <?= htmlspecialchars($fetch_product['product_name']); ?>
                        </h5>

                        <p class="mb-1 text-muted small"><i class="bi bi-tags"></i> Brand: <?= $fetch_product['product_brand']; ?></p>
                        <p class="mb-1 text-muted small"><i class="bi bi-box"></i> Material: <?= $fetch_product['product_material']; ?></p>
                        <p class="mb-3 text-muted small"><i class="bi bi-building"></i> Manufacturer: <?= $fetch_product['product_manufacturer']; ?></p>

                        <div class="mt-auto">
                            <div class="d-flex gap-2">
                                <a href="update_product.php?get_id=<?= $product_id; ?>" class="btn btn-outline-dark btn-sm w-100">
                                    <i class="bi bi-pencil-square me-1"></i> Update
                                </a>
                                <button type="submit" name="delete_product" class="btn btn-outline-danger btn-sm w-100"
                                        onclick="return confirm('Are you sure you want to delete this product?');">
                                    <i class="bi bi-trash me-1"></i> Delete
                                </button>
                            </div>
                            <a href="view_products.php?get_id=<?= $product_id; ?>" class="btn btn-dark btn-sm mt-3 w-100">
                                <i class="bi bi-eye me-1"></i> View Product
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
            }
        } else {
            echo '<div class="col-12"><h4 class="alert alert-secondary text-center shadow-sm">No products found!</h4></div>';
        }
        ?>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include '../components/message.php'; ?>
</body>
</html>
