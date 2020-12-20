<?php
require_once("ViewHelper.php");
require_once("model/UserDB.php");
require_once("model/OrderDB.php");
require_once("model/ArticelDB.php");
require_once("model/KolicinaDB.php");

class seminarskaController
{

    //OPERACIJE UPORABNIKA
    public static function dodajanjeMockUporabnikov(){
        UserDB::insert('Stranka', 'Stranka', 'a',1,'Ljubljana',1000,'stranka@gmail.com',password_hash('stranka', PASSWORD_BCRYPT),'stranka',1);
        UserDB::insert('Prodajalec', 'Prodajalec', 'a',1,'Ljubljana',1000,'prodajalec@gmail.com', password_hash('prodajalec', PASSWORD_BCRYPT),'prodajalec',1);
        UserDB::insert('Administrator', 'Administrator', 'a',1,'Ljubljana',1000,'admin@gmail.com', password_hash('admin', PASSWORD_BCRYPT),'administrator',1);
        UserDB::insert('Ivan', 'Bratko', 'Vecna pot',113,'Ljubljana',1000,'ivan@gmail.com',password_hash('lala', PASSWORD_BCRYPT),'administrator',0);
        UserDB::insert('Mici', 'Luna', 'Vecna pot',115,'Ljubljana',1000,'mici@gmail.com',password_hash('1234', PASSWORD_BCRYPT),'prodajalec',0);
        UserDB::insert('Jo', 'Kip', 'Vesela cesta',1,'Ljubljana',1000,'jo@gmail.com',password_hash('tato', PASSWORD_BCRYPT),'stranka',0);        
        ViewHelper::redirect(BASE_URL . "seminarska_naloga");
    }

    public static function registracija()
    {

        $validData = isset($_POST["name"]) && !empty($_POST["name"]) &&
            isset($_POST["surname"]) && !empty($_POST["surname"]) &&
            isset($_POST["street"]) && !empty($_POST["street"]) &&
            isset($_POST["house_number"]) && !empty($_POST["house_number"]) &&
            isset($_POST["post"]) && !empty($_POST["post"]) &&
            isset($_POST["post_number"]) && !empty($_POST["post_number"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["password"]) && !empty($_POST["password"]);

        if ($validData) {
            $sKey = '6LfreQsaAAAAAFV2X0Ove1Kukv20R6pBE9A01lBT';         
            $token = $_POST["g-recaptcha-response"];
            #$ip = $_SERVER["REMOTE_ADDR"];
            $url_naslov = "https://www.google.com/recaptcha/api/siteverify?secret=".urldecode($sKey)."&response=".urldecode($token).'';#"&remoteip=".urldecode($ip);
            $request = file_get_contents($url_naslov);
            $response = json_decode($request);
            #var_dump($response); exit();
            if($response->success){
                echo "Success Captcha Validation!";            
                UserDB::insert($_POST["name"], $_POST["surname"], $_POST["street"], $_POST["house_number"], $_POST["post"], $_POST["post_number"], $_POST["email"],password_hash($_POST["password"], PASSWORD_BCRYPT), "stranka",0);
                $uid = UserDB::get_id_userByMail($_POST['email']);
                $iid = $uid['costumer_id'];               
                $naslov = "https://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/potrditev?id=$iid";
                self::send_mail(htmlspecialchars($_POST["email"]), $naslov);
                ViewHelper::redirect(BASE_URL . "seminarska_naloga");
            }else{
                echo "Captcha Validation Failed!";
                self::showRegistracijaForm($_POST);
            }
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

    ])
    {
        echo ViewHelper::render("view/registracija.php", $values);
    }

    public static function prijava($values = [
        "email" => "",
        "password" => "",
    ])
    {
        echo ViewHelper::render("view/prijava.php", $values);
    }

    public static function prijava_stranka($values = [
        "email" => "",
        "password" => "",
    ])
    {
        echo ViewHelper::render("view/prijava-stranka.php", $values);
    }

    public static function editUser()
    {

        $validData = isset($_POST["name"]) && !empty($_POST["name"]) &&
            isset($_POST["surname"]) && !empty($_POST["surname"]) &&
            isset($_POST["street"]) && !empty($_POST["street"]) &&
            isset($_POST["house_number"]) && !empty($_POST["house_number"]) &&
            isset($_POST["post"]) && !empty($_POST["post"]) &&
            isset($_POST["post_number"]) && !empty($_POST["post_number"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["password"]) && !empty($_POST["password"]) &&
            isset($_POST["id"]) && !empty($_POST["id"]);

        if ($validData) {
            UserDB::update($_POST["id"], $_POST["name"], $_POST["surname"], $_POST["street"], $_POST["house_number"], $_POST["post"], $_POST["post_number"], $_POST["email"], password_hash($_POST["password"], PASSWORD_BCRYPT), "stranka",$_POST["status"]);
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
            //ViewHelper::redirect(BASE_URL . "user?id=" . $_POST["id"]);
        } else {
            self::showEditUserForm($_POST);
        }
    }

    public static function showEditUserForm($user = [])
    {
        if (empty($user)) {

            if(isset($_GET["id"])){
                $userId = $_GET["id"];
            }else{
                //trentuno prijavljeni user
                $userId = $_SESSION["user"];
            }
            
            $user = UserDB::get($userId);
        }

        echo ViewHelper::render("view/uporabniki-edit.php", ["user" => $user]);
    }

    public static function deleteUser()
    {
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

    public static function getAllSellers()
    {

        echo ViewHelper::render("view/prodajalci.php", [
            "sellers" => UserDB::getUsersByRole("prodajalec")
        ]);

    }

    public static function getAllCustomers()
    {

        echo ViewHelper::render("view/stranke.php", [
            "customers" => UserDB::getUsersByRole("stranka")
        ]);

    }


    //OPERACIJE ARTIKLOV IN NAROČIL

    public static function getAllArticles()
    {
        echo ViewHelper::render("view/artikli.php", [
            "articles" => ArticelDB::getAll()
        ]);
        #var_dump("articles" => ArticelDB::getAll())
    }

    # **** za artikle z statusom - nisem 100% kak in kje bi to dejansko uporabu ****
    #public static function getArticlesByStatus() {
    #   echo ViewHelper::render("view/artikli.php", [
    #       "articles" => ArticelDB::getArticlesByStatus($status)
    #   ]);
    # }
    public static function dodaj_artikel()
    {
        $validData = #isset($_POST["article_id"]) && !empty($_POST["article_id"]) &&
            isset($_POST["article_name"]) && !empty($_POST["article_name"]) &&
            isset($_POST["article_price"]) && !empty($_POST["article_price"]) &&
            isset($_POST["article_description"]) && !empty($_POST["article_description"]) &&
            isset($_POST["article_status"]) && !empty($_POST["article_status"]);

        if ($validData) {
            #var_dump($_POST);
            ArticelDB::insert($_POST["article_name"], $_POST["article_price"], $_POST["article_description"], $_POST["article_status"]);
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
        } else {
            self::insertFormArticles($_POST);
        }
    }

    public static function insertFormArticles($values = [
        #vztavljanje artikla
        #"article_id" => "",
        "article_name" => "",
        "article_price" => "",
        "article_description" => "",
        "article_status" => ""

    ])
    {
        echo ViewHelper::render("view/artikli-add.php", $values);
    }

    public static function editArticle()
    {
        
        #var_dump($_POST);
        $validData = isset($_POST["article_id"]) && !empty($_POST["article_id"]) &&
            isset($_POST["article_name"]) && !empty($_POST["article_name"]) &&
            isset($_POST["article_price"]) && !empty($_POST["article_price"]) &&
            isset($_POST["article_description"]) && !empty($_POST["article_description"]) &&
            isset($_POST["article_status"]);
       
        if ($validData) {
            #print("SQL urejanje");
            ArticelDB::update($_POST["article_id"], $_POST["article_name"], $_POST["article_price"], $_POST["article_description"], $_POST["article_status"]);
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
            //ViewHelper::redirect(BASE_URL . "articel?id=" . $_POST["id"]);
        } else {
            self::article_edit($_POST);
        }
    }

    public static function editNarocila()
    {
        
        $validData = isset($_POST["order_id"]) && !empty($_POST["order_id"]) &&
            isset($_POST["costumer_id"]) && !empty($_POST["costumer_id"]) &&
            isset($_POST["total_price"]) && !empty($_POST["total_price"]) &&
            isset($_POST["order_status"]); #&& !empty($_POST["order_status"]);

        if ($validData) {

            OrderDB::update($_POST["order_id"], $_POST["costumer_id"], $_POST["total_price"], $_POST["order_status"]);
            ViewHelper::redirect(BASE_URL . "seminarska_naloga");
            //ViewHelper::redirect(BASE_URL . "articel?id=" . $_POST["id"]);
        } else {
            self::order_edit($_POST);
        }
    }
  
    public static function prikazKolicine($order = [])
    {

        $validDelete = isset($_POST["id"]) && !empty($_POST["id"]);

        if ($validDelete) {
            $order = KolicinaDB::getAll($_POST["id"]);
            echo ViewHelper::render("view/kolicina.php", ["articel" => $order]);
        } else {
            if (isset($_POST["id"])) {
                $url = BASE_URL . "seminarska_naloga/ne_obdelana_narocila-edit?id=" . $_POST["id"];
            } else {
                $url = BASE_URL . "seminarska_naloga";
            }
        }
    }

    public static function prikazKolicine2($order = [])
    {

        $validDelete = isset($_POST["id"]) && !empty($_POST["id"]);

        if ($validDelete) {
            $order = KolicinaDB::getAll($_POST["id"]);
            echo ViewHelper::render("view/kolicina-prikaz.php", ["articel" => $order]);
        } else {
            if (isset($_POST["id"])) {
                $url = BASE_URL . "seminarska_naloga/podrobnosti_vsa_narocila?id=" . $_POST["id"];
            } else {
                $url = BASE_URL . "seminarska_naloga";
            }
        }
    }

    public static function article_edit($articel = [])
    {
       
        if (empty($articel)) {
            $articel = ArticelDB::get($_GET["id"]);
        }
        
        #$tmp = $articel["article_status"];	               
        #if ($tmp == '0') {	        
        #    echo ViewHelper::render("view/artikli-edit.php", ["articel" => $articel]);           
        #} else {	
            
        #    echo ViewHelper::render("view/artikli-edit2.php", ["articel" => $articel]);	           
        #}
        echo ViewHelper::render("view/artikli_edit_specific.php", ["articel" => $articel]); 
    }

    public static function order_edit($order = [])
    {
        if (empty($order)) {
            $order = OrderDB::get($_GET["id"]);
            #var_dump($order); exit();            
        }
        echo ViewHelper::render("view/narocila_edit.php", ["articel" => $order]);
    }
  
    public static function prikaz_detajlov($order = []){ # za narocila -> stranka
        if (empty($order)) {
            $order = OrderDB::get($_GET["id"]);
            #var_dump($order); exit();            
        }
        echo ViewHelper::render("view/narocila-pogled.php", ["articel" => $order]);
    }

    #public static function deleteArticel() {
    #    $validDelete = isset($_POST["id"]) && !empty($_POST["id"]);
    #
    #    if ($validDelete) {
    #        ArticelDB::delete($_POST["id"]);
    #        $url = BASE_URL . "seminarska_naloga";
    #    } else {
    #        if (isset($_POST["id"])) {
    #            $url = BASE_URL . "seminarska_naloga/artikli-edit?id=" . $_POST["id"];
    #        } else {
    #            $url = BASE_URL . "seminarska_naloga";
    #        }
    #    }

    #    echo ViewHelper::redirect($url);
    #}
    # ** z tem so težave, ker so tabele povezane samo tak ni zahtevan v navodilih tak da je kul **
    #public static function deleteOrder() {
    #    $validDelete = isset($_POST["id"]) && !empty($_POST["id"]);
    #
    #    if ($validDelete) {
    #        OrderDB::delete($_POST["id"]);
    #        $url = BASE_URL . "seminarska_naloga";
    #    } else {
    #        if (isset($_POST["id"])) {
    #            $url = BASE_URL . "seminarska_naloga/narocila_edit?id=" . $_POST["id"];
    #        } else {
    #            $url = BASE_URL . "seminarska_naloga";
    #        }
    #    }
    #
    #    echo ViewHelper::redirect($url);
    #}

    public static function getNeobdelanaNarocila()
    {
        echo ViewHelper::render("view/ne-obdelana_narocila.php", [
            "orders" => OrderDB::getOrdersByStatus(2)
        ]);
    }

    public static function getPotrjenaNarocila()
    {
        echo ViewHelper::render("view/ne-obdelana_narocila.php", [
            "orders" => OrderDB::getOrdersByStatus(1)
        ]);
    }

    public static function getVsaNarocila($id){
        echo ViewHelper::render("view/vsa_narocila.php", [
            "orders" => OrderDB::narocila_stranke($id)
        ]);
    }

    # dodajanje naročila
    public static function dodajNarocilo($id2, $price, $status)
    {       
        OrderDB::insert($id2, $price, $status);

    }

    #tabela KOLICINA
    public static function dodajKolicino($id2, $id3, $cena)
    {
        #var_dump($id1);
        KolicinaDB::insert($id2, $id3, $cena);
    }

    public static function get_last_order_id(){
        $a = OrderDB::latest_id();
        #var_dump($a);
        $b = $a[0];
        #var_dump($b['order_id']);
        return (int) $b['order_id'];
    }
    public static function send_mail($to, $povezava){
       require_once('PHPMailer/PHPMailerAutoload.php');

       $mail = new PHPMailer();
       $mail->isSMTP();
       $mail->SMTPAuth = true;
       $mail->SMTPSecure = 'ssl';
       $mail->Host = 'smtp.gmail.com';
       $mail->Port = '465';
       $mail->isHTML();
       $mail->Username = 'eposlovanje5@gmail.com';
       $mail->Password = 'krneki123';
       $mail->SetFrom('no@replay.com');
       $mail->Subject = "Pozdravljen kupec!";
       $mail->Body = "Za dokončanje registracije kliknite na naslednjo povezavo:" . $povezava;
       $mail->AddAddress($to);

       $mail->Send();
    }

}