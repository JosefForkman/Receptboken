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
            if ($this->emptyInput()) {
                # code...
            }
            $user = $this->getUser($this->Lösenord,  $this->Mail);
            var_dump(empty($user));
            if (empty($user)) {
                # Start session
                session_start();
                $_SESSION['userName'] = $user['name'];
                $_SESSION['userMail'] = $user['mail'];
            }
        }

        # Error handling
        private function emptyInput () {
            return empty($this->Lösenord) || empty($this->Mail);
        }
    }
?>
