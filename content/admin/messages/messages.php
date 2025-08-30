<section class="container-fluid px-5 my-5">
  <h1 class="text-center fw-bold mb-4">
    <i class="bi bi-envelope-fill text-dark"></i> User Messages
  </h1>
  <form action="" method="POST" class="d-flex justify-content-center mb-5">
    <div class="col">
      <input type="text" name="search_box" placeholder="Search messages..." 
            class="form-control w-100" maxlength="100" required>
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
          $search_box = filter_var($_POST['search_box'], FILTER_SANITIZE_STRING);
          $select_messages = $conn->prepare("SELECT * FROM `messages` WHERE name LIKE ? OR number LIKE ? OR email LIKE ?");
          $select_messages->execute(["%$search_box%", "%$search_box%", "%$search_box%"]);
      } else {
          $select_messages = $conn->prepare("SELECT * FROM `messages` ORDER BY id DESC");
          $select_messages->execute();
      }

      if ($select_messages->rowCount() > 0) {
          while ($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="col-md-6 col-lg-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body">
          <h5 class="card-title fw-bold">
            <i class="bi bi-person-circle text-dark"></i> 
            <?= htmlspecialchars($fetch_messages['name']); ?>
          </h5>
          <p class="mb-1"><i class="bi bi-envelope"></i> 
            <a class="text-dark text-decoration-none" href="mailto:<?= $fetch_messages['email']; ?>">
              <?= htmlspecialchars($fetch_messages['email']); ?>
            </a>
          </p>
          <p class="mb-1"><i class="bi bi-telephone"></i> 
            <a class="text-dark text-decoration-none" href="tel:<?= $fetch_messages['number']; ?>">
              <?= htmlspecialchars($fetch_messages['number']); ?>
            </a>
          </p>
          <p class="mt-3 text-muted">
            <i class="bi bi-chat-dots"></i> 
            <?= nl2br(htmlspecialchars($fetch_messages['message'])); ?>
          </p>
        </div>
        <div class="card-footer bg-white border-0 d-flex justify-content-between">
          <small class="text-muted">Message ID: <?= $fetch_messages['id']; ?></small>
          <form action="" method="POST" onsubmit="return confirm('Delete this message?');">
            <input type="hidden" name="delete_id" value="<?= $fetch_messages['id']; ?>">
            <button type="submit" name="delete" class="btn btn-sm btn-danger">
              <i class="bi bi-trash"></i> Delete
            </button>
          </form>
        </div>
      </div>
    </div>
    <?php
          }
      } elseif (isset($_POST['search_box']) || isset($_POST['search_btn'])) {
          echo '<p class="text-center text-muted">No results found!</p>';
      } else {
          echo '<p class="text-center text-muted">You have no messages!</p>';
      }
    ?>
  </div>
</section>