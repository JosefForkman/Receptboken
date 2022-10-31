<?php
    class RegistreraContr extends Registrera {
        private $FörNamn;
        private $EfterNamn;
        private $Lösenord;
        private $LösenordIgen;
        private $Mail;

        # Skapar constructor i class
        public function __construct($FörNamn, $EfterNamn, $Lösenord, $LösenordIgen, $Mail) {
            $this->FörNamn = $FörNamn;
            $this->EfterNamn = $EfterNamn;
            $this->Lösenord = $Lösenord;
            $this->LösenordIgen = $LösenordIgen;
            $this->Mail = $Mail;
        }

        public function registreraAnvändare() {
            $this->setUser($this->FörNamn, $this->EfterNamn, $this->Lösenord, $this->Mail);
        }
    }
?>