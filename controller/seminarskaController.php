<?php
require_once("ViewHelper.php");
class seminarskaController {
    //preusmeri na registracijo
    public static function registracija($values = [
        "name" => "",
        "surname" => "",
        "street" => "",
        "house_number" => "",
        "post" => "",
        "post_number" => "",
        "password" => "",
        "password_again" => ""
        
    ]) {
        echo ViewHelper::render("view/registracija.php", $values);
       # ViewHelper::redirect(BASE_URL . "seminarska_naloga");
    }
    
    public static function prijava($values =[
        "email" => "",
        "password" => "",
    ]){
        echo ViewHelper::render("view/prijava.php", $values);
    }
    
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
     
     public static function getAllSellers() {

         #$db = DBInit::getInstance();
 
         #$statement = $db->prepare("SELECT id, joke_text, joke_date FROM jokes");
         
         #$statement->execute();
 
         #return $statement->fetchAll();
         
        $sellers = array(
                    array(
                            "name" => "Štefan",
                            "surname" => "Mori",
                            "street" => "Večna Pot",
                            "house_number" => 113,
                            "post" => "Ljubljana",
                            "post_number" => 1000,
                            "email" => "Stefan@gmail.com",
                            "status" => FALSE
                        
                ),
                    array(
                            "name" => "Mica",
                            "surname" => "Lovrak",
                            "street" => "Večna Pot",
                            "house_number" => "114",
                            "post" => "Ljubljana",
                            "post_number" => "1000",
                            "email" => "mica@gmail.com",
                            "status" => TRUE
                ),
                    array(
                            "name" => "Dup",
                            "surname" => "Božec",
                            "street" => "Večna Pot",
                            "house_number" => "116",
                            "post" => "Ljubljana",
                            "post_number" => "1000",
                            "email" => "dup@gmail.com",
                            "status" => TRUE 
                )           
        );

        return $sellers;
     }
     
      public static function getAllCustomers() {

         #$db = DBInit::getInstance();
 
         #$statement = $db->prepare("SELECT id, joke_text, joke_date FROM jokes");
         
         #$statement->execute();
 
         #return $statement->fetchAll();
         
        $customers = array(
                    array(
                            "name" => "Lisa",
                            "surname" => "Robec",
                            "street" => "Potniška",
                            "house_number" => 12,
                            "post" => "Koper",
                            "post_number" => 1111,
                            "email" => "Lisa@gmail.com",
                            "status" => TRUE 
                        
                ),
                    array(
                            "name" => "Borut",
                            "surname" => "Great",
                            "street" => "Mestni log",
                            "house_number" => "24",
                            "post" => "Ljubljana",
                            "post_number" => "1000",
                            "email" => "borut@gmail.com",
                            "status" => TRUE 
                ),
                    array(
                            "name" => "Miran",
                            "surname" => "Laznik",
                            "street" => "Marinova cesta",
                            "house_number" => "6",
                            "post" => "Ljubljana",
                            "post_number" => "1000",
                            "email" => "miran@gmail.com",
                            "status" => TRUE 
                )            
        );

        return $customers;
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
        #$db = DBinit::getInstance();
        #$statement = $db->prepare("UPDATE jokes SET joke_text =:joke_text, joke_date =:joke_date WHERE id=:id");
        #$statement->bindParam(":id", $id);
        #$statement->bindParam(":joke_date", $joke_date);
        #$statement->bindParam(":joke_text", $joke_text);
        
        #$statement->execute();
    }
    public static function delete($id) {
       # $db = DBInit::getInstance();

       # $statement = $db->prepare("DELETE FROM jokes WHERE id = :id");
       # $statement->bindParam(":id", $id, PDO::PARAM_INT);
       # $statement->execute();
    }
    public static function getAll_orders() {
        #getAll NAROČILA
        # to boma rabla za po bazi sam zaenkrat še ne
        #$db = DBInit::getInstance();

        #$statement = $db->prepare("SELECT id, joke_text, joke_date FROM jokes");
        
        #$statement->execute();

        #return $statement->fetchAll();
        
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
    
    public static function showEditUserForm($user = []) {
        if (empty($user)) {
            //$user = UserDB::get($_GET["id"]);
        }

        echo ViewHelper::render("view/uporabniki-edit.php", ["user" => $user]);
    }

    public static function editUser() {

        $validData = isset($_POST["name"]) && !empty($_POST["name"]) &&
                isset($_POST["surname"]) && !empty($_POST["surname"]) &&
                isset($_POST["street"]) && !empty($_POST["street"]) &&
                isset($_POST["house_number"]) && !empty($_POST["house_number"]) &&
                isset($_POST["post"]) && !empty($_POST["post"])&&
                isset($_POST["post_number"]) && !empty($_POST["post_number"])&&
                isset($_POST["password"]) && !empty($_POST["password"])&&
                isset($_POST["email"]) && !empty($_POST["email"])&&
                isset($_POST["id"]) && !empty($_POST["id"]);

        if ($validData) {
            //UserDB::update($_POST["id"], $_POST["name"], $_POST["surname"], $_POST["street"], $_POST["house_number"],$_POST["post"],$_POST["post_number"],$_POST["password"],$_POST["email"]);
            ViewHelper::redirect(BASE_URL . "user?id=" . $_POST["id"]);
        } else {
            self::showEditForm($_POST);
        }
    }
 
     
}