<!-- search section start here -->
<section class="search-product py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm form-card animate-fade-up">
          <form action="search.php" method="POST" enctype="multipart/form-data">
            <h2 class="mb-4 text-center fw-bold">Tell me what do you want?</h2>
            <!-- Specifications -->
            <h4 class="mt-5 mb-3 text-center">Product Details</h4>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold">Product Name</label>
                <input type="text" class="form-control" name="h_product_name">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Product Price</label>
                <input type="text" class="form-control" name="h_product_price">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Select Color</label>
                <select class="form-select" name="h_color">
                  <option disabled selected>Color</option>
                  <option>Red</option><option>Blue</option><option>Yellow</option><option>Brown</option>
                  <option>Green</option><option>Black</option><option>White</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Select Size</label>
                <select class="form-select" name="h_size">
                  <option disabled selected>Select Size</option>
                  <option>48</option><option>56</option><option>60</option>
                </select>
              </div>
            </div>

            <!-- Specifications -->
            <h4 class="mt-5 mb-3 text-center">Product Specifications</h4>
            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label fw-semibold">Brand</label>
                <input type="text" class="form-control" name="h_product_brand">
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold">Material</label>
                <input type="text" class="form-control" name="h_product_material">
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold">Manufacturer</label>
                <input type="text" class="form-control" name="h_product_manufacturer">
              </div>
            </div>

            <div class="mt-5">
              <button type="submit" class="btn btn-dark w-100 btn-lg shadow-sm" name="h_search_product">
                Search
              </button>
            </div>
          </form>
    </div>
                </section>