![The Swedish Chef](https://media.giphy.com/media/10u6gt11vnm812/giphy.gif)

# Receptboken
[Länk till kokboken](https://forkman.se)

Kokboken är en hemsida där man kan se andras recept och dela sina egna recept. Heminsidan är insparrad av [Ica kvantum recept](https://www.ica.se/recept/) och [Arla recept](https://www.arla.se/recept/).

`Text about the project and why it exists. This would also be a great place to link the project on One.com.`

# Project idé

- Kok bok
  - Se recept
    - boka av steg i recept
    - Beskrivning
    - indrigenser
  - Se Alla recept
    - [Använd pagination](https://www.allphptricks.com/create-simple-pagination-using-php-and-mysqli/)
    - Se bara max 10st recept åt gången
  - Söka på recept
  - Skapa inköpslista
    - Baserat på vad man vill baka / tillaga kan lägga till enskilda Indrigenser
  - Skapa ny recept
    - Bild
    - Beskrivning
    - Lista av steg
    - Indrigenser
    - Spara i en kategori
    - svårt grad
  - Inloggning

## Om jag hinner med

- Ladda in recept från andra sidor
- Betalning av någon sort
- Inloggning med Google & Facebook
- Ändra recept
- Responsiv
  - Funka över mobil storlek
- Kommentera recept
- Betyg
- Spara sina favoriter i kategorier
  - Kunna exportera sina recept till PDF m.m

# Installation
  För att kunna köra kokboken behöver du ha gjort några saker först. Det första är att göra sass till css. 
  
  Det andra är att starta databasen. Detta har jag gjort enkelt med att jag har gjort en docker-compose fil med MySQL och phpMyAdmin.

  Det du behöver för att köra hmsidan är 
  - VS Code
  - Live Sass Compiler plugin till VS Code
  - Docker Desktop
  - Två koppar kafe :coffee::coffee:

## Generera css från scss (Live Sass Compiler)
1. Ladda ner [Live Sass Compilar](https://marketplace.visualstudio.com/items?itemName=glenn2223.live-sass)
2. Legg till detta i din inställningar 
``` json
  "liveSassCompile.settings.formats": [
    {
      "format": "expanded",
      "extensionName": ".css",
      "savePath": "~/../css/"
    }
  ],
```
3. Tryck på `Watch Sass` som man hittar längst ner till höger
4. Live Sass Compilar kommer nu att skapa en css map med css fil inuti 

## Starta databas till kokboken (Docker Desktop)
1. Ladda ner [Docker Desktop](https://www.docker.com/products/docker-desktop)
2. Installera och följ instruktionerna som dyker upp när du kör installations filen.
3. Öppna terminalen och kör `docker-compose up -d`.  
4. Nu är databasen uppe. phpMyAdmin är också uppe på [localhost:2000](http://localhost:2000) så kan man se min databas också.

# Code Review

Code review written by [Jonas Mårtensson](https://github.com/jonas128).

1. All requirements are met. The code contains different types of variables and multiple php-files.
2. `index.php: 6` - I have some problems understanding the styling of this page: why do you refer to a style.css file and then use style.scss?  
3. The styling of page does not work when I run it in local server. 
4. All the web fonts you uploaded are not in use.
5. You could use more functions to make the code easier to follow and 'declare(strict_types=1);'.
6. `TIP` - The login functions seem to complicated for this assignment.

# Testers

Tested by the following people:

1. Jane Doe
2. John Doe
