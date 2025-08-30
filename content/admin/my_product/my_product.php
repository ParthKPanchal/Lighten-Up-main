<section class="my-product container-fluid px-5 py-4">
    <h1 class="mb-4 text-center fw-bold">
        <i class="bi bi-bag-check-fill text-dark"></i> My Products
    </h1>
    
    <!-- Search Form -->
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
        $search_box = isset($_POST['search_box']) ? htmlspecialchars(trim($_POST['search_box'])) : '';

        if (!empty($search_box)) {
            $select_products = $conn->prepare("
                SELECT * FROM `products` 
                WHERE product_name LIKE ? 
                   OR product_brand LIKE ? 
                   OR product_material LIKE ? 
                   OR product_manufacturer LIKE ? 
                ORDER BY date DESC
            ");
            $search_term = "%$search_box%";
            $select_products->execute([$search_term, $search_term, $search_term, $search_term]);
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
                <input type="hidden" name="product_id" value="<?= (int)$product_id; ?>">
                <input type="hidden" name="delete_id" value="<?= (int)$product_id; ?>">

                <div class="card shadow-lg h-100 border-0 rounded-3">
                    <div class="position-relative">
                        <img src="../uploaded_files/<?= htmlspecialchars($fetch_product['image_01'] ?: 'default.png'); ?>"
                             class="card-img-top rounded-top"
                             alt="<?= htmlspecialchars($fetch_product['product_name'] ?? 'No Name'); ?>"
                             style="height: 220px; object-fit: cover;">

                        <span class="badge bg-dark position-absolute top-0 start-0 m-2 px-3 py-2 fs-6 shadow">
                            ₹<?= number_format((float)$fetch_product['product_price'], 2); ?>
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark text-truncate">
                            <?= htmlspecialchars($fetch_product['product_name']); ?>
                        </h5>

                        <p class="mb-1 text-muted small"><i class="bi bi-tags"></i> Brand: <?= htmlspecialchars($fetch_product['product_brand']); ?></p>
                        <p class="mb-1 text-muted small"><i class="bi bi-box"></i> Material: <?= htmlspecialchars($fetch_product['product_material']); ?></p>
                        <p class="mb-3 text-muted small"><i class="bi bi-building"></i> Manufacturer: <?= htmlspecialchars($fetch_product['product_manufacturer']); ?></p>

                        <div class="mt-auto">
                            <div class="d-flex gap-2">
                                <a href="update_product.php?get_id=<?= (int)$product_id; ?>" class="btn btn-outline-dark btn-sm w-100">
                                    <i class="bi bi-pencil-square me-1"></i> Update
                                </a>
                                <button type="submit" name="delete_product" class="btn btn-outline-danger btn-sm w-100"
                                        onclick="return confirm('Are you sure you want to delete this product?');">
                                    <i class="bi bi-trash me-1"></i> Delete
                                </button>
                            </div>
                            <a href="view_products.php?get_id=<?= (int)$product_id; ?>" class="btn btn-dark btn-sm mt-3 w-100">
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
