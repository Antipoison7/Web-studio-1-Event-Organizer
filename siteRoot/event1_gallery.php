<?php
// Database connection
$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$event_id = 1; // Adjust as necessary
$result = $conn->query("SELECT photo_path FROM event_photos WHERE event_id = $event_id");

// Check if the query executed successfully
if ($result === false) {
    die("Error in query: " . $conn->error);
}

echo "<div class='uploaded-photos'>";
while ($row = $result->fetch_assoc()) {
    echo "<img src='" . htmlspecialchars($row['photo_path']) . "' alt='Uploaded Photo'>";
}
echo "</div>";

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event 1 Gallery</title>
    <link rel="stylesheet" href="fancommunity.css">
</head>
<body>
    <h2>Upload Your Photos</h2>
     <form action="upload_photo.php" method="POST" enctype="multipart/form-data">
       <label for="file">Choose a photo to upload:</label>
       <input type="file" name="file" id="file" required>
       <input type="hidden" name="event_id" value="1"> <!-- Adjust based on the event -->
       <button type="submit">Upload Photo</button>
     </form>
    <h2>Event 1 - Full Gallery</h2>
    <div class="full-gallery-container">
        <!-- Event-specific images -->
        <img src="path/to/event1_image5.jpg" alt="Event 1 Photo 5">
        <img src="path/to/event1_image6.jpg" alt="Event 1 Photo 6">
        <!-- Add as many images as needed for this event -->
    </div>
</body>
</html>
