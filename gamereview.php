<?php
// ==========================
// Game Reviews 3 - PHP Pagina
// Eisen:
// - 1 associatieve array met daarin 2 games
// - $selectedTitle aanpassen om andere game te tonen
// - switch-statement
// - interpolatie
// - leeftijd >= PEGI? anders melding
// - loopjes voor alle info (genre, fotos, platforms, ratings)
// ==========================

// 1) Alleen 1 array met 2 games (associatief)
$games = [
    "FC 26" => [
        "title" => "FC 26",
        "genres" => ["Sport", "Voetbal", "Simulation"],
        "photos" => [
            "images/fc26.avif",
            "images/fc26.avif",
            "images/fc26.avif"
        ],
        "pegi" => 12,
        "description" => "Speel in je eigen team en verbeter je skills op het veld. Ultimate Team, Career en online gameplay.",
        "ratings" => [8, 7, 8, 9], // gemiddelde berekenen
        "youtubeEmbed" => "https://www.youtube.com/embed/9g8v0g9Qd0A", // vervang door echte trailer embed
        "platforms" => ["PC", "PlayStation", "Xbox"],
        "maker" => "EA Sports"
    ],
    "Rocket League" => [
        "title" => "Rocket League",
        "genres" => ["Sport", "Racing", "Arcade"],
        "photos" => [
            "images/rocket_league_coverart.jpg",
            "images/rocket_league_coverart.jpg",
            "images/rocket_league_coverart.jpg"
        ],
        "pegi" => 7,
        "description" => "Auto’s + voetbal = chaos. Snelle matches, rankeds, en skills die je blijft leren.",
        "ratings" => [9, 8, 9, 8],
        "youtubeEmbed" => "https://www.youtube.com/embed/OmMF9EDbmQQ", // vervang door echte trailer embed
        "platforms" => ["PC", "PlayStation", "Xbox", "Switch"],
        "maker" => "Psyonix"
    ],
];

// 2) Variabele veranderen = andere game tonen (op titel)
// Je mag dit ook via URL doen, maar eis zegt: via variabele kunnen switchen
$selectedTitle = "FC 26"; // <-- verander naar "Rocket League" om andere te tonen

// 3) Leeftijd vragen (simpel via GET; kan ook via formulier)
$age = isset($_GET["age"]) ? (int)$_GET["age"] : 0;

// 4) Switch-statement (moet erin)
switch ($selectedTitle) {
    case "FC 26":
        $selectedGame = $games["FC 26"];
        break;
    case "Rocket League":
        $selectedGame = $games["Rocket League"];
        break;
    default:
        $selectedGame = $games["FC 26"];
        break;
}

// helper: gemiddelde rating
function averageRating(array $ratings): float {
    if (count($ratings) === 0) return 0;
    return array_sum($ratings) / count($ratings);
}

$avg = averageRating($selectedGame["ratings"]);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Anass Maliki">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStars - Review PHP</title>
    <link rel="stylesheet" href="styling/style.css">
    <script defer src="lib/script.js"></script>
</head>
<body>

<header>
    <nav class="navbar">
        <div class="logo">
            <a href="index.html"><img src="images/gamestars-logo.png" alt="GameStars Logo"></a>
        </div>
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="games.html">Games</a></li>
            <li><a href="merchandise.html">Merchandise</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="gamereview.php">Review PHP</a></li>
            <li><a href="gamereview-js.html">Review JS</a></li>
        </ul>
        <div class="nav-right">
            <form id="searchForm">
                <input type="text" placeholder="Zoek pagina..." class="search-input" id="searchInput">
                <button type="submit">Zoek</button>
            </form>
            <button id="darkmodeBtn">Dark mode</button>
        </div>
    </nav>
</header>

<main class="game-review-page">
    <h1>Game Review (PHP)</h1>

    <form method="get" style="margin-bottom: 20px;">
        <label for="age"><strong>Vul je leeftijd in:</strong></label>
        <input id="age" name="age" type="number" min="0" value="<?php echo $age; ?>" style="padding:8px; max-width:120px;">
        <button type="submit" class="order-btn" style="width:auto;">Check</button>
    </form>

    <?php if ($age >= $selectedGame["pegi"]): ?>
        <div class="review-card">
            <h2><?php echo "{$selectedGame["title"]} (PEGI {$selectedGame["pegi"]})"; ?></h2>

            <p><strong>Maker:</strong> <?php echo "{$selectedGame["maker"]}"; ?></p>

            <p><strong>Genre(s):</strong>
                <?php
                // loop: genres
                $genreParts = [];
                foreach ($selectedGame["genres"] as $g) { $genreParts[] = $g; }
                echo implode(", ", $genreParts);
                ?>
            </p>

            <p><strong>Platforms:</strong>
                <?php
                // loop: platforms
                $platParts = [];
                foreach ($selectedGame["platforms"] as $p) { $platParts[] = $p; }
                echo implode(", ", $platParts);
                ?>
            </p>

            <p><strong>Beschrijving:</strong> <?php echo "{$selectedGame["description"]}"; ?></p>

            <p><strong>Ratings:</strong>
                <?php
                // loop: ratings
                foreach ($selectedGame["ratings"] as $r) {
                    echo "<span style='margin-right:6px;'>$r</span>";
                }
                ?>
            </p>

            <p><strong>Gemiddelde rating:</strong> <?php echo number_format($avg, 1); ?>/10</p>

            <p><strong>Foto’s:</strong></p>
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px;">
                <?php foreach ($selectedGame["photos"] as $img): ?>
                    <img src="<?php echo $img; ?>" alt="<?php echo $selectedGame["title"]; ?>" style="border-radius:10px;">
                <?php endforeach; ?>
            </div>

            <p style="margin-top:18px;"><strong>Trailer:</strong></p>
            <div style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:12px;">
                <iframe
                    src="<?php echo $selectedGame["youtubeEmbed"]; ?>"
                    title="YouTube trailer"
                    style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    <?php else: ?>
        <div class="review-card">
            <h2>Sorry!</h2>
            <p>Je bent <?php echo $age; ?> jaar. Deze game is PEGI <?php echo $selectedGame["pegi"]; ?>.</p>
            <p><strong>Je bent niet oud genoeg om deze info te bekijken.</strong></p>
        </div>
    <?php endif; ?>

    <div class="switch-links">
        <p><strong>Tip:</strong> verander bovenaan in PHP de variabele <code>$selectedTitle</code> naar een andere titel.</p>
    </div>
</main>

<footer>
    <p>GameStars &copy; 2025 – Bekijk onze reviews!</p>
</footer>
</body>
</html>
