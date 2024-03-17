<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="images/favicon.ico" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <?php
    session_start();
    include '../functions.php';
    ?>

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
            $sql = "SELECT * FROM users WHERE UserName='$user_name'";
            $result = $db->query($sql);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['Password'])) {
                    $user_id = $row['UserId'];
                    $sql = "SELECT * FROM employees WHERE UserId='$user_id'";
                    $verify = $db->query($sql);
                    if ($verify->num_rows == 1) {
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_name'] = $user_name;
                        reDirect("dashboard.php");
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
                                            </div>
                                            <div class="form-outline mb-4">
                                                <input type="password" class="form-control inputs" name="password" id="password" placeholder="Password" required />
                                            </div>
                                            <div class="pt-1 mb-4">
                                                <button class="common_btn full" type="submit" formmethod="post">Login</button>
                                            </div>
                                            <a class="small" style="color: #fff;" href="index.php">Forgot password?</a>
                                            <p class="mb-3 pb-lg-2" style="color: #fff;"> Don't have an account ? <a href="register.php" style="color: #a5c5c5;"> Register here </a></p>
                                            <p style="padding:0 0 0 0;margin:0 0 0 0;color:#e74d46"><?= @$message['message'] ?></p>
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

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/functions.js"></script>
</body>

</html>