<!DOCTYPE html>
<?php
if ((!isset($_SERVER["HTTPS"])) && (isset($_SESSION["role"]))){
    $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("Location: " . $url);
}
?>
<?php
$url = filter_input(INPUT_SERVER, "PHP_SELF", FILTER_SANITIZE_SPECIAL_CHARS);
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD", FILTER_SANITIZE_SPECIAL_CHARS);
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "tabela.css" ?>">
    <meta charset="UTF-8"/>
    <title>Trgovina</title>
</head>

<body>

<!--Navigation bar-->
<?php include 'navigation-bar.php';?>
<h2>Iskanje po artiklih (binarno iskanje):</h2>
<div>
    <form action="<?= $url  ?>" method="post">
        <input type="text" name="iskanje_ime" placeholder="Vnesite ime artikla">
        <input type="submit" value="Išči" class="registerbtn"/>
    </form>
</div>

<h1>Artikli</h1>
<?php
$directory = "/home/ep/NetBeansProjects/seminarska_naloga/slike";
$start_position = "/netbeans/seminarska_naloga/slike";

$files = array();
foreach (scandir($directory) as $file) {
    if ($file !== '.' && $file !== '..') {
        $files[] = $file;
    }
}
?>
<table style="width:100%">
    <tr>
        <th>Id_artikla</th>
        <th>Ime artikla</th>
        <th>Cena artikla</th>
        <th>Opis artikla</th>
        <th>Status artikla</th>
        <th>Dodaj</th>
    </tr>

    <div id="main">
        <?php
       # var_dump($articles);      
        foreach ($articles as $key => $row) {
            $id = htmlspecialchars($row["article_id"]);
            $name = htmlspecialchars($row["article_name"]);
            $price = htmlspecialchars($row["article_price"]);
            $description = htmlspecialchars($row["article_description"]);
            $status = htmlspecialchars($row["article_status"]);
            ?>
            <div class="book">
                <form action="<?= $url ?>" method="post">
                    <tr>
                        <input type="hidden" name="do" value="add_into_cart"/>
                        <input type="hidden" name="id" value="<?= $id ?>"/>
                        <td><?= $id ?></td>
                        <td><?= $name ?></td>
                        <td><?= $price ?>€</td>
                        <td><?= $description ?></td>
                        <td><?php
                            if ($status == true) {
                                echo "aktiven";
                            } else {
                                echo "ne-aktiven";
                            }
                            ?>
                        </td>
                        <?php
                            $seznam=array();
                            foreach($files as $a){
                                if ($a == $name){
                                    $nov_path = $directory.'/'.$a;
                                    $slika_path = $start_position.'/'.$a;
                                    foreach (scandir($nov_path) as $file) {
                                        if ($file !== '.' && $file !== '..') {
                                            $final_path = $nov_path.'/'.$file;
                                            $slika_path2 = $slika_path.'/'.$file;
                                            $seznam[]=$slika_path2;
                                        }
                                    }
                                }
                            }
                            #var_dump($seznam);
                            if (!empty($seznam)){ ?>
                            <td>
                            <?php                 
                                foreach($seznam as $pic){
                                    #print($pic);  print("     "); print($name); echo "<br>";      
                            ?>
                                
                                <img src="<?php echo $pic?>" width="90" height="130" >
                                
                            <?php
                                }
                            }
                            ?>
                        </td>
                            <?php
                            if (empty($seznam)){ ?>
                        <td>
                            <?php print("Ni slike"); ?>
                        </td>
                        <?php
                            }
                        ?>
                        <td>
                            <button type="submit">V košarico</button>
                        </td>
                    </tr>
                </form>
            </div>
        <?php } ?>
</table>
</div>

<div class="cart">
    <h3>Košarica</h3>
    <table style="width:100%">
        <p><?php
            if (isset($_SESSION["cart"])) {
            # var_dump($_SESSION["cart"]);
            # print($_SESSION["cart"][$knjiga->id]);
            #print_r($_SESSION["cart"]);
            $koncna_cena = 0;
            foreach ($_SESSION["cart"] as $key => $value) {
            $my_val = $value;

            # print($key); echo " ";
            #print ($my_val);
            foreach ($articles

            as $key2 => $row){
            $id = htmlspecialchars($row["article_id"]);
            $name = htmlspecialchars($row["article_name"]);
            $price = htmlspecialchars($row["article_price"]);
            $description = htmlspecialchars($row["article_description"]);
            $status = htmlspecialchars($row["article_status"]);


            if ($row['article_id'] == $key){


            #print($knjiga->naslov);
            # print ", ";
            # print($knjiga->avtor);
            #print($knjiga->cena * $value);
            $koncna_cena += ($price * $value);
            ?>
            <form action="<?= $url ?>" method="post">
                <tr>
                    <input type="hidden" name="do" value="update_cart"/>
                    <input type="hidden" name="id" value="<?= $id ?>"/>
                    <td>
        <p><input type="number" class="short_input" name="kolicina" value="<?= $my_val ?>"/></p>
        </td>
        <td><?= $id ?></td>
        <td><?= $name ?></td>
        <td><?= $price ?>€</td>
        <td><?= $description ?></td>
        <td><?php
            if ($status == true) {
                echo "aktiven";
            } else {
                echo "ne-aktiven";
            }
            ?>
        </td>
        <td>
            <p>
                <button type="submit">Posodobi</button>
            </p>
        </td>

        </tr>
        </form>
        <?php

        }
        }
        echo " </br>";


        }
        #print "Total: ";
        #print $koncna_cena;
        #print " EUR";
        ?>
        <p>Total: <b> <?= $koncna_cena ?> EUR</b></p>
        <?php
        echo " </br>";
        ?>
        <form action="<?= $url ?>" method="post">
            <input type="hidden" name="do" value="purge_cart"/>
            <button type="submit">Izprazni košarico</button>
            <?php
            } else {
                echo "Košara je prazna.";
            }
            ?> </p>
    </table>
</div>
<div><p>[
        <a href="<?= BASE_URL . "seminarska_naloga/zakljucek" ?>">zaključek nakupa</a>
        ]</p>
</div>
</body>
</html>