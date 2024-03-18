<?php
session_start();
session_destroy();
require_once $_SERVER['DOCUMENT_ROOT'].'/system/init.php';
reDirect(SYSTEM_BASE_URL."login.php");
?>