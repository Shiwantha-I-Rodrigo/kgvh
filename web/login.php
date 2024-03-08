<?php
session_start();
include 'header.php';
include '../functions.php';
?>


<!-- Form actions -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    extract($_POST);

    $username = dataClean($username);

    $message = array();

    if (empty($username)) {
        $message['username'] = "User Name should not be empty...!";
    }
    if (empty($password)) {
        $message['password'] = "Password should not be empty...!";
    }

    if (empty($message)) {
        $db = dbConn();
        $sql = "SELECT * FROM users WHERE UserName='$username'";
        $result = $db->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['Password'])) {
                $_SESSION['user_id'] = $row['Userid'];
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


<main id="main">
    <section id="contact" class="contact">
        <div class="container ">

            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Login</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" class="main_form" novalidate>
                        <div class="form-group mt-3">
                            <label for="user_name">User Name</label>
                            <input type="text" class="form-control border border-1 border-dark" name="username" id="username" placeholder="Username" required>
                            <span class="text-danger"><?= @$message['username'] ?></span>
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