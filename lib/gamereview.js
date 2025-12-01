// --- GAME DATA (PEGI 12 games) ---
const game1 = {
    titel: "Magic Quest",
    genre: "Fantasy Adventure",
    pegi: 12,
    platforms: "Switch, PC",
    prijs: "€29,99",
    beschrijving: "Een magisch avontuur door verschillende koninkrijken."
};

const game2 = {
    titel: "Sky Racers",
    genre: "Arcade Racing",
    pegi: 12,
    platforms: "PS5, Xbox",
    prijs: "€24,99",
    beschrijving: "Snelle arcade-races hoog boven de wolken."
};


// Prompt
let keuze = prompt("Welke game wil je zien? Typ 1 of 2");

// Selecteer game via switch
let geselecteerdeGame;

switch (keuze) {
    case "1":
        geselecteerdeGame = game1;
        console.log("Game 1 geselecteerd:", game1.titel);
        break;

    case "2":
        geselecteerdeGame = game2;
        console.log("Game 2 geselecteerd:", game2.titel);
        break;

    default:
        geselecteerdeGame = game1;
        console.log("Ongeldige keuze → standaard Game 1");
        break;
}

// Injecteer HTML via interpolatie
document.getElementById("reviewBox").innerHTML = `
    <h2>${geselecteerdeGame.titel}</h2>
    <p><strong>Genre:</strong> ${geselecteerdeGame.genre}</p>
    <p><strong>PEGI:</strong> ${geselecteerdeGame.pegi}</p>
    <p><strong>Platforms:</strong> ${geselecteerdeGame.platforms}</p>
    <p><strong>Prijs:</strong> ${geselecteerdeGame.prijs}</p>
    <p>${geselecteerdeGame.beschrijving}</p>
`;
