<?php
    declare(strict_types=1);

    class userContr extends User{


        # Error handling
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
