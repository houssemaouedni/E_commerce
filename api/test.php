<?php
require './config/config.php';
require './entity/produitEntity.php';
require './model/DataLayer.class.php';
require './api/commun_services.php';
define("BASE_URL", dirname($_SERVER['SCRIPT_NAME']));

    $produit = new produitEntity();
    $produit->setName('houssem');
    $produit->setDescription('king');
    $produit->setPrice('2');
    $produit->setStock('1');
    $produit->setCategory('1');
    $produit->setImage('img.jbg');
    $produit->setIdProduit('49');
    $result = $db->updateProduit($produit);





?>