<?php
    declare(strict_types=1);

    class userContr extends User{
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
                header('location: ../../Registrera.php?error=tomInput');
                exit();
            }
            if ($this->felNamn() == false) {
                header('location: ../../Registrera.php?error=NamnInkorrekt');
                exit();
            }
            if ($this->felMail() == false) {
                header('location: ../../Registrera.php?error=MailInkorrekt');
                exit();
            }
            if ($this->passwordMatch() == false) {
                header('location: ../../Registrera.php?error=lösesnordMatcharInte');
                exit();
            }
            if ($this->mailTagenKoll() == false) {
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
            if ($this->kontrolleraAnvändare($this->Mail)) {
                header('location: ../../LogaIn.php?error=användareNotFund');
                exit();
            }
            $this->getUser($this->password,  $this->Mail);
        }

        # Error handling
        private function empty($inputs) {
            foreach ($inputs as $input) {
                return empty($input);
            }
        }
        private function felNamn() {
            return !preg_match("/^[a-zA-Z0-9]*$/", $this->name) ? true : false;
        }
        private function felMail() {
            return !filter_var($this->Mail, FILTER_VALIDATE_EMAIL) ? false : true;
        }
        private function passwordMatch() {
            return $this->password !== $this->passwordAgain ? false : true;
        }
        private function mailTagenKoll() {
            return !$this->kontrolleraAnvändare($this->Mail) ?  false : true;
        }
    }
?>
