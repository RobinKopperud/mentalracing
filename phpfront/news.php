<?php
// Database connection
include_once '../../../db.php'; // Adjust the path as needed

// Fetch the latest news
$sql = "SELECT title, content, driver, location, date, image FROM news ORDER BY date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="news-item">';
        echo '<img src="../uploads/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['title']) . '">';
        echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
        echo '<p>Driver: ' . htmlspecialchars($row['driver']) . '</p>';
        echo '<p>Location: ' . htmlspecialchars($row['location']) . '</p>';
        echo '<p>Date: ' . htmlspecialchars($row['date']) . '</p>';
        echo '<p>' . htmlspecialchars($row['content']) . '</p>';
        echo '</div>';
    }
} else {
    echo '<p>No news available</p>';
}

$conn->close();
?>
