<?php
require 'commun_services.php';

if(!isset($_REQUEST['name']) || !isset($_REQUEST['description']) || !isset($_REQUEST['price']) || !isset($_REQUEST['stock']) || !isset($_REQUEST['category']) || !isset($_REQUEST['image'])){
    produceErrorRequest();
    return;
}

if(empty($_REQUEST['name']) || empty($_REQUEST['description']) || empty($_REQUEST['price']) || empty($_REQUEST['stock']) || empty($_REQUEST['category']) || empty($_REQUEST['image'])){
    produceErrorRequest();
    return;
}


try {
    $produit = new produitEntity();
    $produit->setName($_REQUEST['name']);
    $produit->setDescription($_REQUEST['description']);
    $produit->setPrice($_REQUEST['price']);
    $produit->setStock($_REQUEST['stock']);
    $produit->setCategory($_REQUEST['category']);
    $produit->setImage($_REQUEST['image']);
    $result = $db->creatProduit($produit);
    if($result){
        produceResult("produit crée Avec Succes");
     }else{
         produceError("Erreur lors de la creation de la produit, Merci de réessayer !");
     }
 } catch (Exception $th) {
     produceError($th->getMessage());
 }

?>
