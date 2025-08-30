
<section class="container-fluid px-5 my-5">
  <h1 class="text-center fw-bold mb-5">
    <i class="bi bi-shield-lock-fill text-dark"></i> Manage Admins
  </h1>


  <!-- Search Form -->
  <form action="" method="POST" class="row g-2 mb-5 justify-content-center">
    <div class="col">
    <input type="text" name="search_box" placeholder="Search admins..." 
           class="form-control" required>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-dark" name="search_btn">
        <i class="bi bi-search"></i> Search
      </button>
    </div>
  </form>

  <?php
      // Fetch logged-in admin first
      $my_admin = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
      $my_admin->execute([$admin_id]);
      $my_data = $my_admin->fetch(PDO::FETCH_ASSOC);
  ?>
  <!-- My Account Card -->
  <div class="card shadow-lg border-0 mb-5">
    <div class="card-body text-center bg-light">
      <i class="bi bi-person-circle display-4 text-dark mb-3"></i>
      <h4 class="fw-bold"><?= htmlspecialchars($my_data['name']); ?> (You)</h4>
      <p class="text-muted">This is your account</p>
      <div class="d-flex justify-content-center gap-2">
        <a href="update.php" class="btn btn-dark">
          <i class="bi bi-pencil-square"></i> Update Account
        </a>
        <a href="register.php" class="btn btn-dark">
          <i class="bi bi-person-plus"></i> Register New
        </a>
      </div>
    </div>
  </div>

  <h3 class="fw-bold mb-4">Other Admins</h3>
  <div class="row g-4">
    <?php
      // Search query
      if(isset($_POST['search_box']) || isset($_POST['search_btn'])){
         $search_box = $_POST['search_box'];
         $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
         $select_admins = $conn->prepare("SELECT * FROM `admins` WHERE name LIKE ? AND id != ?");
         $select_admins->execute(["%$search_box%", $admin_id]);
      }else{
         $select_admins = $conn->prepare("SELECT * FROM `admins` WHERE id != ?");
         $select_admins->execute([$admin_id]);
      }

      if($select_admins->rowCount() > 0){
         while($fetch_admins = $select_admins->fetch(PDO::FETCH_ASSOC)){
    ?>
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body text-center">
          <i class="bi bi-person-fill display-5 text-secondary mb-3"></i>
          <h5 class="card-title"><?= htmlspecialchars($fetch_admins['name']); ?></h5>
          <form action="" method="POST" onsubmit="return confirm('Delete this admin?');">
            <input type="hidden" name="delete_id" value="<?= $fetch_admins['id']; ?>">
            <button type="submit" name="delete" class="btn btn-dark w-100">
              <i class="bi bi-trash"></i> Delete Admin
            </button>
          </form>
        </div>
      </div>
    </div>
    <?php
         }
      } elseif(isset($_POST['search_box']) || isset($_POST['search_btn'])) {
         echo '<p class="text-center text-muted">No results found!</p>';
      } else {
    ?>
      <p class="text-center text-muted">No other admins added yet!</p>
    <?php } ?>
  </div>
</section>