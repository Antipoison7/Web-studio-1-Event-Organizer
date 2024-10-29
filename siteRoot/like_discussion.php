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
        // After updating, fetch the new like or dislike count
        $countSql = "SELECT likes, dislikes FROM discussions WHERE id = ?";
        $countStmt = $conn->prepare($countSql);
        $countStmt->bind_param("i", $id);
        $countStmt->execute();
        $result = $countStmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            // Return the new counts as JSON
            echo json_encode(['likes' => $row['likes'], 'dislikes' => $row['dislikes']]);
        } else {
            echo json_encode(['error' => 'Discussion not found.']);
        }

        $countStmt->close();
    } else {
        echo json_encode(['error' => 'Failed to update count.']);
    }

    $stmt->close();
}

$conn->close();
?>
