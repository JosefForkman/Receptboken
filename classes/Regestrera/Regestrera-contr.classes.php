<?php
    class RegistreraContr extends Registrera {
        private $name;
        private $Lösenord;
        private $LösenordIgen;
        private $Mail;

        # Skapar constructor i class
        public function __construct(string $name, string $Lösenord, string $LösenordIgen, string $Mail) {
            $this->name = $name;
            $this->Lösenord = $Lösenord;
            $this->LösenordIgen = $LösenordIgen;
            $this->Mail = $Mail;
        }

        public function registreraAnvändare() {
            $this->setUser($this->name, $this->Lösenord, $this->LösenordIgen, $this->Mail);
        }
    }
?>
