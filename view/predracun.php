<!DOCTYPE html>
<?php
$url = filter_input(INPUT_SERVER, "PHP_SELF", FILTER_SANITIZE_SPECIAL_CHARS);
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD", FILTER_SANITIZE_SPECIAL_CHARS);
?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "tabela.css" ?>">
        <meta charset="UTF-8" />
        <title>Predračun</title>
        <p>[
        <a href="<?= BASE_URL . "seminarska_naloga" ?>">Domov</a>][
        <a href="<?= BASE_URL . "seminarska_naloga/košarica" ?>">Nazaj na nakupovanje</a>
        ]</p>
    </head>
    <body>
    <div class="cart">
            <h3>Predračun</h3>            
            <table style="width:100%">
            <p><?php
            if (isset($_SESSION["cart"])) {
               # var_dump($_SESSION["cart"]);        
               # print($_SESSION["cart"][$knjiga->id]);
               #print_r($_SESSION["cart"]);
              $koncna_cena=0;
              $check = -1;
               foreach ($_SESSION["cart"] as $key=>$value) {
                   $my_val=$value;
                
                  # print($key); echo " ";
                   #print ($my_val);
                   foreach ($articles as $key2 => $row){
                        $id = $row["article_id"];
                        $name = $row["article_name"];
                        $price = $row["article_price"];
                        $description = $row["article_description"];
                        $status = $row["article_status"];
                       
                       
                       if ($row['article_id'] == $key){
                           if ($check == -1){
                               ?>
                            <tr>
                            <th>Izbrana količina</th>
                            <th>Id_artikla</th>
                            <th>Ime artikla</th>
                            <th>Cena artikla</th>
                            <th>Opis artikla</th>
                            <th>Status artikla</th>
                            </tr>
                            <?php
                            $check = 1;
                           }
                          
                           
                           #print($knjiga->naslov);
                          # print ", ";
                          # print($knjiga->avtor);
                           #print($knjiga->cena * $value);
                           $koncna_cena += ($price * $value);                          
                           ?>
                           <form action="<?= $url ?>" method="post">
                           <tr>
                                <input type="hidden" name="do" value="update_cart" />
                                <input type="hidden" name="id" value="<?= $id ?>" />
                                <td><?= $my_val ?></td>
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
                                
                                  
                           </tr>    
                           </form>
                           <?php
                           
                       }
                   }
                   echo " </br>";
                  
                   
               }
                #print "Total: ";
                #print $koncna_cena;
                #print " EUR";
                ?>
                            <p>Total: <b> <?=$koncna_cena ?> EUR</b></p>       
                <?php
                echo " </br>";
                ?>
                 <form action="<?= $url ?>" method="post">
                        <input type="hidden" name="do" value="save_order" />
                            <button type="submit">Potrdi naročilo</button>
                </form>
                <?php
            } else {
                echo "Naročilo je prazno.";
            }            
            ?> </p>
            </table>
        </div>              
    </body>
</html>