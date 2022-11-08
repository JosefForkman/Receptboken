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
            <h2>Skapa recept</h2>

            <form action="" method="post">
                <label for="image">Recept bild</label>
                <label class="fileInputDesign" for="fileInput"></label>
                <input type="file" name="image"  id="image fileInput">
                <input type="text" placeholder="Bild beskrivning...">

                <label for="Rubrik">Namn på recept</label>
                <input type="text" form="Rubrik" placeholder="Rubrik">

                <label for="Beskrivning">Beskrivning</label>
                <textarea name="" id="Beskrivning" placeholder="Beskrivning"></textarea>

                <label for="">Gör så här</label>
                <textarea name="" id="" placeholder=""></textarea>
                <label for="">Timer</label>
                <input type="checkbox" name="" id="">
            </form>
        </main>
        <script src="js/index.js"></script>
    </body>
</html>
