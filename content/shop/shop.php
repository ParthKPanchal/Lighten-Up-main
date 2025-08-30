<section class="shop-product py-5">
    <div class="container-fluid px-5">
        <h1 class="text-center mb-5 fw-bold">🛒 Shop Products</h1>
        <div class="row">

            <!-- Sidebar Filter -->
            <aside class="col-lg-3 mb-4">
                <form method="GET" class="bg-light p-3 rounded-4 shadow-sm">
                    <h5 class="fw-bold mb-3"><i class="bi bi-funnel"></i> Filters</h5>

                    <!-- Category Filter -->
                    <div class="mb-3">
                    <label class="fw-semibold mb-2">Category</label>
                        <?php foreach ($categorys as $category): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" value="<?= htmlspecialchars($category) ?>" <?= (isset($_GET['category']) && $_GET['category'] === $category) ? 'checked' : '' ?>>
                                <label class="form-check-label"><?= htmlspecialchars($category) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Brand Filter -->
                    <div class="mb-3">
                        <label class="fw-semibold mb-2">Brand</label>
                        <?php foreach ($brands as $brand): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="brand" value="<?= htmlspecialchars($brand) ?>" <?= (isset($_GET['brand']) && $_GET['brand'] === $brand) ? 'checked' : '' ?>>
                                <label class="form-check-label"><?= htmlspecialchars($brand) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Material Filter -->
                    <div class="mb-3">
                        <label class="fw-semibold mb-2">Material</label>
                        <?php foreach ($materials as $material): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="material" value="<?= htmlspecialchars($material) ?>" <?= (isset($_GET['material']) && $_GET['material'] === $material) ? 'checked' : '' ?>>
                                <label class="form-check-label"><?= htmlspecialchars($material) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-3">
                        <label class="fw-semibold mb-2">Price Range</label>
                        <div class="d-flex gap-2">
                            <input type="number" name="min_price" class="form-control" placeholder="Min" value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>">
                            <input type="number" name="max_price" class="form-control" placeholder="Max" value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>">
                        </div>
                    </div>

                        <!-- Buttons -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-dark fw-bold"><i class="bi bi-funnel"></i> Apply</button>
                        <a href="shop.php" class="btn btn-outline-secondary fw-bold"><i class="bi bi-x-circle"></i> Reset</a>
                    </div>
                </form>
            </aside>

            <!-- Product Grid -->
            <div class="col-lg-9">
                <div class="row g-4">
                    <?php if ($select_products->rowCount() > 0): ?>
                    <?php while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)):

                        $select_admins = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
                        $select_admins->execute([$fetch_products['admin_id']]);
                        $fetch_user = $select_admins->fetch(PDO::FETCH_ASSOC);

                        $image_count_02 = !empty($fetch_products['image_02']) ? 1 : 0;
                        $image_count_03 = !empty($fetch_products['image_03']) ? 1 : 0;
                        $total_images = (1 + $image_count_02 + $image_count_03);

                        $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE product_id = ? and user_id = ?");
                        $select_saved->execute([$fetch_products['id'], $user_id]);
                    ?>
                    <!-- 🔹 Product Card -->
                    <div class="col-md-6 col-lg-4">
                        <form action="" method="POST" class="h-100">
                            <input type="hidden" name="product_id" value="<?= ($fetch_products['id']); ?>">
                            <input type="hidden" name="quantity" value="1">

                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden position-relative product-card">
                                
                                <!-- Product Image -->
                                <div class="position-relative">
                                    <?php if(!empty($fetch_products['image_01'])): ?>
                                        <img src="uploaded_files/<?= ($fetch_products['image_01']); ?>" class="card-img-top rounded-top product-img" alt="">
                                    <?php else: ?>
                                        <img src="asset/image/no-image.png" class="card-img-top rounded-top product-img" alt="No image available">
                                    <?php endif; ?>

                                    <!-- Total Images Badge -->
                                    <span class="badge bg-dark position-absolute top-0 start-0 m-2 px-2 py-1 shadow-sm rounded-pill">
                                        <i class="bi bi-image"></i> <?= $total_images; ?>
                                    </span>

                                    <!-- Save Button -->
                                    <?php if($select_saved->rowCount()>0){ ?>
                                        <button class="btn btn-danger position-absolute top-0 end-0 m-2 rounded-circle shadow-sm" type="submit" name="save">
                                            <i class="bi bi-heart-fill"></i>
                                        </button>
                                    <?php } else { ?>
                                        <button class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle shadow-sm" type="submit" name="save">
                                            <i class="bi bi-heart"></i>
                                        </button>
                                    <?php } ?>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-3">
                                        <?php if($fetch_user): ?>
                                            <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; font-weight:bold;">
                                                <?= (substr($fetch_user['name'], 0, 1)); ?>
                                            </div>
                                            <div class="ms-2">
                                                <p class="mb-0 fw-semibold"><?= ($fetch_user['name']); ?></p>
                                                <small class="text-muted"><?= ($fetch_products['date']); ?></small>
                                            </div>
                                        <?php else: ?>
                                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; font-weight:bold;">?</div>
                                            <div class="ms-2">
                                                <p class="mb-0 fw-semibold">Unknown</p>
                                                <small class="text-muted"><?= ($fetch_products['date']); ?></small>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Product Details -->
                                    <h5 class="card-title fw-bold"><?= htmlspecialchars($fetch_products['product_name']) ?></h5>
                                    <p class="text-success fw-bold h5 mb-3"><i class="fas fa-indian-rupee-sign"></i> <?= ($fetch_products['product_price']); ?></p>
                                    <ul class="list-unstyled text-muted small mb-4">
                                        <li><strong>Brand:</strong> <?= ($fetch_products['product_brand']); ?></li>
                                        <li><strong>Material:</strong> <?= ($fetch_products['product_material']); ?></li>
                                        <li><strong>Manufacturer:</strong> <?= ($fetch_products['product_manufacturer']); ?></li>
                                    </ul>

                                    <!-- Action Buttons -->
                                    <div class="mt-auto d-flex gap-2">
                                        <a href="view_products.php?get_id=<?= ($fetch_products['id']); ?>" class="btn btn-outline-dark flex-fill rounded-3">👁 View</a>
                                        <input type="submit" value="📩 Enquiry" name="send" class="btn btn-dark flex-fill rounded-3">
                                    </div>

                                    <!-- Add to Cart -->
                                    <button type="submit" name="add_to_cart" class="btn btn-warning w-100 mt-3 fw-semibold shadow-sm rounded-3">
                                        <i class="bi bi-cart me-1"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <h4 class="alert alert-dark text-center shadow-sm">No Result Found!</h4>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>