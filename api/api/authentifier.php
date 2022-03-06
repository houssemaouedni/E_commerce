<?php
session_start();

require 'commun_services.php';
// cas ou l'utilisateur est deja connecter 
if(isset($_SESSION['ident'])){
    produceError("utilisateur deja connecter");
    return;
}
// cas ou la requete est mal formuler
if(!isset($_REQUEST['email']) || !isset($_REQUEST['password'])){
    produceErrorRequest();
    return;
}


try {
    $user = new usersEntity();
    $user->setEmail($_REQUEST['email']);
    $user->setPassword($_REQUEST['password']);

    $dataAuth = $db->authentifier($user);
    if($dataAuth){
        //authentification reussie
        produceResult(clearData($dataAuth));
        $_SESSION['ident'] = $dataAuth;
    }else{
        produceError("email ou password incorrect. Merci de ressayer");
    }

} catch (Exception $th) {
    produceError($th->getMessage());
}

?>