// Latest Reviews slideshow
// EIS JS: maar 1 review tegelijk zichtbaar + genoeg leestijd + interval + DOM + CSS aanpassing

const data = window.latestReviewsData || [];

let index = 0;
let timer = null;
let isPaused = false;

// DOM elements
const slideContent = document.getElementById("slideContent");
const slideCounter = document.getElementById("slideCounter");
const prevBtn = document.getElementById("prevReview");
const nextBtn = document.getElementById("nextReview");
const pauseBtn = document.getElementById("pauseReview");
const slideshowCard = document.getElementById("slideshowCard");

// CSS aanpassing via JS (rubric: JS -> CSS)
if (slideshowCard) {
    slideshowCard.style.border = "2px solid rgba(0,0,0,0.08)";
}

// helper render
function renderSlide() {
    if (!slideContent || !data.length) return;

    const r = data[index];
    slideCounter.textContent = `Review ${index + 1}/${data.length}`;

    // visitor reviews (3 stuks)
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

    // ratings (game ratings)
    const ratingsHtml = r.ratings.map(n => `<span style="margin-right:6px;">${n}</span>`).join("");

    // genres/platforms
    const genres = r.genres.join(", ");
    const platforms = r.platforms.join(", ");

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
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
      </iframe>
    </div>
  `;
}

// navigation
function next() {
    index = (index + 1) % data.length;
    renderSlide();
}
function prev() {
    index = (index - 1 + data.length) % data.length;
    renderSlide();
}

// interval (leestijd: 10s default)
function startAuto() {
    stopAuto();
    timer = setInterval(() => {
        if (!isPaused) next();
    }, 10000); // 10 seconden (genoeg om te lezen)
}
function stopAuto() {
    if (timer) clearInterval(timer);
    timer = null;
}

if (nextBtn) nextBtn.addEventListener("click", next);
if (prevBtn) prevBtn.addEventListener("click", prev);

if (pauseBtn) {
    pauseBtn.addEventListener("click", () => {
        isPaused = !isPaused;
        pauseBtn.textContent = isPaused ? "▶ Play" : "⏸ Pause";
    });
}

renderSlide();
startAuto();
