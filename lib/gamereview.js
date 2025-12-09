
const myGames = {
    FC26: {
        title: "FC 26",
        pegi: 12,
        genre: "Sport / Voetbal",
        description: "Speel in je eigen team en verbeter je skills op het veld.",
        platform: "PC, PlayStation, Xbox",
        image: "../images/fc26.avif"
        
    }, 
    RocketLeague: {
        title: "Rocket League",
        pegi: 7,
        genre: "Racing / Sport",
        description: "Race met je auto en scoor epische goals in een futuristisch stadion.",
        platform: "PC, PlayStation, Xbox, Switch",
        image: "../images/Rocket_League_coverart.jpg"
    },
    Valorant: {
        title: "Valorant",
        pegi: 16,
        genre: "FPS / Shooter",
        description: "Tactische shooter waarin teamwork en strategie centraal staan.",
        platform: "PC",
        image: "../images/valorant.jpeg"
    },
    Fortnite: {
        title: "Fortnite",
        pegi: 12,
        genre: "Battle Royale",
        description: "Bouw en strijd tegen andere spelers in een kleurrijke wereld.",
        platform: "PC, PlayStation, Xbox, Switch, Mobile",
        image: "../images/fortnite.png"
    }
}
console.log(`Toon reviews voor: ${player}`);


for (let key in myGames) {
    let game = myGames[key];
    console.log(game);

    let div = document.createElement("div");
    div.className = "review-card";
    div.innerHTML = `
        <h2>${game.title} (PEGI ${game.pegi})</h2>
        <img src="${game.image}" alt="${game.title} Cover">
        <p><strong>Genre:</strong> ${game.genre}</p>
        <p><strong>Beschrijving:</strong> ${game.description}</p>
        <p><strong>Platform:</strong> ${game.platform}</p>
    `;
    document.body.appendChild(div);
}
