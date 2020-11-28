<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "registracijaPrijava.css" ?>">
</head>
<body>
<div>
<h1>Urejanje/brisanje artikla</h1>
<form action="<?= BASE_URL . "seminarska_naloga/artikli-edit" ?>" method="post">
  <div>
    <input type="hidden" name="id" value="<?= $articel["article_id"]?>" />
    <label for="article_id"><b>Id artikla</b></label>
    <input type="text" placeholder="Vnesite id artikla" name="article_id" id="article_id" value="<?= $articel["article_id"] ?>" required><br/>
    <label for="article_name"><b>Naziv artikla</b></label>
    <input type="text" placeholder="Vnesite naziv artikla" name="article_name" id = "article_name" value="<?= $articel["article_name"] ?>" required><br/>
    <label for="article_price"><b>Cena artikla</b></label>
    <input type="text" placeholder="Vnesite ceno artikla" name="article_price" id = "article_price"  value="<?= $articel["article_price"] ?>" required>   
    <label for="article_description"><b>Opis artikla</b></label>
    <input type="text" placeholder="Vnesite opis artikla" name="article_description" id = "article_description"  value="<?= $articel["article_description"] ?>" required><br/>
   
    <label for="article_status"><b>Status artikla</b></label>
     <select>
     <option value="0">Ne aktiven</option> 
    <option value="1">Aktiven</option>       
  	</select>  
    
    <input type="submit" value="Posodobi" class="registerbtn" />    
  </div>
  
  </form>

    <!-- izbriši artikel -->
    <form action="<?= BASE_URL . "seminarska_naloga/zbrisi_artikel" ?>" method="post">
        <input type="hidden" name="id" value="<?= $articel["article_id"] ?>"/>
        <label><b>Izbriši profil?</b></label><br>
        <input type="submit" value="Izbriši" class="registerbtn" >
    </form>
  
    <div>
        <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga">
            <input type="submit" value="DOMOV" class="signbtn" >
        </form>
    </div>

  
  </div>
</body>
</html>


