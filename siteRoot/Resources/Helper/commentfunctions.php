<?php
session_start(); // Start the session
header('Content-Type: application/json'); // Set header for JSON response

include_once('./Resources/Helper/commentfunctions.php');
include_once('./Resources/Helper/sanitization.php');
include_once('./Resources/Helper/headers.php');

// Make sure to include your database connection here
include_once('./Resources/Helper/database.php'); // Hypothetical file for database connection

$response = [];

// Handle a new comment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_text']) && isset($_POST['comment_posted'])) {
    $comment_text = sanitizeInput($_POST['comment_text']);
    $user_id = $_SESSION['loginDetails']['user_id'] ?? null;

    if ($user_id && !empty($comment_text)) {
        $comment_id = addComment($user_id, $comment_text); // Function to add comment
        $comment_html = generateCommentHtml($comment_id); // Function to generate HTML for the new comment

        $response = [
            "comment" => $comment_html,
            "comments_count" => getCommentsCount() // Function to get comment count
        ];
    } else {
        $response = ["error" => "Invalid comment or user"];
    }
    echo json_encode($response); // Send the response as JSON
    exit;
}

// Handling a new reply
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_text']) && isset($_POST['comment_id'])) {
    $reply_text = sanitizeInput($_POST['reply_text']);
    $comment_id = intval($_POST['comment_id']);
    $user_id = $_SESSION['loginDetails']['user_id'] ?? null;

    if ($user_id && !empty($reply_text) && $comment_id) {
        // Database connection should already be established
        $stmt = $db->prepare("INSERT INTO replies (user_id, comment_id, body, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $user_id, $comment_id, $reply_text);

        if ($stmt->execute()) {
            $inserted_id = $db->insert_id;
            $reply_html = generateReplyHtml($inserted_id); // Function to generate HTML for the new reply
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
exit(); // Ensure no further processing happens after this point
?>
