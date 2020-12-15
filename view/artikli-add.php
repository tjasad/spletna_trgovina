<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "registracijaPrijava.css" ?>">
</head>
<body>

<!--Navigation bar-->
<?php include 'navigation-bar.php';?>

<div>
    <h1>Dodajanje artikla</h1>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <div>
            <input type="hidden" name="do" value="add"/>
            <label for="article_id"><b>Id artikla</b></label>
            <input type="text" placeholder="Vnesite id artikla" name="article_id" id="article_id" required><br/>
            <label for="article_name"><b>Naziv artikla</b></label>
            <input type="text" placeholder="Vnesite naziv artikla" name="article_name" id="article_name" required><br/>
            <label for="article_price"><b>Cena artikla</b></label>
            <input type="text" placeholder="Vnesite ceno artikla" name="article_price" id="article_price" required>
            <label for="article_description"><b>Opis artikla</b></label>
            <input type="text" placeholder="Vnesite opis artikla" name="article_description" id="article_description"
                   required><br/>

            <label for="article_status"><b>Status artikla</b></label>
            <select name="article_status" id="article_status">
                <option value="1">Aktiven</option>
                <option value="0">Ne aktiven</option>
            </select>


            <input type="submit" value="Dodaj artikel" class="registerbtn"/>
        </div>

    </form>

    <div>
        <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga">
            <input type="submit" value="DOMOV" class="signbtn">
        </form>
        <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/artikli">
            <input type="submit" value="Seznam vseh artiklov" class="signbtn">
        </form>
    </div>


</div>
</body>
</html>


