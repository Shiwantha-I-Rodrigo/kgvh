<?php
session_start();
include 'header.php';
include '../functions.php';
?>


<div class="page_title">
  <section class="vh-100" style="background-color: #fff;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-8">
          <div class="card" style="border-radius: 1rem;background-color: #0f5256;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="images/login.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form class="main_form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" novalidate>
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <img src="images/logo_big.png" alt="login form" class="img-fluid full" style="border-radius: 1rem 0 0 1rem;" />
                    </div>

                    <h2 class="text-center" style="color: #fff;">Hello ⬩ <?php echo $_SESSION['user_name']; ?> ⬩ </h2>
                    <h3 class="text-center" style="color: #fff;">Your account has been successfully created and a confirmation email has been sent to the provided email address.</h3>
                    <h3 class="text-center" style="color: #fff;">Your Registration Number is <strong><?php echo $_SESSION['reg_no']; ?></strong></h3>
                    <h3 class="text-center" style="color: #fff;">Thank You.</h3>

                    <h4 class="text-center text-muted" style="color: #fff;"> Already confirmed account ? <a href="login.php" style="color: #69ba6b;"> Login </a></h4>
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


<?php
include 'footer.php';
?>