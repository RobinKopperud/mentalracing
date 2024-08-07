<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Racing Team</title>
    <link rel="stylesheet" href="css/style.css?v=6.0">
    <link rel="stylesheet" href="css/countdown.css?v=5.0">
    <link rel="stylesheet" href="css/news.css?v=6.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="css/mobile.css?v=6.0" media="screen and (max-width: 768px)">
</head>
<body>
    <header>
        <div class="container">
            <a href="index.php"><h1>Mental Racing Team</h1></a>
        </div>
    </header>

    <button class="menu-toggle" aria-label="Toggle menu">☰</button>

    <nav>
        <a href="ref/resultater.php">Resultater</a>
        <a href="ref/timeline.php">Historie</a>
        <a href="ref/galleri.php">Galleri</a>
        <a href="#contact">Kontakt/Sponsor</a>
        <a href="admin/admin.php">Administrator</a>
    </nav>

    <section id="countdown-section" class="content-section">
        <h2>Nedtelling til neste race</h2>
        <div id="countdown" class="countdown">
            <div class="countdown-item">
                <span id="days"></span>
                <div class="smalltext">Dager</div>
            </div>
            <div class="countdown-item">
                <span id="hours"></span>
                <div class="smalltext">Timer</div>
            </div>
            <div class="countdown-item">
                <span id="minutes"></span>
                <div class="smalltext">Minutter</div>
            </div>
            <div class="countdown-item">
                <span id="seconds"></span>
                <div class="smalltext">Sekunder</div>
            </div>
        </div>
        <p>til neste race!</p>
        <div class="race-icons">
            <i class="fas fa-flag-checkered"></i>
            <i class="fas fa-tachometer-alt"></i>
            <i class="fas fa-car"></i>
        </div>
    </section>

    <section id="news" class="content-section">
        <h2>Nyheter</h2>
        <div class="news-container">
            <?php include 'news.php'; ?>
        </div>
    </section>

    <section id="about" class="content-section">
        <h2>Om Mental Racing Team</h2>
        <p>Mental Racing Team ble grunnlagt av en ung racerfører som gjennomgikk en hjertetransplantasjon i en alder av 16 år. Denne livsendrende erfaringen har formet vår misjon om å bruke racing som en plattform for å rette oppmerksomhet mot menns mentale helse.</p>
    </section>

    <section id="mission" class="content-section">
        <h2>Vår Misjon</h2>
        <p>Vi er dedikert til å bryte ned stigmaet rundt menns mentale helse gjennom kraften av motorsport. Vår visjon er å skape et fellesskap der menn føler seg trygge på å diskutere sine mentale helseproblemer, og hvor støtte alltid er tilgjengelig.</p>
    </section>

    <section id="contact" class="content-section">
        <h2>Kontakt Oss</h2>
        <p>Interessert i å sponse eller støtte vårt oppdrag? Ta kontakt med oss på Instagram eller send oss en e-post.</p>
        <p>Instagram: @Mental.racing22</p>
        <p>E-post: contact@mentalracing.no</p>
        <p>
            <button id="contactButton">Send oss en melding</button>
        </p>
    </section>
    
    <footer>
        <div class="social-links">
            <a href="https://www.instagram.com/Mental.racing22" target="_blank">Instagram</a>
            <a href="https://www.tiktok.com/@mentalracingteam" target="_blank">TikTok</a>
        </div>
        <p>&copy; 2024 Mental Racing Team. Alle rettigheter reservert.</p>
    </footer>

    <script src="scripts/script.js"></script>
    <script src="scripts/nextrace.js"></script>
    <script src="scripts/mail.js"></script>
    <script src="scripts/news.js"></script>
    <script src="scripts/news2.js"></script>
</body>
</html>
