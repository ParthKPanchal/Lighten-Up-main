<?php
include 'connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
}else{
  $get_id = '';
  header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Lighten Up - Add Product</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/loader.css" />
<link rel="stylesheet" type="text/css" href="css/navbar.css" />
<link rel="stylesheet" type="text/css" href="css/banner.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include "components/navbar.php"; ?>
<!-- update product section start here -->
<section class="update-product py-5 d-flex align-items-center">
  <div class="container d-flex justify-content-center">
    <div class="col-md-8">
      <div class="bg-white p-3 p-sm-4 p-md-5 rounded-4 shadow-sm form-card animate-fade-up">
        <?php
          $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
          $select_product->execute([$get_id]);
          if($select_product->rowCount() > 0) {
            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
              $product_id = $fetch_product['id'];
              // $product_name = $fetch_product['name'];
              // $product_price = $fetch_product['price'];
              // $product_color = $fetch_product['color'];
              // $product_size = $fetch_product['size'];
              // $product_brand = $fetch_product['brand'];
              // $product_material = $fetch_product['material'];
              // $product_manufacturer = $fetch_product['manufacturer'];
              // $image_01 = $fetch_product['image_01'];
              // $image_02 = $fetch_product['image_02'];
              // $image_03 = $fetch_product['image_03'];
            }
          }else{
            echo '<p class="empty">Product not found!</p>';
          }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
          <h2 class="mb-4 text-center">Add Product</h2>
          <input type="hidden" name="product_id" value="<?= $product_id; ?>">
          <h4 class="mb-4 text-center">Image section</h4>
          <div class="mb-3">
            <label for="image_01" class="form-label fw-semibold">Main Image 1</label>
            <input type="file" class="form-control form-control-lg" id="image_01" name="image_01" accept="image/*" required value="<?= $image_01 = $fetch_product['image_01']; ?>"/>
          </div>
          <div class="mb-3">
            <label for="image_02" class="form-label fw-semibold">Main Image 2</label>
            <input type="file" class="form-control form-control-lg" id="image_02" name="image_02" accept="image/*" required value="<?= $image_02 = $fetch_product['image_02']; ?>"/>
          </div>
          <div class="mb-3">
            <label for="image_03" class="form-label fw-semibold">Main Image 3</label>
            <input type="file" class="form-control form-control-lg" id="image_03" name="image_03" accept="image/*" required value="<?= $image_03 = $fetch_product['image_03']; ?>"/>
          </div> 

          <h4 class="mb-4 text-center">Product Details</h4>         
          <div class="mb-3">
            <label for="product_name" class="form-label fw-semibold">Product Name</label>
            <input type="text" class="form-control form-control-lg" id="product_name" name="product_name" required value="<?= $product_name = $fetch_product['name']; ?>"/>
          </div>
          <div class="mb-3">
            <label for="product_price" class="form-label fw-semibold">Product Price</label>
            <input type="text" class="form-control form-control-lg" id="product_price" name="product_price" required value="<?= $product_price = $fetch_product['price']; ?>"/>
          </div>
          <div class="mb-3">
            <label for="color" class="form-label fw-semibold">Select Color</label>
            <select class="form-select form-select-lg" id="color" name="color" required>
              <option value="<?= $product_color = $fetch_product['color']; ?>" disabled selected><?= $product_color = $fetch_product['color']; ?></option>
              <option value="red">Red</option>
              <option value="blue">Blue</option>
              <option value="yellow">Yellow</option>
              <option value="green">Green</option>
              <option value="black">Black</option>
              <option value="white">White</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="size" class="form-label fw-semibold">Select Size</label>
            <select class="form-select form-select-lg" id="size" name="size" required>
              <option value="<?= $product_size = $fetch_product['size']; ?>" disabled selected><?= $product_size = $fetch_product['size']; ?></option>
              <option value="size_01">48</option>
              <option value="size_02">56</option>
              <option value="size_03">60</option>
            </select>
          </div>

          <h4 class="mb-4 text-center">Product Specifications</h4>
          <div class="mb-3">
            <label for="product_brand" class="form-label fw-semibold">Product Brand</label>
            <input type="text" class="form-control form-control-lg" id="product_brand" name="product_brand" required/>
          </div>
          <div class="mb-3">
            <label for="product_material" class="form-label fw-semibold">Product Material</label>
            <input type="text" class="form-control form-control-lg" id="product_material" name="product_material" required/>
          </div>
          <div class="mb-3">
            <label for="product_manufacturer" class="form-label fw-semibold">Product Manufacturer</label>
            <input type="text" class="form-control form-control-lg" id="product_manufacturer" name="product_manufacturer" required/>
          </div>

          <h4 class="mb-4 text-center">Why You'll Love It</h4>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="available" name="available">
            <label class="form-check-label fw-semibold" for="available">
              Available both online and in-store
            </label>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="rated" name="rated">
            <label class="form-check-label fw-semibold" for="rated">
              Highly rated by customers
            </label>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="installation" name="installation">
            <label class="form-check-label fw-semibold" for="installation">
              Includes installation and after-sales support
            </label>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="warranty" name="warranty">
            <label class="form-check-label fw-semibold" for="warranty">
              Comes with a manufacturer warranty
            </label>
          </div>

          <button type="submit" class="btn btn-dark w-100 btn-lg shadow-sm" name="add_product">Update Product now!</button>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- update product section end here -->
<?php include "components/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
 <?php
    include 'components/message.php';
    ?>
</body>
</html>
