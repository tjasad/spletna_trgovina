<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "tabela.css" ?>">
</head>
<body>
<h1>Vsi artikli</h1>
<p>[
    <!--Anonimni uporabnik|Stranka|Prodajalec|Admin-->
    <a href="<?= BASE_URL . "seminarska_naloga/trgovina" ?>">Domov</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/prijava" ?>">Prijava</a> |
    <!--Stranka|Prodajalec|Admin-->
    <?php
      if (isset($_SESSION["user"])) {?>
        <a href="<?= BASE_URL . "seminarska_naloga/uredi_profil" ?>">Uredi profil</a> |
    <?php } ?>
    <!--Prodajalec|Admin-->
    <a href="<?= BASE_URL . "seminarska_naloga/registracija" ?>">Dodaj stranko</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/ne-obdelana_narocila" ?>">neobdelana naročila</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/artikli" ?>">artikli</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/artikli-add" ?>">dodaj artikel</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/stranke" ?>">stranke</a> |
    <!--Admin-->
    <a href="<?= BASE_URL . "seminarska_naloga/prodajalci" ?>">prodajalci</a>

    ]</p>

<table style="width:100%">
    <tr>
        <th>Id_artikla</th>
        <th>Ime artikla</th>
        <th>Cena artikla</th>
        <th>Opis artikla</th>
        <th>Status artikla</th>
    </tr>

    <?php
    # var_dump($articles); exit();
    foreach ($articles as $key => $row) {
        #$url = htmlspecialchars($_SERVER["PHP_SELF"]) . "?do=edit&id=" . $row["id"];
        $id = $row["article_id"];
        $name = $row["article_name"];
        $price = $row["article_price"];
        $description = $row["article_description"];
        $status = $row["article_status"];

        # echo "<p><b>$date</b>. $text [<a href='$url'>Uredi</a>]";
        ?>
        <tr>
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
                <a href='http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/artikli-edit?id=<?= $id ?>'>Uredi</a>
            </td>
        </tr>


        <?php
    }
    ?>


</table>
</body>

