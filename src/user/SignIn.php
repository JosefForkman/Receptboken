<?php
declare(strict_types=1);
namespace Josef\Receptboken\user;

use Josef\Receptboken\Databas\Dbh;
use Josef\Receptboken\http\http;
use Josef\Receptboken\vallidation\DB;
use Josef\Receptboken\vallidation\input;

class SignIn extends Dbh
{
    private string $password;
    private string $Mail;

    # Skapar constructor i class
    public function __construct(string $password = '', string $Mail = '')
    {
        $this->password = $password;
        $this->Mail = $Mail;
    }

    public function signIn (): array {
        $kontrollDbValidering = new DB();
        $error = [];

        if (
            input::empty($this->Mail) &&
            input::empty($this->password)
        ) {
            $error[] = 'tomInput';
        }
        if (!$kontrollDbValidering->kontrolleraAnvändare($this->Mail)) {
            $error[] = 'MailInkorrekt';
        }

        # Om det finns ett error skicka användaren tillbaka till Registrera sidan
        if (!empty($error)) {
            http::redirect('Registrera.php', $error);
        }

        # Gör en prepared statement
        ## Kollade in w3schools om prepared statement https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $stmt = $this->connect()->prepare("SELECT * FROM User Where mail = :mail");
        $stmt->bindParam(":mail", $Mail);

        # $stmt->execute() return true / false
        if ( !$stmt->execute() ) {
            $stmt = null;
            http::redirect('LogaIn.php', ['stmtMisslyckades']);
        }

        # Fetch the user from DB
        $user = $stmt->fetch();

        # kontrollera Password (true om match annars false)
        $checkPassword = password_verify($this->password, $user['password']);

        # Om Lösenord är fell
        if (!$checkPassword) {
            http::redirect('LogaIn.php', ['FelLösenord']);
        }

        return $user;
    }
}
