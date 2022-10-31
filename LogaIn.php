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
            <h2>Logga In</h2>
            <form action="" method="post">
                <label for="email" class="text-Independence">E-post</label>
                <input type="email" class="text-Independence" name="" id="email" placeholder="E-post">
                <label for="password" class="text-Independence">Lösenord</label>
                <input type="password" class="text-Independence" name="" id="password" placeholder="Lösenord">
                <div class="submitContainer">
                    <a href="Registrera.php" class="text-Independence">Har inget konto?</a>
                    <button class="btn bg-TerraCotta">Logga in</button>
                </div>
            </form>
        </main>

        <script src="js/index.js"></script>
    </body>
</html>
