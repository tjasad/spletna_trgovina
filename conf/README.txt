Navodila za zagon aplikacije

1. Najprej se naložijo podatki za podatkovno bazo. Ti se nahajajo v datoteki /sql/trgovina.sql

        mysql -u root -p NetBeansProjects/spletna_trgovina/sql/trgovina.sql

2. Administratorja in testne uporabnike se doda preko url: http://localhost/netbeans/spletna_trgovina/index.php/seminarska_naloga/dodajanjeUporabnikov

Emaili in gesla različnih tipov uporabnikov:

Administrator:
-> gmail: admin@gmail.com
-> geslo: admin

Prodajalec:
-> gmail: prodajalec@gmail.com
-> geslo: prodajalec

Stranka:
-> gmail: stranka@gmail.com
-> geslo: stranka

Pri prodajalcu in administratorju poteka overjanje tudi preko certifikatov.
Navodila za certifikate se nahajajo v certs/navodila.txt
