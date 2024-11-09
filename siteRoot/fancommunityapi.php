<?php
header("Content-Type: application/json");
include('db_connection.php'); // Ensure this path matches your setup

// Main handler based on the 'action' parameter in the request
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'addDiscussion':
            addDiscussion();
            break;
        case 'addReply':
            addReply();
            break;
        case 'likeDiscussion':
            likeDiscussion();
            break;
        case 'dislikeDiscussion':
            dislikeDiscussion();
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
}

// Function to add a new discussion
function addDiscussion() {
    global $conn;
    $content = $_POST['content'] ?? '';
    if (!empty($content)) {
        $sql = "INSERT INTO discussions (content) VALUES ('$content')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Discussion added']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add discussion']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Content cannot be empty']);
    }
}

// Function to add a reply to a discussion
function addReply() {
    global $conn;
    $discussion_id = $_POST['discussion_id'] ?? 0;
    $reply_content = $_POST['reply_content'] ?? '';
    if ($discussion_id > 0 && !empty($reply_content)) {
        $sql = "INSERT INTO replies (discussion_id, content) VALUES ('$discussion_id', '$reply_content')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Reply added']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add reply']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid discussion ID or empty content']);
    }
}

// Function to like a discussion
function likeDiscussion() {
    global $conn;
    $discussion_id = $_POST['discussion_id'] ?? 0;
    if ($discussion_id > 0) {
        $sql = "UPDATE discussions SET likes = likes + 1 WHERE id = '$discussion_id'";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Discussion liked']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to like discussion']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid discussion ID']);
    }
}

// Function to dislike a discussion
function dislikeDiscussion() {
    global $conn;
    $discussion_id = $_POST['discussion_id'] ?? 0;
    if ($discussion_id > 0) {
        $sql = "UPDATE discussions SET dislikes = dislikes + 1 WHERE id = '$discussion_id'";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Discussion disliked']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to dislike discussion']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid discussion ID']);
    }
}
?>
