<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <title><?php echo $title?></title>

</head>

<body>
<nav class="navbar navbar-expand-lg" style="background-color: #20c997 !important;">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="<?php echo BASE_URL.SP."accueil"?>">J-store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white active" aria-current="page" href="<?php echo BASE_URL.SP."accueil"?>">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?php echo BASE_URL.SP."produit"?>">Produit</a>
        </li>
        <li class="nav-item dropdown">
          <a type="button" class="nav-link text-white disp dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Category</a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <?php
              foreach ($category as $key => $value) {
                echo '<a class="dropdown-item" href="'.BASE_URL.SP."category".SP.$value["id"].'">'.$value["name"].'</a>';
              }          
            ?>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?php echo BASE_URL.SP."contact"?>">contact</a>
        </li>
      </ul>
      <a class="btn btn-outline-light" style="margin-right: 1rem!important;" href="<?php echo BASE_URL.SP."panier"?>">panier</a>
      <?php if(!isset($_SESSION["customer"])): ?>
      <form class="d-flex" action="actionConnexion" method="post">
        <input  class="form-control me-2" type="email" placeholder="votre email" aria-label="Search" name="email">
        <input  class="form-control me-2" type="password"  placeholder="votre mot de passe" aria-label="password" name="password" >
        <button class="btn btn-outline-light me-2" type="submit">connecion</button>
      </form>
      <a href="<?php echo BASE_URL.SP."accueil"?>" class="btn btn-outline-light me-2" type="submit">inscription</a>
      <?php endif; ?>
      <?php if(isset($_SESSION["customer"])): ?>
        <a href="<?php echo BASE_URL.SP."profil"?>" class="btn btn-outline-light me-2" type="submit">Profil</a>
        <a href="<?php echo BASE_URL.SP."deconnexion"?>" class="btn btn-outline-light me-2" type="submit">Déconnexion</a>
      <?php endif; ?>
    </div>
  </div>
</nav>


    <div class="container">
        <?php
        echo $content;
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>