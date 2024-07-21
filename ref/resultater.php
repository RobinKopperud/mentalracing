<?php
// Include the database connection file
include_once '../../db.php'; // Adjust the path as needed

// Fetch the unique years from the results table
$years_sql = "SELECT DISTINCT YEAR(date) as year FROM results ORDER BY year ASC";
$years_result = $conn->query($years_sql);

$years = [];
if ($years_result->num_rows > 0) {
    while ($row = $years_result->fetch_assoc()) {
        $years[] = $row['year'];
    }
}

// Fetch the results from the database
$year_filter = isset($_GET['year']) ? (int)$_GET['year'] : null;
$sql = "SELECT * FROM results";
if ($year_filter) {
    $sql .= " WHERE YEAR(date) = $year_filter";
}
$sql .= " ORDER BY date ASC";
$result = $conn->query($sql);

$results = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultater - Mental Racing Team</title>
    <link rel="stylesheet" href="../css/style.css?v=1.5">
    <link rel="stylesheet" href="../css/resultater.css?v=1.5">
    <link rel="stylesheet" href="../css/mobile.css?v=1.5" media="screen and (max-width: 768px)">
</head>
<body>
    <header>
        <div class="container">
            <a href="../index.php" class="header-link">
                <h1>Mental Racing Team</h1>
            </a>
        </div>
    </header>

    <section class="container">
        <h2>Resultater</h2>
        <form method="GET" action="">
            <label for="year">Filter by year:</label>
            <select id="year" name="year">
                <option value="">All</option>
                <?php foreach ($years as $year): ?>
                    <option value="<?php echo $year; ?>" <?php echo ($year_filter == $year) ? 'selected' : ''; ?>>
                        <?php echo $year; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Filter</button>
        </form>
        <div class="timeline">
            <?php
            $side = 'left';
            foreach ($results as $result) {
                echo '<div class="timeline-event ' . $side . '">';
                echo '    <div class="timeline-content">';
                echo '        <div class="image-container">';
                $image = !empty($result['image']) ? htmlspecialchars($result['image']) : 'default.jpg';
                echo '            <img src="../uploads/' . $image . '" alt="' . htmlspecialchars($result['race']) . '">';
                echo '        </div>';
                echo '        <div class="content">';
                echo '            <h2>' . htmlspecialchars($result['race']) . '</h2>';
                echo '            <p>Posisjon: ' . htmlspecialchars($result['position']) . '</p>';
                echo '            <p>Sykkel: ' . htmlspecialchars($result['bike']) . '</p>';
                echo '            <p>Tid: ' . htmlspecialchars($result['time']) . '</p>';
                echo '            <div class="date">' . htmlspecialchars($result['date']) . '</div>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
                $side = ($side === 'left') ? 'right' : 'left';
            }
            ?>
        </div>
    </section>
</body>
</html>
