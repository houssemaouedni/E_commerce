<?php

// print_r($_SERVER['SCRIPT_NAME']);exit();
define('SRC', dirname(__FILE__));
define('ROOT', dirname(SRC));
define('SP', DIRECTORY_SEPARATOR);
define('CONFIG', ROOT . SP . "config");
define('VIEWS', ROOT . SP . "views");
define('MODEL', ROOT . SP . "model");
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('TVA', 19);
//import du model
 //print_r(ROOT);exit();
require CONFIG.SP."config.php";
require MODEL.SP."DataLayer.class.php";
$model = new DataLayer();
$category = $model->getCategory();
// $idCustomers = $model->getCustomers(218);
// print_r($idCustomers[0]);exit();


// $oreder = $model->suprimeOreders('10');
// $data = $model->getProduct(5,2);
// print_r($data);exit();
// $var = $data->createCustomers('khouloud','jdidikhouloud@gmail.com','20835267');
// $auten = $data->authentifier('jdidikhouloud@gmail.com','20835267');
// print_r($auten);
// $data->updateInfoCustomer(array('id'=>'3','sexe'=>'1','pseudo'=>'azouz','lastname'=>'aouedni','firstname'=>'houssem','email'=>'abdelaziz@gmail.com'));
// $category =$data->getProduct(10);
// var_dump($category);
//les functions appelée par le controleur
require "functions.php";
