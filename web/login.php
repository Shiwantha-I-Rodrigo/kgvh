<?php
include 'header.php';
include '../functions.php';
?>

<main id="main">
    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
        <div class="container " data-aos="fade-up">

            <div class="contact">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="titlepage">
                                <h2>Login</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
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
                                    header("Location:dashboard.php");
                                } else {
                                    $message['password'] = "Invalid User Name or Password...!";
                                }
                            } else {
                                $message['password'] = "Invalid User Name or Password...!";
                            }
                        }
                    }
                    ?>
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" class="main_form" novalidate>

                        <div class="form-group mt-3">
                            <label for="name">User Name</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter your User Name" required>
                            <span class="text-danger"><?= @$message['username'] ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" required>
                            <span class="text-danger"><?= @$message['password'] ?></span>
                        </div>

                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Login</button></div>
                    </form>
                </div>

            </div>

        </div>

    </section>
</main>

<?php
include 'footer.php';
?>