<?php

header('Content-Type: application/json');

// Database credentials
$servername = "talsprddb02.int.its.rmit.edu.au:3306";
$username = "COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";

// Establish database connection
$db = mysqli_connect($servername, $username, $password, $dbname);
if (!$db) {
    echo json_encode(["error" => "Database connection failed"]);
    exit();
}

// Include necessary files
include_once('./Resources/Helper/commentfunctions.php');
include_once('./Resources/Helper/sanitization.php');

// Check if the request is an AJAX request
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    
    // Handling a new comment
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_text'])) {
        $comment_text = sanitizeInput($_POST['comment_text']);
        $user_id = $_SESSION['loginDetails']['user_id'] ?? null;

        if ($user_id && !empty($comment_text)) {
            $stmt = $db->prepare("INSERT INTO comments (post_id, user_id, body, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("iis", $post_id, $user_id, $comment_text);
            $post_id = 1; // Assuming the post ID is known

            if ($stmt->execute()) {
                $inserted_id = $db->insert_id;
                $comment_html = generateCommentHtml($inserted_id);
                $response = [
                    "comment" => $comment_html,
                    "comments_count" => getCommentsCountByPostId($post_id)
                ];
            } else {
                $response = ["error" => "Failed to add comment"];
            }
            $stmt->close();
        } else {
            $response = ["error" => "Invalid comment or user"];
        }
        echo json_encode($response);
        exit();
    }

    // Handling a new reply
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_text']) && isset($_POST['comment_id'])) {
        $reply_text = sanitizeInput($_POST['reply_text']);
        $comment_id = intval($_POST['comment_id']);
        $user_id = $_SESSION['loginDetails']['user_id'] ?? null;

        if ($user_id && !empty($reply_text)) {
            $stmt = $db->prepare("INSERT INTO replies (user_id, comment_id, body, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("iis", $user_id, $comment_id, $reply_text);

            if ($stmt->execute()) {
                $inserted_id = $db->insert_id;
                $reply_html = generateReplyHtml($inserted_id);
                echo json_encode(["reply" => $reply_html]);
            } else {
                echo json_encode(["error" => "Failed to add reply"]);
            }
            $stmt->close();
            exit();
        } else {
            echo json_encode(["error" => "Invalid reply or user"]);
            exit();
        }
    }

    // Default error response for invalid requests
    echo json_encode(["error" => "Invalid request"]);
    exit();
}
?>
