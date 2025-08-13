<?php
include 'connect.php'; // must return a PDO connection in $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Upload images
    $imageFields = ['mainImage1', 'mainImage2', 'mainImage3'];
    $uploadedImages = [];

    foreach ($imageFields as $field) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] == 0) {
            $targetDir = "uploads/";
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $fileName = time() . "_" . basename($_FILES[$field]['name']);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES[$field]["tmp_name"], $targetFile)) {
                $uploadedImages[$field] = $targetFile;
            } else {
                $uploadedImages[$field] = null;
            }
        } else {
            $uploadedImages[$field] = null;
        }
    }

    // Collect form data
    $productName = $_POST['productName'] ?? '';
    $price = $_POST['price'] ?? '';
    $colors = $_POST['colors'] ?? '';
    $sizes = $_POST['sizes'] ?? '';
    $features = $_POST['features'] ?? '';
    $brand = $_POST['brand'] ?? '';
    $material = $_POST['material'] ?? '';
    $manufacturer = $_POST['manufacturer'] ?? '';

    // Insert into DB
    $sql = "INSERT INTO products 
            (product_name, price, colors, sizes, features, brand, material, manufacturer, main_image1, main_image2, main_image3)
            VALUES 
            (:product_name, :price, :colors, :sizes, :features, :brand, :material, :manufacturer, :main_image1, :main_image2, :main_image3)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':product_name' => $productName,
        ':price' => $price,
        ':colors' => $colors,
        ':sizes' => $sizes,
        ':features' => $features,
        ':brand' => $brand,
        ':material' => $material,
        ':manufacturer' => $manufacturer,
        ':main_image1' => $uploadedImages['mainImage1'],
        ':main_image2' => $uploadedImages['mainImage2'],
        ':main_image3' => $uploadedImages['mainImage3']
    ]);

    echo "<script>alert('Product added successfully!'); window.location.href='add_product.php';</script>";
}
?>
