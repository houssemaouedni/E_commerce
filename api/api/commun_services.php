<?php
date_default_timezone_set("Africa/Tunis");
header("Content-type: application/json; charset=UTF-8");

define("API", dirname(__FILE__));
define("ROOT", dirname(API));
define("SP", DIRECTORY_SEPARATOR);
define("CONFIG", ROOT.SP."config");
define("MODEL",ROOT.SP."model");
define("ENTITY", ROOT.SP."entity");
define("API_KEY", 'h11059586');

require CONFIG.SP."config.php";
require MODEL.SP."DataLayer.class.php";
require ENTITY.SP."categoryEntity.php";
require ENTITY.SP."ordersEntity.php";
require ENTITY.SP."produitEntity.php";
require ENTITY.SP."usersEntity.php";
$db =new DataLayer();

function answer($reponse){
    global $_REQUEST;
    $reponse['args'] = $_REQUEST;
    // unset($reponse['args']['password']);
    // unset($reponse['result']['password']);
    $reponse['time'] = date('d/m/y H:i:s');
    echo json_encode($reponse);
}

function produceError($message){
    answer(['status' =>404, 'message' => $message]);
}
function produceErrorAuth(){
    answer(['status' =>401, 'message' => 'Erreur d\'authentification']);
}
function produceErrorRequest(){
    answer(['status' =>400, 'message' => 'Requete mal formulée']);
}
function produceResult($result){
    
    answer(['status' =>200, 'result' => $result]);
}
function clearData($objectMetier){
    $objectMetier = (array)$objectMetier;
    $result =[];
    foreach ($objectMetier as $key => $value) {
        $result[substr($key,3)]= $value;
    }
    return $result;
}

function clearDataArray($array_obj_metrier){
    $result= [];
    foreach ($array_obj_metrier as $key => $value) {
        
        $result[$key] = clearData($value);
    }
    return $result;
}

function controlAccess(){
    global $_REQUEST;
    if(!isset($_REQUEST['API_KEY']) || empty($_REQUEST['API_KEY'])){
        produceErrorAuth();
        exit();
    }elseif($_REQUEST['API_KEY'] !== API_KEY){
        produceError("API_KEY incorrecte !");
        exit();
    }
}

 controlAccess();

?>
