<?php


require 'commun_services.php';

try {
    $category = $db->getCategory();
    if($category){
        produceResult(clearDataArray($category));
    }else{
        produceError("Probleme de recuperation des donner");
    }
} catch (Exception $th) {
    produceError("Echec de Récuperation des Category");
}

?>