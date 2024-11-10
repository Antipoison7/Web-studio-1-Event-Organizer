<?php
// Database connection details
$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if file is uploaded and event_id is set in the URL
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0 && isset($_GET['event_id'])) {
        $event_id = intval($_GET['event_id']); // Get event_id from the query parameter
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpPath = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        // Check if the file type is allowed
        if (!in_array($fileType, $allowedTypes)) {
            echo "Error: Only JPG, PNG, and GIF files are allowed.";
            exit;
        }

        // Check file size (example: max size 15MB)
        if ($fileSize > 15 * 1024 * 1024) { // 15MB
            echo "Error: File size exceeds the 15MB limit.";
            exit;
        }

        // Set upload directory
        $uploadDir = 'uploads/';
        
        // Create the directory if it does not exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Define the full path where the file will be saved
        $filePath = $uploadDir . basename($fileName);

        // Debugging: Print file info
        echo 'File name: ' . $fileName . '<br>';
        echo 'File type: ' . $fileType . '<br>';
        echo 'File size: ' . $fileSize . ' bytes<br>';
        echo 'File path: ' . $filePath . '<br>';

        // Move the uploaded file to the target directory
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            // Insert the photo path into the database
            $stmt = $conn->prepare("INSERT INTO event_photos (event_id, photo_path) VALUES (?, ?)");
            $stmt->bind_param("is", $event_id, $filePath);
            $stmt->execute();
            $stmt->close();

            // Redirect back to the specific event gallery page
            header("Location: event_gallery.php?event_id=" . $event_id);
            exit();
        } else {
            echo "Error: Could not upload the file.";
        }
    } else {
        echo "Error: No file uploaded, event ID missing, or there was an error during the upload.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
