<?php

class DataLayer
{
    private $connexion;

    function __construct()
    {
        try {
            //code...
            $this->connexion = new PDO("mysql:host=" . HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
            // echo "connection réussie <br><br>";
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }


    /***authentification de user connect
     * méthode permettant d'authentifier un utilisateur
     * @parm userEntity $user Objet métier décrivant un utilisateur 
     * @return usersEntity $user objet métier décrivant l'utilidateur authentifier 
     * @return FALSE en cas d'echec d'authentification
     */
    function authentifier(usersEntity $user){
        $sql ="SELECT * FROM `jstore_ecommerce`.`customers` WHERE `email` = :email";

        try {
            $result= $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':email' => $user->getEmail()
            ));

            $data = $result->fetch(PDO::FETCH_OBJ);
            if($data && ($data->password == sha1($user->getPassword()))){
                //autentidication reussie 
                $user->setIdUser($data->id);
                $user->setPseudo($data->pseudo);
                $user->setSexe($data->sexe);
                $user->setFirstname($data->firstname);
                $user->setLastname($data->lastname);
                $user->setPassword(NULL);
                $user->setAdressefacturation($data->adresse_facturation);
                $user->setAdresselivraison($data->adresse_livraison);
                $user->setTEL($data->tel);
                $user->setDateBirth($data->dateBirth);
                return $user;
            }else{
                //authentification echouéé
                return FALSE;
            }
        } catch (PDOException $th) {
            //  print_r($th);exit();
            return null;
        }

    }

    /**CRUD */
    /**
     * creatOrders
     *
    
     */
    function creatUsers(usersEntity $user)
    {
        $sql = "INSERT INTO `jstore_ecommerce`.`customers` (sexe, pseudo, firstname, lastname, description, dateBirth, adresse_facturation, adresse_livraison, tel, email, password) VALUES
         (:sexe, :pseudo, :firstname, :lastname, :description, :dateBirth, :adresse_facturation, :adresse_Livraison, :tel, :email, :password)";
        try {
            $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                ':sexe' => $user->getSexe(),
                ':pseudo' => $user->getPseudo(),
                ':firstname' => $user->getFirstname(),
                ':lastname' => $user->getLastname(),
                ':description' => $user->getDescription(),
                ':dateBirth' => $user->getDateBirth(),
                ':adresse_facturation' => $user->getAdressefacturation(),
                ':adresse_Livraison' => $user->getAdresseLivraison(),
                ':tel' => $user->getTel(),
                ':email' => $user->getEmail(),
                ':password' => sha1($user->getPassword()),
            ));
            if ($data) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $th) {
            // print_r($sql);exit();
            // print_r($data);exit();
            return null;
        }
    }
    function creatCategory(CategoryEntity $category)
    {
        $sql = "INSERT INTO `jstore_ecommerce`.`category`(name) VALUES (:name)";
        try {
            $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                ':name' => $category->getName(),
            ));
            if ($data) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $th) {
            throw $th;
        }
    }
    function creatProduit(produitEntity $produit)
    {
        $sql = "INSERT INTO `jstore_ecommerce`.`product`(name, description, price, stock, category, image) VALUES (:name, :description, :price, :stock, :category, :image)";
        try {
            $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                ':name' => $produit->getName(),
                ':description' => $produit->getDescription(),
                ':price' => $produit->getPrice(),
                ':stock' => $produit->getStock(),
                ':category' => $produit->getCategory(),
                ':image' => $produit->getImage(),
            ));
            if ($data) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $th) {
            throw $th;
        }
    }
    function creatOrders(ordersEntity $orders)
    {
        $sql = "INSERT INTO `jstore_ecommerce`.`orders`(id_customers, id_product, quantity, price) VALUES (:id_customers, :id_product, :quantity, :price)";
        try {
            $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                ':id_customers' => $orders->getIdUser(),
                ':id_product' => $orders->getIdProduct(),
                ':quantity' => $orders->getQuantity(),
                ':price' => $orders->getPrice(),
            ));
            if ($data) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $th) {
            throw $th;
        }
    }

    /**READ */
    function getUsers()
    {
        $sql = 'SELECT * FROM `jstore_ecommerce`.`customers`';

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $users = [];
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $user = new usersEntity();
                $user->setIdUser($data->id);
                $user->setEmail($data->email);
                $user->setFirstname($data->firstname);
                $user->setLastname($data->lastname);
                $user->setSexe($data->sexe);
                $users[] = $user;
            }
            if ($users) {
                return $users;
            } else {
                return FALSE;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getCategory()
    {
        $sql = 'SELECT * FROM `jstore_ecommerce`.`category`';

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $categorys = [];
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $category = new CategoryEntity();
                $category->setIdCategory($data->id);
                $category->setName($data->name);
                $categorys[] = $category;
            }
            if ($categorys) {
                return $categorys;
            } else {
                return FALSE;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getProduit()
    {
        $sql = 'SELECT * FROM `jstore_ecommerce`.`product`';

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $produits = [];
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $produit = new produitEntity();
                $produit->setIdProduit($data->id);
                $produit->setName($data->name);
                $produit->setDescription($data->description);
                $produit->setPrice($data->price);
                $produit->setStock($data->stock);
                $produit->setCategory($data->category);
                $produit->setImage($data->image);
                $produit->setCreatedAt($data->createdAt);
                $produits[] = $produit;
            }
            
            if ($produits) {
                return $produits;
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getOrders()
    {
        $sql = 'SELECT * FROM `jstore_ecommerce`.`orders`';

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $orders = [];
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $order = new ordersEntity();
                $order->setIdOrder($data->id);
                $order->setidUser($data->id_customers);
                $order->setIdProduct($data->id_product);
                $order->setQuantity($data->quantity);
                $order->setPrice($data->price);
                $order->setCreated_at($data->created_at);
                $orders[] = $order;
            }
            if ($orders) {
                return $orders;
            } else {
                return FALSE;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**UPDATE */
    function updateProduit(produitEntity $user)
    {

        $sql = "UPDATE `jstore_ecommerce`.`product` SET ";

        try {
            $sql .= " name = '" . $user->getName() . "',";
            $sql .= " description = '" . $user->getDescription() . "',";
            $sql .= " price = '" . $user->getPrice() . "',";
            $sql .= " stock = '" . $user->getStock() . "',";
            $sql .= " category = '" . $user->getCategory() . "',";
            $sql .= " image = '" . $user->getImage() . "'";
            $sql .= " WHERE id = '" . $user->getIdProduit()."'";
            // print_r($sql);exit();
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();

            if ($var) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $th) {
            throw $th;
        }
    }
    function updateCategory(CategoryEntity $user)
    {
        $sql = "UPDATE `jstore_ecommerce`.`category` SET ";
        try {
            $sql .= " name = '" . $user->getName() . "'";
            $sql .= " WHERE id = " . $user->getIdCategory();
            //print_r($sql);exit();
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();

            if ($var) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $th) {
            throw $th;
        }
    }
    function updateOrders(ordersEntity $user)
    {
        $sql = "UPDATE `jstore_ecommerce`.`orders` SET ";
        try {
            $sql .= " id_customers = '" . $user->getIdUser() . "',";
            $sql .= " id_product = '" . $user->getIdProduct() . "',";
            $sql .= " quantity = '" . $user->getQuantity() . "',";
            $sql .= " price = '" . $user->getPrice() . "'";
            $sql .= " WHERE id = " . $user->getIdOrder();
            // print_r($sql);exit();
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();

            if ($var) {
                // print_r($var);exit();
                return TRUE;
            } else {
                return FALSE;
            };
        } catch (PDOException $th) {
            throw $th;
        }
    }
    function updateUsers(usersEntity $user){
        $sql = "UPDATE `jstore_ecommerce`.`customers` SET ";
        try {
            $sql .= " pseudo = '" . $user->getPseudo() . "',";
            $sql .= " email = '" . $user->getEmail() . "',";
            $sql .= " sexe = '" . $user->getSexe() . "',";
            $sql .= " firstname = '" . $user->getFirstname() . "',";
            $sql .= " lastname = '" . $user->getLastname() . "',";
            $sql .= " description = '" . $user->getDescription() . "',";
            $sql .= " Adresse_Livraison = '" . $user->getAdresseLivraison() . "',";
            $sql .= " Adresse_facturation = '" . $user->getAdressefacturation() . "',";
            $sql .= " password = '".sha1($user->getPassword())."',";
            $sql .= " tel = '" . $user->getTel() . "',";
            $sql .= " dateBirth = '".$user->getDateBirth()."'";
            /*$sql .= " createdAt = '".$user->getCreatedAt()."'";*/
            $sql .= " WHERE id = " . $user->getIdUser();
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            throw $th;
        }
    }

    /**DELETE */    

    function deleteUsers(usersEntity $user)
    {
        $sql ="DELETE FROM `jstore_ecommerce`. `customers` ";
        try {
            $sql .= " WHERE id = " . $user->getIdUser();
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }

        } catch (PDOException $th) {
            throw $th;
        }
    }    

    function deleteProduit(produitEntity $user)
    {
        $sql ="DELETE FROM `jstore_ecommerce`.`product` ";
        try {
            $sql .= " WHERE id = " . $user->getIdProduit();
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }

        } catch (PDOException $th) {
            throw $th;
        }
    }    

    function deleteCategory(CategoryEntity $user)
    {
        $sql ="DELETE FROM `jstore_ecommerce`.`category` ";
        try {
            $sql .= " WHERE id = " . $user->getIdCategory();
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }

        } catch (PDOException $th) {
            throw $th;
        }
    }    
    function deleteOrders(ordersEntity $user)
    {
        $sql ="DELETE FROM `jstore_ecommerce`.`orders` ";
        try {
            $sql .= " WHERE id = " . $user->getIdOrder();
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }

        } catch (PDOException $th) {
            throw $th;
        }
    }
}
?>


