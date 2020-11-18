<!DOCTYPE html>
<h1>Košarica</h1>

<p>[
<a href="<?= BASE_URL . "seminarska_naloga" ?>">Domov</a>
]</p>

<head>
     <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "tabela.css" ?>">
</head>
<body>
<table style="width:100%">
    <tr>
    <th>Id_artikla</th>
    <th>Ime artikla</th>
    <th>Cena artikla</th>
    <th>Opis artikla</th>
    <th>Status artikla</th>
    </tr>

<?php
$sk_cena=0;
   # var_dump($articles); exit();
    foreach ($articles as $key => $row) {
        #$url = htmlspecialchars($_SERVER["PHP_SELF"]) . "?do=edit&id=" . $row["id"];
        $id = $row["article_id"];
        $name = $row["article_name"];
        $price = $row["article_price"];
        $description = $row["article_description"];
        $status = $row["article_status"];
        $sk_cena+=$price;

       # echo "<p><b>$date</b>. $text [<a href='$url'>Uredi</a>]";
       ?>
       <tr>
          <td><?=$id?></td>
          <td><?=$name?></td>
          <td><?=$price?>€</td>
          <td><?=$description?></td>
          <td><?php
                  if ($status==true){
                        echo "aktiven";
                  }else{
                        echo "ne-aktiven";
                  }
              ?>
          </td>
          <td><a href='link'>Uredi količino (nevem če to rabma?)</a></td>
    </tr>

       		
           
 <?php
    }
?>
<h2>Skupna cena: <?=$sk_cena?></h2>
 


 </table>
 </body>

