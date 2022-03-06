<?php
require 'commun_services.php';

if(!isset($_REQUEST['idUser']) || empty($_REQUEST['idUser'])){
    produceErrorRequest();
    return;
}

try {
    $user = new usersEntity();
    $user->setIdUser($_REQUEST['idUser']);
    $result = $db->deleteUsers($user);
    if($result){
        produceResult("Delete user avec success");
    }else{
        produceError("Echec de la Update ");
    }
} catch (Exception $th) {
    
    produceError($th->getMessage());
}

?>