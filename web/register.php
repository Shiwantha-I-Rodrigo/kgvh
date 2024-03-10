<?php
session_start();
include 'header.php';
include '../functions.php';
include '../config.php';
include '../mail.php';
?>


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
    if (!isset($gender)) {
        $message['gender'] = "Gender is required";
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
        $sql = "SELECT * FROM customers WHERE Email='$email'";
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
    }
    if (empty($message)) {
        $pw_hash = password_hash($password, PASSWORD_BCRYPT);
        $db = dbConn();
        $sql = "INSERT INTO `users`(`UserName`, `Password`) VALUES ('$user_name','$pw_hash')";
        $db->query($sql);

        $user_id = $db->insert_id;
        $reg_no = date('Y') . date('m') . $user_id;
        $_SESSION['reg_no'] = $reg_no;

        $sql = "INSERT INTO `customers`(`FirstName`, `LastName`, `Email`, `AddressLine1`, `AddressLine2`, `AddressLine3`, `TelNo`, `MobileNo`, `Gender`, `DistrictId`,`RegNo`,`UserId`) VALUES ('$first_name','$last_name','$email','$address_line1','$address_line2','$address_line3','$telno','$mobile_no','$gender','$district','$reg_no','$user_id')";
        $db->query($sql);

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
    <section class="vh-100" style="background-color: #fff;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-8">
                    <div class="card" style="border-radius: 1rem;background-color: #0f5256;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-12 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form class="main_form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" novalidate>
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <img src="images/logo_big.png" alt="login form" class="img-fluid full" style="border-radius: 1rem 0 0 1rem;" />
                                        </div>

                                        <h1 class="full"> ⬩ Registration Form ⬩</h1>

                                        <label class="halfL">Username</label>
                                        <label class="halfR">Password</label>
                                        <input type="text" class="form-control inputs halfL" name="user_name" id="user_name" placeholder="Username *" required />
                                        <input type="password" class="form-control inputs halfR" name="password" id="password" placeholder="Password *" required />
                                        <span class="text-danger"><?= @$message['credentials'] ?></span>

                                        <label class="halfL">Email</label>
                                        <input type="email" class="form-control inputs" name="email" id="email" placeholder="Email *" required />
                                        <span class="text-danger"><?= @$message['email'] ?></span>

                                        <label class="halfL">First Name</label>
                                        <label class="halfR">Last Name</label>
                                        <input type="text" class="form-control inputs halfL" name="first_name" id="first_name" placeholder="First Name *" required />
                                        <input type="text" class="form-control inputs halfR" name="last_name" id="last_name" placeholder="Last Name *" required />
                                        <span class="text-danger halfL"><?= @$message['first_name'] ?></span>
                                        <span class="text-danger halfR"><?= @$message['last_name'] ?></span>

                                        <label class="halfL">NIC</label>
                                        <label class="halfR">Birthday</label>
                                        <input type="text" class="form-control inputs halfL" name="nic" id="nic" placeholder="National ID Card Number" />
                                        <input type="date" class="form-control inputs halfR" name="birthday" id="birthday" placeholder="Birth Day" />
                                        <span class="text-danger halfL"><?= @$message['nic'] ?></span>
                                        <span class="text-danger halfR"><?= @$message['birthday'] ?></span>

                                        <label class="halfL">Address</label>
                                        <input type="text" class="form-control inputs" name="address1" id="address1" placeholder="House/Building No." />
                                        <input type="text" class="form-control inputs" name="address2" id="address2" placeholder="Street" />
                                        <input type="text" class="form-control inputs" name="address3" id="address3" placeholder="Town" />
                                        <span class="text-danger"><?= @$message['address'] ?></span>

                                        <?php
                                        $db = dbConn();
                                        $sql = "SELECT * FROM  districts";
                                        $result = $db->query($sql);
                                        ?>

                                        <label class="halfL">Nationality</label>
                                        <label class="halfR">Gender</label>

                                        <select name="nationality" id="nationality" class="form-control inputs halfL">
                                            <?php
                                            while ($row = $result->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row['Id'] ?>"><?= $row['Name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                        <select name="gender" id="gender" class="form-control inputs halfR">
                                            <option value="0">Male</option>
                                            <option value="1">Female</option>
                                        </select>

                                        <label class="halfL">Mobile</label>
                                        <label class="halfR">Telephone</label>
                                        <input type="text" class="form-control inputs halfL" name="mobile" id="mobile" placeholder="Mobile No." />
                                        <input type="text" class="form-control inputs halfR" name="telephone" id="telephone" placeholder="Telephone No." />
                                        <span class="text-danger halfL"><?= @$message['mobile'] ?></span>
                                        <span class="text-danger halfR"><?= @$message['telephone'] ?></span>

                                        <label class="halfL">About You</label>
                                        <input type="text" class="form-control inputs" name="about" id="about" placeholder="Something About You " />
                                        <span class="text-danger"><?= @$message['about'] ?></span>

                                        <button class="common_btn full" type="submit" formmethod="post">Submit</button>

                                        <p style="color: #fff;"> Already have an account ? <a href="login.php" style="color: #a5c5c5;"> Login here </a></p>
                                        <p style="color: #fff; margin-top: 20px;" class="text-muted"> ! Required fields are indicated with a '*' mark </p>
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