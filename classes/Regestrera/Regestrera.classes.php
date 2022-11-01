<?php
    declare(strict_types=1);
    class Registrera extends Dbh {

        protected function setUser(string $name, string $Lösenord, string $LösenordIgen, string $Mail) {

            # Kollar om lösenorden matchar varandra
            if ($Lösenord != $LösenordIgen) {
                header('location: ../../Registrera.php?error=passwordNotMatch');
                exit();
            }

            # hash lösenord
            $hashLösenord = password_hash($Lösenord, PASSWORD_DEFAULT);

            # Gör en prepared statement
            ## Kollade in w3schools om prepared statement https://www.w3schools.com/php/php_mysql_prepared_statements.asp

            $stmt = $this->connect()->prepare('INSERT INTO User (name, "password", mail) VALUES (:Name, :Lösenord, :Mail)');
            // $stmt = $this->connect()->prepare("INSERT INTO kund (Förnamn, Efternamn, Lösenord, Mail, ProfilBild) VALUES (Förnamn = ?, Efternamn = ?, Lösenord = ?, Mail = ?, ProfilBild = ?)");

            # placerar in alla korkkorrekta värden i prepared statement
            // $stmt->bindValue(":Name", $name);
            // $stmt->bindValue(":Lösenord", $hashLösenord);
            // $stmt->bindValue(":Mail", $Mail);

            # $stmt->execute() return true / false
            if (!$stmt->execute(['Name' => $name, 'Lösenord' => $hashLösenord, 'Mail' => $Mail])) {
                $stmt = null;
                header('location: ../../Registrera.php?error=stmtMisslyckades');
                exit();
            }

        }

        protected function kontrolleraAnvändare($Mail) {
            $stmt = $this->connect()->prepare('SELECT id FROM kund WHERE Mail = :Mail;');
            $stmt->bindParam(':Mail', $Mail);
        }
    }
?>
