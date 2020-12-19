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
    <h1>Ocena artikla</h1>
    <form action="<?= BASE_URL . "seminarska_naloga/ocena" ?>" method="post">
        <div>            
            <label for="ocena"><b>Ocena artikla</b></label>
            <input type="hidden" name="id_artikel"  value="<?= htmlspecialchars($id[0]) ?>">
            <input type="number" max="5" placeholder="Vnesite oceno artikla 1-5" name="ocena_artikla" id="ocena_artikla" required><br/>           

            <input type="submit" value="Podaj oceno" class="registerbtn"/>
        </div>

    </form>
    <div>
        <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga">
            <input type="submit" value="DOMOV" class="signbtn">
        </form>
    </div>


</div>
</body>
</html>