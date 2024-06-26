<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/header.php';
?>

<body>

    <!-- Form actions -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        extract($_POST);

        $user_name = dataClean($user_name);

        $message = array();

        if (empty($password)) {
            $message['message'] = "Password should not be empty...!";
        }
        if (empty($user_name)) {
            $message['message'] = "User Name should not be empty...!";
        }

        if (empty($message)) {
            $db = dbConn();
            $sql = "SELECT * FROM users u INNER JOIN employees e ON u.UserId = e.UserId WHERE u.UserName='$user_name' OR u.Email='$user_name'";
            $result = $db->query($sql);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['Password'])) {
                    $_SESSION['user_id'] = $row['UserId'];
                    $_SESSION['user_name'] = $row['UserName'];
                    $_SESSION['first_name'] = $row['FirstName'];
                    $_SESSION['last_name'] = $row['LastName'];
                    $_SESSION['title'] = $row['Title'];
                    $_SESSION['profile_pic'] = $row['ProfilePic'];
                    $_SESSION['employee_role'] = $row['Role'];
                    reDirect(SYSTEM_BASE_URL . "dashboard.php");
                } else {
                    $message['message'] = "Invalid User Name or Password...!";
                }
            } else {
                $message['message'] = "Invalid User Name or Password...!";
            }
        } else {
            $message['message'] = "Invalid User Name or Password...!";
        }
    }
    ?>


    <div class="page_title">
        <section class="vh-100" style="background-color: #000;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-8">
                        <div class="card" style="border-radius: 1rem;background-color: #191C24;">
                            <div class="row g-0">
                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                    <img src="<?= SYSTEM_BASE_URL ?>images/login.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-4 p-lg-5 text-black">
                                        <form class="main_form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" novalidate>
                                            <div class="d-flex align-items-center mb-3 pb-1">
                                                <img src="<?= SYSTEM_BASE_URL ?>images/logo_big.png" alt="login form" class="img-fluid full" style="border-radius: 1rem 0 0 1rem;" />
                                            </div>
                                            <div class="form-outline mb-4">
                                                <input type="text" class="form-control inputs" name="user_name" id="user_name" placeholder="Username or Email" required />
                                            </div>
                                            <div class="form-outline mb-4">
                                                <input type="password" class="form-control inputs" name="password" id="password" placeholder="Password" required />
                                            </div>
                                            <div class="pt-1 mb-4">
                                                <button class="common_btn full" type="submit" formmethod="post">Login</button>
                                            </div>
                                            <a class="small" style="color: #fff;" href="index.php">Forgot password?</a>
                                            <p class="mb-3 pb-lg-2" style="color: #fff;"> Don't have an account ? <a href="<?= SYSTEM_BASE_URL ?>register.php" style="color: #a5c5c5;"> Register here </a></p>
                                            <p style="padding:0 0 0 0;margin:0 0 0 0;color:#e74d46"><?= @$message['message'] ?></p>
                                            <a href="<?= SYSTEM_BASE_URL ?>index.php" class="small text-muted">Terms of use.</a>
                                            <a href="<?= SYSTEM_BASE_URL ?>index.php" class="small text-muted">Privacy policy</a>
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