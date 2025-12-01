<?php
// Kies welke game getoond wordt
$gameKeuze = 1; // 1 of 2

// Associatieve arrays met game info
$game1 = [
    "titel" => "FC 26",
    "genre" => "Sport / Voetbal",
    "pegi" => "3+",
    "platforms" => "PC, PlayStation, Xbox",
    "beschrijving" => "FC 26 is een realistische voetbalgame met veel licenties en teams."
];

$game2 = [
    "titel" => "Rocket League",
    "genre" => "Racing / Sport",
    "pegi" => "3+",
    "platforms" => "PC, PlayStation, Xbox, Switch",
    "beschrijving" => "Rocket League combineert voetbal met snelle auto’s in spannende multiplayer matches."
];

// Kies welke game getoond wordt
if($gameKeuze == 1){
    $game = $game1;
} else {
    $game = $game2;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStars - Game Review PHP</title>
    <link rel="stylesheet" href="styling/style.css">
    <script defer src="lib/script.js"></script>
</head>
<body>
<header>
    <nav class="navbar">
        <div class="logo">
            <a href="index.html">
                <img src="images/logo gamstars.png" alt="GameStars Logo">
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="games.html">Games</a></li>
            <li><a href="merchandise.html">Merchandise</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="gamereview-js.html">Review JS</a></li>
        </ul>
        <div class="nav-right">
            <button id="darkmodeBtn">Dark mode</button>
        </div>
    </nav>
</header>

<main class="games-page">
    <h1>Game Review</h1>
    <div class="game-item">
        <h2><?= $game['titel']; ?></h2>
        <p><strong>Genre:</strong> <?= $game['genre']; ?></p>
        <p><strong>PEGI:</strong> <?= $game['pegi']; ?></p>
        <p><strong>Platforms:</strong> <?= $game['platforms']; ?></p>
        <p><?= $game['beschrijving']; ?></p>
    </div>

    <a href="index.html" class="hero-btn" style="margin-top:20px; display:inline-block;">Terug naar Home</a>
</main>

<footer>
    <p>GameStars &copy; 2025 – Bekijk meer reviews of ga terug naar Home!</p>
</footer>
</body>
</html>
