<?php
// Database connection details
$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if a file was uploaded without errors
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $event_id = $_POST['event_id'];
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpPath = $file['tmp_name'];

        // Set upload directory and move uploaded file
        $uploadDir = 'uploads/';
        $filePath = $uploadDir . basename($fileName);

        // Create upload directory if it does not exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move the file to the upload directory
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            // Insert the photo path into the database
            $stmt = $conn->prepare("INSERT INTO event_photos (event_id, photo_path) VALUES (?, ?)");
            $stmt->bind_param("is", $event_id, $filePath);
            $stmt->execute();
            $stmt->close();

            // Redirect back to gallery page
            header("Location: event1_gallery.php");
            exit();
        } else {
            echo "Error: Could not upload the file.";
        }
    } else {
        echo "Error: No file uploaded or there was an error during the upload.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>