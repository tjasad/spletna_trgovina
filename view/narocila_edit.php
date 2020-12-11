<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "registracijaPrijava.css" ?>">
</head>
<body>
<div>
<h1>Urejanje naročila</h1>
<form action="<?= BASE_URL . "seminarska_naloga/ne_obdelana_narocila-edit" ?>" method="post">
  <div>
    <input type="hidden" name="id" value="<?= $articel["order_id"]?>" />
    <label for="order_id"><b>Id naročila</b></label>
    <input type="text" placeholder="Vnesite id naročila" name="order_id" id="order_id" value="<?= $articel["order_id"] ?>" required><br/>
    <label for="article_name"><b>Id stranke</b></label>
    <input type="text" placeholder="Vnesite id stranke" name="costumer_id" id = "costumer_id" value="<?= $articel["costumer_id"] ?>" required><br/>
    <label for="article_price"><b>Skupna cena</b></label>
    <input type="text" placeholder="Vnesite skupno ceno" name="total_price" id = "total_price"  value="<?= $articel["total_price"] ?>" required>   
    <label for="order_status"><b>Status naročila (-1 == stoniran, 0 == preklican, 1 == potrjen, 2 == oddano(neobdelano))</b></label>
    <input type="text" placeholder="Vnesite status naročila" name="order_status" id = "order_status"  value="<?= $articel["order_status"] ?>" required><br/>
          
    <input type="submit" value="Posodobi" class="registerbtn" />    
  </div>
  
  </form>

    <!-- izbriši naročilo -->
    <!--<form action="<?#= BASE_URL . "seminarska_naloga/izbrisi_narocilo" #?>" method="post">
        <input type="hidden" name="id" value="<?= $articel["order_id"] ?>"/>
        <label><b>Izbriši naročilo?</b></label><br>
        <input type="submit" value="Izbriši" class="registerbtn" >
    </form> -->

    <!-- postavke naročila -->
    <form action="<?= BASE_URL . "seminarska_naloga/uredi_kolicino" ?>" method="post">
        <input type="hidden" name="id" value="<?= $articel["order_id"] ?>"/>
        <label><b>Preglej postavke naročila?</b></label><br>
        <input type="submit" value="Postavke naročila" class="registerbtn" >
    </form>
  
    <div>
        <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga">
            <input type="submit" value="DOMOV" class="signbtn" >
        </form>
    </div>

  
  </div>
</body>
</html>


