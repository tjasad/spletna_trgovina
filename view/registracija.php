<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "registracijaPrijava.css" ?>">
</head>
<body>
<div>
<h1>Registracija</h1>
<h3>Prosimo, izpolnite vsa spodnja okna!</h3>
<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
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
    <label for="geslo"><b>Geslo</b></label>
    <input type="password" placeholder="Vnesite izbrano geslo" name="password" id = "geslo" required><br/>
    <label for="geslo2"><b>Vnovično geslo</b></label>
    <input type="password" placeholder="Ponovno vnesite izbrano geslo" name="password_again" id = "geslo2" required><br/>   
    <input type="submit" value="Registriraj se" class="registerbtn" />
  </div>
  <div>
   <p> Že imate ustvarjen račun? </p> <input type="submit" value="Prijavi se" class="signbtn" />
  </div>
  </form>
  
    <div>
        <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga">
            <input type="submit" value="DOMOV" class="signbtn" >
        </form>
    </div>

  
  </div>
</body>
</html>

