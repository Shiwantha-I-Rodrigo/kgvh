<?php
session_start();
include 'header.php';
include '../functions.php';
?>

<main id="main">
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2 class="text-success">SUCCESS</h2>
                
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 border border-3  border-success" data-aos="fade-up" data-aos-delay="200">
                    <h1 class="text-center">Congratulations</h1>
                    
                    <h2 class="text-center">Your account has been successfully created</h2>
                    
                    <h1 class="text-center">Your Registration Number is <?php $_SESSION['reg_no'];?></h1>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include 'footer.php';
?>