<?php
    declare(strict_types=1);

    class LoggaInContr extends LoggaIn {
        private $Lösenord;
        private $Mail;

        # Skapar constructor i class
        public function __construct(string $Lösenord, string $Mail) {
            $this->Lösenord = $Lösenord;
            $this->Mail = $Mail;
        }

        public function LoggaInAnvändare() {
            if (!$this->emptyInput()) {
                header('location: ../../LogaIn.php?error=tomInput');
                exit();
            }
            $this->getUser($this->Lösenord,  $this->Mail);
        }

        # Error handling
        private function emptyInput () {
            return empty($this->Lösenord) || empty($this->Mail) ? false : true;
        }
    }
?>
