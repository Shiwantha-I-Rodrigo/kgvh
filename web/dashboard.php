<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:login.php");
}
include 'header.php';
?>


<div class="page_title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h2 onclick="userNameOn();">Dashboard</h2>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include 'footer.php';
?>