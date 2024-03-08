<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:login.php");
}
include 'header.php';
?>


<main id="main">
    <section id="contact" class="contact">
        <div class="container ">

            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Dashboard</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <h3><?php echo $_SESSION['user_id']; ?></h3>
                </div>
                <div class="col-md-12">
                    <button onclick="reDirect('logout.php')">logout</button>
                </div>
            </div>
        </div>
    </section>
</main>


<?php
include 'footer.php';
?>