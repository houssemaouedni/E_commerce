<?php
require 'commun_services.php';

if(isset($_REQUEST["name"]) && !empty($_REQUEST["name"])){

    $urlImage = '../image/product/'.$_REQUEST["name"];

    if(file_exists($urlImage)){
        unlink($urlImage);
        produceResult("supression de l'image resusie !");
    }else{
        produceError("Image n'existe pas sur le serveur");
    }

}else{
    produceErrorRequest();
}
?>