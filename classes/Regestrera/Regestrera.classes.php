<?php
    class Registrera extends Dbh {
        
        protected function setUser($FörNamn, $EfterNamn, $Lösenord, $Mail) {
            $Profilbild = 'temp.png';
            # hash lösenord
            $hashLösenord = password_hash($Lösenord, PASSWORD_DEFAULT);

            # Gör en prepared statement
            ## Kollade in w3schools om prepared statement https://www.w3schools.com/php/php_mysql_prepared_statements.asp
            
            $stmt = $this->connect()->prepare("INSERT INTO kund (Förnamn, Efternamn, Lösenord, Mail, ProfilBild) VALUES (:Förnamn, :Efternamn, :Lösenord, :Mail, :ProfilBild)");
            // $stmt = $this->connect()->prepare("INSERT INTO kund (Förnamn, Efternamn, Lösenord, Mail, ProfilBild) VALUES (Förnamn = ?, Efternamn = ?, Lösenord = ?, Mail = ?, ProfilBild = ?)");

            # placerar in alla korkkorrekta värden i prepared statement
            $stmt->bindValue(":Förnamn", '%$FörNamn%');
            $stmt->bindValue(":Efternamn", '%$EfterNamn%');
            $stmt->bindValue(":Lösenord", '%$hashLösenord%');
            $stmt->bindValue(":Mail", '%$Mail%');
            $stmt->bindValue(":ProfilBild", '%$Profilbild%');

            # $stmt->execute() return true / false
            print_r(array(':Förnamn' =>  $FörNamn, ':Efternamn' => $EfterNamn, ':Lösenord' => $hashLösenord, ':Mail' => $Mail, ':ProfilBild' => 'temp.png'));
            if (!$stmt->execute()) {
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