<?php

// enables sessions for the entire app
session_start();

require_once("controller/seminarskaController.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

/* Uncomment to see the contents of variables
  var_dump(BASE_URL);
  var_dump(IMAGES_URL);
  var_dump(CSS_URL);
  var_dump($path);
  exit(); */
 
// ROUTER: defines mapping between URLS and controllers
$urls = [  
    "seminarska_naloga" => function(){        
        echo ViewHelper::render("view/zlistani_gumbi.php", []);
    },
    "seminarska_naloga/registracija" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {        
            seminarskaController::registracija();
        }        
        seminarskaController::showRegistracijaForm();
    },
    "seminarska_naloga/prijava" => function (){    
        seminarskaController::prijava(); 
    },
    "" => function () {        
        ViewHelper::redirect(BASE_URL . "seminarska_naloga");
    },
    "seminarska_naloga/artikli" => function () {
        seminarskaController::getAllArticles();       
    },
    "seminarska_naloga/artikli-edit" => function () {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            seminarskaController::editArticle();
        } else {
            seminarskaController::article_edit();           
        }
    },
    "seminarska_naloga/artikli-add" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {        
            seminarskaController::dodaj_artikel();
        }        
        seminarskaController::insertFormArticles();
    },
    "seminarska_naloga/zbrisi_artikel" => function () {
        
        seminarskaController::deleteArticel();

    },
    "seminarska_naloga/ne-obdelana_narocila" => function () {
        
        echo ViewHelper::render("view/ne-obdelana_narocila.php", [
            "orders" => seminarskaController::getAll_orders()
        ]);
       
    },
    "seminarska_naloga/košarica" => function () {
        
        echo ViewHelper::render("view/košarica.php", [
            "articles" => seminarskaController::getAllArticles()
        ]);
       
    },
    "seminarska_naloga/uredi_profil" => function () {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            seminarskaController::editUser();
        } else {
            seminarskaController::showEditUserForm();
           
        }
    },
    "seminarska_naloga/zbrisi_profil" => function () {
        
        seminarskaController::deleteUser();

    },
    "seminarska_naloga/prodajalci" => function () {
        
        seminarskaController::getAllSellers();

    },
    "seminarska_naloga/stranke" => function () {

        seminarskaController::getAllCustomers();

    },
    "seminarska_naloga/trgovina" => function () {
        
        echo ViewHelper::render("view/trgovina.php", [
            "articles" => seminarskaController::getAllArticles()
        ]);
    }
    
            
            
];
#var_dump($path);
#exit();
try {
    if (isset($urls[$path])) {
        $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (InvalidArgumentException $e) {
    ViewHelper::error404();
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
} 
