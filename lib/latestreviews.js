// ============================
// Latest Reviews slideshow (JS)
// ============================
//
// Eisen:
// - Maar 1 review tegelijk zichtbaar (slideshow)
// - Interval met genoeg tijd om te lezen
// - DOM elementen selecteren en aanpassen
// - CSS aanpassen via JS (rubric punt)
//

// Data komt uit PHP via: window.latestReviewsData
const data = window.latestReviewsData || [];

let index = 0;       // huidige slide index
let timer = null;    // interval reference
let isPaused = false;

// ============ DOM SELECTIE ============
// We pakken de HTML elementen waar we content in gaan zetten / mee gaan werken.
const slideContent = document.getElementById("slideContent");
const slideCounter = document.getElementById("slideCounter");
const prevBtn = document.getElementById("prevReview");
const nextBtn = document.getElementById("nextReview");
const pauseBtn = document.getElementById("pauseReview");
const slideshowCard = document.getElementById("slideshowCard");

// ============ CSS AANPASSING VIA JS ============
// Rubric punt: “JS kan CSS aanpassen”
if (slideshowCard) {
    slideshowCard.style.border = "2px solid rgba(0,0,0,0.08)";
}

// ============ RENDER FUNCTIE ============
// Deze functie laat precies 1 review zien (slideshow eis).
function renderSlide() {
    // Als het element niet bestaat of data leeg is: stop.
    if (!slideContent || !data.length) return;

    // Pak 1 review object uit de array
    const r = data[index];

    // Counter bovenaan (bijv. Review 2/4)
    if (slideCounter) {
        slideCounter.textContent = `Review ${index + 1}/${data.length}`;
    }

    // ============ Visitor reviews (3 stuks) ============ 
    // We maken HTML van de 3 bezoekersreviews met map() (loop in JS).
    const visitorHtml = r.visitorReviews
        .map(v => {
            return `
        <div style="padding:10px; border-radius:10px; background: rgba(0,0,0,0.03); margin-top:10px;">
          <strong>${v.name}</strong> — Rating: ${v.rating}/5
          <p style="margin:6px 0 0;">${v.text}</p>
        </div>
      `;
        })
        .join("");

    // Game ratings (array -> HTML)
    const ratingsHtml = r.ratings
        .map(n => `<span style="margin-right:6px;">${n}</span>`)
        .join("");

    // Genres/platforms arrays -> string
    const genres = r.genres.join(", ");
    const platforms = r.platforms.join(", ");

    // ============ Interpolatie ============ 
    // Hier gebruik ik template literals `${}` om data in HTML te zetten.
    slideContent.innerHTML = `
    <h3 style="margin-top:0;">${r.title} (PEGI ${r.pegi})</h3>
    <p><strong>Maker:</strong> ${r.maker}</p>
    <p><strong>Genre(s):</strong> ${genres}</p>
    <p><strong>Platforms:</strong> ${platforms}</p>
    <p><strong>Korte beschrijving:</strong> ${r.description}</p>

    <p style="margin-top:12px;"><strong>Ratings (game):</strong> ${ratingsHtml}</p>

    <p style="margin-top:12px;"><strong>3 Bezoekersreviews:</strong></p>
    ${visitorHtml}

    <p style="margin-top:14px;"><strong>YouTube trailer:</strong></p>
    <div style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:12px;">
      <iframe
        src="${r.youtube}"
        title="YouTube trailer"
        style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;"
        allowfullscreen>
      </iframe>
    </div>
  `;
}

// ============ NAVIGATIE FUNCTIES ============
// Volgende slide (met modulo zodat je terug naar begin gaat)
function next() {
    index = (index + 1) % data.length;
    renderSlide();
}

// Vorige slide (zorgt dat je niet negatief gaat)
function prev() {
    index = (index - 1 + data.length) % data.length;
    renderSlide();
}

// ============ INTERVAL (auto slideshow) ============
// Eis: genoeg tijd om te lezen -> 10 seconden
function startAuto() {
    stopAuto();
    timer = setInterval(() => {
        if (!isPaused) next();
    }, 10000);
}

function stopAuto() {
    if (timer) clearInterval(timer);
    timer = null;
}

// ============ EVENT LISTENERS ============
// Klik op knoppen = handmatig navigeren
if (nextBtn) nextBtn.addEventListener("click", next);
if (prevBtn) prevBtn.addEventListener("click", prev);

// Pause knop toggled play/pause
if (pauseBtn) {
    pauseBtn.addEventListener("click", () => {
        isPaused = !isPaused;
        pauseBtn.textContent = isPaused ? "▶ Play" : "⏸ Pause";
    });
}

// Start: eerste slide render + interval starten
renderSlide();
startAuto();
