<?php
    declare(strict_types=1);

    require dirname(__DIR__, 2) . "/vendor/autoload.php";

    use Josef\Receptboken\http\http;

    class userContr extends User {
        private $name;
        private $password;
        private $passwordAgain;
        private $Mail;

        # Skapar constructor i class
        public function __construct(string $name = '', string $password = '', string $passwordAgain = '', string $Mail = '') {
            $this->name = $name;
            $this->password = $password;
            $this->passwordAgain = $passwordAgain;
            $this->Mail = $Mail;
        }

        # funktioner för att hantera fel som kan uppstå när man registrerar sig på hemsidan
        public function registreraAnvändare() {
            if ($this->empty([$this->name, $this->password, $this->passwordAgain, $this->Mail ])) {
                http::redirect('Registrera.php', ["error" => "tomInput"]);
                // header('location: ../../Registrera.php?error=tomInput');
                // exit();
            }
            if ($this->felNamn() == false) {
                http::redirect('Registrera.php', ["error" => "NamnInkorrekt"]);
                // header('location: ../../Registrera.php?error=NamnInkorrekt');
                // exit();
            }
            if ($this->felMail() == false) {
                header('location: ../../Registrera.php?error=MailInkorrekt');
                exit();
            }
            if ($this->passwordMatch() == false) {
                header('location: ../../Registrera.php?error=lösesnordMatcharInte');
                exit();
            }
            if ($this->mailTagenKoll() == true) {
                header('location: ../../Registrera.php?error=användareFinnsRedan');
                exit();
            }

            $this->insertUser($this->name, $this->password, $this->passwordAgain, $this->Mail);
        }

        public function LoggaInAnvändare() {
            if ($this->empty([$this->password, $this->Mail])) {
                header('location: ../../LogaIn.php?error=tomInput');
                exit();
            }
            if (!$this->kontrolleraAnvändare($this->Mail)) {
                header('location: ../../LogaIn.php?error=användareNotFund');
                exit();
            }
            $this->getUser($this->password,  $this->Mail);
        }

        # Error handling
        private function empty(array $inputs): bool {
            foreach ($inputs as $input) {
                return empty($input);
            }
        }
        private function felNamn(): bool {
            return preg_match("/^[a-zA-Z0-9 ]*$/", $this->name) ? true : false;
        }
        private function felMail(): bool {
            return !filter_var($this->Mail, FILTER_VALIDATE_EMAIL) ? false : true;
        }
        private function passwordMatch(): bool {
            return $this->password !== $this->passwordAgain ? false : true;
        }
        private function mailTagenKoll(): bool {
            return !$this->kontrolleraAnvändare($this->Mail) ?  false : true;
        }
    }
?>
