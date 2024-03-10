<?php
session_start();
include 'header.php';
include '../functions.php';
?>


<!-- Form actions -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  extract($_POST);

  $user_name = dataClean($user_name);

  $message = array();

  if (empty($user_name)) {
    $message['user_name'] = "User Name should not be empty...!";
  }
  if (empty($password)) {
    $message['password'] = "Password should not be empty...!";
  }

  if (empty($message)) {
    $db = dbConn();
    $sql = "SELECT * FROM users WHERE UserName='$user_name'";
    $result = $db->query($sql);
    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      if (password_verify($password, $row['Password'])) {
        $_SESSION['user_id'] = $row['Userid'];
        $_SESSION['user_name'] = $user_name;
        reDirect("dashboard.php");
      } else {
        $message['password'] = "Invalid User Name or Password...!";
      }
    } else {
      $message['password'] = "Invalid User Name or Password...!";
    }
  }
}
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
                    <div class="form-outline mb-4">
                      <input type="text" class="form-control inputs" name="user_name" id="user_name" placeholder="Username" required />
                      <span class="text-danger"><?= @$message['user_name'] ?></span>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="password" class="form-control inputs" name="password" id="password" placeholder="Password" required />
                      <span class="text-danger"><?= @$message['password'] ?></span>
                    </div>
                    <div class="pt-1 mb-4">
                      <button class="common_btn full" type="submit" formmethod="post">Login</button>
                    </div>
                    <a class="small" style="color: #fff;" href="index.php">Forgot password?</a>
                    <p class="mb-5 pb-lg-2" style="color: #fff;"> Don't have an account ? <a href="register.php" style="color: #a5c5c5;"> Register here </a></p>
                    <a href="index.php" class="small text-muted">Terms of use.</a>
                    <a href="index.php" class="small text-muted">Privacy policy</a>
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