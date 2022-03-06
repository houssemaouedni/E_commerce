<?php
require 'commun_services.php';

// if(!isset($_REQUEST['name']) || !isset($_REQUEST['description']) ||!isset($_REQUEST['price']) ||!isset($_REQUEST['stock']) ||!isset($_REQUEST['category']) ||!isset($_REQUEST['image']) ||!isset($_REQUEST['idproduit'])){
//     produceErrorRequest();
//     return;
// }

// if(empty($_REQUEST['name']) || empty($_REQUEST['description']) ||empty($_REQUEST['price']) ||empty($_REQUEST['stock']) ||empty($_REQUEST['category']) ||empty($_REQUEST['image']) ||empty($_REQUEST['idproduit'])){
//     produceErrorRequest();
//     return;
// }

try {
    $produit = new produitEntity();
    $produit->setName($_REQUEST['name']);
    $produit->setDescription($_REQUEST['description']);
    $produit->setPrice($_REQUEST['price']);
    $produit->setStock($_REQUEST['stock']);
    $produit->setCategory($_REQUEST['category']);
    $produit->setImage($_REQUEST['image']);
    $produit->setIdProduit($_REQUEST['idproduit']);
    $result = $db->updateProduit($produit);
    // print_r($result);exit();
    if($result){
        produceResult("Update Produit avec success");
    }else{
        produceError("Echec de la Update ");
    }
} catch (Exception $th) {

    produceError($th->getMessage());
}
?>







