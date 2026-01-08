<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1) Eén array met 4 games
$games = [
    "FC 26" => [
        "title" => "FC 26",
        "owner" => "Anass",
        "genres" => ["Sport", "Voetbal", "Simulation"],
        "pegi" => 12,
        "description" => "Realistische voetbalgame met Ultimate Team, Career Mode en online gameplay.",
        "ratings" => [8, 7, 8, 9],
        "youtube" => "https://www.youtube.com/embed/9g8v0g9Qd0A",
        "platforms" => ["PC", "PlayStation", "Xbox"],
        "maker" => "EA Sports"
    ],
    "Rocket League" => [
        "title" => "Rocket League",
        "owner" => "Anass",
        "genres" => ["Sport", "Racing", "Arcade"],
        "pegi" => 7,
        "description" => "Auto’s + voetbal in snelle en competitieve matches.",
        "ratings" => [9, 8, 9, 8],
        "youtube" => "https://www.youtube.com/embed/OmMF9EDbmQQ",
        "platforms" => ["PC", "PlayStation", "Xbox", "Switch"],
        "maker" => "Psyonix"
    ],
    "Valorant" => [
        "title" => "Valorant",
        "owner" => "Peter",
        "genres" => ["FPS", "Tactical Shooter"],
        "pegi" => 16,
        "description" => "Tactische shooter waarin teamwork en strategie centraal staan.",
        "ratings" => [8, 9, 8, 8],
        "youtube" => "https://www.youtube.com/embed/e_E9W2vsRbQ",
        "platforms" => ["PC"],
        "maker" => "Riot Games"
    ],
    "Fortnite" => [
        "title" => "Fortnite",
        "owner" => "Peter",
        "genres" => ["Battle Royale", "Sandbox"],
        "pegi" => 12,
        "description" => "Populaire battle royale met bouwen, skins en live events.",
        "ratings" => [7, 8, 7, 8],
        "youtube" => "https://www.youtube.com/embed/2gUtfBmw86Y",
        "platforms" => ["PC", "PlayStation", "Xbox", "Switch", "Mobile"],
        "maker" => "Epic Games"
    ]
];

function avg($arr) {
    return array_sum($arr) / count($arr);
}

// 2) Game kiezen via GET
$selectedTitle = $_GET['game'] ?? "FC 26";
$age = isset($_GET['age']) ? (int)$_GET['age'] : 0;

// 3) Switch-statement
switch ($selectedTitle) {
    case "FC 26":
    case "Rocket League":
    case "Valorant":
    case "Fortnite":
        $game = $games[$selectedTitle];
        break;
    default:
        $selectedTitle = "FC 26";
        $game = $games["FC 26"];
        break;
}

// 4) Review verwerken (rating 1-5 -> *2 naar /10, daarna gemiddelde met oude avg)
$review = null;
$newAvg = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $text = trim($_POST["text"] ?? "");
    $rating5 = (int)($_POST["rating"] ?? 0);

    // game + age meenemen uit hidden fields (zodat je niet reset)
    $selectedTitle = $_POST["game"] ?? $selectedTitle;
    $age = isset($_POST["age"]) ? (int)$_POST["age"] : $age;

    // opnieuw game pakken (voor zekerheid)
    if (isset($games[$selectedTitle])) {
        $game = $games[$selectedTitle];
    }

    if ($name && $text && $rating5 >= 1 && $rating5 <= 5) {
        $oldAvg = avg($game["ratings"]);
        $rating10 = $rating5 * 2;
        $newAvg = ($oldAvg + $rating10) / 2;

        $review = [
            "name" => htmlspecialchars($name),
            "text" => htmlspecialchars($text),
            "rating5" => $rating5,
            "rating10" => $rating10
        ];
    } else {
        $review = ["error" => "Vul naam + beschrijving in en kies een rating van 1 t/m 5."];
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Anass Maliki">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GameStars - Game Review 4 (PHP)</title>

  <!-- ✅ extra veilig: absolute paden vanaf localhost root -->
  <link rel="stylesheet" href="/styling/style.css">
  <script defer src="/lib/script.js"></script>
</head>

<body>

<header>
  <nav class="navbar">
    <div class="logo">
      <a href="index.html">
        <img src="/images/gamestars-logo.png" alt="GameStars Logo">
      </a>
    </div>

    <ul class="nav-links">
      <li><a href="index.html">Home</a></li>
      <li><a href="games.html">Games</a></li>
      <li><a href="merchandise.html">Merchandise</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li><a href="gamereview.php">Review PHP</a></li>
      <li><a href="gamereview-js.html">Review JS</a></li>
      <li><a href="latest-reviews.php">Latest Reviews</a></li>

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
  <h1>Game Review (PHP) – Review 4</h1>

  <!-- Game kiezen via GET -->
  <div class="review-card">
    <p><strong>Kies een game (via URL / GET):</strong></p>

    <?php foreach ($games as $g): ?>
      <a href="?game=<?php echo urlencode($g['title']); ?>&age=<?php echo $age; ?>">
        <?php echo $g["title"]; ?>
      </a> |
    <?php endforeach; ?>

    <form method="get" style="margin-top:10px; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
      <input type="hidden" name="game" value="<?php echo htmlspecialchars($selectedTitle); ?>">
      <label><strong>Leeftijd:</strong></label>
      <input type="number" name="age" value="<?php echo $age; ?>" min="0" style="padding:8px; max-width:140px;">
      <button type="submit" class="order-btn" style="width:auto;">Check</button>
    </form>

    <a href="index.html" class="hero-btn" style="margin-top:12px; display:inline-block;">Terug naar Home</a>
  </div>

  <?php if ($age >= $game["pegi"]): ?>
    <div class="review-card">
      <h2><?php echo $game["title"]; ?> (PEGI <?php echo $game["pegi"]; ?>)</h2>
      <p><strong>Reviewer:</strong> <?php echo $game["owner"]; ?></p>
      <p><strong>Maker:</strong> <?php echo $game["maker"]; ?></p>
      <p><strong>Genres:</strong> <?php echo implode(", ", $game["genres"]); ?></p>
      <p><strong>Platforms:</strong> <?php echo implode(", ", $game["platforms"]); ?></p>
      <p><strong>Beschrijving:</strong> <?php echo $game["description"]; ?></p>
      <p><strong>Gemiddelde rating (bestaand):</strong> <?php echo number_format(avg($game["ratings"]), 1); ?>/10</p>

      <div style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:12px; margin-top:12px;">
        <iframe src="<?php echo $game["youtube"]; ?>"
                style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;"
                allowfullscreen></iframe>
      </div>
    </div>

    <div class="review-card">
      <h2>Plaats jouw review</h2>

      <?php if (is_array($review) && isset($review["error"])): ?>
        <p style="color:#ff4444;"><strong><?php echo $review["error"]; ?></strong></p>
      <?php endif; ?>

      <form method="post">
        <!-- ✅ behoud game + age bij POST -->
        <input type="hidden" name="game" value="<?php echo htmlspecialchars($selectedTitle); ?>">
        <input type="hidden" name="age" value="<?php echo $age; ?>">

        <label><strong>Naam:</strong></label><br>
        <input type="text" name="name" required style="padding:10px; width:100%; max-width:500px;"><br><br>

        <label><strong>Beschrijving:</strong></label><br>
        <textarea name="text" rows="5" required style="padding:10px; width:100%; max-width:700px;"></textarea><br><br>

        <strong>Rating (1–5):</strong><br>
        <?php for ($i=1; $i<=5; $i++): ?>
          <label style="margin-right:10px;">
            <input type="radio" name="rating" value="<?php echo $i; ?>" required> <?php echo $i; ?>
          </label>
        <?php endfor; ?>

        <br><br>
        <button type="submit" class="order-btn" style="width:auto;">Submit</button>
      </form>
    </div>

    <?php if (is_array($review) && !isset($review["error"]) && $review !== null): ?>
      <div class="review-card">
        <h2>Review geplaatst ✅</h2>
        <p><strong><?php echo $review["name"]; ?>:</strong> <?php echo $review["text"]; ?></p>
        <p><strong>Jouw rating:</strong> <?php echo $review["rating5"]; ?>/5 (=<?php echo $review["rating10"]; ?>/10)</p>
        <p><strong>Nieuwe gemiddelde rating:</strong> <?php echo number_format($newAvg, 1); ?>/10</p>
      </div>
    <?php endif; ?>

  <?php else: ?>
    <div class="review-card">
      <h2>Sorry!</h2>
      <p>Je bent <?php echo $age; ?> jaar. Deze game is PEGI <?php echo $game["pegi"]; ?>.</p>
      <p><strong>Je bent niet oud genoeg om deze info te bekijken.</strong></p>
    </div>
  <?php endif; ?>

</main>

<footer>
  <p>GameStars &copy; 2025 – Game Review 4</p>
</footer>

</body>
</html>
