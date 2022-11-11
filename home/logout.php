<?php   
session_start(); 
header("Location: ../account/login.php");
session_destroy(); 
exit();
?>