<?php
require 'commun_services.php';

if(!isset($_REQUEST['name']) || empty($_REQUEST['name'])){
produceErrorRequest();
return;
}
try {
    $category = new CategoryEntity();
    $category->setName($_REQUEST['name']);
    $result = $db->creatCategory($category);
    if($result){
        produceResult("category creer avec success");
    }else{
        produceError("Echec de la creation ");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}



?>