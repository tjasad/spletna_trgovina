<!DOCTYPE html>
<?php
if (!isset($_SERVER["HTTPS"])){
    $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("Location: " . $url);
}
?>
<?php
require_once("model/ArticelDB.php")
?>
<h1>Vsi artikli izbranega naročila</h1>

<p>[
    <a href="<?= BASE_URL . "seminarska_naloga" ?>">Domov</a> |    
    ]</p>

<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "tabela.css" ?>">
</head>
<body>
<table style="width:100%">
    <tr>
        <th>Številka naročila</th>
        <th>Id artikla</th>
        <th>Izbrana količina</th>
        <th>Naziv artikla</th>
    </tr>

    <?php
    #var_dump($articel); #exit();
    foreach ($articel as $key => $row) {
        #$url = htmlspecialchars($_SERVER["PHP_SELF"]) . "?do=edit&id=" . $row["id"];
        $id = $row["id_kolicina"];
        $order_id = $row["order_id"];
        $article_id = $row["article_id"];
        $kolicina = $row["overal"];
        $tmp_artikel = ArticelDB::get($article_id);
        $articel_name = $tmp_artikel['article_name'];
        # var_dump($tmp_artikel['article_name']); exit(42);

        # echo "<p><b>$date</b>. $text [<a href='$url'>Uredi</a>]";
        ?>
        <tr>
            <td><?= $order_id ?></td>
            <td><?= $article_id ?></td>
            <td><?= $kolicina ?></td>
            <td><?= $articel_name ?></td>


        </tr>


        <?php
    }
    ?>


</table>
</body>

