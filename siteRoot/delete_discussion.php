<?php
$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $discussionId = $_GET['id'];

    // Prepare the statement to delete discussion
    $stmt = $conn->prepare("DELETE FROM discussions WHERE id = ?");
    $stmt->bind_param("i", $discussionId);

    if ($stmt->execute()) {
        echo "Discussion deleted successfully.";
    } else {
        echo "Error deleting discussion: " . $stmt->error;
    }
    $stmt->close();
    header("Location: discussions.php");
    exit;
} else {
    echo "No discussion ID provided.";
}
?>
