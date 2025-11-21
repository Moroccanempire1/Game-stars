// Selecteer de darkmode knop
const btn = document.getElementById("darkmodeBtn");

// Check of darkmode eerder is ingeschakeld
if (localStorage.getItem("darkmode") === "enabled") {
    document.body.classList.add("darkmode");
}

// Darkmode aan/uit zetten bij knop
btn.addEventListener("click", () => {
    document.body.classList.toggle("darkmode");

    // Opslaan in localStorage
    if (document.body.classList.contains("darkmode")) {
        localStorage.setItem("darkmode", "enabled");
    } else {
        localStorage.setItem("darkmode", "disabled");
    }
});
