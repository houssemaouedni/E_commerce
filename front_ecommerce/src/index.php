
<?php
require "include.php";

$url = trim($_SERVER['PATH_INFO'], '/');
$url = explode('/', $url);
$route = array("accueil", "contact","produit","category","details","panier","Supprimer","actionInscription","profil","deconnexion","actionConnexion", "messageContact","suprimeOreders" ,"updateProfil","actionUpdate","validationCommande");


//  print_r($_SERVER);
$action = $url[0];

//controlleur

if (!in_array($action, $route)) {
    $title = "Page Erreur";
    $content =" URL introuvable";
    $content = displayAccueil();

} else {
    // echo 'bienvenu sur la page ' . $action;
    $function = "display" . ucwords($action);
    $title = "Page " . $action;
    $content = $function();
    
};

require VIEWS.SP."template".SP."default.php";

?>
