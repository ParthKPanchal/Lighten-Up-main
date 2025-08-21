<!-- search section start here -->
<section class="search-product py-5">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm form-card animate-fade-up">
          <form action="search.php" method="POST" enctype="multipart/form-data">
            
            <h2 class="text-center fw-bold mb-4">Tell me what do you want?</h2>
            
            <!-- Specifications -->
            <h4 class="mt-5 mb-3 text-center">Product Details</h4>
            <div class="row g-3">
              
              <!-- Product Name -->
              <div class="col-lg-4 col-md-6">
                <label class="form-label fw-semibold">Product Name</label>
                <input type="text" class="form-control" name="h_product_name" placeholder="Enter product name">
              </div>
              
              <!-- Min Price -->
              <div class="col-lg-2 col-md-6">
                <label class="form-label fw-semibold">Min Price</label>
                <select name="h_min" class="form-select">
                  <option value="" disabled selected>Select Min</option>
                  <option value="0">0</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="500">500</option>
                  <option value="1000">1k</option>
                  <option value="1500">1.5k</option>
                  <option value="2000">2k</option>
                  <option value="5000">5k</option>
                  <option value="10000">10k</option>
                  <option value="15000">15k</option>
                  <option value="20000">20k</option>
                  <option value="30000">30k</option>
               </select>
              </div>
              
              <!-- Max Price -->
              <div class="col-lg-2 col-md-6">
                <label class="form-label fw-semibold">Max Price</label>
                <select name="h_max" class="form-select">
                  <option value="" disabled selected>Select Max</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="500">500</option>
                  <option value="1000">1k</option>
                  <option value="1500">1.5k</option>
                  <option value="2000">2k</option>
                  <option value="5000">5k</option>
                  <option value="10000">10k</option>
                  <option value="15000">15k</option>
                  <option value="20000">20k</option>
                  <option value="30000">30k</option>
                </select>
              </div>
              
              <!-- Select Color -->
              <div class="col-lg-2 col-md-6">
                <label class="form-label fw-semibold">Select Color</label>
                <select class="form-select" name="h_color">
                  <option value="" disabled selected>Select Color</option>
                  <option>Red</option>
                  <option>Blue</option>
                  <option>Yellow</option>
                  <option>Brown</option>
                  <option>Green</option>
                  <option>Black</option>
                  <option>White</option>
                </select>
              </div>
              
              <!-- Select Size -->
              <div class="col-lg-2 col-md-6">
                <label class="form-label fw-semibold">Select Size</label>
                <select class="form-select" name="h_size">
                  <option value="" disabled selected>Select Size</option>
                  <option>48</option>
                  <option>56</option>
                  <option>60</option>
                </select>
              </div>
            </div>

            <!-- Specifications -->
            <h4 class="mt-5 mb-3 text-center">Product Specifications</h4>
            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label fw-semibold">Brand</label>
                <input type="text" class="form-control" name="h_product_brand" placeholder="e.g. Philips">
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold">Material</label>
                <input type="text" class="form-control" name="h_product_material" placeholder="e.g. Plastic">
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold">Manufacturer</label>
                <input type="text" class="form-control" name="h_product_manufacturer" placeholder="e.g. Bajaj">
              </div>
            </div>

            <div class="mt-5">
              <button type="submit" class="btn btn-dark w-100 btn-lg shadow-sm" name="h_search">
                Search
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
