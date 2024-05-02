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
    $db = dbConn();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        extract($_POST);

        $first_name = dataClean($first_name);
        $last_name = dataClean($last_name);
        $address1 = dataClean($address1);
        $address2 = dataClean($address2);
        $address3 = dataClean($address3);

        $message = array();

        //Basic validations-----------------------------------------------
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message['email'] = "Invalid Email Address...!";
        } else {
            $sql = "SELECT * FROM users WHERE Email='$email'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                $message['email'] = "This Email address already exsist...!";
            }
        }
        $sql = "SELECT * FROM users WHERE UserName='$user_name'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $message['user_name'] = "This username already exsist...!";
        }
        if (empty($message)) {
            $pw_hash = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO `users`(`UserName`, `Password`,`Email`,`Role`,`Status`) VALUES ('$user_name','$pw_hash','$email','$role','$status')";
            $db->query($sql);

            $user_id = $db->insert_id;
            $reg_no = date('Y') . date('m') . $user_id;
            $_SESSION['reg_no'] = $reg_no;
            $_SESSION['user_name'] = $user_name;

            $sql = "INSERT INTO `employees`(`FirstName`, `LastName`, `NationalIdCard`, `AddressLine1`, `AddressLine2`, `AddressLine3`, `Telephone`, `Mobile`, `Title`,`RegNo`, `ProfilePic`, `UserId`) VALUES ('$first_name','$last_name','$nic','$address1','$address2','$address3','$telephone','$mobile','$title','$reg_no','images/profile.jpg','$user_id')";
            $db->query($sql);

            $admin = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
            $manager = [1, 3, 4, 5, 6, 7, 8, 9, 12];
            $receptionist = [1, 4, 6, 7, 10, 11, 12];
            $travel = [1, 6, 11, 12];
            $customer = [12];

            if ($role == 1) {
                $modules = $admin;
            } elseif ($role == 2) {
                $modules = $manager;
            } elseif ($role == 3) {
                $modules = $receptionist;
            } elseif ($role == 4) {
                $modules = $travel;
            } else {
                $modules = $customer;
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

    <div class="row justify-content-center">
        <div class="col-8 p-4 m-2">
            <div class="bg-secondary rounded p-4">

                <form class="main_form p-4" id="reg_form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" novalidate>

                    <div class="d-flex align-items-center mb-3 pb-1">
                        <img src="<?= SYSTEM_BASE_URL ?>images/logo_big.png" alt="login form" class="img-fluid full" style="border-radius: 1rem 0 0 1rem;" />
                    </div>

                    <h1 class="full"> ⬩ Employee Registration Form ⬩</h1>

                    <p class="text-muted row justify-content-end">Required fields are indicated with '*'</p>

                    <div class="row">
                        <div class="col-6">
                            <label class="row">Username</label>
                            <span class="text-danger row"><?= @$message['user_name'] ?></span>
                            <input type="text" class="form-control inputs row" name="user_name" id="user_name" placeholder="Username *" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="row">Password</label>
                            <span class="text-danger row"><?= @$message['password'] ?></span>
                            <input type="password" class="form-control inputs row" name="password" id="password" placeholder="Password *" required>
                        </div>
                        <div class="col-6">
                            <label class="row">Confirm Password</label>
                            <span class="text-danger row"><?= @$message['password2'] ?></span>
                            <input type="password" class="form-control inputs row" name="password2" id="password2" placeholder="Confirm Password *" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="alert password_meter d-none col-4" role="alert" id="password-alert">
                            <ul class="list-unstyled">
                                <li class="requirements leng">
                                    <i class="fa fa-check-circle fa-lg tickk" style="color:green; vertical-align: middle;"></i>
                                    <i class="fa fa-times-circle fa-lg tickx" style="color:red; vertical-align: middle;"></i>
                                    password must have at least 8 chars
                                </li>
                                <li class="requirements cap">
                                    <i class="fa fa-check-circle fa-lg tickk" style="color:green; vertical-align: middle;"></i>
                                    <i class="fa fa-times-circle fa-lg tickx" style="color:red; vertical-align: middle;"></i>
                                    password must have a capital letter.
                                </li>
                                <li class="requirements num">
                                    <i class="fa fa-check-circle fa-lg tickk" style="color:green; vertical-align: middle;"></i>
                                    <i class="fa fa-times-circle fa-lg tickx" style="color:red; vertical-align: middle;"></i>
                                    password must have a number.
                                </li>
                                <li class="requirements char">
                                    <i class="fa fa-check-circle fa-lg tickk" style="color:green; vertical-align: middle;"></i>
                                    <i class="fa fa-times-circle fa-lg tickx" style="color:red; vertical-align: middle;"></i>
                                    password must have a special character.
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="row">Email</label>
                            <span class="text-danger row"><?= @$message['email'] ?></span>
                            <input type="email" class="form-control inputs row" name="email" id="email" placeholder="Email *" required />
                        </div>
                        <div class="col-6 align-self-center">
                            <div class="form-check form-check">
                                <input class="form-check-input" type="checkbox" id="promo" value="1" checked>
                                <label class="form-check-label" for="promo">Include promotional offer notifications</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="row">NIC</label>
                            <span class="text-danger row"><?= @$message['nic'] ?></span>
                            <input type="text" class="form-control inputs row" name="nic" id="nic" placeholder="National ID Card Number" maxlength="12" />
                        </div>
                        <div class="col-6">
                            <label class="row">Title</label>
                            <select name="title" id="title" class="form-control inputs row">
                                <option value="0">Mr</option>
                                <option value="1">Mrs</option>
                                <option value="2">Miss</option>
                                <option value="3">Ven</option>
                                <option value="4">Hon</option>
                                <option value="5">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="row">First Name</label>
                            <span class="text-danger row"><?= @$message['first_name'] ?></span>
                            <input type="text" class="form-control inputs row" name="first_name" id="first_name" placeholder="First Name *" required />
                        </div>
                        <div class="col-6">
                            <label class="row">Last Name</label>
                            <span class="text-danger row"><?= @$message['last_name'] ?></span>
                            <input type="text" class="form-control inputs row" name="last_name" id="last_name" placeholder="Last Name *" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="row">User Role</label>
                            <select name="role" id="role" class="form-control inputs row">
                                <option value="5">Customer</option>
                                <option value="4">Travel Solution</option>
                                <option value="3">Receptionist</option>
                                <option value="2">Manager</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="row">Mobile</label>
                            <span class="text-danger row"><?= @$message['mobile'] ?></span>
                            <input type="text" class="form-control inputs row" name="mobile" id="mobile" placeholder="Mobile No." maxlength="18" />
                        </div>
                        <div class="col-6">
                            <label class="row">Telephone</label>
                            <span class="text-danger row"><?= @$message['telephone'] ?></span>
                            <input type="text" class="form-control inputs row" name="telephone" id="telephone" placeholder="Telephone No." maxlength="18" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="row">Address</label>
                            <span class="text-danger row"><?= @$message['address'] ?></span>
                            <input type="text" class="form-control inputs row" name="address1" id="address1" placeholder="House No. & Street" />
                            <input type="text" class="form-control inputs row" name="address2" id="address2" placeholder="City" />
                            <input type="text" class="form-control inputs row" name="address3" id="address3" placeholder="Province or Region" />
                        </div>
                        <?php
                        $sql = "SELECT * FROM  nationals";
                        $result = $db->query($sql);
                        ?>
                        <div class="col-6">
                            <label class="row">Nationality</label>
                            <select name="national_id" id="national_id" class="form-control inputs row">
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?= $row['NationalId'] ?>"><?= $row['NationalName'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <label class="row">Account Status</label>
                            <select name="status" id="status" class="form-control inputs row">
                                <option value="1">Enabled</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div>
                    </div>

                </form>
                <div class="row justify-content-center">
                    <div class="col-2">
                        <button class="common_btn w-100" name="sub_btn" id="sub_btn" data-bs-toggle="modal" data-bs-target="#success_modal" disabled>Submit</button>
                    </div>
                    <div class="col-2">
                        <button class="crit_btn w-100" name="res_btn" id="res_btn" data-bs-toggle="modal" data-bs-target="#reset_modal">Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form End -->


        <!-- Submit Modal -->
        <div class="modal fade back" id="success_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modals">
                    <div class="modal-header">
                        <img src="<?= SYSTEM_BASE_URL ?>images/logo_tiny.png" alt="logo" class="img-fluid" />
                        <h3 class="modal-title" style="color: #fff;">Confirmation</h3>
                        <button type="button" class="close crit_btn" data-bs-dismiss="modal">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="color: #fff;">By submitting the registration, you are agreeing to the terms and conditions of registration !</p>
                        <p style="color: #fff;">Are you sure you want to submit the registration ?</p>
                        <a href="<?= SYSTEM_BASE_URL ?>index.php" class="small text-muted">Terms of use.</a>
                        <a href="<?= SYSTEM_BASE_URL ?>index.php" class="small text-muted">Privacy policy</a>
                    </div>
                    <div class="modal-footer row justify-content-around">
                        <button class="crit_btn col-5" data-bs-dismiss="modal">Cancel</button>
                        <button class="common_btn col-5" type="submit" form="reg_form" formmethod="post">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reset Modal -->
        <div class="modal fade back" id="reset_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modals">
                    <div class="modal-header">
                        <img src="<?= SYSTEM_BASE_URL ?>images/logo_tiny.png" alt="logo" class="img-fluid" />
                        <h3 class="modal-title" style="color: #fff;">Confirmation</h3>
                        <button type="button" class="close crit_btn" data-bs-dismiss="modal">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="color: #fff;">Are you sure you want to reset the entered data ?</p>
                    </div>
                    <div class="modal-footer row justify-content-around">
                        <button class="crit_btn col-5" data-bs-dismiss="modal">Cancel</button>
                        <a class="common_btn col-5" href="javascript: location.reload();">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/system/footer.php';
    ?>

</body>

</html>