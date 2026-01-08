<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
EIS PHP:
- Review info in multidimensionale associatieve array
- Alleen reviews met PEGI 16+ tonen met een loop
- 3 reviews PEGI 16+, 1 review <16
*/

// Multidimensionale associatieve array (4 reviews)
$latestReviews = [
  "Valorant" => [
    "title" => "Valorant",
    "genres" => ["FPS", "Tactical Shooter"],
    "pegi" => 16,
    "description" => "Tactische shooter waarbij teamwork, aim en strategie centraal staan.",
    "ratings" => [8, 9, 8, 8], // game ratings (0-10)
    "visitorReviews" => [
      ["name" => "Youssef", "text" => "Heel tactisch, teamwork is alles.", "rating" => 5],
      ["name" => "Peter", "text" => "Ranked is spannend en verslavend.", "rating" => 4],
      ["name" => "Anass", "text" => "Sterke gunplay, goeie agents.", "rating" => 4],
    ],
    "youtube" => "https://www.youtube.com/embed/e_E9W2vsRbQ",
    "platforms" => ["PC"],
    "maker" => "Riot Games"
  ],

  "Call of Duty: Warzone" => [
    "title" => "Call of Duty: Warzone",
    "genres" => ["Battle Royale", "FPS"],
    "pegi" => 18,
    "description" => "Snelle battle royale met loadouts, squads en intense fights.",
    "ratings" => [7, 8, 7, 8],
    "visitorReviews" => [
      ["name" => "Samir", "text" => "Actie non-stop, echt stress maar leuk.", "rating" => 4],
      ["name" => "Rayan", "text" => "Te veel sweats, maar wel top met vrienden.", "rating" => 4],
      ["name" => "Milo", "text" => "Movement en gunplay zijn heerlijk.", "rating" => 5],
    ],
    "youtube" => "https://www.youtube.com/embed/0E44DClsX5Q",
    "platforms" => ["PC", "PlayStation", "Xbox"],
    "maker" => "Activision"
  ],

  "GTA V" => [
    "title" => "Grand Theft Auto V",
    "genres" => ["Action", "Open World", "Adventure"],
    "pegi" => 18,
    "description" => "Open wereld met story mode en online chaos (GTA Online).",
    "ratings" => [10, 9, 10, 9],
    "visitorReviews" => [
      ["name" => "Taha", "text" => "Story is classic, online is chaos.", "rating" => 5],
      ["name" => "Alex", "text" => "Altijd wel iets te doen in Online.", "rating" => 4],
      ["name" => "Ehsaan", "text" => "Nog steeds één van de beste games.", "rating" => 5],
    ],
    "youtube" => "https://www.youtube.com/embed/QkkoHAzjnUs",
    "platforms" => ["PC", "PlayStation", "Xbox"],
    "maker" => "Rockstar Games"
  ],

  // 1 review voor jongeren (<16)
  "Rocket League" => [
    "title" => "Rocket League",
    "genres" => ["Sport", "Racing", "Arcade"],
    "pegi" => 7,
    "description" => "Auto’s + voetbal: korte matches, hoge skill ceiling en veel fun.",
    "ratings" => [9, 8, 9, 8],
    "visitorReviews" => [
      ["name" => "Yasin", "text" => "Super leuk met vrienden, goeie ranked.", "rating" => 5],
      ["name" => "Souf", "text" => "Makkelijk te leren, moeilijk te masteren.", "rating" => 4],
      ["name" => "Ali", "text" => "Goals voelen altijd satisfying.", "rating" => 5],
    ],
    "youtube" => "https://www.youtube.com/embed/OmMF9EDbmQQ",
    "platforms" => ["PC", "PlayStation", "Xbox", "Switch"],
    "maker" => "Psyonix"
  ],
];

// 16+ reviews selecteren (moet met loop)
$pegi16Plus = [];
foreach ($latestReviews as $key => $review) {
  if ($review["pegi"] >= 16) {
    $pegi16Plus[$key] = $review;
  }
}

// <16 review (zonder loop gebruiken -> hard select)
$under16 = $latestReviews["Rocket League"];

// alles naar JS sturen voor slideshow (4 items)
$allForJs = array_values($latestReviews);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Anass Maliki">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GameStars - Latest Reviews</title>

  <link rel="stylesheet" href="/styling/style.css">
  <script defer src="/lib/script.js"></script>
  <script defer src="/lib/latestreviews.js"></script>
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
  <h1>Latest Reviews</h1>

  <!-- ✅ PHP eis aantonen: alleen PEGI 16+ met LOOP -->
  <div class="review-card">
    <h2>PEGI 16+ Reviews (via PHP loop)</h2>
    <p>Deze 3 reviews worden met een <strong>PHP foreach loop</strong> getoond.</p>

    <?php foreach ($pegi16Plus as $r): ?>
      <p>
        <strong><?php echo "{$r["title"]} (PEGI {$r["pegi"]})"; ?></strong>
        — Maker: <?php echo "{$r["maker"]}"; ?>
        — Genres: <?php echo implode(", ", $r["genres"]); ?>
      </p>
    <?php endforeach; ?>
  </div>

  <!-- ✅ 1 review onder 16 (zonder loop laten zien) -->
  <div class="review-card">
    <h2>Jongeren review (onder 16)</h2>
    <p>
      <strong><?php echo "{$under16["title"]} (PEGI {$under16["pegi"]})"; ?></strong>
      — Maker: <?php echo "{$under16["maker"]}"; ?>
      — Genres: <?php echo implode(", ", $under16["genres"]); ?>
    </p>
  </div>

  <!-- ✅ Slideshow (JS eis: maar 1 tegelijk) -->
  <div class="review-card" id="slideshowCard">
    <h2>Slideshow: laatste 4 reviews</h2>
    <p id="slideCounter" style="margin: 0 0 10px;">Review 1/4</p>

    <div id="slideContent">
      <!-- JS vult dit -->
    </div>

    <div style="margin-top:14px; display:flex; justify-content:center; gap:10px; flex-wrap:wrap;">
      <button id="prevReview" class="order-btn" style="width:auto;">⬅ Vorige</button>
      <button id="nextReview" class="order-btn" style="width:auto;">Volgende ➡</button>
      <button id="pauseReview" class="order-btn" style="width:auto;">⏸ Pause</button>
    </div>
  </div>
</main>

<footer>
  <p>GameStars &copy; 2025 – Latest Reviews</p>
</footer>

<!-- PHP -> JS data -->
<script>
  window.latestReviewsData = <?php echo json_encode($allForJs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
</script>

</body>
</html>
