<?php
session_start();
//verification
    if(!isset($_SESSION['username'])){
        header("Location: ../account/login.php");
    }else{

    $newLogUrl = 'https://netzwelt-devtest.azurewebsites.net/Territories/All';
    $opt = array('http' => array(
                'method'  => "GET",
                'header'  => 'Content-type: application/json; accept: */*',
                ));
    $content = file_get_contents($newLogUrl);               
    $json = json_encode($content);
    //$json = json_decode($json_pretty,JSON_PRETTY_PRINT);
    printf("<pre>%s</pre>", $json);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
<a href="../logout.php">Log Out Btn</a>
</body>
</html>