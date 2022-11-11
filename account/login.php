<?php
    session_start();
    //Checks if the user is already login, if not it stay on the log in page
    if(!isset($_SESSION['username'])) {

        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['username']) && isset($_POST['password'])){
            //declaring variable for the username and password input from the user
            
            $username = $_POST['username'];
            $password = $_POST['password'];
            $_SESSION['username'] = "$username";

           //setting up the url, headers, and data
           $endpoint = "https://netzwelt-devtest.azurewebsites.net/Account/SignIn";
           $headers = array(
               "Accept: text/plain",
               "Content-Type: application/json",
           ); 
           $data = <<<DATA
           {
               "username":"$username", "password":"$password"
           } 
           DATA;
   
           $curl = curl_init($endpoint);
           curl_setopt($curl, CURLOPT_URL, $endpoint);
           curl_setopt($curl, CURLOPT_POST, true);
           curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
           //to get response and http code
           $resp = curl_exec($curl);
           $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
   
           //for debug only!
           curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
           curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
           curl_close($curl);

           //if httpcode received 200 as a success response, the user will be redirected to the homepage 
           if($httpcode == 200){
               echo '<script>alert("Login Successful!");window.location.href="../home/index.php";</script>';
           }else{
               echo '<script>alert("Invalid username or password!");</script>';
           }    
       }
    }else{
        //If the user is already logged in, he or she will be redirected to the homepage
        header("Location: ../home/index.php");
    }
        
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP cURL POST</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <h2 class="text-center">PHP cURL with POST Data</h2>
    <hr>
    <div class="card rounded-0 mx-auto col-lg-6 col-md-8 col-sm-12">
        <div class="card-header">
            <div class="card-title">Sample Form</div>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <form action="" method="POST" id="sample-form">
                    <div class="mb-3">
                        <label for="name" class="control-label">username</label>    
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="control-label">password</label>
                        <input type="text" class="form-control" id="password" name="password" required>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer py-1">
            <div class="d-grid justify-content-center">
                <button class="btn btn-primary rounded-0" form="sample-form">Submit</button>
            </div>
        </div>
    </div>
</body>
</html>