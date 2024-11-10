<?php
// reply.php
session_start();
include_once('./Resources/Helper/loginHelper.php');

$isAdmin = false;

if (isset($_SESSION["loginDetails"]["username"]) && isset($_SESSION["loginDetails"]["password"])) {
  $isAdmin = isValidAdminLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]);
}
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
    $discussionSql = "SELECT title, content FROM discussions WHERE id = ? AND Archived = 0";
    $stmt = $conn->prepare($discussionSql);
    $stmt->bind_param("i", $discussionId);
    $stmt->execute();
    $discussion = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Fetch replies for the discussion
    $replySql = "SELECT reply_text, reply_date, id FROM replies WHERE discussion_id = ? AND Archived = 0 ORDER BY reply_date ASC";
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
    <style>
        .text-container {
            display: inline;
        }
        .read-more-link {
            color: blue;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
    <script>
        function toggleText(element) {
            const fullText = element.previousElementSibling;
            if (fullText.style.display === "none") {
                fullText.style.display = "inline";
                element.textContent = "Read Less";
            } else {
                fullText.style.display = "none";
                element.textContent = "Read More";
            }
        }
    </script>
</head>
<body>
    <nav class="navbar">
        <a href="HomePage.php" class="nav-link">Home</a>
        <a href="fancommunity.php" class="nav-link">Fan Community</a>
        <a href="discussions.php" class="nav-link">Discussions</a>
        <a href="favorites.php" class="nav-link">Favorites</a>
        <a href="profileView.php" class="nav-link">Profile</a>
    </nav>
    <h1>Reply to Discussion</h1>

    <!-- Display selected discussion -->
    <?php if ($discussion): ?>
        <h2><?php echo htmlspecialchars($discussion['title']); ?></h2>
        <p>
            <span class="text-container"><?php echo htmlspecialchars(substr($discussion['content'], 0, 200)); ?></span>
            <?php if (strlen($discussion['content']) > 500): ?>
                <span class="text-container" style="display: none;"><?php echo htmlspecialchars(substr($discussion['content'], 200)); ?></span>
                <span class="read-more-link" onclick="toggleText(this)">Read More</span>
            <?php endif; ?>
        </p>
    <?php endif; ?>

    <!-- Display previous replies -->
    <h3>Replies</h3>
    <?php while ($reply = $replies->fetch_assoc()): ?>
        <div class="reply">
            <p>
                <span class="text-container"><?php echo htmlspecialchars(substr($reply['reply_text'], 0, 100)); ?></span>
                <?php if (strlen($reply['reply_text']) > 500): ?>
                    <span class="text-container" style="display: none;"><?php echo htmlspecialchars(substr($reply['reply_text'], 100)); ?></span>
                    <span class="read-more-link" onclick="toggleText(this)">Read More</span>
                <?php endif; ?>
            </p>
            <small>
                <?php echo htmlspecialchars($reply['reply_date']) . " | "; 
                if($isAdmin){
                echo("<a href='#' onclick='tryArchivePost(\"{$reply['id']}\")' class='delete-btn'>Delete</a>");
                }
                ?>
            </small>
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

<?php if ($isAdmin == true) { ?>
    <script>
        //I do not have enough time to fix this once again, sorry to anyone who has to see this, I would rather not have to do it like this - ---(___C'>

  function tryArchivePost(eventName) {
    if(confirm("Are you sure you want to Archive this comment (ID: " + eventName + ")?"))
    {
      fetch("../APIs/api.php", {
        method: "POST",
        body: JSON.stringify({
          function: "archiveReply",
          Username: "<?php echo($_SESSION["loginDetails"]["username"]); ?>",
          Password: "<?php echo($_SESSION["loginDetails"]["password"]); ?>",
          varA: eventName
        }),
        headers: {
          "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
        }
      }).then((response) => response.json()).then((json) => {location.reload("./discussions.php")}) ;
    //   if(typeof json.status !== 'undefined'){document.getElementById("bigPost" + eventName).remove();}
      ;
    }
    window.event.preventDefault();
  }
  </script>
  <?php } ?>

<?php
$conn->close();
?>