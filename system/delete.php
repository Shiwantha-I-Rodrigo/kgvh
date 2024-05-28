<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/init.php';
if (!isset($_SESSION['user_id'])) {
    reDirect(SYSTEM_BASE_URL . "login.php");
}
if (isset($_GET['id'])) {
    $user_id = $_SESSION['user_id'];
    $record_id = htmlspecialchars($_GET["id"]);
    $module_id = htmlspecialchars($_GET["asset"]);
    unauthorize($user_id, $module_id);
    $db = dbConn();
    switch ($module_id) {
        case '1':
            break;
        case '2':
            break;
        case '3':
            break;
        case '4':
            $sql = "DELETE FROM users where UserId=$record_id";
            break;
        case '5':
            $sql = "DELETE FROM users where UserId=$record_id";
            break;
        case '6':
            break;
        default:
    }
    $result = $db->query($sql);
    $_SESSION['operation'] = 'deleted';
    reDirect("crud_success.php");
}
