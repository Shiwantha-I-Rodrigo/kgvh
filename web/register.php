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


<main id="main">
    <section id="contact" class="contact">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Registration</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" class="main_form" novalidate>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control border border-1 border-dark" id="first_name" value="<?= @$first_name ?>" placeholder="First Name" required>
                                <span class="text-danger"><?= @$message['first_name'] ?></span>
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control border border-1 border-dark" name="last_name" id="last_name" placeholder="Last Name" required>
                                <span class="text-danger"><?= @$message['first_name'] ?></span>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="text" class="form-control border border-1 border-dark" name="email" id="email" placeholder="Email" required>
                            <span class="text-danger"><?= @$message['email'] ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="address_line1">Address</label>
                            <input type="text" class="form-control border border-1 border-dark" name="address_line1" id="address_line1" placeholder="Address Line 1" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control border border-1 border-dark" name="address_line2" id="address_line2" placeholder="Address Line 2" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control border border-1 border-dark" name="address_line3" id="address_line3" placeholder="Address Line 3" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="telno">Tel. No.(Home)</label>
                            <input type="text" class="form-control border border-1 border-dark" name="telno" id="telno" placeholder="Tel. No." required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="telno">Mobile No.</label>
                            <input type="text" class="form-control border border-1 border-dark" name="mobile_no" id="mobile_no" placeholder="Mobile No" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Select Gender</label>
                            <div class="form-check">
                                <input class="form-check-input border border-1 border-dark" type="radio" name="gender" id="male" value="male">
                                <label class="form-check-label" for="male">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input border border-1 border-dark" type="radio" name="gender" id="female" value="female">
                                <label class="form-check-label" for="female">
                                    Female
                                </label>
                            </div>
                            <div class="text-danger mt-4"><?= @$message['gender'] ?></div>
                        </div>
                        <div class="form-group mt-3">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM  districts";
                            $result = $db->query($sql);
                            ?>
                            <label for="telno">District</label>
                            <select name="district" id="district" class="form-select form-select-lg mb-3 border border-1 border-dark" aria-label="Large select example">
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?= $row['Id'] ?>"><?= $row['Name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="user_name">User Name</label>
                            <input type="text" class="form-control border border-1 border-dark" name="user_name" id="user_name" placeholder="Username" required>
                            <span class="text-danger"><?= @$message['user_name'] ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control border border-1 border-dark" name="password" id="password" placeholder="Password" required>
                            <span class="text-danger"><?= @$message['password'] ?></span>
                        </div>
                        <div class="col-md-12">
                            <button class="send_btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include 'footer.php';
?>