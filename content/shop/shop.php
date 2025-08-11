<section class="shop py-5" style="margin-top:80px">
  <div class="container">
    <div class="row">
      <!-- Left Sidebar: Filter Buttons -->
      <div class="col-md-3 mb-4">
        <div class="card shadow-sm p-3 bg-light rounded-4 border-0">
          <h5 class="fw-bold mb-4 text-center text-primary">🔍 Filter Products</h5>

          <!-- Search Filter -->
          <div class="mb-4">
            <label for="searchInput" class="form-label fw-semibold">Keyword</label>
            <input
              type="text"
              id="searchInput"
              class="form-control rounded-pill shadow-sm"
              placeholder="Search products..."
            />
          </div>

          <!-- Category Filter -->
          <div class="mb-4">
            <label class="form-label fw-semibold">Category</label>
            <div class="border rounded-3 p-3 bg-white">
              <div class="form-check mb-2">
                <input class="form-check-input filter-checkbox" type="checkbox" value="fan" id="fanCheck" />
                <label class="form-check-label" for="fanCheck">🌀 Fan</label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input filter-checkbox" type="checkbox" value="light" id="lightCheck" />
                <label class="form-check-label" for="lightCheck">💡 Light</label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input filter-checkbox" type="checkbox" value="switch" id="switchCheck" />
                <label class="form-check-label" for="switchCheck">🔌 Switch</label>
              </div>
              <div class="form-check">
                <input class="form-check-input filter-checkbox" type="checkbox" value="wire" id="wireCheck" />
                <label class="form-check-label" for="wireCheck">🔗 Wire</label>
              </div>
            </div>
          </div>

          <!-- Price Filter -->
          <div class="mb-4">
            <label for="priceRange" class="form-label fw-semibold">💰 Max Price</label>
            <input
              type="range"
              class="form-range"
              id="priceRange"
              min="0"
              max="25000"
              value="25000"
              step="100"
            />
            <div class="text-muted small">Show products below ₹<span id="priceValue">25000</span></div>
          </div>

          <!-- Sort Filter -->
          <div class="mb-3">
            <label for="sortSelect" class="form-label fw-semibold">Sort by</label>
            <select id="sortSelect" class="form-select shadow-sm">
              <option value="latest">🆕 Latest</option>
              <option value="oldest">📜 Oldest</option>
            </select>
          </div>

        </div>
      </div>


      <!-- Right Content: Product Cards -->
      <div class="col-md-9">
        <h3 class="mb-4 fw-bold text-center">All Categories</h3>
        <div class="row g-4" id="productGrid">
          <!-- FAN Products -->
      <div class="col-md-6 product-card-item" data-category="fan" data-price="16999" data-date="2025-07-1">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/fan/ceiling fan.png" class="img-fluid" style="max-height: 120px;" alt="Fan 1">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Crompton Silent Pro Blossom</h5>
                <p class="small">High-speed, 3 blades, 53W, tropical style.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹16,999.00<br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 product-card-item" data-category="fan" data-price="3149" data-date="2025-07-2">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/fan/table fan.png" class="img-fluid" style="max-height: 120px;" alt="table fan">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Crompton Hiflo Wave Plus Table Fan</h5>
                <p class="small">Oscillating, 400mm, 55W, white.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹3,149.00 <br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 product-card-item" data-category="fan" data-price="16999" data-date="2025-06-1">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/fan/ceiling fan.png" class="img-fluid" style="max-height: 120px;" alt="Fan 1">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Crompton Silent Pro Blossom</h5>
                <p class="small">High-speed, 3 blades, 53W, tropical style.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹16,999.00<br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 product-card-item" data-category="fan" data-price="3149" data-date="2025-06-2">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/fan/table fan.png" class="img-fluid" style="max-height: 120px;" alt="table fan">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Crompton Hiflo Wave Plus Table Fan</h5>
                <p class="small">Oscillating, 400mm, 55W, white.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹3,149.00 <br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- LIGHT Products -->
      <div class="col-md-6 product-card-item" data-category="light" data-price="100" data-date="2025-05-1">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/light/LED Bulb.png" class="img-fluid" style="max-height: 120px;" alt="LED Light">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Wipro LED Downlight</h5>
                <p class="small">3W, Warm White, 120° Beam, Indoor use.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹100<br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 product-card-item" data-category="light" data-price="110" data-date="2025-05-2">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/light/LED False Ceiling.png" class="img-fluid" style="max-height: 120px;" alt="LED Light">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Wipro LED Downlight</h5>
                <p class="small">3W, Warm White, 120° Beam, Indoor use.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹110<br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 product-card-item" data-category="light" data-price="100" data-date="2025-04-1">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/light/LED Bulb.png" class="img-fluid" style="max-height: 120px;" alt="LED Light">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Wipro LED Downlight</h5>
                <p class="small">3W, Warm White, 120° Beam, Indoor use.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹100<br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 product-card-item" data-category="light" data-price="110" data-date="2025-04-2">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/light/LED False Ceiling.png" class="img-fluid" style="max-height: 120px;" alt="LED Light">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Wipro LED Downlight</h5>
                <p class="small">3W, Warm White, 120° Beam, Indoor use.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹110<br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- SWITCH Products -->
      <div class="col-md-6 product-card-item" data-category="switch" data-price="196" data-date="2025-03-1">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/switch/bell push.png" class="img-fluid" style="max-height: 120px;" alt="Switch">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Anchor Bell Push</h5>
                <p class="small">Roma Classic, 10A, with neon indicator.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹196<br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 product-card-item" data-category="switch" data-price="990" data-date="2025-03-2">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image\switch\Plug.png" class="img-fluid" style="max-height: 120px;" alt="Smart Plug">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Philips Smart Plug</h5>
                <p class="small">16A, WiFi, Alexa/Google compatible.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹990<br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 product-card-item" data-category="switch" data-price="196" data-date="2025-02-1">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/switch/bell push.png" class="img-fluid" style="max-height: 120px;" alt=" switch" data-price="3149">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Anchor Bell Push</h5>
                <p class="small">Roma Classic, 10A, with neon indicator.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹196<br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 product-card-item" data-category="switch" data-price="990" data-date="2025-02-2">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/switch/Plug.png" class="img-fluid" style="max-height: 120px;" alt="Smart Plug">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Philips Smart Plug</h5>
                <p class="small">16A, WiFi, Alexa/Google compatible.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹990<br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Wires Products -->
      <div class="col-md-6 product-card-item" data-category="wire" data-price="24860" data-date="2025-01-1">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/wires/Core PVC Insulated cable.png" class="img-fluid" style="max-height: 120px;" alt="Switch 2">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Polycab 12 Core Cable</h5>
                <p class="small">1.5 Sqmm, 100m, 1100V, Black, PVC.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹24,860<br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 product-card-item" data-category="wire" data-price="6107" data-date="2025-01-2">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/wires/Copper PVC Insulated cable.png" class="img-fluid" style="max-height: 120px;" alt="Copper Wire">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Polycab Copper Wire</h5>
                <p class="small">1.5 Sqmm, 300m, 1100V, Multicolor.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹6107<br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 product-card-item" data-category="wire" data-price="24860" data-date="2024-12-1">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/wires/Core PVC Insulated cable.png" class="img-fluid" style="max-height: 120px;" alt="Switch 2">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Polycab 12 Core Cable</h5>
                <p class="small">1.5 Sqmm, 100m, 1100V, Black, PVC.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹24,860<br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 product-card-item" data-category="wire" data-price="6107" data-date="2024-12-2">
        <div class="card h-100 border-0 rounded-4 shadow">
          <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img src="image/wires/Copper PVC Insulated cable.png" class="img-fluid" style="max-height: 120px;" alt="Copper Wire">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="fw-semibold">Polycab Copper Wire</h5>
                <p class="small">1.5 Sqmm, 300m, 1100V, Multicolor.</p>
                <p class="fw-bold mb-3 text-success">MRP ₹6107<br /><small class="text-muted"
                      >Inclusive of all taxes</small></p>
                <a href="view-product.php" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="bi bi-cart3 me-2"></i>More Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>

        </div>
      </div>
    </div><!-- No results message -->
<div id="noResultsMessage" class="text-center text-muted py-5 fw-semibold" style="display: none;">
  😕 No products found matching your filters.
</div>
  </div>
</section>






