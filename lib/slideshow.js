// Simple slideshow (Game Review 4 - JS requirement)

const slides = [
    {
        title: "FC 26",
        text: "Nieuwe voetbal ervaring met Ultimate Team & Career.",
        img: "images/fc26.avif"
    },
    {
        title: "Rocket League",
        text: "Auto’s + voetbal: snelle matches en harde skill gap.",
        img: "images/rocket_league_coverart.jpg"
    },
    {
        title: "Valorant",
        text: "Tactische shooter met teamwork en strategie.",
        img: "images/valorant.jpeg"
    }
];

let current = 0;

const slideImage = document.getElementById("slideImage");
const slideTitle = document.getElementById("slideTitle");
const slideText = document.getElementById("slideText");
const prevBtn = document.getElementById("prevSlide");
const nextBtn = document.getElementById("nextSlide");

function renderSlide() {
    if (!slideImage || !slideTitle || !slideText) return;
    const s = slides[current];
    slideImage.src = s.img;
    slideImage.alt = s.title;
    slideTitle.textContent = s.title;
    slideText.textContent = s.text;
}

function next() {
    current = (current + 1) % slides.length;
    renderSlide();
}
function prev() {
    current = (current - 1 + slides.length) % slides.length;
    renderSlide();
}

if (nextBtn) nextBtn.addEventListener("click", next);
if (prevBtn) prevBtn.addEventListener("click", prev);

// Auto slide every 5 seconds
setInterval(() => {
    // alleen als slideshow op pagina bestaat
    if (slideImage) next();
}, 5000);

renderSlide();
