<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/init.php';
if (!isset($_SESSION['user_id'])) {
    reDirect(SYSTEM_BASE_URL . "login.php");
}
$user_id = $_SESSION['user_id'];
$db = dbConn();
$sql = "SELECT * FROM user_modules WHERE UserId='$user_id' AND ModuleId ='5'";
$result = $db->query($sql);
if ($result->num_rows < 1) {
    reDirect(SYSTEM_BASE_URL . "401.php");
};
$form_title = "User Details Form";
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
                        <label class="form-check-label" for="inlineCheckbox1">Include promotional offer notifications</label>
                    </div>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="checkbox" id="promotional" value="1">
                        <label class="form-check-label" for="inlineCheckbox1">Consent processing personal data for 3rd party marketing purposes</label>
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


<?php
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