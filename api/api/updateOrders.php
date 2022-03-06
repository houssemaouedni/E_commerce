<?php
require 'commun_services.php';

if(!isset($_REQUEST['id_customers']) || !isset($_REQUEST['id_product']) || !isset($_REQUEST['quantity'])
 || !isset($_REQUEST['price']) || !isset($_REQUEST['idOrders'])){
     produceErrorRequest();
     return;
 }
 if(empty($_REQUEST['id_customers']) || empty($_REQUEST['id_product']) || empty($_REQUEST['quantity'])
 || empty($_REQUEST['price']) || empty($_REQUEST['idOrders'])){
     produceErrorRequest();
     return;
 }

 try {
     $order = new ordersEntity();
     $order->setIdUser($_REQUEST['id_customers']);
     $order->setIdProduct($_REQUEST['id_product']);
     $order->setQuantity($_REQUEST['quantity']);
     $order->setprice($_REQUEST['price']);
     $order->setIdOrder($_REQUEST['idOrders']);
     $result = $db->updateOrders($order);
     if($result){
        // print_r($result);exit();
        produceResult("Update Orders  Avec Succes");
     }else{
         produceError("Erreur lors de l'update de l'Order' Merci de réessayer !");
     }
 } catch (Exception $th) {
     produceError($th->getMessage());
 }
?>