<?php
    declare(strict_types=1);

    class User extends Dbh{

        # Registrera User
        protected function insertUser(string $name, string $password, string $passwordAgain, string $Mail) {
            # Ansluter till DB
            $conn = $this->connect();

            # Kollar om lösenorden matchar varandra
            if ($password != $passwordAgain) {
                header('location: ../../Registrera.php?error=passwordNotMatch');
                exit();
            }

            # Kollar om lösenorden matchar varandra
            if ($password != $passwordAgain) {
                header('location: ../../Registrera.php?error=passwordNotMatch');
                exit();
            }

            # hash lösenord
            ## https://www.php.net/manual/en/function.password-hash.php
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            # Gör en prepared statement
            ## Kollade in w3schools om prepared statement https://www.w3schools.com/php/php_mysql_prepared_statements.asp
            $stmt = $conn->prepare("INSERT INTO User (mail, password, name) VALUES (:mail, :password, :name)");

            $Mail = strtolower($Mail);

            # Bind parameter till SQL fråga
            $stmt->bindParam(":mail", $Mail);
            $stmt->bindParam(":password", $hashPassword);
            $stmt->bindParam(":name", $name);

            # $stmt->execute() return true / false
            if ( !$stmt->execute() ) {
                $stmt = null;
                header('location: ../../Registrera.php?error=stmtMisslyckades');
                exit();
            }
        }

        # Login User
        protected function getUser(string $Password, string $Mail) {
            # Gör en prepared statement
            ## Kollade in w3schools om prepared statement https://www.w3schools.com/php/php_mysql_prepared_statements.asp
            $conn = $this->connect();
            $stmt = $conn->prepare("SELECT * FROM User Where mail = :mail");
            $stmt->bindParam(":mail", $Mail);

            # $stmt->execute() return true / false
            if ( !$stmt->execute() ) {
                $stmt = null;
                header('location: ../../LogaIn.php?error=stmtMisslyckades');
                exit();
            }

            # Hämtar användare
            $user = $stmt->fetch(pdo::FETCH_ASSOC);

            # kontrollera Password (true om match annars false)
            $checkPassword = password_verify($Password, $user['password']);

            if ($checkPassword) {
               # Startar session och lägger till användare i session
               session_start();
               $_SESSION["AnvändareId"] = $user['id'];
               $_SESSION["AnvändareNamn"] = $user['name'];

               # Nollställer $conn variabeln
               $conn = null;
            } else {
                header('location: ../../LogaIn.php?error=FelLösenord');

                # Nollställer $conn variabeln och avslutar koden
                $conn = null;
                exit();
            }
            $conn = null;
        }

        # Kollar om det finna en användare med specifik mail
        protected function kontrolleraAnvändare($Mail): bool {
            # DB anslutning
            $conn = $this->connect();

            $stmt = $conn->prepare("SELECT id FROM User WHERE Mail = :mail;");
            $stmt->bindParam(":mail", $Mail);

            # $stmt->execute() return true / false
            if (!$stmt->execute()) {
                # Kolla upp om det behövs
                // $stmt->close();

                header('location: ../../Registrera.php?error=stmtMisslyckades');
                exit();
            }

            # Hämtar användare
            $user = $stmt->fetch(pdo::FETCH_ASSOC);

            $conn = null;

            # Använder två "!" för att vara säker att man alltid kommer få en bool
            return !!$user;

            # Om inte den övre funkar gå till baka till denna und er
            // return count($user) > 0 ? false : true;
        }
    }
?>
