<?php


require 'commun_services.php';

try {
    $order = $db->getOrders();
    if($order){
        produceResult(clearDataArray($order));
    }else{
        produceError("Probleme de recuperation des donner");
    }
} catch (Exception $th) {
    produceError("Echec de Récuperation des Order");
}

?>