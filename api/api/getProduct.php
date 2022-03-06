<?php


require 'commun_services.php';

try {
    $produit = $db->getProduit();
    if($produit){
        produceResult(clearDataArray($produit));
    }else{
        produceError("Probleme de recuperation des donner");
    }
} catch (Exception $th) {
    echo $th;
    produceError("Echec de Récuperation des Produit");
}

?>