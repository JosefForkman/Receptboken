<?php
    class RegistreraContr extends Registrera {
        private $name;
        private $password;
        private $passwordAgain;
        private $Mail;

        # Skapar constructor i class
        public function __construct(string $name, string $password, string $passwordAgain, string $Mail) {
            $this->name = $name;
            $this->password = $password;
            $this->passwordAgain = $passwordAgain;
            $this->Mail = $Mail;
        }

        # funktioner för att hantera fel som kan uppstå när man registrerar sig på hemsidan
        public function registreraAnvändare() {
            if ($this->empty() == false) {
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

            $this->setUser($this->name, $this->password, $this->passwordAgain, $this->Mail);
        }

        private function empty() {
            $resultat;

            if (empty($this->name) || empty($this->password) || empty($this->passwordAgain) || empty($this->Mail)) {
                $resultat = false;
            } else {
                $resultat = true;
            }
            return $resultat;
        }
        private function felNamn() {
            $resultat;

            if (!preg_match("/^[a-zA-Z0-9]*$/", $this->name)) {
                $resultat = false;
            } else {
                $resultat = true;
            }
            return $resultat;
        }
        private function felMail() {
            $resultat;

            if (!filter_var($this->Mail, FILTER_VALIDATE_EMAIL)) {
                $resultat = false;
            } else {
                $resultat = true;
            }
            return $resultat;
        }
        private function passwordMatch() {
            $resultat;

            if ($this->password !== $this->passwordAgain) {
                $resultat = false;
            } else {
                $resultat = true;
            }
            return $resultat;
        }
        private function mailTagenKoll() {
            $resultat;

            if (!$this->kontrolleraAnvändare($this->Mail)) {
                $resultat = false;
            } else {
                $resultat = true;
            }
            return $resultat;
        }
    }
?>
