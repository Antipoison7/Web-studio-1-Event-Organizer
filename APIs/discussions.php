<?php
header('Content-Type: application/json');

$servername = "talsprddb02.int.its.rmit.edu.au";
$username = " COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch discussions
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM discussions LIMIT 500";
    $result = $conn->query($sql);
    
    $discussions = [];
    while ($row = $result->fetch_assoc()) {
        $discussions[] = $row;
    }
    echo json_encode($discussions);
}

// Save a new discussion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newDiscussion = json_decode(file_get_contents("php://input"), true);
    $content = $newDiscussion['content'];
    
    $stmt = $conn->prepare("INSERT INTO discussions (content) VALUES (?)");
    $stmt->bind_param("s", $content);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Discussion saved!"]);
    } else {
        echo json_encode(["message" => "Error saving discussion."]);
    }
}

$conn->close();
?>
