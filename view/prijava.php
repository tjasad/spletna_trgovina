<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "registracijaPrijava.css" ?>">
</head>
<body>
<div>
<h1>Prijava</h1>
<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
  <div>
    <input type="hidden" name="do" value="add" />
    <label for="email"><b>Epošta</b></label>
    <input type="email" placeholder="Vnesite epoštni naslov" name="email" id="email" /><br/>
    <label for="geslo"><b>Geslo</b></label>
    <input type="password" placeholder="Vnesite geslo" name="password" id = "geslo" required><br/>
    <input type="submit" value="Prijavi se" class="registerbtn" />
  </div>
  </form>
  </div>
</body>
</html>

