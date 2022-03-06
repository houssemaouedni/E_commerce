<?php
require './config/config.php';
define("BASE_URL", dirname($_SERVER['SCRIPT_NAME']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>

        
        a{
            color: black;
        }
        p{
            background-color: #fff;
            font-size: 20px;
            border: 1px solid rgba(0, 0, 0, .1);
            box-shadow: 
            0 10px 20px rgba(0, 0, 0, .22),
            0 14px 56px rgba(0, 0, 0, .25);
            
        }
        p span:nth-child(1){
            display: inline-block;
            font-size: 28px;
            font-weight: 900;
            min-width: 200px;
            padding: 6px 15px;
            text-align: center;
            color: #fff;
        }
        p span:nth-child(2){
            font-size: 20px;
            font-weight: 700;
        }
        .get{
            background-color: #3caab5;
            text-transform: uppercase;
        }
        .post{
            background-color: #78bc61;
            text-transform: uppercase;
        }
        .delete{
            background-color: #f93e3e;
            text-transform: uppercase;
        }
        .put{
            background-color: #fca130;
            text-transform: uppercase;
        }
        nav.navbar{
            background-color: #288690 !important;

        }
    </style>
    <title>API JSORE</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <a class="navbar-brand" href="#">JSTOR API</a>
</nav>
        <div class="container">
        <h1 class="text-center display-4"> Documentation API JSTOR</h1>

        
    <?php
    foreach ($_ROUTES as $key => $entity) {
        $repense = "<div id='$entity' class='display-4'><h4>".ucwords($entity)."<h4>";
        foreach ($METHODS as $methode => $description) {
            $repense .= "<p><span class='$methode'> $methode </span>
            <span class='url'>
            <a href='".BASE_URL."/api/$entity'target='_blank'> /api/$entity</a>
            </span>
            ".$description['description']." : $entity</p>";
        }
        echo $repense.'</div>';
    }

    ?>
    </div>
</body>
</html>