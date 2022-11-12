<?php
session_start();
//if user is not logged in, he/she will be redirected to the login page
    if(!isset($_SESSION['username'])){
        header("Location: ../Account/login.php");
    }
    $url = 'https://netzwelt-devtest.azurewebsites.net/Territories/All';

    $options = array(
        'http' => array(
            'method'  => 'GET',
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $resultData = json_decode($result,true);
    
    $parent = 0;
    //checking every parent in the given result
   
    $treeData=$resultData["data"];
    $tree ="";
    
    for ($i=0; $i<count($treeData); $i++) {
    
        if($treeData[$i]["parent"] == null) {
            $parent ++;
            $tree .= "{";
                $tree .='text : "'.$treeData[$i]["name"].'"';
                $tree .=",selectable:true,state:{expanded:false, checked:true}";
                $child = find_child($treeData[$i]["id"], $treeData);
                $tree .=$child;
            $tree .= "},";
        }
    }
    //function for finding another child, and grandchild using recursive loop
    function find_child($id, $treeData) {
        $child = "";
    
        for($i=0;$i<count($treeData); $i++) {
            if($treeData[$i]["parent"] == $id) {
                $child .= "{";  
                $child .='text: "'.$treeData[$i]["name"].'"';
                $child .=",state:{expanded:false, checked:true}";
                $grandChild = find_child($treeData[$i]["id"], $treeData);
                $child .=$grandChild;
                $child .= "},";
            }
        }
        if($child!="") {
            $child =", nodes: [".$child."]";
        }
        return $child;
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <!-- STLYES -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script type="text/javascript" src="../js/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-treeview.js"></script>
    <link rel= "stylesheet" href="../css/styles.css">
   
</head>
<body>
    <nav class ="navbar fixed-top navbar-expand-lg navbar-dark bg-dark" id="navdes">
        <div class="container">
         <span class="navbar-brand mb-0 h1">netzwelt</span>
            <div class ="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                         <a href="#" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
            <div class ="d-flex">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a href="../logout.php" class="nav-link">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        
    <div class="container" id="container1">
        <div class="row">
        <div class="col-sm-9 col-md-8 col-lg-8 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
            <div class="card-body p-4 p-sm-5" >
                <div class ="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-building-fill" viewBox="0 0 16 16">
                    <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H3Zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5ZM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Z"/>
                    </svg>
                </div><hr>
                    <div class="form-group">
                        <h3 for="logo">Territories</h3>
                        <hr>
                    </div>
                        <div id="tree"></div>
            </div>
        </div>
        </div>
        </div> 
    </div>
</body>
</html>

<script type="text/javascript">
       
       var tree = [<?php echo $tree;?>];
        $("#document").ready(function(){
            $('#tree').treeview({data: tree,levels:3});
        });
        $(document).on('click','.node-tree', function(event, data) {
            const id = Number($(this).attr("data-nodeid"));
            console.log(id);
             $('#tree').treeview('toggleNodeExpanded', [ id, { levels: 1, silent: true } ]);
            
        });
    </script>  