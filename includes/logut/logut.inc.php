<?php
    # Startar en session för att sedan kunna logga ut användaren
    session_start();
    session_unset();
    session_destroy();

    # skicka tillbaka användaren till index
    header('location: ../../index.php?error=none');
?>
