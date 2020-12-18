<!DOCTYPE html>
<?php
if (!isset($_SERVER["HTTPS"])){
    $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("Location: " . $url);
}
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "registracijaPrijava.css" ?>">
</head>
<body>
<!--Navigation bar-->
<?php include 'navigation-bar.php';?>

<div>
    <h1>Urejanje artikla</h1>
    <form action="<?= BASE_URL . "seminarska_naloga/artikli-edit" ?>" method="post">
        <div>
            <input type="hidden" name="id" value="<?= htmlspecialchars($articel["article_id"]) ?>"/>
            <label for="article_id"><b>Id artikla</b></label>
            <input type="text" placeholder="Vnesite id artikla" name="article_id" id="article_id"
                   value="<?= htmlspecialchars($articel["article_id"]) ?>" required><br/>
            <label for="article_name"><b>Naziv artikla</b></label>
            <input type="text" placeholder="Vnesite naziv artikla" name="article_name" id="article_name"
                   value="<?= htmlspecialchars($articel["article_name"]) ?>" required><br/>
            <label for="article_price"><b>Cena artikla</b></label>
            <input type="text" placeholder="Vnesite ceno artikla" name="article_price" id="article_price"
                   value="<?= htmlspecialchars($articel["article_price"]) ?>" required>
            <label for="article_description"><b>Opis artikla</b></label>
            <input type="text" placeholder="Vnesite opis artikla" name="article_description" id="article_description"
                   value="<?= htmlspecialchars($articel["article_description"]) ?>" required><br/>

            <label for="article_status"><b>Status artikla</b></label>
            <?php
            $aktiven = htmlspecialchars($articel["article_status"]);
            if ($aktiven ==1){
            ?>
                 <select name="article_status">
                        <option value="1" selected="selected">Aktiven</option>
                        <option value="0">Ne aktiven</option>                        
                    </select>
            <?php
            }
            else{
            ?>
                    <select name="article_status">
                        <option value="0" selected="selected">Ne aktiven</option>
                        <option value="1">Aktiven</option>                        
                    </select>
                <?php
            }                
            ?>

            <input type="submit" value="Posodobi" class="registerbtn"/>
        </div>

    </form>

    <!-- izbriši artikel -->
    <!-- <form action="<? #= BASE_URL . "seminarska_naloga/zbrisi_artikel" #?>" method="post">
        <input type="hidden" name="id" value="<?= $articel["article_id"] ?>"/>
        <label><b>Izbriši artikel?</b></label><br>
        <input type="submit" value="Izbriši" class="registerbtn" >
    </form> -->

    <div>
        <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga">
            <input type="submit" value="DOMOV" class="signbtn">
        </form>
    </div>


</div>
</body>
</html>