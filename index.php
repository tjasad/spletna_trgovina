<?php

// enables sessions for the entire app
session_start();

require_once("controller/seminarskaController.php");
require_once("controller/ArticlesRESTController.php");
require_once("model/ArticelDB.php");
require_once("model/OceneDB.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";



// ROUTER: defines mapping between URLS and controllers
$urls = [
    "seminarska_naloga" => function () {
        ViewHelper::redirect(BASE_URL . "seminarska_naloga/trgovina");
    },
    "seminarska_naloga/registracija" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            seminarskaController::registracija();
        }
        seminarskaController::showRegistracijaForm();
    },
    "seminarska_naloga/prijava" => function () {
        $method = filter_input(INPUT_SERVER, "REQUEST_METHOD", FILTER_SANITIZE_SPECIAL_CHARS);
        if ($method == "POST") {

            switch ($_POST["do"]) {
                case "log_in_user":
                    try {
                        //to spremen na getUserByEmail
                        $user = UserDB::getUserByEmail($_POST["email"]);
                        # certifikat

                        $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
                        $cert_data = openssl_x509_parse($client_cert);
                        #ime uporabnika by cert
                        $cert_name = $cert_data['subject']['CN'];
                        $cert_mail = $cert_data['subject']['emailAddress'];
                        #var_dump($cert_name); var_dump($user['name']); var_dump($cert_mail); var_dump($user['email']);
                        if(($cert_name == $user['name']) && ($cert_mail == $user['email'])) {
                           
                            if(password_verify( $_POST["password"],  $user["password"])){                                
                                $_SESSION["user"] = $user['costumer_id'];
                                $_SESSION["role"] = $user['role'];
                                ViewHelper::redirect(BASE_URL . "seminarska_naloga/trgovina");
                            }else{
                                ViewHelper::redirect(BASE_URL . "seminarska_naloga/prijava");
                            }
                        }
                        else{
                            print("Napačni prijavni podatki!");
                            ViewHelper::redirect(BASE_URL . "seminarska_naloga/prijava");
                        }


                    } catch (Exception $exc) {
                        ViewHelper::redirect(BASE_URL . "seminarska_naloga/prijava");
                    }
                    break;
                default:
                    // default naj bo prazen
                    break;
            }

        } else {
            seminarskaController::prijava();
        }
    },
    "seminarska_naloga/prijava-stranka" => function() {
        $method = filter_input(INPUT_SERVER, "REQUEST_METHOD", FILTER_SANITIZE_SPECIAL_CHARS);
        if ($method == "POST") {

            switch ($_POST["do"]) {
                case "log_in_user":
                    try {

                        $user = UserDB::getUserByEmail($_POST["email"]);
                        if($_POST["email"] == 'prodajalec@gmail.com'){                            
                            ViewHelper::redirect(BASE_URL . "seminarska_naloga/prijava-stranka");
                        }
                        else if ($_POST["email"] == 'admin@gmail.com'){                            
                            ViewHelper::redirect(BASE_URL . "seminarska_naloga/prijava-stranka");
                        }
                        else if(password_verify( $_POST["password"],  $user["password"])){

                            $_SESSION["user"] = $user['costumer_id'];
                            $_SESSION["role"] = $user['role'];
                            ViewHelper::redirect(BASE_URL . "seminarska_naloga/trgovina");
                        }else{
                            var_dump($user['role']); print("tu"); exit();
                            ViewHelper::redirect(BASE_URL . "seminarska_naloga/prijava-stranka");
                        }


                    } catch (Exception $exc) {
                        ViewHelper::redirect(BASE_URL . "seminarska_naloga/prijava-stranka");
                    }
                    break;
                default:
                    // default naj bo prazen
                    break;
            }

        } else {
            seminarskaController::prijava_stranka();
        }
    },
    "seminarska_naloga/odjava" => function () {
        try {
            session_destroy();
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        } catch (Exception $exc) {
            die($exc->getMessage());
        }
    },
    "" => function () {
        ViewHelper::redirect(BASE_URL . "seminarska_naloga");
    },
    "seminarska_naloga/artikli" => function () {
        if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'prodajalec' || $_SESSION["role"] == 'administrator')) {
            seminarskaController::getAllArticles();
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }
    },
    "seminarska_naloga/artikli-edit" => function () {
        if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'prodajalec' || $_SESSION["role"] == 'administrator')) {

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                seminarskaController::editArticle();
            } else {
                seminarskaController::article_edit();
            }
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }
    },
    "seminarska_naloga/artikli-add" => function () {
        if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'prodajalec' || $_SESSION["role"] == 'administrator')) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                seminarskaController::dodaj_artikel();
            }
            seminarskaController::insertFormArticles();
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }
    },
    #"seminarska_naloga/zbrisi_artikel" => function () {
    #
    #    seminarskaController::deleteArticel();
    #  },
    "seminarska_naloga/ne-obdelana_narocila" => function () {
        if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'prodajalec' || $_SESSION["role"] == 'administrator')) {
            seminarskaController::getNeobdelanaNarocila();
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }
    },
    "seminarska_naloga/ne_obdelana_narocila-edit" => function () {
        if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'prodajalec' || $_SESSION["role"] == 'administrator')) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {            
                seminarskaController::editNarocila();
            } else {
                seminarskaController::order_edit();
            }
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }
    },
    "seminarska_naloga/potrjena_narocila" => function () {
        if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'prodajalec' || $_SESSION["role"] == 'administrator')) {
            seminarskaController::getPotrjenaNarocila();
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }
    },
    "seminarska_naloga/vsa_narocila" => function () {   #  za stranko
        if (isset($_SESSION["user"])) {
            $test = (int)$_SESSION["user"];
            seminarskaController::getVsaNarocila($test);
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }
    },
    "seminarska_naloga/podrobnosti_vsa_narocila" => function () {  #  za stranko
        if (isset($_SESSION["user"])) {
            seminarskaController::prikaz_detajlov();
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }
    },
    #"seminarska_naloga/izbrisi_narocilo" => function () {
    #    seminarskaController::deleteOrder();
    #},
    "seminarska_naloga/uredi_kolicino" => function () {
        if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'prodajalec' || $_SESSION["role"] == 'administrator')) {
            seminarskaController::prikazKolicine();
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }
    },
    "seminarska_naloga/prikazi_kolicino_uporabnik" => function () {
        if (isset($_SESSION["user"])) {
            seminarskaController::prikazKolicine2();
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }
    },
    "seminarska_naloga/trgovina" => function () {
        $url = filter_input(INPUT_SERVER, "PHP_SELF", FILTER_SANITIZE_SPECIAL_CHARS);
        $method = filter_input(INPUT_SERVER, "REQUEST_METHOD", FILTER_SANITIZE_SPECIAL_CHARS);        
        if ($method == "POST") {
            $validationRules = [
                'do' => [
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => [
                        // dopustne vrednosti spremenljivke do, popravi po potrebi
                        "regexp" => "/^(add_into_cart|purge_cart|update_cart)$/"
                    ]
                ],
                'id' => [
                    'filter' => FILTER_VALIDATE_INT,
                    'options' => ['min_range' => 0]
                ],
                'kolicina' => [
                    'filter' => FILTER_VALIDATE_INT,
                    'options' => ['min_range' => 0]
                ]

            ];
            $post = filter_input_array(INPUT_POST, $validationRules);

            switch ($post["do"]) {
                case "add_into_cart":
                    try {
                        $knjiga = ArticelDB::get($post["id"]);
                        #var_dump($knjiga['article_id']);

                        if (isset($_SESSION["cart"][$knjiga['article_id']])) {
                            $_SESSION["cart"][$knjiga['article_id']]++;
                        } else {
                            $_SESSION["cart"][$knjiga['article_id']] = 1;
                            #var_dump($_SESSION["cart"][$knjiga['article_id']]);
                        }
                    } catch (Exception $exc) {
                        die($exc->getMessage());
                    }
                    break;
                case "purge_cart":
                    try {
                        unset($_SESSION["cart"]);
                    } catch (Exception $exc) {
                        die($exc->getMessage());
                    }

                    break;
                case "update_cart":
                    try {
                        $nova_kolicina = $post["kolicina"];
                        #print($nova_kolicina);
                        $knjiga = ArticelDB::get($post["id"]);

                        if (isset($_SESSION["cart"][$knjiga['article_id']])) {
                            $_SESSION["cart"][$knjiga['article_id']] = $nova_kolicina;
                        } else {
                            $_SESSION["cart"][$knjiga['article_id']] = $nova_kolicina;
                        }
                        # session.start();
                    } catch (Exception $exc) {
                        die($exc->getMessage());
                    }
                    break;
                default:
                    // default naj bo prazen
                    break;
            }
        }     
        if(isset($_POST['iskanje_ime'])){
            $ime = htmlspecialchars($_POST[ 'iskanje_ime']);
            $test = ArticelDB::binarno_iskanje($ime);           
            if(empty($test)){
                # take poivedbe ni
                echo ViewHelper::render("view/košarica.php", [
                    "articles" => ArticelDB::getArticlesByStatus(1)
                ]);
            }else{
                echo ViewHelper::render("view/košarica.php", [
                    "articles" => ArticelDB::binarno_iskanje($ime)
                ]);
            }
        }else{
            echo ViewHelper::render("view/košarica.php", [
                "articles" => ArticelDB::getArticlesByStatus(1)
            ]);
        }


    },
    
    "seminarska_naloga/zakljucek" => function () {
        if (isset($_SESSION["user"])) {
            # var_dump($id_kolicina); exit(54);
            #print("Zaključi nakup\n");
            $url = filter_input(INPUT_SERVER, "PHP_SELF", FILTER_SANITIZE_SPECIAL_CHARS);
            $method = filter_input(INPUT_SERVER, "REQUEST_METHOD", FILTER_SANITIZE_SPECIAL_CHARS);
            if ($method == "POST") {
                $validationRules = [
                    'do' => [
                        'filter' => FILTER_VALIDATE_REGEXP,
                        'options' => [
                            // dopustne vrednosti spremenljivke do, popravi po potrebi
                            "regexp" => "/^(add_into_cart|purge_cart|update_cart|save_order)$/"
                        ]
                    ],
                    'id' => [
                        'filter' => FILTER_VALIDATE_INT,
                        'options' => ['min_range' => 0]
                    ],
                    'kolicina' => [
                        'filter' => FILTER_VALIDATE_INT,
                        'options' => ['min_range' => 0]
                    ]

                ];
                $post = filter_input_array(INPUT_POST, $validationRules);

                switch ($post["do"]) {

                    case "save_order":
                        #var_dump($GLOBALS['id_narocila']);
                        #$GLOBALS['id_narocila']+=1;
                        #var_dump($GLOBALS['id_narocila']); exit(42);
                        $cena = 0;
                        foreach (ArticelDB::getAll() as $knjiga) {
                            if (isset($_SESSION["cart"][$knjiga['article_id']])) {
                                #var_dump($_SESSION["cart"][$knjiga['article_id']]);
                                #var_dump((int)$knjiga['article_id']);
                                $tmp_kolicina = $_SESSION["cart"][$knjiga['article_id']];
                                $tmp_artikel_id = (int)$knjiga['article_id'];
                                $tmp_cena = ((float)$knjiga['article_price']) * $tmp_kolicina;
                                $cena += $tmp_cena;
                                #var_dump($tmp_kolicina, $tmp_artikel_id);
                            }
                        }
                        #var_dump($cena);
                        #  i) dodam naročilo v bazo OrderDB -> zaenkrat vsi costumer_id == 1 TODO **** to je potrebno popraviti ****
                        $test = -1;
                        if(isset($_SESSION["user"])){
                            $test = (int)$_SESSION["user"];
                        }
                        seminarskaController::dodajNarocilo($test, $cena, 2);
                        $zadnji = seminarskaController::get_last_order_id(); # var_dump($zadnji); exit();

                        #  ii) dodam v KolicinaDB
                        foreach (ArticelDB::getAll() as $knjiga) {
                            if (isset($_SESSION["cart"][$knjiga['article_id']])) {

                                $tmp_kolicina = $_SESSION["cart"][$knjiga['article_id']];
                                $tmp_artikel_id = (int)$knjiga['article_id'];
                                seminarskaController::dodajKolicino($zadnji, $tmp_artikel_id, $tmp_kolicina);
                            }
                        }
                        ViewHelper::redirect(BASE_URL . "seminarska_naloga");
                        break;
                    default:
                        // default naj bo prazen
                        break;
                }
            }

            echo ViewHelper::render("view/predracun.php", [
                "articles" => ArticelDB::getAll()
            ]);
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }

    },
    "seminarska_naloga/uredi_profil" => function () {
        if (isset($_SESSION["user"])){
            if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'stranka')){
                if(!empty($_GET)){                   
                    ViewHelper::redirect(BASE_URL . "seminarska_naloga");
                }else{            
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        seminarskaController::editUser();
                    } else {
                        seminarskaController::showEditUserForm();

                    }
                }
            }else{
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    seminarskaController::editUser();
                } else {
                    seminarskaController::showEditUserForm();

                }
            }
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }
    },
    "seminarska_naloga/zbrisi_profil" => function () {
        if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'prodajalec' || $_SESSION["role"] == 'administrator')) {  
            seminarskaController::deleteUser();
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }

    },
    "seminarska_naloga/prodajalci" => function () {
        if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'administrator')) { 
            seminarskaController::getAllSellers();
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }

    },
    "seminarska_naloga/stranke" => function () {
        if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'prodajalec' || $_SESSION["role"] == 'administrator')) {
            seminarskaController::getAllCustomers();
        }else{
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        }

    },
    "seminarska_naloga/ocena" => function () {
        $id=Null;
        if(isset($_GET['id'])){
            $id = htmlspecialchars($_GET['id']);
        }       
       
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $id_artikel = $_POST['id_artikel'];
            $ocena = $_POST['ocena_artikla'];
            $user_id = $_SESSION['user'];
            OceneDB::insert($user_id, $id_artikel, $ocena);
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
            
        } else {
            echo ViewHelper::render("view/podaj_oceno.php", ["id" => $id]);
        }
    },
    "seminarska_naloga/potrditev" => function() {
        UserDB::update_status($_GET['id'], TRUE);
        print("Dobrodošli na potrditveni strani. Vaš račun je uspešno aktiviran!");
        sleep(3);
        ViewHelper::redirect(BASE_URL. "seminarska_naloga");        

    },
    "seminarska_naloga/vsi_linki" => function () {

        echo ViewHelper::render("view/zlistani_gumbi.php", []);
    },
    "seminarska_naloga/dodajanjeUporabnikov" => function () {
        seminarskaController::dodajanjeMockUporabnikov();
    },# REST API
    "seminarska_naloga/api/artikli" => function () {
        // podatki o specifičnem artiklu
    
        if(isset($_GET["id"])){
            ArticlesRESTController::get($_GET["id"]);
        }else{
            ArticlesRESTController::index();
        }
    },
    "seminarska_naloga/api/prijava" => function () {

        try {

            $user = UserDB::getUserByEmail($_GET["email"]);
            if($_GET["email"] != 'prodajalec@gmail.com' && $_GET["email"] != 'admin@gmail.com' && password_verify( $_GET["password"],  $user["password"])){                            
                echo ViewHelper::renderJSON(UserDB::getUserByEmail($_GET["email"]));
            }else{
               echo ViewHelper::renderJSON("Bad request", 400);
            }


        } catch (Exception $exc) {
            echo ViewHelper::renderJSON($exc->getMessage(), 404);
        }
  
    },"seminarska_naloga/api/urediProfil" => function () {

        try {                      
            echo ViewHelper::renderJSON(UserDB::update($_POST["id"], $_POST["name"], $_POST["surname"], $_POST["street"], $_POST["house_number"], $_POST["post"], $_POST["post_number"], $_POST["email"], password_hash($_POST["password"], PASSWORD_BCRYPT), "stranka",$_POST["status"]));

        } catch (Exception $exc) {
            echo ViewHelper::renderJSON($exc->getMessage(), 404);
        }
  
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