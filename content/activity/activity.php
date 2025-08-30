<!-- Dashboard Section -->
<section class="dashboard py-5">
    <div class="container-fluid px-5 px-md-5">
        <h1 class="text-center fw-bold text-dark mb-5">My Activity</h1>
        <div class="row g-4">

            <!-- User Welcome -->
            <div class="col-md-6 col-lg-4">
                <div class="card dashboard-card shadow-sm border-0 rounded-4 h-100">
                    <div class="card-body d-flex flex-column text-center p-4">
                        <?php
                        $select_user = $conn->prepare("SELECT * FROM `users` WHERE id=? LIMIT 1");
                        $select_user->execute([$user_id]);
                        $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="icon-wrapper bg-dark text-white mx-auto mb-3">
                            <i class="bi bi-person-circle fs-1"></i>
                        </div>
                        <h4 class="fw-bold">Welcome!</h4>
                        <p class="text-muted border rounded-3 py-1 px-3 d-inline-block bg-white shadow-sm"><?= $fetch_user['name']; ?></p>
                        <div class="mt-auto">
                            <a href="update.php" class="btn btn-dark rounded-pill shadow-sm hover-scale w-100">Update Profile</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Search -->
            <div class="col-md-6 col-lg-4">
                <div class="card dashboard-card shadow-sm border-0 rounded-4 h-100">
                    <div class="card-body d-flex flex-column text-center p-4">
                        <div class="icon-wrapper bg-primary text-white mx-auto mb-3">
                            <i class="bi bi-search fs-1"></i>
                        </div>
                        <h4 class="fw-bold">Filter Search</h4>
                        <p class="text-muted border rounded-3 py-1 px-3 d-inline-block bg-white shadow-sm">Search your product easily</p>
                        <div class="mt-auto">
                            <a href="search.php" class="btn btn-primary rounded-pill shadow-sm hover-scale w-100">Search Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Saved Products -->
            <div class="col-md-6 col-lg-4">
                <div class="card dashboard-card shadow-sm border-0 rounded-4 h-100">
                    <div class="card-body d-flex flex-column text-center p-4">
                        <?php
                        $count_saved_products = $conn->prepare("SELECT * FROM `saved` WHERE user_id = ?");
                        $count_saved_products->execute([$user_id]);
                        $total_saved_products = $count_saved_products->rowCount();
                        ?>
                        <div class="icon-wrapper bg-danger text-white mx-auto mb-3">
                            <i class="bi bi-heart-fill fs-1"></i>
                        </div>
                        <h4 class="fw-bold"><?= $total_saved_products; ?></h4>
                        <p class="text-muted border rounded-3 py-1 px-3 d-inline-block bg-white shadow-sm">Saved Products</p>
                        <div class="mt-auto">
                            <a href="saved.php" class="btn btn-danger rounded-pill shadow-sm hover-scale w-100">View Saved</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

