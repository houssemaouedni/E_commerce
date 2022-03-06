<?php
require 'commun_services.php';

if(!isset($_REQUEST['idOrders']) || empty($_REQUEST['idOrders'])){
    produceErrorRequest();
    return;
}

try {
    $order = new ordersEntity();
    $order->setIdOrder($_REQUEST['idOrders']);
    $result = $db->deleteOrders($order);
    if($result){
        produceResult("Delete Order avec success");
    }else{
        produceError("Echec de l'effacement ");
    }
} catch (Exception $th) {
    
    produceError($th->getMessage());
}

?>