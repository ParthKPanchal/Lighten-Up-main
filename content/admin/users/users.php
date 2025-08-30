<!-- Users Section -->
<section class="users container-fluid px-5 my-5">
  <h1 class="heading text-center fw-bold mb-4">
    <i class="bi bi-people-fill text-dark"></i> Users
  </h1>

  <form action="" method="POST" class="d-flex justify-content-center mb-4">
    <div class="col">
      <input type="text" name="search_box" placeholder="Search users..." maxlength="100"
            class="form-control w-100" required>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-dark ms-2" name="search_btn">
        <i class="bi bi-search"></i> Search
      </button>
    </div>
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