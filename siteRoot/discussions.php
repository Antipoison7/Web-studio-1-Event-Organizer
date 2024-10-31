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

function getReplies($discussionId) {
    global $conn;
    $stmt = $conn->prepare("SELECT reply_text, user_id FROM replies WHERE discussion_id = ? ORDER BY reply_date ASC");
    $stmt->bind_param("i", $discussionId);
    $stmt->execute();
    $result = $stmt->get_result();
    $replies = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $replies;
}

// Function to fetch random discussions from the database
function fetchRandomDiscussions() {
    global $conn;
    $sql = "SELECT id, title, content, likes, dislikes FROM discussions ORDER BY id DESC LIMIT 500";
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
    <link rel="stylesheet" href="./Resources/Style/discussions.css"> <!-- CSS for discussions -->
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
    <style>
        /* Additional styles for two-column layout */
        .discussions-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .discussion-item {
            width: 48%; /* Adjust the width for two items per row */
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .discussion-actions {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <a href="HomePage.php" class="nav-link">Home</a>
        <a href="fancommunity.php" class="nav-link">Fan Community</a>
        <a href="favorites.php" class="nav-link">Favorites</a>
        <a href="profileView.php" class="nav-link">Profile</a>
    </nav>

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
    // Fetch discussions from your SQL database
    $discussions = fetchRandomDiscussions();
    
    // Loop through discussions and display them in pairs
    for ($i = 0; $i < count($discussions); $i += 2) {
        echo "<div class='discussion-row'>"; // Start a new row
        // Display the first discussion
        echo "<div class='discussion-item'>";
        echo "<h3>{$discussions[$i]['title']}</h3>";
        echo "<p>{$discussions[$i]['content']}</p>";
        echo "<div class='discussion-actions'>";
        echo "<span>Likes: {$discussions[$i]['likes']}</span> | ";
        echo "<span>Dislikes: {$discussions[$i]['dislikes']}</span>";
        echo "<br>";
        echo "<div class = 'like-button'>";
        echo "<a href='#' class='like-btn' data-id='{$discussions[$i]['id']}'>Like</a> ";
        echo "<a href='#' class='dislike-btn' data-id='{$discussions[$i]['id']}'>Dislike</a> ";
        echo "<a href='reply.php?discussion_id={$discussions[$i]['id']}'>Reply</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        
        // Check if there is a second discussion to display
        if (isset($discussions[$i + 1])) {
            echo "<div class='discussion-item'>";
            echo "<h3>{$discussions[$i + 1]['title']}</h3>";
            echo "<p>{$discussions[$i + 1]['content']}</p>";
            echo "<div class='discussion-actions'>";
            echo "<span>Likes: {$discussions[$i + 1]['likes']}</span> | ";
            echo "<span>Dislikes: {$discussions[$i + 1]['dislikes']}</span>";
            echo "<br>";
            echo "<div class = 'like-button'>";
            echo "<a href='#' class='like-btn' data-id='{$discussions[$i + 1]['id']}'>Like</a> ";
            echo "<a href='#' class='dislike-btn' data-id='{$discussions[$i + 1]['id']}'>Dislike</a> ";
            echo "<a href='reply.php?discussion_id={$discussions[$i + 1]['id']}'>Reply</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>"; // End the discussion row
    }
    ?>
</section>


<script>
    document.querySelectorAll('.like-btn').forEach(btn => {
        btn.addEventListener('click', function(event) {
            event.preventDefault();
            const discussionId = this.getAttribute('data-id');
            
            fetch('like_discussion.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${discussionId}&action=like`
            })
            .then(response => response.json())
            .then(data => {
                console.log('Response from like_discussion.php:', data);

                if (data.likes !== undefined && data.dislikes !== undefined) {
                    const likeCountElement = document.querySelector(`#like-count-${discussionId}`);
                    const dislikeCountElement = document.querySelector(`#dislike-count-${discussionId}`);

                    if (likeCountElement && dislikeCountElement) {
                        likeCountElement.textContent = data.likes;
                        dislikeCountElement.textContent = data.dislikes;
                        alert('Liked successfully');
                    } else {
                        console.error(`Like or dislike count element not found for discussion ID ${discussionId}`);
                    }
                } else {
                    alert('Error: ' + (data.error || 'An unknown error occurred'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred: ' + error);
            });
        });
    });

    document.querySelectorAll('.dislike-btn').forEach(btn => {
        btn.addEventListener('click', function(event) {
            event.preventDefault();
            const discussionId = this.getAttribute('data-id');
            
            fetch('like_discussion.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${discussionId}&action=dislike`
            })
            .then(response => response.json())
            .then(data => {
                console.log('Response from like_discussion.php:', data);

                if (data.likes !== undefined && data.dislikes !== undefined) {
                    const likeCountElement = document.querySelector(`#like-count-${discussionId}`);
                    const dislikeCountElement = document.querySelector(`#dislike-count-${discussionId}`);

                    if (likeCountElement && dislikeCountElement) {
                        likeCountElement.textContent = data.likes;
                        dislikeCountElement.textContent = data.dislikes;
                        alert('Disliked successfully');
                    } else {
                        console.error(`Like or dislike count element not found for discussion ID ${discussionId}`);
                    }
                } else {
                    alert('Error: ' + (data.error || 'An unknown error occurred'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred: ' + error);
            });
        });
    });
</script>

</body>
</html>
