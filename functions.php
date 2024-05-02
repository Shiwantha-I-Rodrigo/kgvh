<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';


//Create Database Conection-------------------
function dbConn()
{
    global $_DB_SERVER, $_DB_USERNAME, $_DB_PASSWORD, $_DB_NAME;
    $conn = new mysqli($_DB_SERVER, $_DB_USERNAME, $_DB_PASSWORD, $_DB_NAME);

    if ($conn->connect_error) {
        die("Database Error : " . $conn->connect_error);
    } else {
        return $conn;
    }
}


//Data Clean------------------------------------------
function dataClean($data = null)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = preg_replace("/[^a-zA-Z0-9_-]/", "", $data);

    return $data;
}


//Redirect---------------------------------------------
function reDirect($data = null)
{
    echo '<script type="text/javascript">window.location = "' . $data . '";</script>';
}


//RoleSelect---------------------------------------------
function role($data = null)
{
    $data == 1 ? $user_role = "Admin" : ($data == 2 ? $user_role = "Manager" : ($data == 3 ? $user_role = "Receptionist" : $user_role = "Travel Solution"));
    return $user_role;
}


//TitleSelect---------------------------------------------
function title($data = null)
{
    $data == 0 ? $user_title = "Mr" : ($data == 1 ? $user_title = "Mrs" : ($data == 2 ? $user_title = "Miss" : ($data == 3 ? $user_title = "Hon" : $user_title = "Ven")));
    return $user_title;
}


//Unauthorize---------------------------------------------
function unauthorize($user_id = null, $module_id = null)
{
    $db = dbConn();
    $sql = "SELECT * FROM user_modules WHERE UserId='$user_id' AND ModuleId ='$module_id'";
    $result = $db->query($sql);
    if ($result->num_rows < 1) {
        reDirect(SYSTEM_BASE_URL . "401.php");
    };
}
