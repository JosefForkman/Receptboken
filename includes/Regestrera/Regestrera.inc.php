<?php
    declare(strict_types=1);

    require dirname(__DIR__, 2) . "/vendor/autoload.php";
    use Josef\Receptboken\http\http;

    if (isset($_POST["submit"])) {

        # Tar data från Registrerings formuläret
        $name = $_POST['name'];
        $Lösenord = $_POST["pass"];
        $LösenordIgen = $_POST["passigen"];
        $Mail = $_POST["mail"];

        # Lägger till class i detta dokument
        require("../../classes/dbh.classes.php") ;
        require("../../classes/User/User.classes.php");
        require("../../classes/User/User-contr.classes.php");

        # Skapar användare
        $registrera = new userContr($name, $Lösenord, $LösenordIgen, $Mail);

        $registrera->registreraAnvändare();

        # Om allt gick bra hamnar användaren på login sidan
        http::redirect('LogaIn.php');
    }

    # Om användaren försöker komma till denna fil så blir den tillbaka skickad till hem
    http::redirect('index.php');
?>
