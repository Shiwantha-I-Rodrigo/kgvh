<!DOCTYPE html>
<html lang="en">

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/header.php';
?>

<body>

    <!-- Spinner Start -->
    <div class="overlay" id="loader">
        <span class='loader' style="text-align:center;display:inline-block"></span>
    </div>
    <!-- Spinner End -->

    <div class="container-fluid position-relative d-flex p-0">

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3" id="sidebar" name="sidebar">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="dashboard.php" class="navbar-brand mx-4 mb-3">
                    <img src="<?= SYSTEM_BASE_URL ?>images/logo_red.png" alt="logo" />
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="<?= SYSTEM_BASE_URL ?><?= $role_image ?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <span><strong><?= $user_role ?></strong></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">

                    <?php while ($row = $modules->fetch_assoc()) { ?>
                        <a href="<?= SYSTEM_BASE_URL ?>modules/<?= $row['ModulePath'] ?>" class="nav-item nav-link"><i class="<?= $row['ModuleClasses'] ?>"></i><?= $row['ModuleName'] ?></a>
                    <?php }; ?>

                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content" id="content" name="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="<?= SYSTEM_BASE_URL ?>dashboard.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0" id="sidebar_toggle">
                    <i class="fa fa-bars"></i>
                </a>
                <h1 style="margin-left: 20px; margin-top:10px;"><?= $page_title ?></h1>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">

                            <?php while ($row = $messages->fetch_assoc()) { ?>
                                <a href="<?= SYSTEM_BASE_URL ?><?= $row['MessagePath'] ?>" class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle" src="<?= SYSTEM_BASE_URL ?><?= $row['ProfileImagePath'] ?>" alt="" style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0"><?= $row['MessageShort'] ?></h6>
                                            <small><?= $row['Date'] ?></small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                            <?php }; ?>

                            <a href="<?= SYSTEM_BASE_URL ?>modules/reception/messages.php" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notifications</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">

                            <?php while ($row = $notes->fetch_assoc()) { ?>
                                <a href="<?= SYSTEM_BASE_URL ?><?= $row['NotePath'] ?>" class="dropdown-item">
                                    <h6 class="fw-normal mb-0"><?= $row['NotePath'] ?></h6>
                                    <small><?= $row['Date'] ?></small>
                                </a>
                                <hr class="dropdown-divider">
                            <?php }; ?>

                            <a href="<?= SYSTEM_BASE_URL ?>modules/employees/notifications.php" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?= SYSTEM_BASE_URL ?><?= $user_image ?>" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?= $first_name ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="<?= SYSTEM_BASE_URL ?>profile.php" class="dropdown-item">Profile</a>
                            <a href="<?= SYSTEM_BASE_URL ?>lock.php" class="dropdown-item">Lock</a>
                            <a href="<?= SYSTEM_BASE_URL ?>logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Page Start -->
            <?php echo $page_content; ?>
            <!-- Page End -->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">King Garden View Hotel</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By <a href="https://github.com/Shiwantha-I-Rodrigo">Shiwantha Rodrigo</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/system/footer.php';
    ?>

</body>

</html>