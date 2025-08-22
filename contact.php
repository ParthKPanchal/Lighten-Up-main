<?php
include 'connect.php';

echo create_unique_id();

if(isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = "";
}

if(isset($_POST['send_message'])){
    $msg_id = create_unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $message = $_POST['message'];
    $message = filter_var($message, FILTER_SANITIZE_STRING);

    $verify_contact = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
    $verify_contact->execute([$name, $email, $number, $message]);
    if($verify_contact->rowCount() > 0){
      $warning_msg[] = 'message sent already!';
    }else{
      $send_message = $conn->prepare("INSERT INTO `messages`(id, name, email, number, message) VALUES(?,?,?,?,?)");
      $send_message->execute([$msg_id, $name, $email, $number, $message]);
      $success_msg[] = 'message send successfully!';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lighten Up - Contact us</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="author" content="Gemplyte IT Solutions" />
    <meta name="keywords" content="Lighten Up,Gemplyte,Sample Project" />
    <meta name="description" content="Gemplyte Sample Project" />
    <!-- Favicon -->
    <link
      rel="shortcut icon"
      href="asset/image/logo/title.png"
      type="image/x-icon"
    />
    <!-- Bootstrap Icons CDN (put this in <head> if not already added) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/loader.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/banner.css">
    <link rel="stylesheet" type="text/css" href="css/categories.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&family=Spectral:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  </head>
  <body>
    
      <?php include "components/navbar.php"; ?>
      <!-- contact us section start here -->
        <section class="contact py-5" id="contact">
            <div class="container-fluid">
                <div class="row g-4 align-items-start mx-5">
                <!-- Left Content -->
                <div class="col-12">
                    <h3 class="display-5 fw-bold mb-3">
                    Get <span class="contact-text-gradient">25% Off</span> on Your First Purchase
                    </h3>
                    <p class="lead mb-4">
                    Questions about fans, lights, switches, or wires? Let our team help you choose the right tech for your home or business. From bulk orders to smart installations — we’re here for you.
                    </p>
                    <ul class="list-unstyled d-flex flex-wrap gap-4">
                    <li>
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Quick Response
                    </li>
                    <li>
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Tech Support
                    </li>
                    <li>
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Hassle-free Orders
                    </li>
                    </ul>
                </div>


                <!-- Right: Map and Form Side by Side -->
                <div class="col-md-6">
                    <div class="rounded-3 overflow-hidden shadow-sm" style="height: 23rem;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3761.6519702693154!2d72.79810318512004!3d19.47056649259965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b1caaf879551%3A0xb740daaf3833d0cb!2sAjay%20Infotech%20%7C%20Best%20TallyPrime%20Expert%20%7C%20Web%20Development%20%7C%20Certified%20Tally%20Partner%20in%20Mumbai%20%2C%20Mira%20Road%2C%20Virar!5e0!3m2!1sen!2sus!4v1753252643049!5m2!1sen!2sus"
                        width="100%"
                        height="100%"
                        style="border: 0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    </div>
                </div>


                    <!-- Form -->
                    <div class="col-md-6">
                        <div class="bg-white p-3 p-sm-4 p-md-5 rounded-4 shadow-sm form-card animate-fade-up">
                        <form method="POST" action="">
                            <h2 class="mb-4 text-center fw-bold">Get in touch</h2>

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Name</label>
                                <input type="text" class="form-control form-control-lg" 
                                    id="name" name="name" placeholder="Your Name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control form-control-lg" 
                                    id="email" name="email" placeholder="you@example.com" required>
                            </div>

                            <div class="mb-3">
                                <label for="number" class="form-label fw-semibold">Mobile Number</label>
                                <input type="number" class="form-control" 
                                    id="number" name="number" placeholder="Enter Mobile Number" required>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label fw-semibold">Your Message</label>
                                <textarea class="form-control" id="message" 
                                        name="message" rows="5" placeholder="Enter Your Message" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-dark w-100 btn-lg shadow-sm" name="send_message">
                                Send Message
                            </button>
                        </form>

                        </div>
                    </div>
                    </div> <!-- end inner row -->
                </div> <!-- end col-md-6 -->
                </div> <!-- end row -->
            </div> <!-- end container-fluid -->
            </section>

      <!-- contact us section end here -->
      <?php include "components/footer.php"; ?>
    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
    <?php
    include 'components/message.php';
    ?>
  </body>
</html>
 