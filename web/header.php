<!DOCTYPE html>
<html>

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site meta -->
    <title>KGVH</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!-- Javascripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/sweetalert2@11.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/functions.js"></script>
</head>

<body class="main-layout" onload="setActive();">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <!-- header -->
    <header>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col">
                        <a href="index.php"><img src="images/logo.png" alt="#" /></a>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item" id="index.php">
                                        <a class="nav-link" href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item" id="about.php">
                                        <a class="nav-link" href="about.php">About</a>
                                    </li>
                                    <li class="nav-item" id="room.php">
                                        <a class="nav-link" href="room.php">Rooms</a>
                                    </li>
                                    <li class="nav-item" id="gallery.php">
                                        <a class="nav-link" href="gallery.php">Gallery</a>
                                    </li>
                                    <li class="nav-item" id="blog.php">
                                        <a class="nav-link" href="blog.php">Blog</a>
                                    </li>
                                    <li class="nav-item" id="contact.php">
                                        <a class="nav-link" href="contact.php">Message</a>
                                    </li>
                                </ul>

                                <?php
                                session_start();
                                if (!isset($_SESSION['user_id'])) {
                                    echo '<button class="nav-btn" onclick="reDirect(\'login.php\')">Login</button>';
                                    echo '<button class="nav-btn" onclick="reDirect(\'register.php\')">Register</button>';
                                } else {
                                    echo '<button class="nav-crt" onclick="reDirect(\'logout.php\')">Logout</button>';
                                    echo '<button class="nav-btn" onclick="reDirect(\'dashboard.php\')">Profile</button>';
                                }
                                ?>

                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="user_overlay" onclick="reDirect('dashboard.php')">
        <div id="user_overlay_text">Welcome Back <?php echo $_SESSION['user_name']?></div>
    </div>