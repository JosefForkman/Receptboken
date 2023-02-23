<?php
    namespace Josef\Receptboken\user;
    declare(strict_types=1);

    require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Josef\Receptboken\http\http;
use Josef\Receptboken\vallidation\input;

    class signIn {
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

        public function signUp()
        {
            if (
                input::empty($this->name) &&
                input::empty($this->password) &&
                input::empty($this->passwordAgain) &&
                input::empty($this->Mail
            )) {
                http::redirect('Registrera.php', ['error' => 'tomInput']);
            }

            if (!input::matchName($this->name)) {
                http::redirect('Registrera.php', ['error' => 'NamnInkorrekt']);
            }

            if (!input::matchMail($this->Mail)) {
                http::redirect('Registrera.php', ['error' => 'MailInkorrekt']);
            }

            if (!input::matchPassword($this->password, $this->passwordAgain)) {
                http::redirect('Registrera.php', ['error' => 'lösesnordMatcharInte']);
            }
        }

    }
?>
