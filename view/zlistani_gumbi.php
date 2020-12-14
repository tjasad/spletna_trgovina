<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "registracijaPrijava.css" ?>">
</head>
<body>

<h3><b>(tudi stranka, prodajalec, admin) Splošen view: </b>
    <h3><br>
        <ul>
            <li>
                <div>
                    <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/registracija">
                        <input type="submit" value="Registracija" class="signbtn">
                    </form>
                </div>
            </li>
            <li>
                <div>
                    <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/prijava">
                        <input type="submit" value="Prijava" class="signbtn">
                    </form>
                </div>
            </li>
            <li>
                <div>
                    <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/trgovina">
                        <input type="submit" value="Trgovina" class="signbtn">
                    </form>
                </div>
            </li>
        </ul>


        <h3><b>(tudi prodajalec, admin) Stranka view: </b>
            <h3><br>
                <ul>
                    <li>
                        <div>
                            <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/uredi_profil">
                                <input type="submit" value="Uredi profil" class="signbtn">
                            </form>
                        </div>
                    </li>
                    <li>
                        <div>
                            <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/trgovina">
                                <input type="submit" value="Trgovina" class="signbtn">
                            </form>
                        </div>
                    </li>
                </ul>

                <h3><b>(tudi admin)Prodajalec view: </b>
                    <h3><br>

                        <ul>
                            <li>NAROČILA<br>
                                <div>
                                    <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/ne-obdelana_narocila">
                                        <input type="submit" value="Ne-obdelana narocila" class="signbtn">
                                    </form>
                                </div>
                            </li>
                            <li>ARTIKLI<br>
                                <div>
                                    <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/artikli">
                                        <input type="submit" value="Artikli" class="signbtn">
                                    </form>
                                </div>
                                <div>
                                    <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/artikli-add">
                                        <input type="submit" value="Dodaj artiklel" class="signbtn">
                                    </form>
                                </div>
                            </li>
                            <li>STRANKE<br>
                                <div>
                                    <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/stranke">
                                        <input type="submit" value="Stranke" class="signbtn">
                                    </form>
                                </div>
                            </li>

                        </ul>

                        <h3><b>Administrator view: </b>
                            <h3><br>
                                <ul>
                                    <li>
                                        <div>
                                            <form action="http://localhost/netbeans/seminarska_naloga/index.php/seminarska_naloga/prodajalci">
                                                <input type="submit" value="Prodajalci" class="signbtn">
                                            </form>
                                        </div>
                                    </li>
                                </ul>

                                <body>
</html>