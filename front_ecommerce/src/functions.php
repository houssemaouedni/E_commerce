<?php
session_start();

function displayAccueil()
{
  $result = '<h1>bienvenue sur la page d\'accueil</h1>';
  $result .= '<div class="bg-white shadow-sm rounded p-6">
    <form class="" action="actionInscription" method="post">
      <div class="mb-4">
        <h2 class="h4">INSCRIPTION</h2>
      </div>

      <!-- Input -->
      <div class=" mb-3">
        <div class="input-group input-group form">
          <input type="text" name="pseudo" class="form-control " value="" required="" placeholder="Entrer votre Pseudo" aria-label="Entrer votre Pseudo">
        </div>
      </div>
      <!-- End Input -->

      <!-- Input -->
      <div class=" mb-3">
        <div class="input-group input-group form">
          <input type="email" class="form-control " name="email" value="" required="" placeholder="Entrez votre adresse email" aria-label="Entrez votre adresse email">
        </div>
      </div>
      <!-- End Input -->

      <!-- Input -->
      <div class=" mb-3">
        <div class="input-group input-group form">
          <input type="password" class="form-control " name="password" value="" required="" placeholder="Entrez votre mot de passe" aria-label="Entrez votre mot de passe">
        </div>
      </div>
      <!-- End Input -->

      <button type="submit" class="btn d-block btn-primary">S\'inscrire</button>
    </form>
  </div>';
  return $result;
};
function displayActionInscription()
{
  global $model;
  //print_r($_REQUEST); exit();
  $pseudo = $_REQUEST["pseudo"];
  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];

  $data = $model->createCustomers($pseudo, $email, $password);
  if ($data) { //inscription réussie
    $data_customer = $model->authentifier($email, $password);
    if ($data_customer) {
      $_SESSION["customer"] = $data_customer;
      return '<p class="btn btn-success d-block">Inscription réussie ' . $pseudo . ', Vous êtes bien connecté</p>' . displayProduit();
    }
  } else { // inscription échouée
    return '<p class=" btn btn-danger d-block">inscription échouée</p>' . displayProduit();
  }
}
function displayActionConnexion()
{
  global $model;
  //print_r($_REQUEST); exit();
  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];
  $data_customer = $model->authentifier($email, $password);
  if ($data_customer) {
    $_SESSION["customer"] = $data_customer;
    return '<p class="btn btn-success d-block">authentification réussie , Vous êtes bien connecté</p>' . displayProduit();
  } else {
    return '<p class="btn btn-danger d-block">authentification échouée</p>' . displayProduit();
  }
}
function displayDeconnexion()
{
  unset($_SESSION["customer"]);
  return '<p class="btn btn-success d-block">Deconnexion réussie</p>' . displayproduit();
}

function displayContact()
{
  $result = '<h1></h1>';
  $result .= '
    <h1 class="text-center"> Contactez-Nous !</h1>
    <form action="messageContact" method="post">
    <div class="form-row ">
      <div class="form-group col-md-6">
        <label for="inputEmail1" name="nom" >Nom : </label>
        <input type="text" name="nom" class="form-control" id="inputEmail1">
        </div>
      <div class="form-group col-md-6 ">
        <label for="inputPassword2" name="prenom" >Prenom : </label>
        <input type="text" name="prenom"  class="form-control" id="inputPassword2" required>
      </div>
    </div>
    <div class="form-group">
      <label for="inputAddress" name="email" >Email : </label>
      <input type="text" name="email" class="form-control" id="inputAddress" placeholder="" required>
    </div>
    <div class="form-group">
      <label for="inputAddress2" name="message" >Message : </label>
      <textarea class="form-control" row="5" col="80" name="message" required></textarea>
    </div>

    <div class="form-group">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="">
        <label class="form-check-label" for="">
          Se rappeler de moi
        </label>
      </div>
    </div>
    <button type="submit" class="btn btn-success">Envoyer</button>
  </form>
    ';
  return $result;
};
function displayMessageContact()
{
  $nom = $_REQUEST["nom"];
  $prenom = $_REQUEST["prenom"];
  $email = $_REQUEST["email"];
  $message = $_REQUEST["message"];
  $arry = $_REQUEST;

  $destinataire = $email;
  $object = "un message de votre site";
  $message = $message;
  $entete = "from : \"$nom,$prenom\" <houssemaouedni@e-commerce.com> \r\n";
  $entete .= "replay-to :\"$nom,$prenom\" <paulinedubois@pauline.com> \r\n";
  $entete .= "X-Priority : 1\r\n";
  $envoi = mail($destinataire, $object, $message, $entete);
  if ($envoi) {
    return displayContact();
  }
}

function displayproduit()
{
  global $model;
  $dataProduct = $model->getProduct();

  $result = '<h1>bienvenue sur la page produit</h1>';

  foreach ($dataProduct as $key => $value) {
    $price = $value["price"] * 1.19;
    $result .= '<div class="card m-2 mt-2" style="width: 16rem; display:inline-block;">
        <img src="' . BASE_URL . SP . "images" . SP . "produit" . SP . $value["image"] . '" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">' . $value["name"] . '</h5>
          <div class="card-title">Prix : ' . number_format($price, 3) . ' (TTC)</div>
          <a href="' . BASE_URL . SP . "details" . SP . $value["id"] . '" class="btn btn-primary btn-sm ">Détails</a>
          <a href="' . BASE_URL . SP . "panier" . SP . $value["id"] . '" class="btn btn-success  btn-sm">A jouter au panier</a>  
        </div>
      </div>';
  }
  return $result;
};
function displayCategory()
{
  global $model;
  global $url;
  global $category;
  if (isset($url[1]) && is_numeric($url[1]) && $url[1] > 0 && $url[1] <= sizeof($category)) {

    $result = '<h1>Produit de la catégorie ' . $category[$url[1] - 1]['name'] . '</h1>';
    $dataProduct = $model->getProduct(NULL, $url[1]);
    //print_r($dataProduct[0]);exit();
    foreach ($dataProduct as $key => $value) {
      $result .= '<div class="card m-2 mt-2" style="width: 16rem; display:inline-block;">
            <img src="' . BASE_URL . SP . "images" . SP . "produit" . SP . $value["image"] . '" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">' . $value["name"] . '</h5>
            <a href="' . BASE_URL . SP . "details" . SP . $value["id"] . '" class="btn btn-primary">Détails</a>
            <a href="' . BASE_URL . SP . "panier" . SP . $value["id"] . '" class="btn btn-success">Acheter</a>
            </div>
            </div>';
    };
  } else {
    $result = '<h1> URL incorect </h1>';
  }
  return $result;
};
function displayDetails()
{
  global $model;
  global $url;
  global $category;
  // print_r($category);exit();
  $result = "<h1>details produit</h1>";
  $dataProduct = $model->getProduct(NULL, NULL, $url[1]);
  //print_r($dataProduct);exit();
  $result .=
    '
    <div class="row details ">
     <div class="col-md-5 col-12"> 
            <img src="' . BASE_URL . SP . "images" . SP . "produit" . SP . $dataProduct[0]["image"] . '" class="card-img-top" alt="...">
    </div> 
     <div class="col-md-7 col-12"> 
     <h2>' . $dataProduct[0]["name"] . ' </h2>
     <p>' . $dataProduct[0]["description"] . '</p>
     <p> categorie :' . $category[$dataProduct[0]["category"] - 1]['name'] . '</p>
     <div class="d-grid gap-2 d-md-flex justify-content-md-between">
     <a href="' . BASE_URL . SP . "produit" . '" class="btn btn-success">Retour page produit</a>
     <a href="' . BASE_URL . SP . "panier" . SP . $dataProduct[0]["id"] . '" class="btn btn-success">A jouter au panier</a>
     </div>
     </div> 
    </div>
    ';

  return $result;
}
function displayPanier()
{
  // $message = $_REQUEST["message"];
  global $model;
  global $url;
  if (isset($url[1])) {

    $idProduit = $url[1];
    $dataProduct = $model->getProduct(NULL, NULL, $idProduit);
    $_SESSION["panier"][] = $dataProduct[0];



    $idProduct = $dataProduct[0]["id"];
    $idCustomers = $_SESSION["customer"]["id"];
    $quantity = '1';
    $price = $dataProduct[0]["price"];
    $data = $model->createOrders($idCustomers, $idProduct, $quantity, $price);
  }



  // print_r($_SESSION["panier"]);exit();
  $result = '<table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">NOM</th>
          <th scope="col">Description</th>
          <th scope="col">Image</th>
          <th scope="col">Prix</th>
          <th scope="col">Quantité</th>
          <th scope="col">   Action</th>
        </tr>
      </thead>
      <tbody>';
  if (!isset($_SESSION["panier"]) || sizeof($_SESSION["panier"]) == 0) {
    return '<h1> Votre panier et vide ! </h1>' . displayproduit();
  } else {
    $total_price = 0;

    foreach ($_SESSION["panier"] as $key => $value) {
      $result .= '<tr>
              <th scope="row">' . $value['id'] . '</th>
              <td>' . $value['name'] . '</td>
              <td>' . $value['description'] . '</td>
              <td><img src="' . BASE_URL . SP . "images" . SP . "produit" . SP . $value['image'] . '" class="card-img-top" alt="..."></td>
              <td>' . $value['price'] . '</td>
              <td>1</td>
              <td><a href="' . BASE_URL . SP . "Supprimer" . SP . $key . '" class="btn btn-danger">Supprimer</a></td>
              </tr>';
              $total_price += $value["price"];
              $total_tva = $total_price * TVA / 100;
              $total_ttc = $total_tva + $total_price;
    }
    $result .= '<tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Prix Total (HT) <br>' . number_format($total_price, 3) . ' TND</td>
        </tr>';
    $result .= '<tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>TVA' . TVA . '%</td>
        </tr>';
    $result .= '<tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>TOTAL (TTC) <br>' . number_format($total_ttc, 3) . ' TND</td>
        </tr>';
    $result .= '</tbody>
                        </table>';



    $result .= '<a href="' . BASE_URL . SP . "validationCommande" .'" class="btn btn-success">Valider votre commande</a>';
    return $result;
  }
}
// function suprimeOreders()
// {
//   global $model;
//   global $url;
//   if (isset($url[1]) && is_numeric($url[1])) {
//     $param = $url[1];
//     $model->suprimeOreders($param);
//   }
// }
//$_SESSION["panier"][$url[1]]["id"]
function displaySupprimer()
{
  global $model;
  global $url;
  if ($_SESSION["customer"]["id"]) {
    // $model->suprimeOreders($_SESSION["panier"][$url[1]]["id"]);
  }
  if (isset($url[1]) && is_numeric($url[1])) {
    $param = $url[1];
    unset($_SESSION["panier"][$param]);
    header("location:" . BASE_URL . SP . "panier");
  }
}

function displayProfil()
{

  if (isset($_SESSION['customer']['sexe'])) {
    if ($_SESSION['customer']['sexe'] === 1) {
      $_SESSION['customer']['sexe'] = "homme";
    } else {
      $_SESSION['customer']['sexe'] = "femme";
    }
  }
  $result = '<ul class="list-group">
  <li class="list-group-item mt-2" aria-current="true">Bienvenu sur votre profil ' . $_SESSION['customer']['pseudo'] . '</li>
  <li class="list-group-item"> Sexe : ' . $_SESSION['customer']['sexe'] . '</li>
  <li class="list-group-item">pseudo : ' . $_SESSION['customer']['pseudo'] . '</li>
  <li class="list-group-item">Nom : ' . $_SESSION['customer']['firstname'] . '</li>
  <li class="list-group-item">Prenom : ' . $_SESSION['customer']['lastname'] . '</li>
  <li class="list-group-item">email : ' . $_SESSION['customer']['email'] . '</li>
  <li class="list-group-item">Adresse livraison : ' . $_SESSION['customer']['Adresse_Livraison'] . '</li>
  <li class="list-group-item">Adresse facturation : ' . $_SESSION['customer']['Adresse_facturation'] . '</li>
  </ul>
  
  <div> <a href="' . BASE_URL . SP . "updateProfil" . '" class="btn btn-danger">Mettre a jour mes donnée</a> </div>
  ';


  return $result;
}

function displayUpdateProfil()
{
  $result = '<form action="actionUpdate" method="post">
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Nom</label>
      <input type="text" name="firstname" value="' . $_SESSION['customer']['lastname'] . '" class="form-control" id="inputEmail4">
    </div>
    <div class="form-group col-md-3">
      <label for="inputPassword4">Prenom</label>
      <input type="text" name="lastname" value="' . $_SESSION['customer']['firstname'] . '" class="form-control" id="inputPassword4">
    </div>
    <div class="form-group col-md-3">
      <label for="inputPassword4">email</label>
      <input type="text" name="email" value="' . $_SESSION['customer']['email'] . '" class="form-control" id="inputPassword4">
    </div>
    <div class="form-group col-md-3">
      <label for="inputPassword4">Telephone</label>
      <input type="text" name="tel" class="form-control" value="' . $_SESSION['customer']['tel'] . '" id="inputPassword4">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">description</label>
    <input type="text" name="description" value="' . $_SESSION['customer']['description'] . '" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
    <label for="inputAddress2">Address de facturation</label>
    <input type="text" name="Adresse_facturation" class="form-control" value="' . $_SESSION['customer']['Adresse_facturation'] . '" id="inputAddress2" placeholder="Apartment, studio, or floor"> </div>
    <div class="form-group col-md-6">
    <label for="inputAddress2">Address de Livrasion</label>
    <input type="text" name="Adresse_Livraison" class="form-control" value="' . $_SESSION['customer']['Adresse_Livraison'] . '" id="inputAddress2" placeholder="Apartment, studio, or floor"> </div>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select name="sexe" id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option value="1" >HOMME</option>
        <option value="2" >FEMME</option>
      </select>
    </div>
  
    
    <button type="submit" class="btn btn-primary">Mettre a jour</button>
    </form>';


  return $result;
}

function displayActionUpdate()
{
  global $model;
  $_REQUEST['id'] = $_SESSION['customer']['id'];
  $result = $model->updateInfosCustomer($_REQUEST);
  
  if ($result) {
    $r = $model->getCustomer($_SESSION['customer']['id']);
    
    // print_r($r);exit();
    $_SESSION['customer'] = $r;
    echo "Mise a jour réussie";
  } else {
    echo "Mise a jour echouér";
  }
  return displayProfil();
}
function displayValidationCommande(){
  if(isset($_SESSION['customer'])){
    echo '<h1>commande valider</h1>';
    return displayproduit();
  }else{
    echo '<h1>Connecter vous</h1>';
    return displayPanier();
  }
  
}
