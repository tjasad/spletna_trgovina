<!DOCTYPE html>
<h1>Vsi artikli</h1>

<p>[
<a href="<?= BASE_URL . "seminarska_naloga" ?>">Domov</a> |
<a href="<?= BASE_URL . "seminarska_naloga/artikli" ?>">Vsi artikli</a> |
<a href="<?= BASE_URL . "seminarska_naloga/artikli-add" ?>">Dodaj artikel</a>
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
          <td>         
          <a href='http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/artikli-edit?id=<?=$id?>'>Uredi</a>
          </td>
    </tr>

       		
           
 <?php
    }
?>
 


 </table>
 </body>

