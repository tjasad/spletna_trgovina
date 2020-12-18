<!DOCTYPE html>
<?php
if (!isset($_SERVER["HTTPS"])){
    $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("Location: " . $url);
}
?>
<html>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "registracijaPrijava.css" ?>">    
</head>
<body>
<?php
      if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'prodajalec' || $_SESSION["role"] == 'administrator')) {?>
        <!--Navigation bar-->
        <?php include 'navigation-bar.php';?>
<?php } ?>

<div>
<?php
      if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'prodajalec' || $_SESSION["role"] == 'administrator')) {?>
        <h1>Dodaj stranko</h1>
    <?php } else{?>
        <h1>Registracija</h1>
    <?php }?>

    <h3>Prosimo, izpolnite vsa spodnja okna!</h3>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <div>
            <input type="hidden" id="g-token" name="g-token"/>
            <input type="hidden" name="do" value="add"/>
            <label for="ime"><b>Ime</b></label>
            <input type="text" placeholder="Vnesite ime" name="name" id="ime" value="<?= $name ?>" required><br/>
            <label for="priimek"><b>Priimek</b></label>
            <input type="text" placeholder="Vnesite priimek" name="surname" id="priimek" value="<?= $surname ?>"
                   required><br/>
            <label for="naslov"><b>Naslov</b></label>
            <input type="text" placeholder="Vnesite ulico" name="street" id="naslov" value="<?= $street ?>" required>
            <input type="text" placeholder="Vnesite hišno številko" name="house_number" value="<?= $house_number ?>"
                   required>
            <input type="text" placeholder="Vnesite pošto" name="post" value="<?= $post ?>" required>
            <input type="text" placeholder="Vnesite poštno številko" name="post_number"
                   value="<?= $post_number ?>"/><br/>
            <label for="email"><b>Epošta</b></label>
            <input type="email" placeholder="Vnesite epoštni naslov" name="email" id="email"
                   value="<?= $email ?>"/><br/>
            <label for="geslo"><b>Geslo</b></label>
            <input type="password" placeholder="Vnesite izbrano geslo" name="password" id="geslo"
                   value="<?= $password ?>" required><br/> 
            <div class="g-recaptcha" data-sitekey="6LfreQsaAAAAADP7wkXXFCtkB0H_w6r8m_EYmhFm"></div>
            <br/>
           
            <!--<label for="geslo2"><b>Vnovično geslo</b></label>
            <input type="password" placeholder="Ponovno vnesite izbrano geslo" name="password_again" id = "geslo2" required><br/> -->
            <input type="submit" value="Registriraj se" class="registerbtn"/>
        </div>
        <div>
            <p> Že imate ustvarjen račun? </p> <input type="submit" value="Prijavi se" class="signbtn"/>
        </div>
    </form>

    <div>
        <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga">
            <input type="submit" value="Trgovina" class="signbtn">
        </form>
    </div>


</div>
<!--
<script src="https://www.google.com/recaptcha/api.js?render=6LftWQsaAAAAAHQfGnH1QoGzg4MphhYlRWHHBNnP"></script>
<script>    
        grecaptcha.ready(function() {
          grecaptcha.execute('6LftWQsaAAAAAHQfGnH1QoGzg4MphhYlRWHHBNnP', {action: 'submit'}).then(function(token) {
              // Add your logic to submit to your backend server here.
              document.getElementById("g-token").value = token;
          });
        });
      
</script>
-->
</body>
</html>


