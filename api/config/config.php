
<?php
define("HOST", "localhost");
define("DB_USER", "root");
define("DB_NAME", "jstore_ecommerce");
define("DB_PASSWORD", "Ha11059586");


$METHODS = [
    "get" => ["description" => "Lire les données", "prefixe" => "get"],
    "post" => ["description" => "Créer une données", "prefixe" => "create"],
    "put" => ["description" => "Mettre a jour une données", "prefixe" => "update"],
    "delete" => ["description" => "Supprime une donnée", "prefixe" => "delete"],
];

$_ROUTES = ["product", "category", "orders", "users"];

?>