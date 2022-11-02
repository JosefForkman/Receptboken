<?php
    declare(strict_types=1);
    if (isset($_POST["submit"])) {
        # Tar data från Registrerings formuläret
        $Mail = $_POST["mail"];
        $Lösenord = $_POST["pass"];

        # Lägger till class i detta dokument
        require("../../classes/dbh.classes.php");
        require("../../classes/LoggaIn/LoggaIn.classes.php");
        require("../../classes/LoggaIn/LoggaIn-contr.classes.php");

        # Skapar användare
        $LoggaIn = new LoggaInContr($Lösenord, $Mail);

        # Error plus loggar in användaren
        $LoggaIn->LoggaInAnvändare();

        # Om allt gick bra hamnar användaren på tack sidan
        header('location: ../../index.php?error=none');
    }
?>
