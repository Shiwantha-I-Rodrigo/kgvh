<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/init.php';
if (!isset($_SESSION['user_id'])) {
    reDirect(SYSTEM_BASE_URL . "login.php");
}
$user_id = $_SESSION['user_id'];
unauthorize($user_id, '5');
$db = dbConn();
$form_title = "Employee Details";

//load employee
$update = false;
if (isset($_GET['id'])) {
    $customer_id = htmlspecialchars($_GET["id"]);
    $sql = "SELECT * FROM users u INNER JOIN employees c ON u.UserId = c.UserId WHERE u.UserId='$customer_id'";
    $result = $db->query($sql);
    $row = mysqli_fetch_array($result);
    $auser_name = $row["UserName"];
    $apassword_hash = $row["Password"];
    $aemail = $row["Email"];
    $anic = $row["NationalIdCard"];
    $atitle = $row["Title"];
    $afirst_name = $row["FirstName"];
    $alast_name = $row["LastName"];
    $arole = $row["Role"];
    $amobile = $row["Mobile"];
    $atelephone = $row["Telephone"];
    $aaddress1 = $row["AddressLine1"];
    $aaddress2 = $row["AddressLine2"];
    $aaddress3 = $row["AddressLine3"];
    $anational_id = $row["NationalId"];
    $astatus = $row["Status"];
    $apromo = $row["Promo"];
    $update = "1";
}

// form actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    extract($_POST);

    $update = $update_stat == "1" ? true : false;

    $first_name = dataClean($first_name);
    $last_name = dataClean($last_name);
    $address1 = dataClean($address1);
    $address2 = dataClean($address2);
    $address3 = dataClean($address3);

    $message = array();

    //Basic validations-----------------------------------------------
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message['email'] = "Invalid Email Address...!";
    } else if (!$update) {
        $sql = "SELECT * FROM users WHERE Email='$email'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $message['email'] = "This Email address already exsist...!";
        }
    }
    if (!$update) {
        $sql = "SELECT * FROM users WHERE UserName='$user_name'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $message['user_name'] = "This username already exsist...!";
        }
    }
    if (empty($message)) {

        if ($update) {
            $sql = "UPDATE `users` SET `UserName`='$user_name', `Password`='$password_hash',`Email`='$email',`Role`='$role',`Status`='$status' WHERE `UserId` = $customer_id";
        } else {
            $pw_hash = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO `users`(`UserName`, `Password`,`Email`,`Role`,`Status`) VALUES ('$user_name','$pw_hash','$email','$role','$status')";
        }
        $db->query($sql);

        $user_id = $db->insert_id;
        $reg_no = date('Y') . date('m') . $user_id;
        $promoint = (int)$promo;
        $_SESSION['reg_no'] = $reg_no;
        $_SESSION['user_name'] = $user_name;

        if ($update) {
            $sql = "UPDATE `employees` SET `FirstName`='$first_name', `LastName`='$last_name', `NationalIdCard`='$nic', `AddressLine1`='$address1', `AddressLine2`='$address2', `AddressLine3`='$address3', `Telephone`='$telephone', `Mobile`='$mobile', `Title`='$title',`RegNo`='$reg_no', `ProfilePic`='images/profile.jpg', `UserId`='$customer_id' WHERE `UserId` = $customer_id ";
        } else {
            $sql = "INSERT INTO `employees`(`FirstName`, `LastName`, `NationalIdCard`, `AddressLine1`, `AddressLine2`, `AddressLine3`, `Telephone`, `Mobile`, `Title`,`RegNo`, `ProfilePic`, `UserId`) VALUES ('$first_name','$last_name','$nic','$address1','$address2','$address3','$telephone','$mobile','$title','$reg_no','images/profile.jpg','$user_id')";
        }
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

        if (!$update) {
            foreach ($modules as $module) {
                $sql = "INSERT INTO `user_modules`(`UserId`, `ModuleId`) VALUES ('$user_id','$module')";
                $db->query($sql);
            }
        }

        $_SESSION['operation'] = 'updated';
        if (!$update) {
            $_SESSION['operation'] = 'created';
            $msg = "<h1>SUCCESS</h1>";
            $msg .= "<h2>Congratulations</h2>";
            $msg .= "<p>Your account has been successfully created</p>";
            $msg .= "<a href=" . $_CUSTOMER_VERIFICATION_LINK . ">Click here to verifiy your account</a>";
            sendEmail($email, $first_name, "Account Verification", $msg);
        }

        reDirect(SYSTEM_BASE_URL . "crud_success.php");
    }
}

ob_start();
?>

<!-- Form Start -->
<div class="container-fluid p-4 m-2">
    <div class="bg-secondary rounded p-4">

        <form class="main_form p-4" id="reg_form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" novalidate>

            <h2 class="row justify-content-center"> <?= $form_title ?> </h2>

            <p class="text-muted row justify-content-end">Required fields are indicated with '*'</p>

            <div class="row">
                <div class="col-6">
                    <label class="row">Username</label>
                    <span class="text-danger row"><?= @$message['user_name'] ?></span>
                    <input type="text" class="form-control inputs row" name="user_name" id="user_name" placeholder="Username *" value="<?= $auser_name ?>" required />
                </div>
            </div>

            <div class="row <?= $update ? "" : "d-none" ?>">
                <div class="col-4">
                    <button class="common_btn w-100 mb-3" name="pwd_btn" id="pwd_btn" type="button">Change Password</button>
                </div>
            </div>

            <div class="row <?= $update ? "d-none" : "" ?>" name="pwd_row" id="pwd_row">
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
                    <input type="email" class="form-control inputs row" name="email" id="email" placeholder="Email *" value="<?= $aemail ?>" required />
                </div>
                <div class="col-6 align-self-center">
                    <div class="form-check form-check">
                        <input class="form-check-input" type="checkbox" name="promo" id="promo" value="1" <?= $apromo == 1 ? "checked" : ""; ?>>
                        <label class="form-check-label" for="promo">Include promotional offer notifications</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label class="row">NIC</label>
                    <span class="text-danger row"><?= @$message['nic'] ?></span>
                    <input type="text" class="form-control inputs row" name="nic" id="nic" placeholder="National ID Card Number" maxlength="12" value="<?= $anic ?>" />
                </div>
                <div class="col-6">
                    <label class="row">Title</label>
                    <select name="title" id="title" class="form-control inputs row">
                        <option value="0" <?= $atitle == 0 ? "selected" : ""; ?>>Mr</option>
                        <option value="1" <?= $atitle == 1 ? "selected" : ""; ?>>Mrs</option>
                        <option value="2" <?= $atitle == 2 ? "selected" : ""; ?>>Miss</option>
                        <option value="3" <?= $atitle == 3 ? "selected" : ""; ?>>Ven</option>
                        <option value="4" <?= $atitle == 4 ? "selected" : ""; ?>>Hon</option>
                        <option value="5" <?= $atitle == 5 ? "selected" : ""; ?>>Other</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label class="row">First Name</label>
                    <span class="text-danger row"><?= @$message['first_name'] ?></span>
                    <input type="text" class="form-control inputs row" name="first_name" id="first_name" placeholder="First Name *" value="<?= $afirst_name ?>" required />
                </div>
                <div class="col-6">
                    <label class="row">Last Name</label>
                    <span class="text-danger row"><?= @$message['last_name'] ?></span>
                    <input type="text" class="form-control inputs row" name="last_name" id="last_name" placeholder="Last Name *" value="<?= $alast_name ?>" required />
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label class="row">User Role</label>
                    <select name="role" id="role" class="form-control inputs row">
                        <option value="4" <?= $arole == 4 ? "selected" : ""; ?>>Travel Solution</option>
                        <option value="3" <?= $arole == 3 ? "selected" : ""; ?>>Receptionist</option>
                        <option value="2" <?= $arole == 2 ? "selected" : ""; ?>>Manager</option>
                        <option value="1" <?= $arole == 1 ? "selected" : ""; ?>>Admin</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label class="row">Mobile</label>
                    <span class="text-danger row"><?= @$message['mobile'] ?></span>
                    <input type="text" class="form-control inputs row" name="mobile" id="mobile" placeholder="Mobile No." maxlength="18" value="<?= $amobile ?>" />
                </div>
                <div class="col-6">
                    <label class="row">Telephone</label>
                    <span class="text-danger row"><?= @$message['telephone'] ?></span>
                    <input type="text" class="form-control inputs row" name="telephone" id="telephone" placeholder="Telephone No." maxlength="18" value="<?= $atelephone ?>" />
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label class="row">Address</label>
                    <span class="text-danger row"><?= @$message['address'] ?></span>
                    <input type="text" class="form-control inputs row" name="address1" id="address1" placeholder="House No. & Street" value="<?= $aaddress1 ?>" />
                    <input type="text" class="form-control inputs row" name="address2" id="address2" placeholder="City" value="<?= $aaddress2 ?>" />
                    <input type="text" class="form-control inputs row" name="address3" id="address3" placeholder="Province or Region" value="<?= $aaddress3 ?>" />
                </div>
                <div class="col-6">
                    <label class="row">Account Status</label>
                    <select name="status" id="status" class="form-control inputs row">
                        <option value="1" <?= $astatus == 1 ? "selected" : ""; ?>>Enabled</option>
                        <option value="0" <?= $astatus == 0 ? "selected" : ""; ?>>Disabled</option>
                    </select>
                </div>
            </div>

            <input type="text" name="password_hash" id="password_hash" class="d-none" value="<?= $apassword_hash ?>" />
            <input type="text" name="customer_id" id="customer_id" class="d-none" value="<?= $customer_id ?>" />
            <input type="text" name="update_stat" id="update_stat" class="d-none" value="<?= $update ?>" />

        </form>
        <div class="row justify-content-center">
            <div class="col-2">
                <button class="common_btn w-100" name="sub_btn" id="sub_btn" data-bs-toggle="modal" data-bs-target="#success_modal" <?= $update ? "" : "disabled" ?>>Submit</button>
            </div>
            <div class="col-2">
                <button class="crit_btn w-100" name="res_btn" id="res_btn" data-bs-toggle="modal" data-bs-target="#reset_modal">Reset</button>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->


<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/modals.php';
$page_content = ob_get_clean();
$page_title = "Employees";
$user_image = $_SESSION['profile_pic'];
$first_name = $_SESSION['first_name'];
$_SESSION['employee_role'] == 1 ? $user_role = "Admin" : ($_SESSION['employee_role'] == 2 ? $user_role = "Manager" : ($_SESSION['employee_role'] ? $user_role = "Receptionist" : $user_role = "Travel Solution"));
$role_image = "images/" . $_SESSION['employee_role'] . ".jpg";

$sql = "SELECT * FROM modules m INNER JOIN user_modules um ON m.ModuleId = um.ModuleId WHERE um.UserId = " . $user_id;
$modules = $db->query($sql);
$sql = "SELECT * FROM  messages WHERE messages.UserIdTo = '$user_id'";
$messages = $db->query($sql);
$sql = "SELECT * FROM  notes WHERE notes.UserIdTo = " . $user_id;
$notes = $db->query($sql);

require_once $_SERVER['DOCUMENT_ROOT'] . '/system/layout.php';
?>