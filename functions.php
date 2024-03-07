<?php
require 'config.php';


//Create Database Conection-------------------
function dbConn()
{
    global $_DB_SERVER, $_DB_USERNAME, $_DB_PASSWORD, $_DB_NAME;
    $conn = new mysqli( $_DB_SERVER, $_DB_USERNAME, $_DB_PASSWORD, $_DB_NAME);

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

    return $data;
}


//Redirect---------------------------------------------
function reDirect($data = null)
{
    echo '<script type="text/javascript">window.location = "'.$data.'";</script>';
}

?>