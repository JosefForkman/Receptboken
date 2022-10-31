<?php
    class Dbh {
        protected function connect () {
            try {
                # Skapar variablar för DB
                $servername = "localhost";
                $username = "Café";
                $password = "v/lQ)KQL0rGkxz.A";
                $dbname = "café";
                
                # Starar en PDO anslutning till DB
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

                return $conn;
            } catch (PDOException $e) {
                echo "MySQL misslyckades att ansluta sig: " . $e->getMessage();
                die();
            }
        }
    }
?>