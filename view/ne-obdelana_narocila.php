<!DOCTYPE html>
<h1>Neobdelana naročila</h1>

<p>[
<a href="<?= BASE_URL . "seminarska_naloga" ?>">Domov</a> |
<a href="<?= BASE_URL . "seminarska_naloga/ne-obdelana_narocila" ?>">Neobdelana naročila</a>
]</p>

<head>
     <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "tabela.css" ?>">
</head>
<body>
<table style="width:100%">
    <tr>
    <th>Id_naročila</th>    
    <th>Skupna cena</th>
    <th>Id_stranka</th>
    <th>Status naročila</th>
    </tr>

<?php
   # var_dump($orders);
    foreach ($orders as $key => $row) {
        #$url = htmlspecialchars($_SERVER["PHP_SELF"]) . "?do=edit&id=" . $row["id"];
        $id = $row["order_id"];
        #$articles = $row["articles"];
        $t_price = $row["total_price"];
        $c_id = $row["costumer_id"];
        $status = $row["order_status"];

       # echo "<p><b>$date</b>. $text [<a href='$url'>Uredi</a>]";
       ?>
       <tr>
          <td><?=$id?></td>         
          <td><?=$t_price?>€</td>
          <td><?=$c_id?></td>
          <td><?php
                  if ($status=='-1'){
                        echo "Stoniran";
                  }else if ($status=='0'){
                        echo "Preklican";
                  }else if ($status == '1'){
                      echo 'Potrjen';
                  }else if ($status == '2'){
                      echo 'Oddan';
                  }
              ?>
          </td>
          <td>
          <a href='http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/ne_obdelana_narocila-edit?id=<?=$id?>'>Uredi</a>
          </td>
    </tr>

       		
           
 <?php
    }
?>
 


 </table>
 </body>

