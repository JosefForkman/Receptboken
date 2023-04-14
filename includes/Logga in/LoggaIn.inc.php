<?php
    declare(strict_types=1);

    require dirname(__DIR__, 2) . "/vendor/autoload.php";
    use Josef\Receptboken\http\http;

    if (isset($_POST["submit"])) {

        # Tar data från LoggaIn formuläret
        $Mail = $_POST["mail"];
        $Lösenord = $_POST["pass"];

        # Lägger till class i detta dokument
        require("../../classes/dbh.classes.php");
        require("../../classes/User/User.classes.php");
        require("../../classes/User/User-contr.classes.php");

        # Skapar användare
        $LoggaIn = new userContr(password: $Lösenord, Mail: $Mail);

        # Error plus loggar in användaren
        $LoggaIn->LoggaInAnvändare();

        # Om allt gick bra hamnar användaren på tack sidan
        http::redirect('index.php');
    }

    http::redirect('index.php');
?>
