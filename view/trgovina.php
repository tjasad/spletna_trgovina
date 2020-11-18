<!DOCTYPE html>
<h1>Trgovina</h1>

<p>[
<a href="<?= BASE_URL . "seminarska_naloga/prijava" ?>">Prijava</a> 
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
        <form action="<?= BASE_URL . "view/add-to-cart" ?>" method="post" />
                <h3><b><?=$name?></b></h3>
                <p><?=$description?></p>
                <p><?=$price?>€</p>
                <button class="addToCartbtn">Dodaj v košarico</button>
        </form> 
        </div>        
 <?php
    }
?>
 
 </table>
 </body>

