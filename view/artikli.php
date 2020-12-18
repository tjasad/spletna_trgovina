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

<h1>Vsi artikli</h1>

<?php
$directory = "/home/ep/NetBeansProjects/seminarska_naloga/slike";
$start_position = "/netbeans/seminarska_naloga/slike";

$files = array();
foreach (scandir($directory) as $file) {
    if ($file !== '.' && $file !== '..') {
        $files[] = $file;
    }
}
?>

<table style="width:100%">
    <tr>
        <th>Id_artikla</th>
        <th>Ime artikla</th>
        <th>Cena artikla</th>
        <th>Opis artikla</th>
        <th>Status artikla</th> 
        <th>Slike</th>       
    </tr>

    <?php
    # var_dump($articles); exit();
    foreach ($articles as $key => $row) {
        #$url = htmlspecialchars($_SERVER["PHP_SELF"]) . "?do=edit&id=" . $row["id"];
        $id = htmlspecialchars($row["article_id"]);
        $name = htmlspecialchars($row["article_name"]);
        $price = htmlspecialchars($row["article_price"]);
        $description = htmlspecialchars($row["article_description"]);
        $status = htmlspecialchars($row["article_status"]);

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
                      
            <?php
            $seznam=array();
            foreach($files as $a){
                if ($a == $name){
                    $nov_path = $directory.'/'.$a;
                    $slika_path = $start_position.'/'.$a;
                    foreach (scandir($nov_path) as $file) {
                        if ($file !== '.' && $file !== '..') {
                            $final_path = $nov_path.'/'.$file;
                            $slika_path2 = $slika_path.'/'.$file;
                            $seznam[]=$slika_path2;
                        }
                    }
                }
            }
            #var_dump($seznam);
            if (!empty($seznam)){ ?>
               <td>
            <?php                 
                foreach($seznam as $pic){
                    #print($pic);  print("     "); print($name); echo "<br>";      
            ?>
                 
                <img src="<?php echo $pic?>" width="90" height="130" >
                
            <?php
                }
            }
            ?>
            </td>
            <?php
            if (empty($seznam)){ ?>
            <td>
            <?php print("Ni slike"); ?>
            </td>
            <?php
            }
            ?>
                   
            <td>
                <a href='http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/artikli-edit?id=<?= $id ?>'>Uredi</a>
            </td>
        </tr>


        <?php
    }
    ?>


</table>
</body>

