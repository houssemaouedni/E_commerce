<?php
session_start();
require 'commun_services.php';
if(isset($_SESSION['ident'])){
    unset($_SESSION['ident']);
    session_destroy();
    produceResult("Utilisateur Déconnecter");
    return;
}else{
    produceError("utlisateur non connecter");
}

?>