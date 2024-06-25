<?php
include_once '../../db.php'; // Adjust the path as needed

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['news_title']) && $_SESSION['authenticated']) {
    $title = $_POST['news_title'];
    $content = $_POST['news_content'];
    $driver = $_POST['news_driver'];
    $location = $_POST['news_location'];
    $date = $_POST['news_date'];
    $image = $_FILES['news_image']['name'];

    // Set a default value for image
    $target = null;
    if (!empty($image)) {
        $target = "../uploads/" . basename($image);
    }

    // Attempt to move the uploaded image if one was provided
    if (empty($image) || move_uploaded_file($_FILES['news_image']['tmp_name'], $target)) {
        $image = empty($image) ? null : basename($image); // Use null if no image was uploaded
        $sql = "INSERT INTO news (title, content, driver, location, date, image) VALUES ('$title', '$content', '$driver', '$location', '$date', " . ($image ? "'$image'" : "NULL") . ")";
        if ($conn->query($sql) === TRUE) {
            $success = 'News item uploaded successfully!';
        } else {
            $error = 'Database error: ' . $conn->error;
        }
    } else {
        $error = 'Failed to upload image';
    }
}
?>

<form class="admin-form" method="POST" enctype="multipart/form-data">
    <label for="news_title">Title:</label>
    <input type="text" id="news_title" name="news_title" required>

    <label for="news_content">Content:</label>
    <textarea id="news_content" name="news_content" required></textarea>

    <label for="news_driver">Driver:</label>
    <input type="text" id="news_driver" name="news_driver" required>

    <label for="news_location">Location:</label>
    <input type="text" id="news_location" name="news_location" required>

    <label for="news_date">Date:</label>
    <input type="date" id="news_date" name="news_date" required>

    <label for="news_image">Image:</label>
    <input type="file" id="news_image" name="news_image" accept="image/*" optional>

    <button type="submit">Post News</button>
    <?php if (isset($success)): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
</form>
