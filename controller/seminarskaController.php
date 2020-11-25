<?php
require_once("ViewHelper.php");
require_once("model/UserDB.php");

class seminarskaController {

    //OPERACIJE UPORABNIKA

    public static function registracija() {

        $validData = isset($_POST["name"]) && !empty($_POST["name"]) &&
                isset($_POST["surname"]) && !empty($_POST["surname"]) &&
                isset($_POST["street"]) && !empty($_POST["street"]) && 
                isset($_POST["house_number"]) && !empty($_POST["house_number"]) &&
                isset($_POST["post"]) && !empty($_POST["post"]) &&
                isset($_POST["post_number"]) && !empty($_POST["post_number"]) &&
                isset($_POST["email"]) && !empty($_POST["email"]) &&
                isset($_POST["password"]) && !empty($_POST["password"]);

        if ($validData) {

            UserDB::insert(12,$_POST["name"], $_POST["surname"], $_POST["street"], $_POST["house_number"], $_POST["post"], $_POST["post_number"], $_POST["email"], $_POST["password"], "stranka");
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        } else {
            self::showRegistracijaForm($_POST);
        }
    }

    public static function showRegistracijaForm($values = [
        "name" => "",
        "surname" => "",
        "street" => "",
        "house_number" => "",
        "post" => "",
        "post_number" => "",
        "password" => "",
        "email" => ""
        
    ]){
        echo ViewHelper::render("view/registracija.php", $values);
    }
    
    public static function prijava($values =[
        "email" => "",
        "password" => "",
    ]){
        echo ViewHelper::render("view/prijava.php", $values);
    }

    public static function editUser() {

        $validData = isset($_POST["name"]) && !empty($_POST["name"]) &&
                isset($_POST["surname"]) && !empty($_POST["surname"]) &&
                isset($_POST["street"]) && !empty($_POST["street"]) && 
                isset($_POST["house_number"]) && !empty($_POST["house_number"]) &&
                isset($_POST["post"]) && !empty($_POST["post"]) &&
                isset($_POST["post_number"]) && !empty($_POST["post_number"]) &&
                isset($_POST["email"]) && !empty($_POST["email"]) &&
                isset($_POST["password"]) && !empty($_POST["password"]);

        if($validData){
            UserDB::update($_POST["id"],$_POST["name"], $_POST["surname"], $_POST["street"], $_POST["house_number"], $_POST["post"], $_POST["post_number"], $_POST["email"], $_POST["password"], "stranka");
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
            //ViewHelper::redirect(BASE_URL . "user?id=" . $_POST["id"]);
        } else {
            self::showEditUserForm($_POST);
        }
    }
    
    public static function showEditUserForm($user = []) {
        if (empty($user)) {
            $user = UserDB::get($_GET["id"]);
        }

        echo ViewHelper::render("view/uporabniki-edit.php", ["user" => $user]);
    }

    public static function deleteUser() {
        $validDelete = isset($_POST["id"]) && !empty($_POST["id"]);

        if ($validDelete) {
            UserDB::delete($_POST["id"]);
            $url = BASE_URL . "seminarska_naloga";
        } else {
            if (isset($_POST["id"])) {
                $url = BASE_URL . "seminarska_naloga/uredi_profil?id=" . $_POST["id"];
            } else {
                $url = BASE_URL . "seminarska_naloga";
            }
        }

        echo ViewHelper::redirect($url);
    }

    public static function getAllSellers() {

        echo ViewHelper::render("view/prodajalci.php", [
            "sellers" => UserDB::getUsersByRole("prodajalec")
        ]);

     }
     
      public static function getAllCustomers() {

        echo ViewHelper::render("view/stranke.php", [
            "customers" => UserDB::getUsersByRole("stranka")
        ]);

     }


    //OPERACIJE ARTIKLOV IN NAROČIL

     public static function getAllArticles() {
         #getAll ARTIKLE
         # to boma rabla za po bazi sam zaenkrat še ne
         #$db = DBInit::getInstance();
 
         #$statement = $db->prepare("SELECT id, joke_text, joke_date FROM jokes");
         
         #$statement->execute();
 
         #return $statement->fetchAll();
         
        $a = array(
                    array(
                            'article_id' => 1,
                            'article_name' => 'kranjska klobasa',
                            'article_price' => 12.5,
                            'article_description' => 'Mesnata klobasa, v naravnem ovitku.',
                            'article_status' => TRUE,
                ),
                    array(
                            'article_id' => 2,
                            'article_name' => 'pariška klobasa',
                            'article_price' => 23.43,
                            'article_description' => 'Klobasa z okusom Pariza.',
                            'article_status' => TRUE,
                ),
                    array(
                            'article_id' => 3,
                            'article_name' => 'milanska klobasa',
                            'article_price' => 17.93,
                            'article_description' => 'Klobasa z okusom Milana.',
                            'article_status' => TRUE,
                ),
                    array(
                            'article_id' => 4,
                            'article_name' => 'savinjski želodec',
                            'article_price' => 10.33,
                            'article_description' => 'Savinjska specialiteta.',
                            'article_status' => FALSE,
                ),
        );
        #var_dump($a);
        return $a;
     }
     
     
     public static function insertForm($values = [
         #vztavljanje artikla
        "article_id" => "",
        "article_name" => "",
        "article_price" => "",
        "article_description" => "",
        "article_status" => ""
        
    ]) {
        echo ViewHelper::render("view/artikli-add.php", $values);
    }
    public static function article_edit($values = [
        #urejanje artikla
        "article_id" => "",
        "article_name" => "",
        "article_price" => "",
        "article_description" => "",
        "article_status" => ""
        
    ]) {
        echo ViewHelper::render("view/artikli-edit.php", $values);
    }
    
    public static function uredi ($id, $joke_text, $joke_date) {
        seminarskaController::article_edit();

    }

    public static function delete($id) {

    }

    public static function getAll_orders() {
        
       $a = array(
                   array(
                           'order_id' => 1,
                           'articles' => 'kranjska klobasa, kislo zelje, krompir, čebula',
                           'total_price' => 12.5,
                           'costumer_id' => '12',
                           'order_status' => '-1',
               ),
                   array(
                           'order_id' => 2,
                           'articles' => 'pariška klobasa, kisla repa, riž, česen',
                           'total_price' => 23.43,
                           'costumer_id' => '13',
                           'order_status' => '0',
               ),
                   array(
                           'order_id' => 3,
                           'articles' => 'milanska klobasa, rdeče zelje, mlinci, prtešilj',
                           'total_price' => 17.93,
                           'costumer_id' => '14',
                           'order_status' => '1',
               ),
                   array(
                           'order_id' => 4,
                           'articles' => 'savinjski želodec, kruh, sir, paprika',
                           'total_price' => 10.33,
                           'costumer_id' => '15',
                           'order_status' => 1,
               ),
       );
       #var_dump($a);
       return $a;
    }
    
}