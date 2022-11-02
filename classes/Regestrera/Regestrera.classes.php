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

            $stmt = $this->getConnectionMySQL()->prepare("INSERT INTO User (mail, password, name) VALUES (?, ?, ?)");
            // $stmt = $this->getConnectionPDO()->prepare("INSERT INTO User (mail, password, name) VALUES (:Mail, :Lösenord, :Name)");
            // $stmt = $this->getConnectionMySQL()->prepare("INSERT INTO kund (Förnamn, Efternamn, Lösenord, Mail, ProfilBild) VALUES (Förnamn = ?, Efternamn = ?, Lösenord = ?, Mail = ?, ProfilBild = ?)");

            # placerar in alla korkkorrekta värden i prepared statement
            // $stmt->bindParam(':Name', $name);
            // $stmt->bindParam(':Lösenord', $hashLösenord);
            // $stmt->bindParam(':Mail', $Mail);

            // $stmt->bind_param("sss",$Mail, $hashLösenord, $name);

            $data = [$Mail, $hashLösenord, $name ];
            $stmt->

            # $stmt->execute() return true / false
            if ( !$stmt->execute($data) ) {
                $stmt = null;
                header('location: ../../Registrera.php?error=stmtMisslyckades');
                exit();
            }

           $stmt->close();
        }

        protected function kontrolleraAnvändare($Mail) {
            $stmt = $this->getConnectionMySQL()->prepare('SELECT id FROM kund WHERE Mail = :Mail;');
            // $stmt->bindParam(':Mail', $Mail);
            $stmt->bind_param("sss", $Mail);
        }
    }
?>
