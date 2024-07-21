<?php
session_start();
include_once '../../db.php'; // Adjust the path as needed

// Ensure user is authenticated
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date']) && $_SESSION['authenticated']) {
    $date = $_POST['date'];
    $race = $_POST['race'];
    $position = $_POST['position'];
    $time = $_POST['time'];
    $bike = $_POST['bike'];
    $image = $_FILES['image']['name'];

    // Set a default value for image
    $target = null;
    if (!empty($image)) {
        $target = "../../uploads/" . basename($image);
    }

    // Attempt to move the uploaded image if one was provided
    if (empty($image) || move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $image = empty($image) ? null : basename($image); // Use null if no image was uploaded
        $sql = "INSERT INTO results (date, race, position, time, bike, image) VALUES ('$date', '$race', '$position', '$time', '$bike', " . ($image ? "'$image'" : "NULL") . ")";
        if ($conn->query($sql) === TRUE) {
            $success = 'Resultat vellykket lastet opp!';
            // Clear the form fields after successful submission
            $date = $race = $position = $time = $bike = $image = "";
        } else {
            $error = 'Database error: ' . $conn->error;
        }
    } else {
        $error = 'Failed to upload image';
    }
}
?>

<form class="admin-form" method="POST" enctype="multipart/form-data">
    <label for="date">Dato:</label>
    <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" required>
    
    <label for="race">Race:</label>
    <input type="text" id="race" name="race" value="<?php echo htmlspecialchars($race); ?>" required>
    
    <label for="position">Posisjon:</label>
    <input type="number" id="position" name="position" value="<?php echo htmlspecialchars($position); ?>" required>
    
    <label for="time">Tid:</label>
    <input type="text" id="time" name="time" value="<?php echo htmlspecialchars($time); ?>" placeholder="HH:MM:SS" required>
    
    <label for="bike">Sykkel:</label>
    <input type="text" id="bike" name="bike" value="<?php echo htmlspecialchars($bike); ?>" required>
    
    <label for="image">Bilde:</label>
    <input type="file" id="image" name="image" accept="image/*">
    
    <button type="submit">Last opp resultat</button>
    <?php if (!empty($success)): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
</form>
