<!DOCTYPE html>
<?php
if (!isset($_SERVER["HTTPS"])){
    $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("Location: " . $url);
}
?>
<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "tabela.css" ?>">
</head>

<body>
<!--Navigation bar-->
<?php include 'navigation-bar.php';?>

<h1>Stranke</h1>
<table style="width:100%">
    <tr>
        <th>Ime</th>
        <th>Priimek</th>
        <th>Ulica</th>
        <th>Hišna številka</th>
        <th>Pošta</th>
        <th>Poštna številka</th>
        <th>Epošta</th>
        <th>Status</th>
        <th>Uredi</th>
        <th>Izbriši</th>
    </tr>
    <?php

    #var_dump($customers); exit();
    foreach ($customers as $key => $row) {
        #$url = htmlspecialchars($_SERVER["PHP_SELF"]) . "?do=edit&id=" . $row["id"];
        $name = $row["name"];
        $surname = $row["surname"];
        $street = $row["street"];
        $house_number = $row["house_number"];
        $post = $row["post"];
        $post_number = $row["post_number"];
        $email = $row["email"];
        $id = $row["costumer_id"];
        $status = $row["status"];

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
            <td><?php
            if ($status == true) {
                echo "aktiven";
            } else {
                echo "ne-aktiven";
            }
            ?>
            </td>
            <td>
                <form action="<?= BASE_URL . "seminarska_naloga/uredi_profil" ?>" method="get">
                    <input type="hidden" name="id" value="<?= $id ?>"/>
                    <input type="submit" value="Uredi stranko" class="registerbtn">
                </form>
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
