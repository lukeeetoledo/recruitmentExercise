<?php   
session_start(); 
//onced pressed the session will expire and will be redirected to login. It will also prevent force entry to the index without loging in
session_destroy();
header("Location: ./Account/login.php");
?>