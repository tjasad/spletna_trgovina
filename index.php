<?php

// enables sessions for the entire app
session_start();

require_once("controller/seminarskaController.php");
require_once("model/ArticelDB.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";


# *** globalne spremenljivke za določanje uniq ID-ja ***
static $id_narocila = 1;

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
                        $user = UserDB::getUserByEmailAndPasswod($_POST["email"], $_POST["password"]);
                        var_dump($user['name']);

                        $_SESSION["user"] = $user['costumer_id'];
                        $_SESSION["role"] = $user['role'];
                        ViewHelper::redirect(BASE_URL . "seminarska_naloga/trgovina");

                    } catch (Exception $exc) {
                        //TODO tu se bo moglo neki drugeg anarest
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
    #"seminarska_naloga/zbrisi_artikel" => function () {
    #    
    #    seminarskaController::deleteArticel();
    #  },
    "seminarska_naloga/ne-obdelana_narocila" => function () {
        seminarskaController::getNeobdelanaNarocila();
    },
    "seminarska_naloga/ne_obdelana_narocila-edit" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            seminarskaController::editNarocila();
        } else {
            seminarskaController::order_edit();
        }
    },
    #"seminarska_naloga/izbrisi_narocilo" => function () {
    #    seminarskaController::deleteOrder();
    #},
    "seminarska_naloga/uredi_kolicino" => function () {
        seminarskaController::prikazKolicine();
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
                        session_destroy();
                        session_start();
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

        echo ViewHelper::render("view/košarica.php", [
            "articles" => ArticelDB::getAll()
        ]);


    },
    "seminarska_naloga/zakljucek" => function () {
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
                    $aa = $GLOBALS['id_narocila'];
                    $zadnji_id = seminarskaController::dodajNarocilo($aa, 1, $cena, 2);

                    #  ii) dodam v KolicinaDB
                    foreach (ArticelDB::getAll() as $knjiga) {
                        if (isset($_SESSION["cart"][$knjiga['article_id']])) {

                            $tmp_kolicina = $_SESSION["cart"][$knjiga['article_id']];
                            $tmp_artikel_id = (int)$knjiga['article_id'];
                            $bb = $GLOBALS['id_narocila'];
                            seminarskaController::dodajKolicino($bb, $tmp_artikel_id, $tmp_kolicina);
                        }
                    }
                    $GLOBALS['$id_narocila'] += 1;
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
    "seminarska_naloga/vsi_linki" => function () {

        echo ViewHelper::render("view/zlistani_gumbi.php", []);
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
