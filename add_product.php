<?php
include 'connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['add_product'])) {
    $id = create_unique_id();

    // Sanitize product details
    $product_name         = filter_var($_POST['product_name'], FILTER_SANITIZE_STRING);
    $product_price        = filter_var($_POST['product_price'], FILTER_SANITIZE_STRING);
    $color                = filter_var($_POST['color'], FILTER_SANITIZE_STRING);
    $size                 = filter_var($_POST['size'], FILTER_SANITIZE_STRING);
    $product_brand        = filter_var($_POST['product_brand'], FILTER_SANITIZE_STRING);
    $product_material     = filter_var($_POST['product_material'], FILTER_SANITIZE_STRING);
    $product_manufacturer = filter_var($_POST['product_manufacturer'], FILTER_SANITIZE_STRING);

    // Checkbox values
    $available   = isset($_POST['available']) ? filter_var($_POST['available'], FILTER_SANITIZE_STRING) : 'no';
    $rated       = isset($_POST['rated']) ? filter_var($_POST['rated'], FILTER_SANITIZE_STRING) : 'no';
    $installation= isset($_POST['installation']) ? filter_var($_POST['installation'], FILTER_SANITIZE_STRING) : 'no';
    $warranty    = isset($_POST['warranty']) ? filter_var($_POST['warranty'], FILTER_SANITIZE_STRING) : 'no';

    // Function to handle image uploads
    function handleImageUpload($inputName) {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == 0) {
            $fileName = filter_var($_FILES[$inputName]['name'], FILTER_SANITIZE_STRING);
            $fileExt  = pathinfo($fileName, PATHINFO_EXTENSION);
            $newName  = create_unique_id() . '.' . $fileExt;
            $tmpName  = $_FILES[$inputName]['tmp_name'];
            $fileSize = $_FILES[$inputName]['size'];
            $filePath = 'uploaded_files/' . $newName;

            if ($fileSize > 2000000) {
                return ['error' => 'Image size is too large!'];
            }

            if (move_uploaded_file($tmpName, $filePath)) {
                return ['name' => $newName];
            }
        }
        return ['name' => '']; // If no file uploaded
    }

    // Process images
    $image1 = handleImageUpload('image_01');
    $image2 = handleImageUpload('image_02');
    $image3 = handleImageUpload('image_03');

    // If any image had size error
    if (!empty($image1['error']) || !empty($image2['error']) || !empty($image3['error'])) {
        $warning_msg[] = $image1['error'] ?? $image2['error'] ?? $image3['error'];
    } else {
        // Insert into DB
        $add_product = $conn->prepare("
            INSERT INTO `products`
            (id, user_id, image_01, image_02, image_03, product_name, product_price, color, size, product_brand, product_material, product_manufacturer, available, rated, installation, warranty) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $add_product->execute([
            $id,
            $user_id,
            $image1['name'],
            $image2['name'],
            $image3['name'],
            $product_name,
            $product_price,
            $color,
            $size,
            $product_brand,
            $product_material,
            $product_manufacturer,
            $available,
            $rated,
            $installation,
            $warranty
        ]);

        $success_msg[] = 'Product added successfully!';
    }
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

<section class="add-product py-5 d-flex align-items-center">
  <div class="container d-flex justify-content-center">
    <div class="col-md-8">
      <div class="bg-white p-3 p-sm-4 p-md-5 rounded-4 shadow-sm form-card animate-fade-up">
        <form action="" method="POST" enctype="multipart/form-data">
          <h2 class="mb-4 text-center">Add Product</h2>

          <h4 class="mb-4 text-center">Image section</h4>
          <div class="mb-3">
            <label for="image_01" class="form-label fw-semibold">Main Image 1</label>
            <input type="file" class="form-control form-control-lg" id="image_01" name="image_01" accept="image/*" required />
          </div>
          <div class="mb-3">
            <label for="image_02" class="form-label fw-semibold">Main Image 2</label>
            <input type="file" class="form-control form-control-lg" id="image_02" name="image_02" accept="image/*" required />
          </div>
          <div class="mb-3">
            <label for="image_03" class="form-label fw-semibold">Main Image 3</label>
            <input type="file" class="form-control form-control-lg" id="image_03" name="image_03" accept="image/*" required />
          </div> 

          <h4 class="mb-4 text-center">Product Details</h4>         
          <div class="mb-3">
            <label for="product_name" class="form-label fw-semibold">Product Name</label>
            <input type="text" class="form-control form-control-lg" id="product_name" name="product_name" required/>
          </div>
          <div class="mb-3">
            <label for="product_price" class="form-label fw-semibold">Product Price</label>
            <input type="text" class="form-control form-control-lg" id="product_price" name="product_price" required/>
          </div>
          <div class="mb-3">
            <label for="color" class="form-label fw-semibold">Select Color</label>
            <select class="form-select form-select-lg" id="color" name="color" required>
              <option value="" disabled selected>Select Color</option>
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
              <option value="" disabled selected>Select Size</option>
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

          <button type="submit" class="btn btn-dark w-100 btn-lg shadow-sm" name="add_product">Add Product now!</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include "components/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
 <?php
    include 'components/message.php';
    ?>
</body>
</html>
