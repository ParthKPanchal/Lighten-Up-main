<section class="add-product container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm form-card animate-fade-up">
            <h1 class="mb-4 text-center fw-bold">
              <i class="bi bi-box-seam-fill text-dark"></i> Add Product
            </h1>
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
              <!-- Image 01 -->
              <div class="col-md-4">
                <label class="form-label fw-semibold">Main Image 1</label>
                <input type="file" class="form-control" id="image_01" name="image_01" accept="image/*" required />
              </div>
              <!-- Image 01 -->
              <div class="col-md-4">
                <label class="form-label fw-semibold">Main Image 2</label>
                <input type="file" class="form-control" id="image_02" name="image_02" accept="image/*" required />
              </div>
              <!-- Image 01 -->
              <div class="col-md-4">
                <label class="form-label fw-semibold">Main Image 3</label>
                <input type="file" class="form-control" id="image_03" name="image_03" accept="image/*" required />
              </div>
              <div class="col-md-6">
                <label for="product_name" class="form-label fw-semibold">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required/>
              </div>
              <div class="col-md-6">
                <label for="product_price" class="form-label fw-semibold">Product Price</label>
                <input type="text" class="form-control" id="product_price" name="product_price" required/>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold">Select Category</label>
                <select class="form-select" name="category" required>
                  <option disabled selected>Select Category</option>
                  <option value="Fan">Fan</option>
                  <option value="Light">Light</option>
                  <option value="Switch">Switch</option>
                  <option value="Wire">Wire</option>
                </select>
              </div>

              <div class="col-md-4">
                <label class="form-label fw-semibold">Select Color</label>
                <select class="form-select" name="color">
                  <option disabled selected>Color</option>
                  <option>Red</option><option>Blue</option><option>Yellow</option><option>Brown</option>
                  <option>Green</option><option>Black</option><option>White</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold">Select Size</label>
                <select class="form-select" name="size">
                  <option disabled selected>Select Size</option>
                  <option>48</option><option>56</option><option>60</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold">Brand</label>
                <input type="text" class="form-control" id="product_brand" name="product_brand" required/>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold">Material</label>
                <input type="text" class="form-control" id="product_material" name="product_material" required/>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold">Manufacturer</label>
                <input type="text" class="form-control" id="product_manufacturer" name="product_manufacturer" required/>
              </div>
              <div class="col-md-6">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="available" name="available">
                  <label class="form-check-label">Available both online and in-store</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="rated" name="rated">
                  <label class="form-check-label">Highly rated by customers</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="installation" name="installation">
                  <label class="form-check-label">Includes installation and support</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="warranty" name="warranty">
                  <label class="form-check-label">Comes with warranty</label>
                </div>
              </div>
            <div class="mt-5">
              <button type="submit" class="btn btn-dark w-100 btn-lg shadow-sm" name="add_product">
                Add Product Now!
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
</section>