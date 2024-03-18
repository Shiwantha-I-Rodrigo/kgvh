<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/system/init.php';
?>

<head>
  <meta charset="utf-8">
  <title>DarkPan - Bootstrap 5 Admin Template</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <!-- Favicon -->
  <link href="<?= SYSTEM_BASE_URL ?>images/favicon.ico" rel="icon">
  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Libraries Stylesheet -->
  <link href="<?= SYSTEM_BASE_URL ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?= SYSTEM_BASE_URL ?>lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
  <!-- Customized Bootstrap Stylesheet -->
  <link href="<?= SYSTEM_BASE_URL ?>css/bootstrap.min.css" rel="stylesheet">
  <!-- Template Stylesheet -->
  <link href="<?= SYSTEM_BASE_URL ?>css/style.css" rel="stylesheet">
</head>

<body>
  <div class="page_title">
    <section class="vh-100" style="background-color: #000;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-8">
            <div class="card" style="border-radius: 1rem;background-color: #191C24;">
              <div class="row g-0">
                <div class="col-md-6 col-lg-5 d-none d-md-block">
                  <img src="<?= SYSTEM_BASE_URL ?>images/register.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">
                    <form class="main_form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" novalidate>
                      <div class="d-flex align-items-center mb-3 pb-1">
                        <img src="<?= SYSTEM_BASE_URL ?>images/logo_big.png" alt="login form" class="img-fluid full" style="border-radius: 1rem 0 0 1rem;" />
                      </div>

                      <h2 class="text-center" style="color: #fff;">Hello ⬩ <?php echo $_SESSION['user_name']; ?> ⬩ </h2>
                      <h3 class="text-center" style="color: #fff;">Your account has been successfully created and a confirmation email has been sent to the provided email address.</h3>
                      <h3 class="text-center" style="color: #fff;">Your Registration Number is <strong><?php echo $_SESSION['reg_no']; ?></strong></h3>
                      <h3 class="text-center" style="color: #fff;">Thank You.</h3>

                      <h4 class="text-center text-muted" style="color: #fff;"> Already confirmed account ? <a href="<?= SYSTEM_BASE_URL ?>login.php" style="color: #69ba6b;"> Login </a></h4>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= SYSTEM_BASE_URL ?>lib/chart/chart.min.js"></script>
  <script src="<?= SYSTEM_BASE_URL ?>lib/easing/easing.min.js"></script>
  <script src="<?= SYSTEM_BASE_URL ?>lib/waypoints/waypoints.min.js"></script>
  <script src="<?= SYSTEM_BASE_URL ?>lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?= SYSTEM_BASE_URL ?>lib/tempusdominus/js/moment.min.js"></script>
  <script src="<?= SYSTEM_BASE_URL ?>lib/tempusdominus/js/moment-timezone.min.js"></script>
  <script src="<?= SYSTEM_BASE_URL ?>lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Template Javascript -->
  <script src="<?= SYSTEM_BASE_URL ?>js/functions.js"></script>
</body>

</html>