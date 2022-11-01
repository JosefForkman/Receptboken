<?php
    declare(strict_types=1);
    if (isset($_POST["submit"])) {
        # Tar data från Registrerings formuläret
        $name = $_POST['name'];
        $Lösenord = $_POST["pass"];
        $LösenordIgen = $_POST["passigen"];
        $Mail = $_POST["mail"];

        # Lägger till class i detta dokument
        require("../../classes/dbh.classes.php") ;
        require("../../classes/Regestrera/Regestrera.classes.php");
        require("../../classes/Regestrera/Regestrera-contr.classes.php");

        # Skapar användare
        $registrera = new RegistreraContr($name, $Lösenord, $LösenordIgen, $Mail);

        $registrera->registreraAnvändare();
    }
?>
