<?php
    declare(strict_types=1);
    namespace Josef\Receptboken\vallidation;

    class input {
        public static function empty(string $input): bool
        {
            return empty($input);
        }
        public static function matchName(string $input): bool
        {
            return (bool)preg_match("/^[a-zA-Z0-9 ]*$/", $input);
        }
        public static function matchMail(string $input): bool
        {
            return (bool)filter_var($input, FILTER_VALIDATE_EMAIL);
        }
        public static function matchPassword(string $password, string $passwordAgain): bool
        {
            return $password === $passwordAgain;
        }
    }
?>
