// Include the database connection file
include_once '../../db.php'; // Adjust the path as needed

// Fetch the unique years from the timeline_events table
$years_sql = "SELECT DISTINCT YEAR(event_date) as year FROM timeline_events ORDER BY year ASC";
$years_result = $conn->query($years_sql);

$years = [];
if ($years_result->num_rows > 0) {
    while ($row = $years_result->fetch_assoc()) {
        $years[] = $row['year'];
    }
}

// Fetch the timeline events from the database
$year_filter = isset($_GET['year']) ? (int)$_GET['year'] : null;
$sql = "SELECT * FROM timeline_events";
if ($year_filter) {
    $sql .= " WHERE YEAR(event_date) = $year_filter";
}
$sql .= " ORDER BY event_date ASC";
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tidslinje - Mental Racing Team</title>
    <link rel="stylesheet" href="timeline.css?v=1.4">
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
        <h2>Historie</h2>
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
            foreach ($events as $event) {
                echo '<div class="timeline-event ' . $side . '">';
                echo '    <div class="timeline-content">';
                echo '        <div class="image-container">';
                $image = !empty($event['image']) ? htmlspecialchars($event['image']) : 'v2.jpg';
                echo '            <img src="../uploads/' . $image . '" alt="' . htmlspecialchars($event['title']) . '">';
                echo '        </div>';
                echo '        <div class="content">';
                echo '            <h2>' . htmlspecialchars($event['title']) . '</h2>';
                echo '            <p>' . htmlspecialchars($event['comment']) . '</p>';
                echo '            <div class="date">' . htmlspecialchars($event['event_date']) . '</div>';
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
