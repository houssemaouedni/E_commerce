<?php
require 'commun_services.php';

if(!isset($_REQUEST['idCategory']) || empty($_REQUEST['idCategory'])){
    produceErrorRequest();
    return;
}

try {
    $category = new CategoryEntity();
    $category->setIdCategory($_REQUEST['idCategory']);
    $result = $db->deleteCategory($category);
    if($result){
        produceResult("Delete category avec success");
    }else{
        produceError("Echec de la Update ");
    }
} catch (Exception $th) {
    
    produceError($th->getMessage());
}

?>