<?php
require 'commun_services.php';

if(!isset($_REQUEST['id']) || empty($_REQUEST['id'])){
    produceErrorRequest();
    return;
}

try {
    $produit = new produitEntity();
    $produit->setIdProduit($_REQUEST['id']);
    $result = $db->deleteProduit($produit);
    if($result){
        produceResult("Delete produit avec success");
    }else{
        produceError("Echec de l'effacement de produit ");
    }
} catch (Exception $th) {
    
    produceError($th->getMessage());
}

?>