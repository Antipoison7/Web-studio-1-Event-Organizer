<?php
session_start(); // Ensure session is started before accessing it
header('Content-Type: application/json');

include_once('./Resources/Helper/commentfunctions.php');
include_once('./Resources/Helper/sanitization.php');
include_once('./Resources/Helper/headers.php');

$response = [];

// Handling a new comment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_text']) && isset($_POST['comment_posted'])) {
    $comment_text = sanitizeInput($_POST['comment_text']);
    $user_id = $_SESSION['loginDetails']['user_id'] ?? null;

    if ($user_id && !empty($comment_text)) {
        $comment_id = addComment($user_id, $comment_text); // Function to add comment
        $comment_html = generateCommentHtml($comment_id); // Function to generate HTML for the new comment

        $response = [
            "comment" => $comment_html,
            "comments_count" => getCommentsCount()
        ];
    } else {
        $response = ["error" => "Invalid comment or user"];
    }
    echo json_encode($response);
    exit;
}

// Handling a new reply
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_text']) && isset($_POST['reply_posted']) && isset($_POST['comment_id'])) {
    $reply_text = sanitizeInput($_POST['reply_text']);
    $comment_id = intval($_POST['comment_id']);
    $user_id = $_SESSION['loginDetails']['user_id'] ?? null;

    if ($user_id && !empty($reply_text) && $comment_id) {
        $reply_id = addReply($user_id, $comment_id, $reply_text); // Function to add reply
        $reply_html = generateReplyHtml($reply_id); // Function to generate HTML for the new reply

        echo json_encode(["reply" => $reply_html]);
        exit;
    } else {
        echo json_encode(["error" => "Invalid reply or user"]);
        exit;
    }
}

// Default error response for invalid requests
echo json_encode(["error" => "Invalid request"]);
exit; // Ensure no further processing happens after this point
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <?php headerNoLogin("Discussion Board"); ?>
    <div class="BannerFlex">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 post">
                    <h2><?php echo $post['eventName']; ?></h2>
                    <p><?php echo $post['eventDesc']; ?></p>
                </div>
                <div class="col-md-6 col-md-offset-3 comments-section">
                    <?php if (isset($user_id)): ?>
                        <form class="clearfix" action="commentSection.php" method="post" id="comment_form">
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
                        <?php if (isset($comments)): ?>
                            <?php foreach ($comments as $comment): ?>
                                <div class="comment clearfix">
                                    <img src="profile.png" alt="" class="profile_pic">
                                    <div class="comment-details">
                                        <span class="comment-name"><?php echo getUsernameById($comment['user_id']); ?></span>
                                        <span class="comment-date"><?php echo date("F j, Y ", strtotime($comment["created_at"])); ?></span>
                                        <p><?php echo $comment['body']; ?></p>
                                        <a class="reply-btn" href="#" data-id="<?php echo $comment['id']; ?>">reply</a>
                                    </div>
                                    <form action="commentSection.php" method="post" id="comment_reply_form_<?php echo $comment['id']; ?>" data-id="<?php echo $comment['id']; ?>">
                                        <textarea class="form-control" name="reply_text" id="reply_text" cols="30" rows="2"></textarea>
                                        <button class="btn btn-primary btn-xs pull-right submit-reply">Submit reply</button>
                                    </form>
                                    <?php $replies = getRepliesByCommentId($comment['id']); ?>
                                    <div class="replies_wrapper_<?php echo $comment['id']; ?>">
                                        <?php if (isset($replies)): ?>
                                            <?php foreach ($replies as $reply): ?>
                                                <div class="comment reply clearfix">
                                                    <img src="profile.png" alt="" class="profile_pic">
                                                    <div class="comment-details">
                                                        <span class="comment-name"><?php echo getUsernameById($reply['user_id']); ?></span>
                                                        <span class="comment-date"><?php echo date("F j, Y ", strtotime($reply["created_at"])); ?></span>
                                                        <p><?php echo $reply['body']; ?></p>
                                                        <a class="reply-btn" href="#">reply</a>
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
    $(document).ready(function() {
        // Submitting a comment
        $(document).on('click', '#submit_comment', function(e) {
            e.preventDefault();
            var comment_text = $('#comment_text').val();
            var url = $('#comment_form').attr('action');

            if (comment_text === "") return;

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    comment_text: comment_text,
                    comment_posted: 1
                },
                success: function(data) {
                    console.log("Server response:", data);

                    if (data.error) {
                        alert(data.error);
                    } else {
                        $('#comments-wrapper').prepend(data.comment);
                        $('#comments_count').text(data.comments_count);
                        $('#comment_text').val('');
                    }
                },
                error: function() {
                    alert("An error occurred during the request.");
                }
            });
        });

        // Submitting a reply
        $(document).on('click', '.reply-btn', function(e) {
            e.preventDefault();
            var comment_id = $(this).data('id');
            $(this).parent().siblings('form#comment_reply_form_' + comment_id).toggle(500);
        });

        $(document).on('click', '.submit-reply', function(e) {
            e.preventDefault();
            var comment_id = $(this).closest('form').data('id');
            var reply_text = $(this).siblings('textarea').val();
            var url = $(this).closest('form').attr('action');

            if (reply_text === "") return;

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    comment_id: comment_id,
                    reply_text: reply_text,
                    reply_posted: 1
                },
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        $('.replies_wrapper_' + comment_id).append(data.reply);
                        $(this).siblings('textarea').val('');
                    }
                },
                error: function() {
                    alert("An error occurred during the request.");
                }
            });
        });
    });
    </script>

    <?php makeFooter(); ?>
</body>
<script>
    function toggleDeleteMenu(eventName) {
        let deleteMenuBox = document.getElementById("deleteBox" + eventName);
        deleteMenuBox.classList.toggle("hiddenClass");
    }

    function tryArchivePost(eventName) {
        let archiveValue = document.getElementById("post" + eventName).value;

        if (archiveValue == "Delete") // Replace with actual word
        {
            document.getElementById("bigPost" + eventName).remove();
        }
    }
</script>
</html>
