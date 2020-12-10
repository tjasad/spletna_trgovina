<!DOCTYPE html>
<?php
$url = filter_input(INPUT_SERVER, "PHP_SELF", FILTER_SANITIZE_SPECIAL_CHARS);
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD", FILTER_SANITIZE_SPECIAL_CHARS);
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="UTF-8" />
        <title>Košarica</title>
        <p>[
        <a href="<?= BASE_URL . "seminarska_naloga" ?>">Domov</a>
        ]</p>
    </head>
    <body>
        <h1>Košarica</h1>

        <div id="main">
        <?php
        foreach ($articles as $key => $row) {        
            $id = $row["article_id"];
            $name = $row["article_name"];
            $price = $row["article_price"];
            $description = $row["article_description"];
            $status = $row["article_status"];            
            ?>
                <div class="book">
                    <form action="<?= $url ?>" method="post">
                        <input type="hidden" name="do" value="add_into_cart" />
                        <input type="hidden" name="id" value="<?= $id ?>" />
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
                            <button type="submit">V košarico</button>
                    </form>
                </div>
        <?php } ?>

        </div>

        <div class="cart">
            <h3>Košarica</h3>
            <p><?php
            if (isset($_SESSION["cart"])) {
               # var_dump($_SESSION["cart"]);        
               # print($_SESSION["cart"][$knjiga->id]);
               #print_r($_SESSION["cart"]);
              $koncna_cena=0;
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
                          
                           
                           #print($knjiga->naslov);
                          # print ", ";
                          # print($knjiga->avtor);
                           #print($knjiga->cena * $value);
                           $koncna_cena += ($price * $value);                          
                           ?>
                           <form action="<?= $url ?>" method="post">
                                <input type="hidden" name="do" value="update_cart" />
                                <input type="hidden" name="id" value="<?= $id ?>" />
                               <p><input type="number" class="short_input" name="kolicina" value="<?= $my_val ?>"/> </p>
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
                               <p><button type="submit">Posodobi</button></p>
                                  
                                     
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
                        <input type="hidden" name="do" value="purge_cart" />
                            <button type="submit">Izprazni košarico</button>
                <?php
            } else {
                echo "Košara je prazna.";
            }            
            ?> </p>
        </div>
    </body>
</html>