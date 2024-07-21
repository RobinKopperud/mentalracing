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

// Fetch the unique drivers from the results table
$drivers_sql = "SELECT DISTINCT driver FROM results ORDER BY driver ASC";
$drivers_result = $conn->query($drivers_sql);

$drivers = [];
if ($drivers_result->num_rows > 0) {
    while ($row = $drivers_result->fetch_assoc()) {
        $drivers[] = $row['driver'];
    }
}

// Fetch the results from the database
$year_filter = isset($_GET['year']) ? (int)$_GET['year'] : null;
$driver_filter = isset($_GET['driver']) ? $_GET['driver'] : null;
$sql = "SELECT * FROM results";
if ($year_filter || $driver_filter) {
    $sql .= " WHERE";
    $conditions = [];
    if ($year_filter) {
        $conditions[] = " YEAR(date) = $year_filter";
    }
    if ($driver_filter) {
        $conditions[] = " driver = '$driver_filter'";
    }
    $sql .= implode(" AND", $conditions);
}
$sql .= " ORDER BY date ASC";
$result = $conn->query($sql);

$results = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
}

// Calculate the number of first, second, and third places for the selected driver
$first_place = $second_place = $third_place = 0;
if ($driver_filter) {
    $place_sql = "SELECT position, COUNT(*) as count FROM results WHERE driver = '$driver_filter' GROUP BY position";
    $place_result = $conn->query($place_sql);

    if ($place_result->num_rows > 0) {
        while ($row = $place_result->fetch_assoc()) {
            if ($row['position'] == 1) {
                $first_place = $row['count'];
            } elseif ($row['position'] == 2) {
                $second_place = $row['count'];
            } elseif ($row['position'] == 3) {
                $third_place = $row['count'];
            }
        }
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

            <label for="driver">Filter by driver:</label>
            <select id="driver" name="driver">
                <option value="">All</option>
                <?php foreach ($drivers as $driver): ?>
                    <option value="<?php echo htmlspecialchars($driver); ?>" <?php echo ($driver_filter == $driver) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($driver); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Filter</button>
        </form>

        <?php if ($driver_filter): ?>
            <div class="driver-summary">
                <h3>Driver Summary for <?php echo htmlspecialchars($driver_filter); ?>:</h3>
                <p>First Places: <?php echo $first_place; ?></p>
                <p>Second Places: <?php echo $second_place; ?></p>
                <p>Third Places: <?php echo $third_place; ?></p>
            </div>
        <?php endif; ?>

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
                        <p>Fører: <?php echo htmlspecialchars($result['driver']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
