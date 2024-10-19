<?php
// Database connection
$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Save a new discussion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title']; // Get the title from the form
    $content = $_POST['content']; // Get the content from the form
    
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO discussions (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to discussions page after successful insertion
        header("Location: discussions.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>
