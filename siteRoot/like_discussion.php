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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action == 'like') {
        $sql = "UPDATE discussions SET likes = likes + 1 WHERE id = ?";
    } elseif ($action == 'dislike') {
        $sql = "UPDATE discussions SET dislikes = dislikes + 1 WHERE id = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
    $stmt->close();
}
$conn->close();
?>
