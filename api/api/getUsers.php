<?php


require 'commun_services.php';

try {
    $user = $db->getUsers();
    if($user){
        produceResult(clearDataArray($user));
    }else{
        produceError("Probleme de recuperation des donner");
    }
} catch (Exception $th) {
    produceError("Echec de Récuperation des User");
}

?>