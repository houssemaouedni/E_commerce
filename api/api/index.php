<?php
// echo "Page index";
// var_dump($_SERVER['REQUEST_URI']);

$url = trim($_SERVER['REQUEST_URI'],'/');
$url_clean = explode("/",$url);
// print_r($url_clean);exit();
if(sizeof($url_clean) < 3){
    header("location: ../index.php");
    exit();
}else{
    $action = $url_clean[sizeof($url_clean)-1];
    $pos = strpos($action,'?');
    if($pos){
        $temp = explode("?",$action);
        $action = $temp[0];
    }
    if($_SERVER['REQUEST_METHOD'] === "GET"){
        require './get'.ucWords($action).".php";       
    }elseif($_SERVER['REQUEST_METHOD'] === "POST"){
        require './create'.ucWords($action).".php";
    }elseif($_SERVER['REQUEST_METHOD'] === "DELETE"){
        require './delete'.ucWords($action).".php";
    }elseif($_SERVER['REQUEST_METHOD'] === "PUT"){
        require './update'.ucWords($action).".php";
    }
}

// var_dump($action)
?>