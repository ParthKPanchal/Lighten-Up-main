<section class="register py-5 d-flex align-items-center" style="min-height: 100vh;">
  <div class="container d-flex justify-content-center">
    <div class="col-md-6">
      <div class="bg-white p-3 p-sm-4 p-md-5 rounded-4 shadow-sm form-card animate-fade-up">
        <form action="" method="POST">
          <h2 class="mb-4 text-center">Create an Account</h2>
          <div class="mb-3">
            <label for="first_name" class="form-label fw-semibold">First Name</label>
            <input
              type="text"
              class="form-control form-control-lg"
              id="first_name"
              name="first_name"
              placeholder="Your First Name"
              required
            />
          </div>
          <div class="mb-3">
            <label for="last_name" class="form-label fw-semibold">Last Name</label>
            <input
              type="text"
              class="form-control form-control-lg"
              id="last_name"
              name="last_name"
              placeholder="Your Last Name"
              required
            />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input
              type="email"
              class="form-control form-control-lg"
              id="email"
              name="email"
              placeholder="you@example.com"
              required
            />
          </div>
          <div class="mb-3">
            <label for="number" class="form-label fw-semibold">Mobile Number</label>
            <input
              type="number"
              class="form-control form-control-lg"
              id="number"
              name="number"
              min="0"
              max="9999999999"
              maxlength="10"
              placeholder="Enter Mobile Number"
              required
            />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input
              type="password"
              class="form-control form-control-lg"
              id="password"
              name="password"
              placeholder="Enter Password"
              required
            />
          </div>
          <div class="mb-3">
            <label for="c_password" class="form-label fw-semibold">Confirm Password</label>
            <input
              type="password"
              class="form-control form-control-lg"
              id="c_password"
              name="c_password"
              placeholder="Enter Confirm Password"
              required
            />
          </div>
          <p class="text-center">Already have an account? <a href="login.php">Login Now!</a></p>
          <button type="submit" class="btn btn-dark w-100 btn-lg shadow-sm">
            Register Now!
          </button>
        </form>
      </div>
    </div>
  </div>
</section>
