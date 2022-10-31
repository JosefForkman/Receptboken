<?php
    if (isset($_POST["submit"])) {
        # Tar data från Registrerings formuläret
        $FörNamn = $_POST["Fnamn"];
        $EfterNamn = $_POST["Enamn"];
        $Lösenord = $_POST["pass"];
        $LösenordIgen = $_POST["passigen"];
        $Mail = $_POST["mail"];

        # Lägger till class i detta dokument
        include "../../classes/dbh.classes.php";
        include "../../classes/Regestrera/Regestrera.classes.php";
        include "../../classes/Regestrera/Regestrera-contr.classes.php";

        # Skapar användare 
        $registrera = new RegistreraContr($FörNamn, $EfterNamn, $Lösenord, $LösenordIgen, $Mail);

        $registrera->registreraAnvändare();
    }
?>