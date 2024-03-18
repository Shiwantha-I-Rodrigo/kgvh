<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/system/init.php';
?>

<head>
    <meta charset="utf-8">
    <title>KGVH Employee Registration</title>
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
    <script src="<?= SYSTEM_BASE_URL ?>js/functions.js"></script>
</head>

<body>

    <!-- Form actions -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        extract($_POST);

        $first_name = dataClean($first_name);
        $last_name = dataClean($last_name);
        $address_line1 = dataClean($address_line1);
        $address_line2 = dataClean($address_line2);
        $address_line3 = dataClean($address_line3);

        $message = array();

        //Basic validation-----------------------------------------------
        if (empty($first_name)) {
            $message['first_name'] = "The first name should not be blank...!";
        }
        if (empty($last_name)) {
            $message['last_name'] = "The last name should not be blank...!";
        }

        //Advance validation and submit-------------------------------------
        if (ctype_alpha(str_replace(' ', '', $first_name)) === false) {
            $message['first_name'] = "Only letters and white space allowed";
        }
        if (ctype_alpha(str_replace(' ', '', $last_name)) === false) {
            $message['last_name'] = "Only letters and white space allowed";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message['email'] = "Invalid Email Address...!";
        } else {
            $db = dbConn();
            $sql = "SELECT * FROM users WHERE Email='$email'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                $message['email'] = "This Email address already exsist...!";
            }
        }
        if (empty($user_name)) {
            $message['user_name'] = "The user name should not be blank...!";
        } else {
            $db = dbConn();
            $sql = "SELECT * FROM users WHERE UserName='$user_name'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                $message['user_name'] = "This user name address already exsist...!";
            }
        }

        if (empty($password)) {
            $message['password'] = "The password should not be blank...!";
        } elseif (strlen($password) < 8 or strlen($password) > 64) {
            $message['password'] = "The password should be between 8 and 64 characters...!";
        } elseif (strlen($password) < 8 or strlen($password) > 64) {
            $message['password'] = "The password should be between 8 and 64 characters...!";
        } elseif (strlen($password) < 8 or strlen($password) > 64) {
            $message['password'] = "The password should be between 8 and 64 characters...!";
        }

        if (empty($message)) {
            $pw_hash = password_hash($password, PASSWORD_BCRYPT);
            $db = dbConn();
            $sql = "INSERT INTO `users`(`UserName`, `Password`,`Email`) VALUES ('$user_name','$pw_hash','$email')";
            $db->query($sql);

            $user_id = $db->insert_id;
            $reg_no = date('Y') . date('m') . $user_id;
            $_SESSION['reg_no'] = $reg_no;
            $_SESSION['user_name'] = $user_name;

            $sql = "INSERT INTO `employees`(`FirstName`, `LastName`, `NationalIdCard`, `AddressLine1`, `AddressLine2`, `AddressLine3`, `Telephone`, `Mobile`, `Gender`,`RegNo`,`UserId`, `EmployeeRole`, `ProfilePic`) VALUES ('$first_name','$last_name','$nic','$address_line1','$address_line2','$address_line3','$telephone','$mobile','$gender','$reg_no','$user_id','$role','images/profile.jpg')";
            $db->query($sql);

            $admin = [1, 2, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13];
            $manager = [2, 3, 4, 5, 7, 8, 9, 10, 13];
            $receptionist = [3, 4, 5, 7, 10, 11, 12, 13];
            $travel = [5, 12, 13];

            if ($role == 1) {
                $modules = $admin;
            } elseif ($role == 2) {
                $modules = $manager;
            } elseif ($role == 3) {
                $modules = $receptionist;
            } else {
                $modules = $travel;
            }

            foreach ($modules as $module) {
                $sql = "INSERT INTO `user_modules`(`UserId`, `ModuleId`) VALUES ('$user_id','$module')";
                $db->query($sql);
            }

            $msg = "<h1>SUCCESS</h1>";
            $msg .= "<h2>Congratulations</h2>";
            $msg .= "<p>Your account has been successfully created</p>";
            $msg .= "<a href=" . $_CUSTOMER_VERIFICATION_LINK . ">Click here to verifiy your account</a>";
            sendEmail($email, $first_name, "Account Verification", $msg);
            reDirect("register_success.php");
        }
    }
    ?>


    <div class="page_title">
        <section class="vh-100" style="background-color: #000;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-8">
                        <div class="card" style="border-radius: 1rem;background-color: #191C24; margin-bottom:40px;">
                            <div class="row g-0">
                                <div class="col-md-6 col-lg-12 d-flex align-items-center">
                                    <div class="card-body p-4 p-lg-5 text-black">
                                        <form class="main_form" id="reg_form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" novalidate>

                                            <div class="d-flex align-items-center mb-3 pb-1">
                                                <img src="<?= SYSTEM_BASE_URL ?>images/logo_big.png" alt="login form" class="img-fluid full" style="border-radius: 1rem 0 0 1rem;" />
                                            </div>

                                            <h1 class="full"> ⬩ Employee Registration Form ⬩</h1>

                                            <label class="halfL">Username</label>
                                            <label class="halfR">Password</label>
                                            <span class="text-danger halfL"><?= @$message['user_name'] ?></span>
                                            <span class="text-danger halfR"><?= @$message['password'] ?></span>
                                            <input type="text" class="form-control inputs halfL" name="user_name" id="user_name" placeholder="Username *" required />
                                            <input type="password" class="form-control inputs halfR" name="password" id="password" placeholder="Password *" required>


                                            <div class="fullL">
                                                <div class="alert px-4 py-3 mb-0 d-none password_meter" role="alert" id="password-alert">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="requirements leng">
                                                            <img class="tickk" src="<?= SYSTEM_BASE_URL ?>images/icons/tick.png" id="leng_tick" alt=">" />
                                                            <img class="tickx" src="<?= SYSTEM_BASE_URL ?>images/icons/x.png" id="leng_x" alt="x" />
                                                            password must have at least 8 chars
                                                        </li>
                                                        <li class="requirements cap">
                                                            <img class="tickk" src="<?= SYSTEM_BASE_URL ?>images/icons/tick.png" id="cap_tick" alt=">" />
                                                            <img class="tickx" src="<?= SYSTEM_BASE_URL ?>images/icons/x.png" id="cap_x" alt="x" />
                                                            password must have a capital letter.
                                                        </li>
                                                        <li class="requirements num">
                                                            <img class="tickk" src="<?= SYSTEM_BASE_URL ?>images/icons/tick.png" id="num_tick" alt=">" />
                                                            <img class="tickx" src="<?= SYSTEM_BASE_URL ?>images/icons/x.png" id="num_x" alt="x" />
                                                            password must have a number.
                                                        </li>
                                                        <li class="requirements char">
                                                            <img class="tickk" src="<?= SYSTEM_BASE_URL ?>images/icons/tick.png" id="chr_tick" alt=">" />
                                                            <img class="tickx" src="<?= SYSTEM_BASE_URL ?>images/icons/x.png" id="chr_x" alt="x" />
                                                            password must have a special character.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>


                                            <label class="halfL">NIC</label>
                                            <label class="halfR">Confirm Password</label>
                                            <span class="text-danger halfL"><?= @$message['nic'] ?></span>
                                            <span class="text-danger halfR"><?= @$message['password2'] ?></span>
                                            <input type="text" class="form-control inputs halfL" name="nic" id="nic" placeholder="National ID Card Number" maxlength="12" />
                                            <input type="password" class="form-control inputs halfR" name="password2" id="password2" placeholder="Confirm Password *" required>

                                            <label class="halfL">Email</label>
                                            <span class="text-danger halfR"><?= @$message['email'] ?></span>
                                            <input type="email" class="form-control inputs" name="email" id="email" placeholder="Email *" required />

                                            <label class="halfL">First Name</label>
                                            <label class="halfR">Last Name</label>
                                            <span class="text-danger halfL"><?= @$message['first_name'] ?></span>
                                            <span class="text-danger halfR"><?= @$message['last_name'] ?></span>
                                            <input type="text" class="form-control inputs halfL" name="first_name" id="first_name" placeholder="First Name *" required />
                                            <input type="text" class="form-control inputs halfR" name="last_name" id="last_name" placeholder="Last Name *" required />

                                            <label class="halfL">User Role</label>
                                            <label class="halfR">Gender</label>
                                            <select name="role" id="role" class="form-control inputs halfL">
                                                <option value="4">Travel Solution</option>
                                                <option value="3">Receptionist</option>
                                                <option value="2">Manager</option>
                                                <option value="1">Admin</option>
                                            </select>

                                            <select name="gender" id="gender" class="form-control inputs halfR">
                                                <option value="0">Male</option>
                                                <option value="1">Female</option>
                                            </select>

                                            <label class="halfL">Mobile</label>
                                            <label class="halfR">Telephone</label>
                                            <span class="text-danger halfL"><?= @$message['mobile'] ?></span>
                                            <span class="text-danger halfR"><?= @$message['telephone'] ?></span>
                                            <input type="text" class="form-control inputs halfL" name="mobile" id="mobile" placeholder="Mobile No." maxlength="18" />
                                            <input type="text" class="form-control inputs halfR" name="telephone" id="telephone" placeholder="Telephone No." maxlength="18" />

                                            <label class="halfL">Address</label>
                                            <span class="text-danger halfR"><?= @$message['address'] ?></span>
                                            <input type="text" class="form-control inputs" name="address1" id="address1" placeholder="House/Building No." />
                                            <input type="text" class="form-control inputs" name="address2" id="address2" placeholder="Street" />
                                            <input type="text" class="form-control inputs" name="address3" id="address3" placeholder="Town" />

                                        </form>
                                        <button class="common_btn full" name="sub_btn" id="sub_btn" data-bs-toggle="modal" data-bs-target="#success_modal" disabled>Submit</button>
                                        <p style="color: #fff;"> Already have an account ? <a href="<?= SYSTEM_BASE_URL ?>login.php" style="color: #a5c5c5;"> Login here </a></p>
                                        <p style="color: #fff; margin-top: 20px;" class="text-muted"> Required fields are indicated with a '*' mark </p>
                                        <a href="<?= SYSTEM_BASE_URL ?>index.php" class="small text-muted">Terms of use.</a>
                                        <a href="<?= SYSTEM_BASE_URL ?>index.php" class="small text-muted">Privacy policy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- Modal -->
    <div class="modal fade back" id="success_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modals">
                <div class="modal-header">
                    <img src="<?= SYSTEM_BASE_URL ?>images/logo_tiny.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                    <h3 class="modal-title" id="exampleModalCenterTitle" style="color: #fff; margin-left:10px;">Confirmation</h3>
                    <button type="button" class="close crit_btn" data-bs-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="color: #fff;">By submitting the registration, you are agreeing to the terms and conditions of registration !</p>
                    <p style="color: #fff;">Are you sure you want to submit the registration ?</p>
                    <a href="<?= SYSTEM_BASE_URL ?>index.php" class="small text-muted">Terms of use.</a>
                    <a href="<?= SYSTEM_BASE_URL ?>index.php" class="small text-muted">Privacy policy</a>
                </div>
                <div class="modal-footer">
                    <button class="crit_btn halfL" data-bs-dismiss="modal" style="margin-right: 20px;">Cancel</button>
                    <button class="common_btn halfR" type="submit" form="reg_form" formmethod="post">Confirm</button>
                </div>
            </div>
        </div>
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

</body>

</html>