<?php
    class Dbh {
        public function connect () {
            try {
                # Skapar variablar för DB
                $servername = "localhost";
                $dbUsername = "ReceptUser";
                $dbPassword = "ReceptPassword";
                $dbName = "ReceptDB";

                # Skapar anslutning till DB
                $conn = new PDO("mysql:host=$servername;dbname=$dbName", $dbUsername, $dbPassword);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $conn;
            } catch(PDOException $e) {
                echo "MySQL misslyckades att ansluta sig: " . $e->getMessage();
                die();
            }
        }
    }
?>
