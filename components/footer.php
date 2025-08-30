<section class="footer bg-light shadow-top pt-5" 
  style="box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.15);
         background-image: url('image/bg/image-4.jpg');
         padding-top: 100px;
         background-size: cover;
         background-position: center;
         background-repeat: no-repeat;">
  <div class="container-fluid">
    <div class="row gy-4 text-center text-md-start">
      
      <!-- Logo & Social Icons -->
      <div class="col-md-4 text-center">
        <img src="asset/image/logo/logo.png" alt="Lighten up Logo" 
             class="img-fluid mb-3 footer-logo">

        <div class="d-flex justify-content-center gap-3">
          <a href="#" class="social-icon" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
          <a href="#" class="social-icon" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="social-icon" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="social-icon" aria-label="Email"><i class="bi bi-envelope-fill"></i></a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-md-4 col-sm-6">
        <h5 class="footer-heading">Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="index.php" class="footer-link">Home</a></li>
          <li><a href="shop.php" class="footer-link">Products</a></li>
          <li><a href="about.php" class="footer-link">About Us</a></li>
          <li><a href="terms-and-conditions.php" class="footer-link">Terms & Conditions</a></li>
          <li><a href="contact.php" class="footer-link">Contact Us</a></li>
        </ul>
      </div>

      <!-- Customer Support -->
      <div class="col-md-4 col-sm-12">
        <h5 class="footer-heading">Customer Support</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="footer-link"><i class="bi bi-whatsapp me-2"></i>+91 - 9324753025</a></li>
          <li><a href="#" class="footer-link"><i class="bi bi-telephone-inbound-fill me-2"></i>+91 - 9112315665</a></li>
          <li><a href="#" class="footer-link"><i class="bi bi-telephone-inbound-fill me-2"></i>+91 - 9607315665</a></li>
          <li><a href="#" class="footer-link"><i class="bi bi-telephone-inbound-fill me-2"></i>+91 - 9130610665</a></li>
          <li><a href="#" class="footer-link"><i class="bi bi-geo-alt-fill me-2"></i>A-220, Redbricks Business Plaza, Above Croma, Virar West</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Copyright -->
  <div class="text-center border-top mt-4 py-3 small text-muted">
    &copy; 2025 <strong>Gemlyte</strong>. All Rights Reserved.
  </div>
</section>

<style>
  /* Footer Logo */
  .footer-logo {
    max-width: 200px;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
    transition: transform 0.3s ease;
  }
  .footer-logo:hover {
    transform: scale(1.05);
  }

  /* Section Headings */
  .footer-heading {
    font-weight: 600;
    font-size: 1.2rem;
    margin-bottom: 1rem;
    position: relative;
  }
  .footer-heading::after {
    content: "";
    display: block;
    width: 40px;
    height: 3px;
    background: #f1c40f;
    margin-top: 6px;
    border-radius: 2px;
    transition: width 0.3s ease;
  }
  .footer-heading:hover::after {
    width: 60px;
  }

  /* Footer Links */
  .footer-link {
    color: #222;
    text-decoration: none;
    display: block;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
    position: relative;
  }
  .footer-link::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    height: 2px;
    width: 0%;
    background: #f1c40f;
    transition: width 0.3s ease;
  }
  .footer-link:hover {
    color: #f1c40f;
    padding-left: 5px;
  }
  .footer-link:hover::after {
    width: 20%;
  }

  /* Social Icons */
  .social-icon {
    color: #222;
    font-size: 1.6rem;
    transition: all 0.3s ease;
  }
  .social-icon:hover {
    color: #f1c40f;
    transform: scale(1.2) rotate(5deg);
  }
</style>
