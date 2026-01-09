// ==========================
// Game Review (JS)
// ==========================
// - 1 array met games
// - dropdown select om game te kiezen
// - leeftijd input + PEGI check
// - loops voor genres/platforms/foto’s/ratings
// - interpolatie (template literals)
// - melding op pagina als te jong
// ==========================

const games = [
  {
    title: "FC 26",
    pegi: 12,
    genres: ["Sport", "Voetbal", "Simulation"],
    platforms: ["PC", "PlayStation", "Xbox"],
    photos: ["images/fc26.avif", "images/fc26.avif", "images/fc26.avif"],
    ratings: [8, 7, 9],
    maker: "EA Sports",
    description: "Speel in je eigen team en verbeter je skills op het veld.",
    youtubeEmbed: "https://www.youtube.com/embed/9g8v0g9Qd0A"
  },
  {
    title: "Rocket League",
    pegi: 7,
    genres: ["Sport", "Racing", "Arcade"],
    platforms: ["PC", "PlayStation", "Xbox", "Switch"],
    photos: ["images/rocket_league_coverart.jpg", "images/rocket_league_coverart.jpg", "images/rocket_league_coverart.jpg"],
    ratings: [9, 8, 8],
    maker: "Psyonix",
    description: "Auto’s + voetbal in snelle multiplayer matches.",
    youtubeEmbed: "https://www.youtube.com/embed/OmMF9EDbmQQ"
  }
];

// DOM elementen ophalen
const ageInput = document.getElementById("ageInput");
const gameSelect = document.getElementById("gameSelect");
const showBtn = document.getElementById("showBtn");
const output = document.getElementById("output");

// Dropdown vullen met opties (loop)
gameSelect.innerHTML = `<option value="">-- Kies een game --</option>`;
for (const game of games) {
  const opt = document.createElement("option");
  opt.value = game.title;
  opt.textContent = game.title;
  gameSelect.appendChild(opt);
}

// Gemiddelde rating berekenen
function avg(ratings) {
  return (ratings.reduce((a, b) => a + b, 0) / ratings.length).toFixed(1);
}

// Render functie: laat of review zien of “te jong” melding
function render(game, age) {
  // PEGI controle
  if (age < game.pegi) {
    output.innerHTML = `
      <div class="review-card">
        <h2>Sorry!</h2>
        <p>Je bent <strong>${age}</strong> jaar. Deze game is <strong>PEGI ${game.pegi}</strong>.</p>
        <p><strong>Je bent niet oud genoeg.</strong></p>
      </div>
    `;
    return;
  }

  // Arrays naar strings (genres/platforms)
  const genresText = game.genres.join(", ");
  const platformsText = game.platforms.join(", ");

  // Foto’s (loop met map)
  const imagesHtml = game.photos
    .map(src => `<img src="${src}" alt="${game.title}" style="border-radius:10px;">`)
    .join("");

  // Ratings (loop)
  const ratingsHtml = game.ratings.map(r => `<span style="margin-right:6px;">${r}</span>`).join("");

  // Interpolatie met template literals
  output.innerHTML = `
    <div class="review-card">
      <h2>${game.title} (PEGI ${game.pegi})</h2>
      <p><strong>Maker:</strong> ${game.maker}</p>
      <p><strong>Genre(s):</strong> ${genresText}</p>
      <p><strong>Platforms:</strong> ${platformsText}</p>
      <p><strong>Beschrijving:</strong> ${game.description}</p>

      <p><strong>Ratings:</strong> ${ratingsHtml} | <strong>Gemiddeld:</strong> ${avg(game.ratings)}/10</p>

      <p><strong>Foto’s:</strong></p>
      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px;">
        ${imagesHtml}
      </div>

      <p style="margin-top:18px;"><strong>Trailer:</strong></p>
      <div style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:12px;">
        <iframe src="${game.youtubeEmbed}"
          style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;"
          allowfullscreen></iframe>
      </div>
    </div>
  `;
}

// Klik op “Toon review”
showBtn.addEventListener("click", () => {
  const age = Number(ageInput.value || 0);
  const title = gameSelect.value;

  if (!title) {
    output.innerHTML = `<div class="review-card"><p><strong>Kies eerst een game.</strong></p></div>`;
    return;
  }

  const game = games.find(g => g.title === title);
  render(game, age);
});
