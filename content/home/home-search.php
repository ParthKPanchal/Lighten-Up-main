<section class="filter-product container-fluid px-5">
  <div class="row justify-content-center">
    <div class="col-lg-12 col-md-12">
      <div class="card filter-card shadow-lg border-0 rounded-3 animate-fade-slide">
        <div class="card-body p-4 p-md-5">
          <h1 class="text-center mb-4 fw-bold text-dark">
            🔎 Filter Your Search
          </h1>

          <form action="" method="POST" class="form">
            <div class="row g-4">
              <!-- Product Brand Name -->
              <div class="col-md-6 col-lg-2">
                <label class="form-label fw-semibold"><i class="bi bi-tags-fill me-1"></i> Brand</label>
                <input type="text" class="form-control form-control-modern" name="product_brand" placeholder="Enter Brand Name">
              </div>

              <!-- Category -->
              <div class="col-md-6 col-lg-2">
                <label class="form-label fw-semibold"><i class="bi bi-grid-3x3-gap-fill me-1"></i> Category</label>
                <select class="form-select form-select-modern" name="category">
                  <option value="" disabled selected>Select Category</option>
                  <option value="Fan">Fan</option>
                  <option value="Light">Light</option>
                  <option value="Switch">Switch</option>
                  <option value="Wire">Wire</option>
                </select>
              </div>

              <!-- Min Price -->
              <div class="col-md-6 col-lg-2">
                <label class="form-label fw-semibold"><i class="bi bi-currency-rupee me-1"></i> Min Price</label>
                <select name="min" class="form-select form-select-modern">
                  <option value="" disabled selected>Select Min</option>
                  <option value="0">0</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="500">500</option>
                  <option value="1000">1000</option>
                  <option value="1500">1500</option>
                  <option value="2000">2000</option>
                  <option value="5000">5000</option>
                  <option value="10000">10000</option>
                  <option value="15000">15000</option>
                  <option value="20000">20000</option>
                  <option value="30000">30000</option>
                </select>
              </div>

              <!-- Max Price -->
              <div class="col-md-6 col-lg-2">
                <label class="form-label fw-semibold"><i class="bi bi-currency-rupee me-1"></i> Max Price</label>
                <select name="max" class="form-select form-select-modern">
                  <option value="" disabled selected>Select Max</option>
                  <option value="0">0</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="500">500</option>
                  <option value="1000">1000</option>
                  <option value="1500">1500</option>
                  <option value="2000">2000</option>
                  <option value="5000">5000</option>
                  <option value="10000">10000</option>
                  <option value="15000">15000</option>
                  <option value="20000">20000</option>
                  <option value="30000">30000</option>
                </select>
              </div>

              <!-- Color -->
              <div class="col-md-6 col-lg-2">
                <label class="form-label fw-semibold"><i class="bi bi-palette-fill me-1"></i> Color</label>
                <select class="form-select form-select-modern" name="color">
                  <option value="" disabled selected>Select Color</option>
                  <option>Red</option>
                  <option>Blue</option>
                  <option>Yellow</option>
                  <option>Brown</option>
                  <option>Green</option>
                  <option>Black</option>
                  <option>White</option>
                  <option>Ivory</option>
                  <option>Almond</option>
                  <option>Light Almond</option>
                  <option>Gray</option>
                  <option>Brushed Nickel</option>
                  <option>Brass</option>
                  <option>Oil-Rubbed Bronze</option>
                  <option>Gold</option>
                  <option>Matte Black</option>
                  <option>Wood</option>
                  <option>Copper</option>
                  <option>Silver</option>
                  <option>Champagne</option>
                  <option>Orange</option>
                  <option>Green-Yellow Stripe</option>
                </select>
              </div>

              <!-- Size -->
              <div class="col-md-6 col-lg-2">
                <label class="form-label fw-semibold"><i class="bi bi-aspect-ratio-fill me-1"></i> Size</label>
                <select class="form-select form-select-modern" name="size">
                  <option value="" disabled selected>Select Size</option>
                  <option>24</option>
                  <option>36</option>
                  <option>42</option>
                  <option>48</option>
                  <option>52</option>
                  <option>56</option>
                  <option>60</option>
                  <option>62</option>
                  <option>65</option>
                  <option>72</option>
                  <option>Single Gang</option>
                  <option>Double Gang</option>
                  <option>Triple Gang</option>
                  <option>Quad Gang</option>
                  <option>Jumbo</option>
                  <option>14 AWG</option>
                  <option>12 AWG</option>
                  <option>10 AWG</option>
                  <option>8 AWG</option>
                  <option>6 AWG</option>
                  <option>4 sq mm</option>
                  <option>6 sq mm</option>
                  <option>10 sq mm</option>
                  <option>16 sq mm</option>
                  <option>25 sq mm</option>
                </select>
              </div>

              <!-- Search Button -->
              <div class="col-12 text-center mt-4">
                <button type="submit" name="filter_search" class="btn btn-gradient filter-btn">
                  🔍 Apply Filter
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- search section start here -->
    <?php
      if(isset($_POST['h_search'])){
              $h_product_brand = isset($_POST['h_product_brand']) ? filter_var($_POST['h_product_brand'], FILTER_SANITIZE_STRING) : '';
              
              $h_min = isset($_POST['h_min']) ? filter_var($_POST['h_min'], FILTER_VALIDATE_FLOAT) : 0;
              $h_max = isset($_POST['h_max']) ? filter_var($_POST['h_max'], FILTER_VALIDATE_FLOAT) : PHP_INT_MAX;
              $h_category = isset($_POST['h_category']) ? filter_var($_POST['h_category'], FILTER_SANITIZE_STRING) : '';
              $h_color = isset($_POST['h_color']) ? filter_var($_POST['h_color'], FILTER_SANITIZE_STRING) : '';
              $h_size = isset($_POST['h_size']) ? filter_var($_POST['h_size'], FILTER_SANITIZE_STRING) : '';

              $select_products = $conn->prepare("SELECT * FROM products WHERE product_brand LIKE '%{$h_product_brand}%'AND category LIKE '%{$h_category}%' AND color LIKE '%{$h_color}%' AND size LIKE '%{$h_size}%' AND product_price BETWEEN $h_min AND $h_max ORDER BY date DESC");
              $select_products->execute();
      }elseif(isset($_POST['filter_search'])){
              $product_brand = isset($_POST['product_brand']) ? filter_var($_POST['product_brand'], FILTER_SANITIZE_STRING) : '';
              
              $min = isset($_POST['min']) ? filter_var($_POST['min'], FILTER_VALIDATE_FLOAT) : 0;
              $max = isset($_POST['max']) ? filter_var($_POST['max'], FILTER_VALIDATE_FLOAT) : PHP_INT_MAX;
              $category = isset($_POST['category']) ? filter_var($_POST['category'], FILTER_SANITIZE_STRING) : '';
              $color = isset($_POST['color']) ? filter_var($_POST['color'], FILTER_SANITIZE_STRING) : '';
              $size = isset($_POST['size']) ? filter_var($_POST['size'], FILTER_SANITIZE_STRING) : '';

              $select_products = $conn->prepare("SELECT * FROM products WHERE product_brand LIKE '%{$product_brand}%' AND category LIKE '%{$category}%' AND color LIKE '%{$color}%' AND size LIKE '%{$size}%' AND product_price BETWEEN $min AND $max ORDER BY date DESC");
              $select_products->execute();
      }else{
              $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY date DESC LIMIT 6");
              $select_products->execute();
      }
    ?>
