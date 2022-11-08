<?php
    declare(strict_types=1);

    class LoggaInContr extends LoggaIn {
        private $password;
        private $Mail;

        # Skapar constructor i class
        public function __construct(string $password, string $Mail) {
            $this->password = $password;
            $this->Mail = $Mail;
        }

        public function LoggaInAnvändare() {
            if (!$this->emptyInput()) {
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
        private function emptyInput () {
            return empty($this->password) || empty($this->Mail) ? false : true;
        }
    }
?>
