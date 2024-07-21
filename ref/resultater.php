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
        <div class="results">
            <?php foreach ($results as $result): ?>
                <div class="result-item">
                    <div class="result-image">
                        <?php $image = !empty($result['image']) ? htmlspecialchars($result['image']) : 'default.jpg'; ?>
                        <img src="../uploads/<?php echo $image; ?>" alt="<?php echo htmlspecialchars($result['race']); ?>">
                    </div>
                    <div class="result-content">
                        <h3><?php echo htmlspecialchars($result['race']); ?></h3>
                        <p>Dato: <?php echo htmlspecialchars($result['date']); ?></p>
                        <p>Posisjon: <?php echo htmlspecialchars($result['position']); ?></p>
                        <p>Tid: <?php echo htmlspecialchars($result['time']); ?></p>
                        <p>Sykkel: <?php echo htmlspecialchars($result['bike']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
