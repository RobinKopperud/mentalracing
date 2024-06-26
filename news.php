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
            echo '<img src="../uploads/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['title']) . '">';
            echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
            echo '<div class="metadata">';
            echo '<p>Driver: ' . htmlspecialchars($row['driver']) . '</p>';
            echo '<p>Location: ' . htmlspecialchars($row['location']) . '</p>';
            echo '<p>Date: ' . htmlspecialchars($row['date']) . '</p>';
            echo '</div>';
            echo '<p>' . htmlspecialchars($row['content']) . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No news available</p>';
    }
}

$conn->close();
?>
