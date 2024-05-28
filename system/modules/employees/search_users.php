<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/init.php';
if (!isset($_SESSION['user_id'])) {
    reDirect(SYSTEM_BASE_URL . "login.php");
}

if (isset($_GET['part']) && $_GET['part'] != '') {
    $part = htmlspecialchars($_GET["part"]);
    $db = dbConn();
    $sql = "SELECT UserName FROM users WHERE UserName LIKE '%$part%'";
    $result = $db->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo $row['UserName'] . ',';
    };
} else if (isset($_GET['full']) && $_GET['full'] != '') {
    $full = htmlspecialchars($_GET["full"]);
    $db = dbConn();
    $sql = "SELECT UserName FROM users WHERE UserName=$full";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    echo $row['UserId'];
}
