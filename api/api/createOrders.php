<?php
require 'commun_services.php';

if(!isset($_REQUEST['id_customers']) || !isset($_REQUEST['id_product']) || !isset($_REQUEST['quantity'])
 || !isset($_REQUEST['price'])){
     produceErrorRequest();
     return;
 }
 if(empty($_REQUEST['id_customers']) || empty($_REQUEST['id_product']) || empty($_REQUEST['quantity'])
 || empty($_REQUEST['price'])){
     produceErrorRequest();
     return;
 }

 try {
     $order = new ordersEntity();
     $order->setIdUser($_REQUEST['id_customers']);
     $order->setIdProduct($_REQUEST['id_product']);
     $order->setQuantity($_REQUEST['quantity']);
     $order->setprice($_REQUEST['price']);

     $result = $db->creatOrders($order);
     if($result){
        produceResult("commande crée Avec Succes");
     }else{
         produceError("Erreur lors de la creation de la commande, Merci de réessayer !");
     }
 } catch (Exception $th) {
     produceError($th->getMessage());
 }
?>