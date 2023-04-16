<?php
declare(strict_types=1);

namespace Josef\Receptboken\user;


use Josef\Receptboken\Databas\Dbh;
use Josef\Receptboken\http\http;
use Josef\Receptboken\vallidation\DB;
use Josef\Receptboken\vallidation\input;

class signUp extends Dbh
{
    private string $name;
    private string $password;
    private string $passwordAgain;
    private string $Mail;

    # Skapar constructor i class
    public function __construct(string $name = '', string $password = '', string $passwordAgain = '', string $Mail = '')
    {
        $this->name = $name;
        $this->password = $password;
        $this->passwordAgain = $passwordAgain;
        $this->Mail = $Mail;
    }

    public function signUp(): array
    {
        $kontrollDbValidering = new DB();
        $error = [];
        if (
            input::empty($this->name) &&
            input::empty($this->password) &&
            input::empty($this->passwordAgain) &&
            input::empty($this->Mail
            )) {
            http::redirect('Registrera.php', ['error' => 'tomInput']);
        }

        if (!input::matchName($this->name)) {
            $error[] = 'NamnInkorrekt';
        }

        if (!input::matchMail($this->Mail)) {
            $error[] = 'MailInkorrekt';
        }

        if (!input::matchPassword($this->password, $this->passwordAgain)) {
            $error[] = 'lösenordMatcharInte';
        }
        if (!$kontrollDbValidering->kontrolleraAnvändare($this->Mail)) {
            $error[] = 'användareFinnsRedan';
        }


        # Om det finns ett error skicka användaren tillbaka till Registrera sidan
        if (!empty($error)) {
            http::redirect('Registrera.php', $error);
        }

        # hash lösenord
        ## https://www.php.net/manual/en/function.password-hash.php
        $hashPassword = password_hash($this->password, PASSWORD_DEFAULT);

        # Gör en prepared statement
        ## Kollade in w3schools om prepared statement https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $stmt = $this->connect()->prepare("INSERT INTO User (mail, password, name) VALUES (:mail, :password, :name)");

        $Mail = strtolower($this->Mail);

        # Bind parameter till SQL fråga
        $stmt->bindParam(":mail", $Mail);
        $stmt->bindParam(":password", $hashPassword);
        $stmt->bindParam(":name", $this->name);


        # $stmt->execute() return true / false
        if (!$stmt->execute()) {
            $stmt = null;

            http::redirect('Registrera.php', ['stmtMisslyckades']);
        }

        $stmtUser = $this->connect()->prepare('SELECT * FROM User where id :id');

        # Få idet från senaste SQL query (Kanske inte fungerar)
        $insertedId = $this->connect()->lastInsertId();

        $stmtUser->bindParam(":id", $insertedId);

        # $stmt->execute() return true / false
        if (!$stmt->execute()) {
            $stmt = null;

            http::redirect('Registrera.php', ['stmtMisslyckades']);
        }

        return $stmtUser->fetch();
    }
}
