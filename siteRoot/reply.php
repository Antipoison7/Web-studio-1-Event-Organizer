<?php
// reply.php

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

// Fetch discussion details
if (isset($_GET['discussion_id'])) {
    $discussionId = $_GET['discussion_id'];
    
    // Fetch the main discussion
    $discussionSql = "SELECT title, content FROM discussions WHERE id = ?";
    $stmt = $conn->prepare($discussionSql);
    $stmt->bind_param("i", $discussionId);
    $stmt->execute();
    $discussion = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Fetch replies for the discussion
    $replySql = "SELECT reply_text, reply_date FROM replies WHERE discussion_id = ? ORDER BY reply_date ASC";
    $stmt = $conn->prepare($replySql);
    $stmt->bind_param("i", $discussionId);
    $stmt->execute();
    $replies = $stmt->get_result();
    $stmt->close();
}

// Handle new reply submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $replyText = $_POST['reply_text'];

    // Insert the new reply
    $insertSql = "INSERT INTO replies (discussion_id, user_id, reply_text) VALUES (?, 1, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("is", $discussionId, $replyText);
    if ($stmt->execute()) {
        echo "Reply added successfully!";
        header("Location: reply.php?discussion_id=$discussionId");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reply to Discussion</title>
    <link rel="stylesheet" href="Resources/Style/base.css">
</head>
<body>
    <h1>Reply to Discussion</h1>

    <!-- Display selected discussion -->
    <?php if ($discussion): ?>
        <h2><?php echo ($discussion['title']); ?></h2>
        <p><?php echo ($discussion['content']); ?></p>
    <?php endif; ?>

    <!-- Display previous replies -->
    <h3>Replies</h3>
    <?php while ($reply = $replies->fetch_assoc()): ?>
        <div class="reply">
            <p><?php echo ($reply['reply_text']); ?></p>
            <small><?php echo ($reply['reply_date']); ?></small>
            <hr>
        </div>
    <?php endwhile; ?>

    <!-- Reply form -->
    <form method="POST" action="reply.php?discussion_id=<?php echo $discussionId; ?>">
        <textarea name="reply_text" placeholder="Write your reply here..." required></textarea><br>
        <button type="submit">Submit Reply</button>
    </form>

</body>
</html>

<?php
$conn->close();
?>
