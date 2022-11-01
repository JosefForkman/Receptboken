<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='css/style.css'>
        <title></title>
    </head>
    <body>
    <?php require('includes/header.inc.php') ?>

        <main class="pageMargin">
            <h2>Registrera</h2>
            <form action="includes/Regestrera/Regestrera.inc.php" method="post">
                <label for="email" class="text-Independence">E-post</label>
                <input type="email" class="text-Independence" name="mail" id="email" placeholder="E-post">
                <label for="name" class="text-Independence">Användarnamn</label>
                <input type="text" class="text-Independence" name="name" id="name" placeholder="Användarnamn">
                <label for="password" class="text-Independence">Lösenord</label>
                <input type="password" class="text-Independence" name="pass" id="password" placeholder="Lösenord">
                <label for="passwordRepeat" class="text-Independence">Lösenord igen</label>
                <input type="password" class="text-Independence" name="passigen" id="passwordRepeat" placeholder="Lösenord igen">
                <div class="submitContainer">
                    <a href="LogaIn.php" class="text-Independence">Har redan konto?</a>
                    <button class="btn bg-TerraCotta" name="submit">Logga in</button>
                </div>
            </form>
        </main>

        <script src="js/index.js"></script>
    </body>
</html>
