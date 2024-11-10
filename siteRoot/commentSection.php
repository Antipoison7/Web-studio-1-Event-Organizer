<?php
session_start(); // Ensure the session is started before accessing it
// header('Content-Type: application/json');

include_once('./Resources/Helper/commentfunctions.php');
include_once('./Resources/Helper/sanitization.php');
include_once('./Resources/Helper/headers.php');

$response = [];

// Handle new comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comment_text'], $_POST['comment_posted'])) {
        $comment_text = sanitizeInput($_POST['comment_text']);
        $user_id = $_SESSION['loginDetails']['user_id'] ?? null;

        if ($user_id && !empty($comment_text)) {
            $comment_id = addComment($user_id, $comment_text); // Function to add comment
            $comment_html = generateCommentHtml($comment_id); // Function to generate HTML for the new comment

            $response = [
                "comment" => $comment_html,
                "comments_count" => getCommentsCount() // Get updated comment count
            ];
        } else {
            $response = ["error" => "Invalid comment or user"];
        }
    } elseif (isset($_POST['reply_text'], $_POST['reply_posted'], $_POST['comment_id'])) {
        $reply_text = sanitizeInput($_POST['reply_text']);
        $comment_id = intval($_POST['comment_id']);
        $user_id = $_SESSION['loginDetails']['user_id'] ?? null;

        if ($user_id && !empty($reply_text) && $comment_id) {
            $reply_id = addReply($user_id, $comment_id, $reply_text); // Function to add reply
            $reply_html = generateReplyHtml($reply_id); // Function to generate HTML for the new reply

            $response = ["reply" => $reply_html];
        } else {
            $response = ["error" => "Invalid reply or user"];
        }
    } else {
        $response = ["error" => "Invalid request"];
    }
    echo json_encode($response); // Send JSON response
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Discussion Forum</title>
    <?php createMeta(); ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="stylesheet" href="./Resources/Style/forum.css">
    <link rel="stylesheet" href="./Resources/Style/commentsection.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <?php headerNoLogin("Discussion Board"); ?>
    <div class="BannerFlex">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 post">
                    <h2><?php echo htmlspecialchars($post['eventName']); ?></h2>
                    <p><?php echo htmlspecialchars($post['eventDesc']); ?></p>
                </div>
                <div class="col-md-6 col-md-offset-3 comments-section">
                    <?php if (isset($user_id)): ?>
                        <form class="clearfix" id="comment_form">
                            <textarea name="comment_text" id="comment_text" class="form-control" cols="30" rows="3"></textarea>
                            <button class="btn btn-primary btn-sm pull-right" id="submit_comment">Submit comment</button>
                        </form>
                    <?php else: ?>
                        <div class="well" style="margin-top: 20px;">
                            <h4 class="text-center"><a href="#">Sign in</a> to post a comment</h4>
                        </div>
                    <?php endif ?>
                    <h2><span id="comments_count"><?php echo count($comments); ?></span> Comment(s)</h2>
                    <hr>
                    <div id="comments-wrapper">
                        <?php if (!empty($comments)): ?>
                            <?php foreach ($comments as $comment): ?>
                                <div class="comment clearfix">
                                    <img src="profile.png" alt="" class="profile_pic">
                                    <div class="comment-details">
                                        <span class="comment-name"><?php echo htmlspecialchars(getUsernameById($comment['user_id'])); ?></span>
                                        <span class="comment-date"><?php echo date("F j, Y", strtotime($comment["created_at"])); ?></span>
                                        <p><?php echo htmlspecialchars($comment['body']); ?></p>
                                        <a class="reply-btn" href="#" data-id="<?php echo $comment['id']; ?>">reply</a>
                                    </div>
                                    <form class="reply-form" id="comment_reply_form_<?php echo $comment['id']; ?>" data-id="<?php echo $comment['id']; ?>">
                                        <textarea class="form-control" name="reply_text" id="reply_text" cols="30" rows="2"></textarea>
                                        <button class="btn btn-primary btn-xs pull-right submit-reply">Submit reply</button>
                                    </form>
                                    <div class="replies_wrapper_<?php echo $comment['id']; ?>">
                                        <?php $replies = getRepliesByCommentId($comment['id']); ?>
                                        <?php if (!empty($replies)): ?>
                                            <?php foreach ($replies as $reply): ?>
                                                <div class="comment reply clearfix">
                                                    <img src="profile.png" alt="" class="profile_pic">
                                                    <div class="comment-details">
                                                        <span class="comment-name"><?php echo htmlspecialchars(getUsernameById($reply['user_id'])); ?></span>
                                                        <span class="comment-date"><?php echo date("F j, Y", strtotime($reply["created_at"])); ?></span>
                                                        <p><?php echo htmlspecialchars($reply['body']); ?></p>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                            <h2>Be the first to comment on this post</h2>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            // Fetch comments when the page loads
            fetchComments();

            $('#submit_comment').on('click', function (e) {
                e.preventDefault(); // Prevent the default form submission

                const commentText = $('#comment_text').val(); // Get the comment text

                $.ajax({
                    url: 'commentfunctions.php', // The URL of your PHP file
                    type: 'POST',
                    dataType: 'json', // Specify that you're expecting a JSON response
                    data: {
                        comment_text: commentText,
                        comment_posted: true // Additional data can be sent as needed
                    },
                    success: function (response) {
                        if (response.error) {
                            alert(response.error); // Handle any error messages
                        } else {
                            // Append the new comment to the comments section
                            $('#comments-wrapper').prepend(response.comment);
                            $('#comments_count').text(response.comments_count);
                            $('#comment_text').val(''); // Clear the input field
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error: " + error); // Log any AJAX errors
                        alert("An error occurred while processing your request.");
                    }
                });
            });
        });

        // Function to fetch comments
        function fetchComments() {
            $.ajax({
                url: 'commentfunctions.php', // URL of your PHP file
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.comments_html) {
                        $('#comments-wrapper').html(response.comments_html); // Populate comments
                    } else {
                        $('#comments-wrapper').html('<p>No comments found.</p>'); // Display message if no comments
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error: " + error); // Log any AJAX errors
                }
            });
        }
    </script>

    <?php makeFooter(); ?>
</body>
</html>
