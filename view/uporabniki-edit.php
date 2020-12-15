<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "registracijaPrijava.css" ?>">
</head>
<body>

<!--Navigation bar-->
<?php include 'navigation-bar.php';?>

<div>
    <h1>Uredi profil</h1>
    <form action="<?= BASE_URL . "seminarska_naloga/uredi_profil" ?>" method="post">

        <div>
            <input type="hidden" name="id" value="<?= $user["costumer_id"] ?>"/>
            <label for="ime"><b>Ime</b></label>
            <input type="text" placeholder="Vnesite ime" name="name" id="ime" value="<?= $user["name"] ?>"
                   required><br/>
            <label for="priimek"><b>Priimek</b></label>
            <input type="text" placeholder="Vnesite priimek" name="surname" id="priimek" value="<?= $user["surname"] ?>"
                   required><br/>
            <label for="naslov"><b>Naslov</b></label>
            <input type="text" placeholder="Vnesite ulico" name="street" id="naslov" value="<?= $user["street"] ?>"
                   required>
            <input type="text" placeholder="Vnesite hišno številko" name="house_number"
                   value="<?= $user["house_number"] ?>" required>
            <input type="text" placeholder="Vnesite pošto" name="post" value="<?= $user["post"] ?>" required>
            <input type="text" placeholder="Vnesite poštno številko" name="post_number"
                   value="<?= $user["post_number"] ?>"/><br/>
            <label for="email"><b>Epošta</b></label>
            <input type="email" placeholder="Vnesite epoštni naslov" name="email" id="email"
                   value="<?= $user["email"] ?>"/><br/>
            <label for="geslo"><b>Geslo</b></label>
            <input type="password" placeholder="Vnesite geslo" name="password" id="geslo"
                   value="<?= $user["password"] ?>" required><br/>
            <input type="submit" value="Posodobi" class="registerbtn"/>
        </div>

    </form>

    <!-- izbriši uporabnika -->
    <form action="<?= BASE_URL . "seminarska_naloga/zbrisi_profil" ?>" method="post">
        <input type="hidden" name="id" value="<?= $user["costumer_id"] ?>"/>
        <label><b>Izbriši profil?</b></label><br>
        <input type="submit" value="Izbriši" class="registerbtn">
    </form>
    <div>
        <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga">
            <input type="submit" value="DOMOV" class="signbtn">
        </form>
    </div>

</div>
</body>
</html>