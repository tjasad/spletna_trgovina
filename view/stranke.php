<!DOCTYPE html>
<h1>Stranke</h1>

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

<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "tabela.css" ?>">
</head>
<body>
<table style="width:100%">
    <tr>
        <th>Ime</th>
        <th>Priimek</th>
        <th>Ulica</th>
        <th>Hišna številka</th>
        <th>Pošta</th>
        <th>Poštna številka</th>
        <th>Epošta</th>
    </tr>
    <?php

    # var_dump($articles); exit();
    foreach ($customers as $key => $row) {
        #$url = htmlspecialchars($_SERVER["PHP_SELF"]) . "?do=edit&id=" . $row["id"];
        $name = $row["name"];
        $surname = $row["surname"];
        $street = $row["street"];
        $house_number = $row["house_number"];
        $post = $row["post"];
        $post_number = $row["post_number"];
        $email = $row["email"];
        $id = $row["costumer_id"]

        # echo "<p><b>$date</b>. $text [<a href='$url'>Uredi</a>]";
        ?>
        <tr>
            <td><?= $name ?></td>
            <td><?= $surname ?></td>
            <td><?= $street ?></td>
            <td><?= $house_number ?></td>
            <td><?= $post ?></td>
            <td><?= $post_number ?></td>
            <td><?= $email ?></td>
            <!-- <td><?php
            if ($status == true) {
                echo "aktiven";
            } else {
                echo "ne-aktiven";
            }
            ?>
          </td>-->

            </td>
            <td>
                <form action="<?= BASE_URL . "seminarska_naloga/zbrisi_profil" ?>" method="post">
                    <input type="hidden" name="id" value="<?= $id ?>"/>
                    <input type="submit" value="Odstrani stranko" class="registerbtn">
                </form>
            </td>

        </tr>


        <?php
    }
    ?>


</table>

</body>
