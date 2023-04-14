<?php
    declare(strict_types=1);
    namespace Josef\Receptboken\user;


use Josef\Receptboken\Databas\Dbh;
use Josef\Receptboken\http\http;
use Josef\Receptboken\vallidation\input;

    class signIn extends Dbh {
        private string $name;
        private string $password;
        private string $passwordAgain;
        private string $Mail;

        # Skapar constructor i class
        public function __construct(string $name = '', string $password = '', string $passwordAgain = '', string $Mail = '') {
            $this->name = $name;
            $this->password = $password;
            $this->passwordAgain = $passwordAgain;
            $this->Mail = $Mail;
        }

        public function signUp()
        {
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
                $error[] = 'lösesnordMatcharInte';
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
            $conn = $this->connect();
            $stmt = $conn->prepare("INSERT INTO User (mail, password, name) VALUES (:mail, :password, :name)");

            $Mail = strtolower($this->Mail);

            # Bind parameter till SQL fråga
            $stmt->bindParam(":mail", $Mail);
            $stmt->bindParam(":password", $hashPassword);
            $stmt->bindParam(":name", $this->name);

            # $stmt->execute() return true / false
            if ( !$stmt->execute() ) {
                $stmt = null;
                header('location: ../../Registrera.php?error=stmtMisslyckades');
                exit();
            }
        }
    }
?>
