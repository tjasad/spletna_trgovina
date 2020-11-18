<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "registracijaPrijava.css" ?>">
</head>
<body>
<div>
<h1>Uredi profil</h1>
<form action="<?= BASE_URL . "/urediProfil" ?>" method="post">
    
    <div>
        <input type="hidden" name="do" value="add" />
        <label for="ime"><b>Ime</b></label>
        <input type="text" placeholder="Vnesite ime" name="name" id="ime" required><br/>
        <label for="priimek"><b>Priimek</b></label>
        <input type="text" placeholder="Vnesite priimek" name="surname" id = "priimek" required><br/>
        <label for="naslov"><b>Naslov</b></label>
        <input type="text" placeholder="Vnesite ulico" name="street" id = "naslov" required>
        <input type="text" placeholder="Vnesite hišno številko" name="house_number" required>
        <input type="text" placeholder="Vnesite pošto" name="post" required>
        <input type="text" placeholder="Vnesite poštno številko" name="post_number" /><br/>
        <label for="email"><b>Epošta</b></label>
        <input type="email" placeholder="Vnesite epoštni naslov" name="email" id="email" /><br/>
        <label for="geslo"><b>Geslo</b></label>
        <input type="password" placeholder="Vnesite geslo" name="password" id = "geslo" required><br/>
        <input type="submit" value="Posodobi" class="registerbtn" />
    </div>
  
</form>
  
    <!-- izbriši uporabnika -->
    <form action="<?= BASE_URL . "/deleteUser" ?>" method="post">
        <input type="hidden" name="id"/>
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