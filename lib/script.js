
const darkmodeBtn = document.getElementById("darkmodeBtn");

if (localStorage.getItem("darkmode") === "enabled") {
    document.body.classList.add("darkmode");
}

darkmodeBtn.addEventListener("click", () => {
    const isDark = document.body.classList.toggle("darkmode");
    localStorage.setItem("darkmode", isDark ? "enabled" : "disabled");
});

const searchForm = document.getElementById("searchForm");
const searchInput = document.getElementById("searchInput");

if (searchForm) {
    searchForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const query = searchInput.value.toLowerCase().trim();

        if (query.includes("home")) {
            window.location.href = "index.html";
        } else if (query.includes("games")) {
            window.location.href = "games.html";
        } else if (query.includes("merchandise") || query.includes("merch")) {
            window.location.href = "merchandise.html";
        } else if (query.includes("contact")) {
            window.location.href = "contact.html";
        } else {
            alert("Pagina niet gevonden!");
        }
    });
}
