<?php
    declare(strict_types=1);
    class Registrera extends Dbh {

        protected function setUser(string $name, string $Lösenord, string $LösenordIgen, string $Mail) {
            # Skapar variablar för DB
            $servername = "localhost";
            $dbUsername = "ReceptUser";
            $dbPassword = "ReceptPassword";
            $dbName = "ReceptDB";

            # Skapar anslutning till DB
            $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            # Kollar om lösenorden matchar varandra
            if ($Lösenord != $LösenordIgen) {
                header('location: ../../Registrera.php?error=passwordNotMatch');
                exit();
            }

            # hash lösenord
            ## https://www.php.net/manual/en/function.password-hash.php
            $hashLösenord = password_hash($Lösenord, PASSWORD_DEFAULT);

            # Gör en prepared statement
            ## Kollade in w3schools om prepared statement https://www.w3schools.com/php/php_mysql_prepared_statements.asp

            $stmt = $conn->prepare("INSERT INTO User (mail, password, name) VALUES (?, ?, ?)");

            $stmt->bind_param("sss", strtolower($Mail), $hashLösenord, $name);

            # $stmt->execute() return true / false
            if ( !$stmt->execute() ) {
                $stmt = null;
                header('location: ../../Registrera.php?error=stmtMisslyckades');
                exit();
            }

           $stmt->close();
        }

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
