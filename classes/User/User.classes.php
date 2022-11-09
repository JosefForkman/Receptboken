<?php
    declare(strict_types=1);

    class User extends Dbh {


        # Kollar om det finna en användare med specifik mail
        protected function kontrolleraAnvändare($Mail) {
            # Skapar variablar för DB
            $servername = "localhost";
            $dbUsername = "ReceptUser";
            $dbPassword = "ReceptPassword";
            $dbName = "ReceptDB";

            # Skapar anslutning till DB
            $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

            // Check connection
            if ($conn->connect_error) {
                die("Anslutningen misslyckades: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("SELECT id FROM User WHERE Mail = ?;");
            $stmt->bind_param("s", $Mail);

            # $stmt->execute() return true / false
            if (!$stmt->execute()) {
                $stmt->close();

                header('location: ../../Registrera.php?error=stmtMisslyckades');
                exit();
            }

            # $stmt->num_rows return nummer av hittade i DB
            $stmt->store_result();
            return $stmt->num_rows > 0 ? false : true;

            $conn->close();
        }
    }
?>
