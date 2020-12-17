<!DOCTYPE html>
<?php
if (!isset($_SERVER["HTTPS"])){
    $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("Location: " . $url);
}
?>
<h1>Trgovina</h1>

<p>[
    <!--Anonimni uporabnik|Stranka|Prodajalec|Admin-->
    <a href="<?= BASE_URL . "seminarska_naloga/trgovina" ?>">Domov</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/prijava" ?>">Prijava</a> |
    <!--Stranka|Prodajalec|Admin-->
    <a href="<?= BASE_URL . "seminarska_naloga/uredi_profil" ?>">Uredi profil</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/registracija" ?>">Dodaj stranko</a> |
    <!--Prodajalec|Admin-->
    <a href="<?= BASE_URL . "seminarska_naloga/ne-obdelana_narocila" ?>">neobdelana naročila</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/artikli" ?>">artikli</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/artikli-add" ?>">dodaj artikel</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/stranke" ?>">stranke</a> |
    <!--Admin-->
    <a href="<?= BASE_URL . "seminarska_naloga/prodajalci" ?>">prodajalci</a>

    ]</p>

<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "tabela.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "trgovina.css" ?>">
</head>
<body>

<?php
foreach ($articles as $key => $row) {
    #$url = htmlspecialchars($_SERVER["PHP_SELF"]) . "?do=edit&id=" . $row["id"];
    $id = $row["article_id"];
    $name = $row["article_name"];
    $price = $row["article_price"];
    $description = $row["article_description"];
    $status = $row["article_status"];

    # echo "<p><b>$date</b>. $text [<a href='$url'>Uredi</a>]";
    ?>
    <div class="box">
        <form action="<?= BASE_URL . "view/add-to-cart" ?>" method="post"/>
        <h3><b><?= $name ?></b></h3>
        <p><?= $description ?></p>
        <p><?= $price ?>€</p>
        <button class="addToCartbtn">Dodaj v košarico</button>
        </form>
    </div>
    <?php
}
?>

</table>
</body>

