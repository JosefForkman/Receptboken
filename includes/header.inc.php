<?php
    session_start();
?>
<header class="pageMargin">
    <div class="navWrapper">
        <a href="index.php">Logga här</a>
        <div class="hamburger" id="hamburgerOpen"></div>
    </div>
    <nav>
        <i class="fa-solid fa-x" id="hamburgerClose" style="color: var(--Deep-champagne); font-size: 2rem; cursor: pointer;"></i>
        <ul>
            <li><a href="index.php">Hem</a></li>
            <li><a href="#">Alla recept</a></li>
            <li><a href="#">Om oss</a></li>
            <li><a href="#">Kontakta oss</a></li>

            <?php if(!empty($_SESSION)): ?>
                <li><a href="#">Profil</a></li>
                <li><a href="SkapaRecept.php">Skapa recept</a></li>
                <li><a href="includes/logut/logut.inc.php">Logga ut</a></li>

            <?php else: ?>
                <li><a href="LogaIn.php">Logga in</a></li>
                <li><a href="Registrera.php">Registrera</a></li>

            <?php endif ?>
        </ul>
    </nav>
</header>
