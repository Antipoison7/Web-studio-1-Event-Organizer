<?php
// Database connection
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
        $fileSize = $file['size'];
        $fileType = $file['type'];

        // Set upload directory and move uploaded file
        $uploadDir = 'uploads/';
        $filePath = $uploadDir . basename($fileName);

        // Check if upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create it if not
        }

        // Move file to uploads directory
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            // Store image path in the database
            $stmt = $conn->prepare("INSERT INTO event_photos (event_id, photo_path) VALUES (?, ?)");
            $stmt->bind_param("is", $event_id, $filePath);
            $stmt->execute();
            $stmt->close();

            echo "Photo uploaded successfully!";
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
