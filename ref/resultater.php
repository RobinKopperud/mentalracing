<?php
// Include the database connection file
include_once '../../db.php'; // Adjust the path as needed

// Fetch results from the database
$stmt = $pdo->query('SELECT date, race, position, time, bike, image FROM results ORDER BY date DESC');
$results = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultater - Mental Racing Team</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/resultater.css">
    <link rel="stylesheet" href="css/mobile.css" media="screen and (max-width: 768px)">
</head>
<body>
    <header>
        <div class="container">
            <a href="index.php"><h1>Mental Racing Team</h1></a>
        </div>
    </header>

    <section id="results" class="content-section">
        <h2>Resultater</h2>
        <table class="results-table">
            <thead>
                <tr>
                    <th>Dato</th>
                    <th>Race</th>
                    <th>Posisjon</th>
                    <th>Tid</th>
                    <th>Sykkel</th>
                    <th>Bilde</th> <!-- New column for image -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                <tr>
                    <td><?php echo htmlspecialchars($result['date']); ?></td>
                    <td><?php echo htmlspecialchars($result['race']); ?></td>
                    <td><?php echo htmlspecialchars($result['position']); ?></td>
                    <td><?php echo htmlspecialchars($result['time']); ?></td>
                    <td><?php echo htmlspecialchars($result['bike']); ?></td>
                    <td>
                        <?php if (!empty($result['image'])): ?>
                            <img src="<?php echo htmlspecialchars($result['image']); ?>" alt="Race Image" style="width:100px;height:auto;">
                        <?php else: ?>
                            Ingen bilde tilgjengelig
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
</body>
</html>
