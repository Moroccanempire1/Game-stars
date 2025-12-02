<?php
$myGames = [
    "FC26" => [
        "title" => "FC 26",
        "pegi" => "12",
        "genre" => "Sport / Voetbal",
        "description" => "Speel in je eigen team en verbeter je skills op het veld.",
        "platform" => "PC, PlayStation, Xbox"
    ],
    "RocketLeague" => [
        "title" => "Rocket League",
        "pegi" => "7",
        "genre" => "Racing / Sport",
        "description" => "Race met je auto en scoor epische goals in een futuristisch stadion.",
        "platform" => "PC, PlayStation, Xbox, Switch"
    ],
[
    "Valorant" => [
        "title" => "Valorant",
        "pegi" => "16",
        "genre" => "FPS / Shooter",
        "description" => "Tactische shooter waarin teamwork en strategie centraal staan.",
        "platform" => "PC"
    ],
    "Fortnite" => [
        "title" => "Fortnite",
        "pegi" => "12",
        "genre" => "Battle Royale",
        "description" => "Bouw en strijd tegen andere spelers in een kleurrijke wereld.",
        "platform" => "PC, PlayStation, Xbox, Switch, Mobile"
    ]
    ]
];

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Anass Maliki">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStars - Game Reviews</title>
    <link rel="stylesheet" href="./styling/style.css">
    <script defer src="lib/gamereview.js"></script>
    <script defer src="lib/script.js"></script>
</head>
<body>

<header>
    <nav class="navbar">
        <div class="logo">
            <a href="index.html"><img src="./images/logo gamstars.png" alt="GameStars Logo"></a>
        </div>
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="games.html">Games</a></li>
            <li><a href="merchandise.html">Merchandise</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
        <div class="nav-right">
            <input type="text" placeholder="Zoek pagina..." class="search-input" id="searchInput">
            <button id="darkmodeBtn">Dark mode</button>
        </div>
    </nav>
</header>

<main class="game-review-page">
    <h1>Game Reviews - <?php echo ucfirst($player); ?></h1>

    <?php foreach($gamesToShow as $game): ?>
        <div class="review-card">
            <h2><?php echo $game['title']; ?> (PEGI <?php echo $game['pegi']; ?>)</h2>
            <p><strong>Genre:</strong> <?php echo $game['genre']; ?></p>
            <p><strong>Beschrijving:</strong> <?php echo $game['description']; ?></p>
            <p><strong>Platform:</strong> <?php echo $game['platform']; ?></p>
        </div>
    <?php endforeach; ?>

    <div class="switch-links">
        <a href="?player=me">Mijn reviews</a> | 
        <a href="?player=classmate">Reviews klasgenoot</a>
    </div>
</main>

<footer>
    <p>GameStars &copy; 2025 – Bekijk onze reviews en kies jouw favoriete games!</p>
</footer>

</body>
</html>
