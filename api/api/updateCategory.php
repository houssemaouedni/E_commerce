<?php
require 'commun_services.php';

if(!isset($_REQUEST['name']) || empty($_REQUEST['name']) || !isset($_REQUEST['idCategory']) || empty($_REQUEST['idCategory'])){
    produceErrorRequest();
    return;
}

try {
    $category = new CategoryEntity();
    $category->setName($_REQUEST['name']);
    $category->setIdCategory($_REQUEST['idCategory']);
    $result = $db->updateCategory($category);
    if($result){
        produceResult("Update category creer avec success");
    }else{
        produceError("Echec de la Update ");
    }
} catch (Exception $th) {
    echo "test"  ; 
    produceError($th->getMessage());
}

?>