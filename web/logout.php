<?php
session_start();
session_destroy();
include '../functions.php';
reDirect("login.php");
?>