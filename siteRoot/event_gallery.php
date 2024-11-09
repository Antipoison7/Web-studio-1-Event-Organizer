<?php
// Database connection details
$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set a default event ID if none is provided in the URL
$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 1; // Default to event 1

// Fetch uploaded photos for the event
$result = $conn->query("SELECT photo_path FROM event_photos WHERE event_id = $event_id");

// Check if the query executed successfully
if ($result === false) {
    die("Error in query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event <?php echo htmlspecialchars($event_id); ?> Gallery</title>
    <link rel="stylesheet" href="./Resources/Style/fancommunity.css">
</head>
<body>
    <nav class="navbar">
        <a href="HomePage.php" class="nav-link">Home</a>
        <a href="fancommunity.php" class="nav-link">Fan Community</a>
        <a href="favorites.php" class="nav-link">Favorites</a>
        <a href="profileView.php" class="nav-link">Profile</a>
    </nav>

    <h2>Upload Your Photos for Event <?php echo htmlspecialchars($event_id); ?></h2>
    <form action="upload_photo.php?event_id=<?php echo htmlspecialchars($event_id); ?>" method="POST" enctype="multipart/form-data">
        <label for="file">Choose a photo to upload:</label>
        <input type="file" name="file" id="file" required>
        <button type="submit">Upload Photo</button>
    </form>

    <h2>Event <?php echo htmlspecialchars($event_id); ?> - Full Gallery</h2>
    <div class="full-gallery-container">
        <!-- Static images -->
        <img src="../siteRoot/Resources/Images/fancommunity/Fangallery/E3P3.jpg" alt="Event Photo">
        <img src="../siteRoot/Resources/Images/fancommunity/Fangallery/E2P3.jpg" alt="Event Photo">

        <!-- Uploaded images from the database -->
        <?php while ($row = $result->fetch_assoc()): ?>
            <img src="<?php echo htmlspecialchars($row['photo_path']); ?>" alt="">
        <?php endwhile; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>