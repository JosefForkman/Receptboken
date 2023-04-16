<?php
declare(strict_types=1);
namespace Josef\Receptboken\http;

class http
{
    public static function redirect(string $location, array $query = []): void
    {
        if (count($query) > 0) {
            $query = http_build_query($query);
            header('location: ../../' . $location . '?' . $query);
        } else {
            header('location: ../../' . $location);
        }
        exit();
    }

    public static function setSession(array $sessionData): void
    {
        $kay = array_keys($sessionData);
        $value = array_values($sessionData);

        session_start();
        for ($i = 0; $i < count($sessionData); $i++) {
            $_SESSION[$kay[$i]] = $value[$i];
        }
    }

    public static function getSession(): object
    {
        session_start();

        return json_decode(json_encode($_SESSION));
    }
}
