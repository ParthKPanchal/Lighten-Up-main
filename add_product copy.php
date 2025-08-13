<?php
include 'connect.php';
echo create_unique_id(); // Unique 20-char product ID

$user_id = $_COOKIE['user_id'] ?? "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Lighten Up - Add Product</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" href="css/loader.css" />
<link rel="stylesheet" type="text/css" href="css/navbar.css" />
<link rel="stylesheet" type="text/css" href="css/banner.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { background-color: #f8fafc; font-family: 'Karla', sans-serif; }
    .form-card { 
        max-width: 900px; 
        margin: 40px auto; 
        border-radius: 16px; 
    }
    .form-card h2 { font-family: 'Spectral', serif; font-weight: 700; }
    .preview-img {
        max-height: 180px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #dee2e6;
        background: #f6f6f6;
    }
    .input-group-text { background: #f2f2f7; }
</style>
</head>
<body>
<!-- Loader -->
<div class="loading-screen">
    <div class="loader text-center">
        <span>&lt;</span>
        <span>Gemlyte IT Solutions</span>
        <span>/&gt;</span>
    </div>
</div>

<!-- Main Content -->
<div id="main-content" style="display:none">
<?php include "components/navbar.php"; ?>

<section class="add_product py-5">
  <div class="container">
    <div class="bg-white p-md-5 shadow-sm form-card">
        <form action="submit_product.php" method="POST" enctype="multipart/form-data">   
            <h2 class="mb-4 text-center">
                <i class="bi bi-box-seam text-dark"></i> Add / Edit Product
            </h2>

            <!-- Images -->
            <h6 class="mb-3 text-dark"><i class="bi bi-image"></i> Product Images</h6>
            <?php for($i=1;$i<=3;$i++): ?>
            <div class="mb-3">
                <label for="mainImage<?php echo $i; ?>" class="form-label fw-semibold">
                    Main Image <?php echo $i; ?><?php if ($i==1) echo ' <span class="text-danger">*</span>'; ?>
                </label>
                <input type="file" class="form-control" 
                    name="mainImage<?php echo $i; ?>" 
                    id="mainImage<?php echo $i; ?>"
                    <?php echo $i==1 ? 'required' : ''; ?>
                    accept="image/*"
                    onchange="previewImage(event, <?php echo $i; ?>)">
                <div class="mt-2">
                    <img id="preview<?php echo $i; ?>" class="preview-img w-100" style="display:none;" alt="Preview">
                </div>
            </div>
            <?php endfor; ?>

            <!-- Details -->
            <h6 class="mt-4 mb-3 text-dark"><i class="bi bi-info-circle"></i> Product Details</h6>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-tag"></i></span>
                <input type="text" class="form-control" name="productName" placeholder="Product Name" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-currency-rupee"></i></span>
                <input type="number" step="0.01" class="form-control" name="price" placeholder="MRP Price" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-palette"></i></span>
                <select class="form-select" name="colors" required>
                    <option value="">Select a Color</option>
                    <option>White</option>
                    <option>Steel Grey</option>
                    <option>Rich Brown</option>
                    <option>Black</option>
                    <option>Matte Silver</option>
                    <option>Ivory</option>
                    <option>Wood Finish</option>
                </select>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-arrows-fullscreen"></i></span>
                <input type="text" class="form-control" name="sizes" placeholder='e.g., 48", 56", 60"' required>
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="bi bi-list-check"></i> Features</label>
                <textarea class="form-control" name="features" rows="3" placeholder="List features here..." required></textarea>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-building"></i></span>
                <input type="text" class="form-control" name="brand" placeholder="Brand" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-box"></i></span>
                <input type="text" class="form-control" name="material" placeholder="Material" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-gear-fill"></i></span>
                <input type="text" class="form-control" name="manufacturer" placeholder="Manufacturer" required>
            </div>

            <!-- Submit -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-dark w-100 btn-lg shadow-sm" name="submit" >
                  Save Now!
                </button>
            </div>
        </form>
    </div>
  </div>
</section>

<?php include "components/footer.php"; ?>
</div>

<!-- Loader JS -->
<script src="js/loader.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<!-- Image Preview Script -->
<script>
function previewImage(event, num) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById("preview"+num);
        output.src = reader.result;
        output.style.display = "block";
    }
    if(event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}
</script>

<?php include 'components/message.php'; ?>
</body>
</html>