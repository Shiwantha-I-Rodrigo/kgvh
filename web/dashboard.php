<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
}
include 'header.php';
?>

<main id="main">
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Dashboard</h2>
                <ol>
                    <li><a href="index.html"><?php $_SESSION['user_id']?></a></li>
                    <li>Dashboard</li>
                </ol>
            </div>

        </div>
    </section>
    <section class="inner-page">
        <div class="container">
            <p>
                Dashboard Area
            </p>
        </div>
    </section>
</main>

<?php
include 'footer.php';
?>