// ==========================
// Game Reviews 3 - JS Pagina
// Eisen:
// - 1 array met daarin 2 games
// - selection box om game te kiezen
// - interpolatie
// - vraag leeftijd + check >= PEGI
// - loopjes voor genres/fotos/platforms/ratings
// - melding op pagina als te jong
// ==========================

const games = [
    {
        title: "FC 26",
        genres: ["Sport", "Voetbal", "Simulation"],
        photos: ["images/fc26.avif", "images/fc26.avif", "images/fc26.avif"],
        pegi: 12,
        description: "Speel in je eigen team en verbeter je skills op het veld. Ultimate Team, Career en online gameplay.",
        ratings: [8, 7, 8, 9],
        youtubeEmbed: "https://www.youtube.com/embed/9g8v0g9Qd0A", // vervang door echte trailer
        platforms: ["PC", "PlayStation", "Xbox"],
        maker: "EA Sports"
    },
    {
        title: "Rocket League",
        genres: ["Sport", "Racing", "Arcade"],
        photos: ["images/rocket_league_coverart.jpg", "images/rocket_league_coverart.jpg", "images/rocket_league_coverart.jpg"],
        pegi: 7,
        description: "Auto’s + voetbal = chaos. Snelle matches, rankeds, en skills die je blijft leren.",
        ratings: [9, 8, 9, 8],
        youtubeEmbed: "https://www.youtube.com/embed/OmMF9EDbmQQ",
        platforms: ["PC", "PlayStation", "Xbox", "Switch"],
        maker: "Psyonix"
    }
];

const ageInput = document.getElementById("ageInput");
const gameSelect = document.getElementById("gameSelect");
const showBtn = document.getElementById("showBtn");
const output = document.getElementById("output");

// dropdown vullen
for (const game of games) {
    const opt = document.createElement("option");
    opt.value = game.title;
    opt.textContent = game.title;
    gameSelect.appendChild(opt);
}

function avgRating(ratings) {
    if (!ratings.length) return 0;
    const sum = ratings.reduce((a, b) => a + b, 0);
    return sum / ratings.length;
}

function renderGame(game, age) {
    // leeftijd check
    if (age < game.pegi) {
        output.innerHTML = `
      <div class="review-card">
        <h2>Sorry!</h2>
        <p>Je bent <strong>${age}</strong> jaar. Deze game is <strong>PEGI ${game.pegi}</strong>.</p>
        <p><strong>Je bent niet oud genoeg om deze info te bekijken.</strong></p>
      </div>
    `;
        return;
    }

    // loops (genres / platforms / photos / ratings)
    const genreList = game.genres.map(g => `<span style="margin-right:6px;">${g}</span>`).join("");
    const platformList = game.platforms.map(p => `<span style="margin-right:6px;">${p}</span>`).join("");
    const ratingList = game.ratings.map(r => `<span style="margin-right:6px;">${r}</span>`).join("");
    const images = game.photos.map(src => `<img src="${src}" alt="${game.title}" style="border-radius:10px;">`).join("");

    output.innerHTML = `
    <div class="review-card">
      <h2>${game.title} (PEGI ${game.pegi})</h2>
      <p><strong>Maker:</strong> ${game.maker}</p>

      <p><strong>Genre(s):</strong> ${genreList}</p>
      <p><strong>Platforms:</strong> ${platformList}</p>

      <p><strong>Beschrijving:</strong> ${game.description}</p>

      <p><strong>Ratings:</strong> ${ratingList}</p>
      <p><strong>Gemiddelde rating:</strong> ${avgRating(game.ratings).toFixed(1)}/10</p>

      <p><strong>Foto’s:</strong></p>
      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px;">
        ${images}
      </div>

      <p style="margin-top:18px;"><strong>Trailer:</strong></p>
      <div style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:12px;">
        <iframe
          src="${game.youtubeEmbed}"
          title="YouTube trailer"
          style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen>
        </iframe>
      </div>
    </div>
  `;
}

showBtn.addEventListener("click", () => {
    const age = Number(ageInput.value || 0);
    const selectedTitle = gameSelect.value;

    const game = games.find(g => g.title === selectedTitle);
    if (!game) return;

    renderGame(game, age);
});

// standaard eerste render
renderGame(games[0], 0);
