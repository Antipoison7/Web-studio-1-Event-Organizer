<?php

// header('Content-Type: application/json'); // Set header for JSON response

// Database connection setup
$host = 'talsprddb02.int.its.rmit.edu.au'; // Your database host (port included in connection string)
$username = 'COSC3046_2402_UGRD_1479_G4'; // Your database username
$password = 'GYS3sfUkzIqA'; // Your database password
$database = 'COSC3046_2402_UGRD_1479_G4'; // Your database name

// Create a new mysqli connection
$db = new mysqli($host, $username, $password, $database);

// Check connection
if ($db->connect_error) {
        die(json_encode(["error" => "Database connection failed: " . $db->connect_error]));
}

// Function to sanitize user input
function sanitizeInput($data)
{
        global $db; // Use the global database connection
        $data = trim($data); // Remove whitespace from the beginning and end
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Convert special characters to HTML entities
        return mysqli_real_escape_string($db, $data); // Escape special characters for SQL
}

// Function to add a comment
function addComment($user_id, $comment_text)
{
        global $db; // Use the global database connection
        $stmt = $db->prepare("INSERT INTO comments (user_id, body, post_id, created_at) VALUES (?, ?, ?, NOW())");
        $post_id = 1; // Adjust this to your actual post ID logic

        // Bind parameters and execute the statement
        $stmt->bind_param("isi", $user_id, $comment_text, $post_id);
        if ($stmt->execute()) {
                return $db->insert_id; // Return the ID of the newly created comment
        } else {
                return false; // Return false if the insert failed
        }
        $stmt->close();
}

// Function to generate HTML for a comment
function generateCommentHtml($comment_id)
{
    global $db; // Use the global database connection
    $result = mysqli_query($db, "SELECT * FROM comments WHERE id = " . intval($comment_id));
    
    // Check if the query was successful
    if (!$result) {
        // Log the error for debugging
        error_log("SQL Error: " . mysqli_error($db)); // Log error
        return ''; // Return an empty string if the query fails
    }

    $comment = mysqli_fetch_assoc($result);

    if ($comment) {
        // Build the comment HTML
        $username = getUsernameById($comment['user_id']);
        $comment_date = date('F j, Y', strtotime($comment['created_at']));
        return "<div class='comment clearfix'>
                    <img src='profile.png' alt='' class='profile_pic'>
                    <div class='comment-details'>
                        <span class='comment-name'>{$username}</span>
                        <span class='comment-date'>{$comment_date}</span>
                        <p>{$comment['body']}</p>
                        <a class='reply-btn' href='#' data-id='{$comment['id']}'>reply</a>
                    </div>
                </div>";
    }
    return ''; // Return an empty string if no comment found
}

// Function to generate HTML for a reply
function generateReplyHtml($reply_id)
{
        global $db; // Use the global database connection
        $result = mysqli_query($db, "SELECT * FROM replies WHERE id = " . intval($reply_id));
        $reply = mysqli_fetch_assoc($result);

        if ($reply) {
                // Build the reply HTML
                $username = getUsernameById($reply['user_id']);
                $reply_date = date('F j, Y', strtotime($reply['created_at']));
                return "<div class='reply clearfix'>
                    <img src='profile.png' alt='' class='profile_pic'>
                    <div class='reply-details'>
                        <span class='reply-name'>{$username}</span>
                        <span class='reply-date'>{$reply_date}</span>
                        <p>{$reply['body']}</p>
                    </div>
                </div>";
        }
        return ''; // Return an empty string if no reply found
}

// Function to get comments count
function getCommentsCount()
{
        global $db; // Use the global database connection
        $result = mysqli_query($db, "SELECT COUNT(*) AS total FROM comments WHERE post_id = 1"); // Adjust post_id as necessary
        $data = mysqli_fetch_assoc($result);
        return $data['total']; // Return the total count of comments
}

// Function to get a username by user ID
function getUsernameById($id)
{
        global $db;
        $result = mysqli_query($db, "SELECT username FROM users WHERE username=" . intval($id) . " LIMIT 1");
        return mysqli_fetch_assoc($result)['username'] ?? 'Unknown'; // Handle case where user is not found
}

// Function to get replies by comment ID
function getRepliesByCommentId($id)
{
        global $db;
        $result = mysqli_query($db, "SELECT * FROM replies WHERE discussion_id=" . intval($id));
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Fetching comments on GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $EVENT_ID = 1; // Change to dynamic as necessary
        $sql = "SELECT * FROM comments WHERE EVENT_ID=" . intval($EVENT_ID) . " ORDER BY created_at DESC";
        
        $comments_query_result = mysqli_query($db, $sql);
    
        // Check for query errors
        if (!$comments_query_result) {
            die(json_encode(["error" => "Query Error: " . mysqli_error($db)]));
        }
    
        $comments = mysqli_fetch_all($comments_query_result, MYSQLI_ASSOC);
    
        foreach ($comments as &$comment) {
            $comment['username'] = getUsernameById($comment['user_id']);
            $comment['replies'] = getRepliesByCommentId($comment['id']);
        }
    
        echo json_encode($comments);
        // exit();
    }

// Handle a new comment on POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_text'])) {
        $comment_text = sanitizeInput($_POST['comment_text']);
        $user_id = $_SESSION['loginDetails']['user_id'] ?? null;

        if ($user_id && !empty($comment_text)) {
                $comment_id = addComment($user_id, $comment_text); // Function to add comment
                $comment_html = generateCommentHtml($comment_id); // Function to generate HTML for the new comment

                echo json_encode([
                        "comment" => $comment_html,
                        "comments_count" => getCommentsCount() // Function to get comment count
                ]);
                exit;
        } else {
                echo json_encode(["error" => "Invalid comment or user"]);
                exit;
        }
}

// Handling a new reply
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_text']) && isset($_POST['comment_id'])) {
        $reply_text = sanitizeInput($_POST['reply_text']);
        $comment_id = intval($_POST['comment_id']);
        $user_id = $_SESSION['loginDetails']['user_id'] ?? null;

        if ($user_id && !empty($reply_text) && $comment_id) {
                // Prepare and execute the insert statement for the reply
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
// exit();
?>