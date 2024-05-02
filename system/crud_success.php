<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/header.php';
?>

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

                      <h2 class="text-center" style="color: #fff;"> ⬩ <?php echo $_SESSION['user_name']; ?> ⬩ </h2>
                      <h3 class="text-center" style="color: #fff;">The Record has been successfully <?php echo $_SESSION['operation']; ?>!.</h3>
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
  require_once $_SERVER['DOCUMENT_ROOT'] . '/system/footer.php';
  ?>

</body>

</html>