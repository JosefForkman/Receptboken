<?php
    declare(strict_types=1);
    namespace Josef\Receptboken\http;

    class http {
        public static function redirect( string $location, array $query = [] ):void {
            if (count($query) > 0) {
                $query = http_build_query($query);
                header('location: ../../' . $location .'?' . $query);
            } else {
                header('location: ../../' . $location);
            }
            exit();
        }
    }
?>
