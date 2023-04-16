<?php

namespace Josef\Receptboken\vallidation;

use Josef\Receptboken\Databas\Dbh;
use Josef\Receptboken\http\http;

class DB extends Dbh
{
    public function kontrolleraAnvändare (string $Mail):bool {
        $stmt = $this->connect()->prepare("SELECT id From User where mail = :mail");
        $stmt->bindParam(":mail", $Mail);

        # $stmt->execute() return true / false
        if (!$stmt->execute()) {
            # Kolla upp om det behövs
            // $stmt->close();

            http::redirect('Registrera.php', ['stmtMisslyckades']);
        }

        # Hämtar användare
        $user = $stmt->fetch();

        $conn = null;

        # Använder två "!" för att vara säker att man alltid kommer få en bool
        return !!$user;

        # Om inte den övre funkar gå till baka till denna und er
        // return count($user) > 0 ? false : true;
    }
}
