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
    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['username']) && isset($_POST['password'])){
         $username = $_POST['username'];
         $password = $_POST['password'];
        
        $url = "https://netzwelt-devtest.azurewebsites.net/Account/SignIn/?username=$username?password=$password";
        echo $url;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $headers = array(
           "Accept: text/plain",
           "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        
        $data = <<<DATA
        {
            "username":"a", "password":"a"
        } 
        DATA;
        
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        //echo $username . $password;
        $resp = curl_exec($curl);
        
        curl_close($curl);
        //var_dump($resp);
    }
    
    

        // if($_SERVER['REQUEST_METHOD'] == "POST"){
        //     $ch = curl_init();
 
        //     curl_setopt($ch, CURLOPT_URL,"https://netzwelt-devtest.azurewebsites.net/Account/SignIn");
        //     curl_setopt($ch, CURLOPT_POST, 1);
        //     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
 
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     curl_setopt($ch, CURLOPT_HEADER, true); 
        //     // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        //     $output = curl_exec($ch);
        //     $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 
        //     curl_close($ch);
 
        // }
    ?>
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
                        <input type="text" class="form-control" id="username" name="username" required="required">
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="control-label">password</label>
                        <input type="text" class="form-control" id="password" name="password" required="required">
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
    <div class="card rounded-0 mx-auto col-lg-6 col-md-8 col-sm-12 mt-3">
        <div class="card-header">
            <div class="card-title">cURL Response</div>
        </div>
        <div class="card-body">
            <?php if(isset($output)): ?>
            <div class="container-fluid">
                <p><b>HTTP Response Code:</b></p>
                <div class="bg-secondary bg-opacity-50 p-2">
                <?= $http_code ?>
                </div>
            </div>
            <?php else: ?>
                <div class="text-center"><b>Submit Data using the Form above first.</b></div>
            <?php endif; ?>
        </div>
    </div>
 
</body>
</html>
<!-- 
// // $headers = [
// //     "accept: application/json",
// //     "Content-Type: application/json"
// // ];

// // $ch = curl_init("https://netzwelt-devtest.azurewebsites.net/Account/SignIn");
// // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// // curl_exec($ch);
// // curl_close($ch);
// //
// $headers = [
//     "accept: application/json",
//     "Content-Type: application/json"
// ];
// $post = [
//     'username' => 'a',
//     'password' => 'a',
// ];

// $ch = curl_init('https://netzwelt-devtest.azurewebsites.net/Account/SignIn');
// //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// // execute!
// $response = curl_exec($ch);

// // close the connection, release resources used
// curl_close($ch);

// // do anything you want with your response
// var_dump($response);

// // if ($server_output == "OK") 
// //     {
// //     echo "pasok";
// //     }
// //     else{
// //         echo "fail";
// //     }

$post = [
    'username' => 'foo',
    'password' => 'bar',
];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://netzwelt-devtest.azurewebsites.net/Account/SignIn');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
$response = curl_exec($ch);
var_export($response);
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
   
</body>
</html> -->