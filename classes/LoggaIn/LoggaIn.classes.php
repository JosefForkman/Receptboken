<?php
    declare(strict_types=1);
    class LoggaIn extends Dbh {

        protected function getUser(string $Lösenord, string $Mail) {
            # Skapar variablar för DB
            $servername = "localhost";
            $username = "ReceptUser";
            $password = "ReceptPassword";
            $dbname = "ReceptDB";

            # Skapar anslutning till DB
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            # Gör en prepared statement
            ## Kollade in w3schools om prepared statement https://www.w3schools.com/php/php_mysql_prepared_statements.asp
            $stmt = $conn->prepare("SELECT * FROM User Where mail = ?");
            $Mail = strtolower($Mail);
            $stmt->bind_param("s", $Mail);

            # $stmt->execute() return true / false
            if ( !$stmt->execute() ) {
                $stmt = null;
                header('location: ../../Registrera.php?error=stmtMisslyckades');
                exit();
            }
            $result = $stmt->get_result();
            $user = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $user;
        }

        protected function kontrolleraAnvändare($Mail) {
            $stmt = $this->getConnectionMySQL()->prepare('SELECT id FROM kund WHERE Mail = :Mail;');
            // $stmt->bindParam(':Mail', $Mail);
            $stmt->bind_param("sss", $Mail);
        }
    }
?>
