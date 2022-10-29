<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='css/style.css'>
        <title></title>
    </head>
    <body>
        <?php require('includes/header.include.php') ?>
        <main class="ReceptContainer">
            <img src="image/homescreenify-sA3wymYqyaI-unsplash.jpg" alt="Skål med Spageti med köttfärs sås med grönt löv i mitten">
            <section class="ReceptSection pageMargin">
                <h2>Spageti med köttfärs sås</h2>
                <p>Gör en extra stor sats av allas vardagsfavorit, spagetti och köttfärssås, och frys in. Vill du variera smaken, prova med lamm- eller viltfärs istället för nötfärs!</p>
                <div class="betyg">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star-half"></i>
                <i class="fa-regular fa-star"></i>
                </div>
                <div class="portions">
                    <i class="fa-solid fa-plus text-GreenSheen"></i>
                    <span>4 port</span>
                    <i class="fa-solid fa-minus text-GreenSheen"></i>
                </div>
            </section>

            <section class="pageMargin" id="ingrediens">
                <h3>Ingredienser</h3>
                <ul>
                    <li>
                        <input type="checkbox">
                        <p class="ingrediensItem">Kötfärs</p>
                        <p>400g</p>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p class="ingrediensItem">Gul lök</p>
                        <p>1</p>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p class="ingrediensItem">Vitlöksklyfta</p>
                        <p>1</p>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p class="ingrediensItem">smör- & rapsolja</p>
                        <p>2 msk</p>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p class="ingrediensItem">salt</p>
                        <p>1 tsk</p>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p class="ingrediensItem">svartpeppar</p>
                        <p>1 krm</p>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p class="ingrediensItem">Röt vin</p>
                        <p>1/2 dl</p>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p class="ingrediensItem">Köttbuljong</p>
                        <p>1/2 tärning</p>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p class="ingrediensItem">Vispgrädde</p>
                        <p>3/4 dl</p>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p class="ingrediensItem">Krossade tomater</p>
                        <p>400 g</p>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p class="ingrediensItem">Strösocker</p>
                        <p>1/2 tsk</p>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p class="ingrediensItem">Spaghetti</p>
                        <p>300 g</p>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p class="ingrediensItem">Riven ost</p>
                        <p>1 1/2 dl</p>
                    </li>
                </ul>
            </section>
            <section class="pageMargin" id="göra">
                <h3>Gör så här</h3>
                <ul>
                    <li>
                        <input type="checkbox">
                        <p>Skala och hacka lök och vitlök fint. Fräs den i smör-&rapsolja någon min. Tillsätt köttfärs, salt och peppar. Fortsätt steka under omrörning så färsen smular sig.</p>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p>Tillsätt vin och smulad buljongtärning. Låt koka på medelvärme 5 min. Rör om då och då.</p>
                    </li>
                    <li>
                        <div class="timer">
                            <i class="fa-solid fa-stopwatch text-TerraCotta"></i>
                            <button class="text-TerraCotta">Öppna timer 5 min</button>
                        </div>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p>Häll i grädde och låt koka ytterligare 5 min. Tillsätt tomater och socker. Låt såsen koka under lock minst 30 min. Rör om då och då, häll i lite vatten om den blir torr.</p>
                    </li>
                    <li>
                        <div class="timer">
                            <i class="fa-solid fa-stopwatch text-TerraCotta"></i>
                            <button class="text-TerraCotta">Öppna timer 30m 25s</button>
                        </div>
                    </li>
                    <li>
                        <input type="checkbox">
                        <p>Koka pastan enligt anvisning på förpackningen. Häll av pastan och blanda med köttfärssåsen. Servera med riven ost.</p>
                    </li>
                </ul>
            </section>

            <nav class="navRecept bg-Independence">
                <a href="#ingrediens">Ingredienser</a>
                <a href="#göra">Gör så här</a>
            </nav>
        </main>

        <script src="js/index.js"></script>
    </body>
</html>
