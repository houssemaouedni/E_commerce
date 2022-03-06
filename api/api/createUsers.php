<?php
require 'commun_services.php';

if(!isset($_REQUEST['sexe']) || !isset($_REQUEST['pseudo']) || !isset($_REQUEST['firstname'] ) || !isset($_REQUEST['lastname'] ) || !isset($_REQUEST['description']) || !isset($_REQUEST['dateBirth'] ) || !isset($_REQUEST['adresse_facturation']) || !isset($_REQUEST['adresse_Livraison']) || !isset($_REQUEST['tel']) || !isset($_REQUEST['email']) || !isset($_REQUEST['password'])){
produceErrorRequest();
return;
}
try {

    $user = new usersEntity();
    $user->setSexe($_REQUEST['sexe']);
    $user->setPseudo($_REQUEST['pseudo']);
    $user->setFirstname($_REQUEST['firstname']);
    $user->setLastname($_REQUEST['lastname']);
    $user->setDescription($_REQUEST['description']);
    $user->setDateBirth($_REQUEST['dateBirth']);
    $user->setAdressefacturation($_REQUEST['adresse_facturation']);
    $user->setAdresseLivraison($_REQUEST['adresse_Livraison']);
    $user->setTel($_REQUEST['tel']);
    $user->setEmail($_REQUEST['email']);
    $user->setPassword($_REQUEST['password']);

    $result = $db->creatUsers($user);
    if($result){
        produceResult("Users creer avec success");
    }else{
        produceError("Echec de la creation ");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}
?>