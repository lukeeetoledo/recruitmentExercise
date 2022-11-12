<?php
//starts session
    session_start();
//for error message
$error="";
if(isset($_SESSION["error"]) && $_SESSION["error"]!="") {
    $error=$_SESSION["error"];
    $_SESSION["error"]="";
}
//if user is already logged in
if((isset($_SESSION["username"]) && $_SESSION["username"]!="")) {
    header("location:../home/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- STLYES -->
    <link rel = "stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel= "stylesheet" href="../css/styles.css">
</head>

<body>
    <div class = "container-fluid">
        <div class = "row justify-content-center">
            <div class="container d-flex align-items-center justify-content-center">
                <form class = "form-container" method="post" action="../validation.php">
                    <div class ="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/>
                    </svg>
                    </div>
                    <div class="form-group">
                        <h3 for="logo">netzwelt Login</h3>
                        <hr>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required placeholder ="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder ="Enter password">
                    </div><br>
                        <button type = "submit" class="btn btn-dark w-100">Submit</button>
                        
                <!-- displaying error message -->
                <?php
                    if($error!="") {
                ?>
                <hr class="my-4">
                <div class="d-grid">
                    <div class="alert alert-danger" role="alert">
                        <?php 
                            echo $error;
                        ?>
                    </div>
                </div>
                <?php
                }
                 ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
