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

// Function to fetch random discussions from the database
function fetchRandomDiscussions() {
    global $conn;
    $sql = "SELECT id, title, content FROM discussions ORDER BY RAND() LIMIT 10";
    $result = $conn->query($sql);

    if (!$result) {
        die("SQL Error: " . $conn->error); // This line will output any SQL error that occurs
    }

    $discussions = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $discussions[] = $row;
        }
    }
    return $discussions;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussions</title>
    <link rel="stylesheet" href="./Resources/Style/base.css"> 
    <link rel="stylesheet" href="./Resources/Style/discussions.css"> <!-- Your new CSS for discussions -->
</head>
<body>
    <header>
        <h1>Fan Community Discussions</h1>
    </header>

    <section class="add-discussion">
        <h2>Start a New Discussion</h2>
        <form action="add_discussion.php" method="POST">
            <input type="text" name="title" placeholder="Discussion Title" required>
            <textarea name="content" placeholder="Discussion Content" required></textarea>
            <button type="submit">Add Discussion</button>
        </form>
    </section>

    <section class="discussions-container">
        <?php
        // Fetch random discussions from your SQL database
        $discussions = fetchRandomDiscussions(); // This should be your SQL query fetching discussions
        
        foreach($discussions as $discussion) {
            echo "<div class='discussion-item'>";
            echo "<h3>{$discussion['title']}</h3>";
            echo "<p>{$discussion['content']}</p>";
            echo "<div class='discussion-actions'>";
            echo "<a href='#' class='like-btn' data-id='{$discussion['id']}'>Like</a>";  // Like button with discussion ID
            echo "<a href='#' class='dislike-btn' data-id='{$discussion['id']}'>Dislike</a>"; // Dislike button with discussion ID
            echo "<a href='reply.php?discussion_id={$discussion['id']}'>Reply</a>"; // Link to reply page
            echo "</div>";
            echo "</div>";
        }
        ?>
    </section>

    <script>
        // JavaScript for handling like and dislike actions
        document.querySelectorAll('.like-btn').forEach(btn => {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                const discussionId = this.getAttribute('data-id');
                // Perform AJAX request to like the discussion
                fetch('like_discussion.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${discussionId}&action=like`
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        alert('Liked successfully');
                    }
                });
            });
        });

        document.querySelectorAll('.dislike-btn').forEach(btn => {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                const discussionId = this.getAttribute('data-id');
                // Perform AJAX request to dislike the discussion
                fetch('like_discussion.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${discussionId}&action=dislike`
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        alert('Disliked successfully');
                    }
                });
            });
        });
    </script>

</body>
</html>
