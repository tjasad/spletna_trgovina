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
            <input type="hidden" name="do" value="log_in_user"/>
            <label for="email"><b>Epošta</b></label>
            <input type="email" placeholder="Vnesite epoštni naslov" name="email" id="email"
                   value="<?= $email ?>"/><br/>
            <label for="geslo"><b>Geslo</b></label>
            <input type="password" placeholder="Vnesite geslo" name="password" id="geslo" required
                   value="<?= $password ?>"><br/>
            <input type="submit" value="Prijavi se" class="registerbtn"/>
        </div>
    </form>
    <form action="<?= BASE_URL . "seminarska_naloga/registracija" ?>">
        <p> Nimate računa?</p> <input type="submit" value="Registracija" class="signbtn"/>
    </form>
</div>

</body>
</html>