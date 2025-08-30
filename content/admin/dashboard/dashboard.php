<!-- dashboard section start here -->
<section class="dashboard py-5">
    <h1 class="text-center fw-bold mb-4">
        <i class="bi bi-speedometer2 text-dark"></i> Dashboard
    </h1>

    <div class="container-fluid px-5">
        <div class="row g-4">

            <!-- Profile Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card dashboard-card text-center h-100">
                    <div class="card-body">
                        <?php
                        $select_profile=$conn->prepare("SELECT * FROM `admins` WHERE id=? LIMIT 1");
                        $select_profile->execute([$admin_id]);
                        $fetch_profile=$select_profile->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="mb-3"><i class="bi bi-person-circle display-4 text-secondary"></i></div>
                        <h3 class="card-title"><?= $fetch_profile['name']; ?></h3>
                        <p class="text-muted">Welcome!</p>
                        <a href="update.php" class="btn btn-outline-dark btn-sm">Update Profile</a>
                    </div>
                </div>
            </div>

            <!-- Requests Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card dashboard-card text-center h-100">
                    <div class="card-body">
                        <?php
                        $count_requests_received = $conn->prepare("SELECT * FROM `requests` WHERE receiver = ?");
                        $count_requests_received->execute([$admin_id]);
                        $total_requests_received = $count_requests_received->rowCount();
                        ?>
                        <div class="mb-3"><i class="bi bi-box-seam-fill display-4 text-success"></i></div>
                        <h3><?= $total_requests_received; ?></h3>
                        <p class="text-muted">Add Products</p>
                        <a href="requests.php" class="btn btn-outline-success btn-sm">View Requests</a>
                    </div>
                </div>
            </div>

            <!-- Total Products Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card dashboard-card text-center h-100">
                    <div class="card-body">
                        <?php
                        $count_select_products=$conn->prepare("SELECT * FROM `products`");
                        $count_select_products->execute();
                        $total_products=$count_select_products->rowCount();
                        ?>
                        <div class="mb-3"><i class="bi bi-bag-check-fill display-4 text-primary"></i></div>
                        <h3><?= $total_products; ?></h3>
                        <p class="text-muted">Total Products</p>
                        <a href="my_product.php" class="btn btn-outline-primary btn-sm">My Products</a>
                    </div>
                </div>
            </div>

            <!-- Users Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card dashboard-card text-center h-100">
                    <div class="card-body">
                        <?php
                        $count_select_users=$conn->prepare("SELECT * FROM `users`");
                        $count_select_users->execute();
                        $total_users=$count_select_users->rowCount();
                        ?>
                        <div class="mb-3"><i class="bi bi-people-fill display-4 text-info"></i></div>
                        <h3><?= $total_users; ?></h3>
                        <p class="text-muted">Total Customers</p>
                        <a href="users.php" class="btn btn-outline-info btn-sm">View Users</a>
                    </div>
                </div>
            </div>

            <!-- Admins Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card dashboard-card text-center h-100">
                    <div class="card-body">
                        <?php
                        $count_select_admins=$conn->prepare("SELECT * FROM `admins`");
                        $count_select_admins->execute();
                        $total_admins=$count_select_admins->rowCount();
                        ?>
                        <div class="mb-3"><i class="bi bi-shield-lock-fill display-4 text-warning"></i></div>
                        <h3><?= $total_admins; ?></h3>
                        <p class="text-muted">Total Admins</p>
                        <a href="admins.php" class="btn btn-outline-warning btn-sm">View Admins</a>
                    </div>
                </div>
            </div>

            <!-- Messages Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card dashboard-card text-center h-100">
                    <div class="card-body">
                        <?php
                        $count_select_messages=$conn->prepare("SELECT * FROM `messages`");
                        $count_select_messages->execute();
                        $total_messages=$count_select_messages->rowCount();
                        ?>
                        <div class="mb-3"><i class="bi bi-envelope-fill display-4 text-danger"></i></div>
                        <h3><?= $total_messages; ?></h3>
                        <p class="text-muted">Total Messages</p>
                        <a href="messages.php" class="btn btn-outline-danger btn-sm">View Messages</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- dashboard section end here -->

