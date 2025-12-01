// ======= Jouw games =======
const myGames = {
    FC26: {
        title: "FC 26",
        pegi: 12,
        genre: "Sport / Voetbal",
        description: "Speel in je eigen team en verbeter je skills op het veld.",
        platform: "PC, PlayStation, Xbox"
    },
    RocketLeague: {
        title: "Rocket League",
        pegi: 7,
        genre: "Racing / Sport",
        description: "Race met je auto en scoor epische goals in een futuristisch stadion.",
        platform: "PC, PlayStation, Xbox, Switch"
    }
};

// ======= Klasgenoot games =======
const classmateGames = {
    Valorant: {
        title: "Valorant",
        pegi: 16,
        genre: "FPS / Shooter",
        description: "Tactische shooter waarin teamwork en strategie centraal staan.",
        platform: "PC"
    },
    Fortnite: {
        title: "Fortnite",
        pegi: 12,
        genre: "Battle Royale",
        description: "Bouw en strijd tegen andere spelers in een kleurrijke wereld.",
        platform: "PC, PlayStation, Xbox, Switch, Mobile"
    }
};

// Prompt gebruiker voor keuze
let player = prompt("Welke reviews wil je zien? (me / classmate)", "me");
let selectedGames = player === "classmate" ? classmateGames : myGames;

// Toon in console en op pagina
console.log(`Toon reviews voor: ${player}`);

for (let key in selectedGames) {
    let game = selectedGames[key];
    console.log(game);

    let div = document.createElement("div");
    div.className = "review-card";
    div.innerHTML = `
        <h2>${game.title} (PEGI ${game.pegi})</h2>
        <p><strong>Genre:</strong> ${game.genre}</p>
        <p><strong>Beschrijving:</strong> ${game.description}</p>
        <p><strong>Platform:</strong> ${game.platform}</p>
    `;
    document.body.appendChild(div);
}
