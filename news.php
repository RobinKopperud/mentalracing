<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include_once '../db.php'; // Adjust the path as needed

// Fetch the latest news
$sql = "SELECT title, content, driver, location, date, image FROM news ORDER BY date DESC";
$result = $conn->query($sql);

if ($result === false) {
    echo "<p>Database error: " . $conn->error . "</p>";
} else {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="news-item">';
            echo '<div class="news-image" style="background-image: url(../uploads/' . htmlspecialchars($row['image']) . ');"></div>';
            echo '<div class="news-content">';
            echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
            echo '<div class="metadata">';
            echo '<p><strong>Driver:</strong> ' . htmlspecialchars($row['driver']) . '</p>';
            echo '<p><strong>Location:</strong> ' . htmlspecialchars($row['location']) . '</p>';
            echo '<p><strong>Date:</strong> ' . htmlspecialchars($row['date']) . '</p>';
            echo '</div>';
            echo '<p>' . htmlspecialchars($row['content']) . '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>No news available</p>';
    }
}

$conn->close();
?>
