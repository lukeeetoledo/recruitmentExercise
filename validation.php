<?php

session_start();
$_SESSION["error"] = "";
//if user is already logged in
 if((isset($_SESSION["username"]) && $_SESSION["username"]!="")) {
     header("location:home/index.php");
     exit();
 }

var_dump($_SESSION);
//if user is not logged in
$username = $_POST['username'];
$password = $_POST['password'];

$url = 'https://netzwelt-devtest.azurewebsites.net/Account/SignIn';
$data = array('username' => $username, 'password' => $password);
//encoding value to json format, from array to json
$content = json_encode($data);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => $content, 
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
 //if results does not match the right credentials an error will show
if (!$result) {
    $_SESSION["error"] = "Invalid username password";
    header("location:Account/login.php");
    exit();
 }
//json_decode function to turn json to object
$resultData = json_decode($result, true);
var_dump($resultData);
if(isset($resultData["displayName"])) {
    $_SESSION["username"] = $username;
    $_SESSION["display_name"] = $resultData["displayName"];
    header("location:home/index.php");
} else {
    $_SESSION["error"] = "Invalid username password";
}