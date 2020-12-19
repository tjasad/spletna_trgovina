<p>[
    <?php
    if (!isset($_SESSION["user"])){ ?>
      <a href="<?= BASE_URL . "seminarska_naloga/registracija" ?>">Registracija</a> |
      <?php
    }
    ?>
    <!--Anonimni uporabnik|Stranka|Prodajalec|Admin-->
    <a href="<?= BASE_URL . "seminarska_naloga/trgovina" ?>">Domov</a> |    
    <a href="<?= BASE_URL . "seminarska_naloga/prijava" ?>">Prijava uslužbenci</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/prijava-stranka" ?>">Prijava uporabniki</a> |
    <!--Stranka|Prodajalec|Admin-->
    <?php
      if (isset($_SESSION["user"])) {?>
        <a href="<?= BASE_URL . "seminarska_naloga/uredi_profil" ?>">Uredi profil</a> |
        <a href="<?= BASE_URL . "seminarska_naloga/odjava" ?>">Odjava</a> |
        <?php
        if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'stranka')){
        ?>
          <a href="<?= BASE_URL . "seminarska_naloga/vsa_narocila" ?>">Pretekla naročila</a> |
        <?php }
    } ?>
    <!--Prodajalec|Admin-->
    <?php
      if (isset($_SESSION["role"]) && ($_SESSION["role"] == 'prodajalec' || $_SESSION["role"] == 'administrator')) {?>
    <a href="<?= BASE_URL . "seminarska_naloga/registracija" ?>">Dodaj stranko</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/ne-obdelana_narocila" ?>">neobdelana naročila</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/potrjena_narocila" ?>">potrjena naročila</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/artikli" ?>">artikli</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/artikli-add" ?>">dodaj artikel</a> |
    <a href="<?= BASE_URL . "seminarska_naloga/stranke" ?>">stranke</a> |
    <?php } ?>
    <!--Admin-->
    <?php
      if (isset($_SESSION["role"]) && $_SESSION["role"] == 'administrator') {?>
    <a href="<?= BASE_URL . "seminarska_naloga/prodajalci" ?>">prodajalci</a>
    <?php } ?>
    ]</p>



