<?php

session_start();
 
$_SESSION = array();

session_destroy();
 
header("location: http://localhost/employeeLMS/employeelogin.php");
exit;
?>