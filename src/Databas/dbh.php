<?php
    namespace Josef\Receptboken\Databas;
    declare(strict_types=1);

    require_once dirname(__DIR__, 2) . "/vendor/autoload.php";

    use PDO;
    use PDOException;
    use Symfony\Component\Dotenv\Dotenv;

    # Loading in .env
    $dotenv = new Dotenv();
    $dotenv->load(dirname(__DIR__, 2) . "/.env");

    class Dbh {
        public function connect ():PDO {
            try {
                # Skapar variablar för DB
                $servername = "localhost";
                $dbUsername = "ReceptUser";
                $dbPassword = "ReceptPassword";
                $dbName = "ReceptDB";

                # PDO settings
                $option = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ];

                # Skapar anslutning till DB
                $conn = new PDO("mysql:host=$servername;dbname=$dbName", $dbUsername, $dbPassword, $option);

                return $conn;
            } catch(PDOException $e) {
                echo "MySQL misslyckades att ansluta sig: " . $e->getMessage();
                die();
            }
        }
    }
?>
