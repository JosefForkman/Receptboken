<?php
    declare(strict_types=1);
    class LoggaIn extends Dbh {

        protected function getUser(string $Password, string $Mail) {
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

            # Gör en prepared statement
            ## Kollade in w3schools om prepared statement https://www.w3schools.com/php/php_mysql_prepared_statements.asp
            $stmt = $conn->prepare("SELECT * FROM User Where mail = ?");
            $Mail = strtolower($Mail);
            $stmt->bind_param("s", $Mail);

            # $stmt->execute() return true / false
            if ( !$stmt->execute() ) {
                $stmt = null;
                header('location: ../../LogaIn.php?error=stmtMisslyckades');
                exit();
            }

            # Hämtar användare
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            var_dump($user);

            # kontrollera Password (true om match annars false)
            $checkPassword = password_verify($Password, $user['password']);

            if ($checkPassword) {
               # Startar session och lägger till användare i session
               session_start();
               $_SESSION["AnvändareId"] = $user['id'];
               $_SESSION["AnvändareNamn"] = $user['name'];

               # Nollställer $conn variabeln
               $conn->close();
            } else {
                header('location: ../../LogaIn.php?error=FelLösenord');

                # Nollställer $conn variabeln och avslutar koden
                $stmt->close();
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

            $stmt = $conn->prepare('SELECT id FROM User WHERE Mail = ?;');
            $stmt->bind_param("s", $Mail);

            # $stmt->execute() return true / false
            if (!$stmt->execute()) {
                $stmt->close();

                header('location: ../../LogaIn.php?error=stmtMisslyckades');
                exit();
            }

            # $stmt->num_rows return nummer av hittade i DB
            $stmt->store_result();
            return $stmt->num_rows > 0 ? false : true;

            $conn->close();
        }
    }
