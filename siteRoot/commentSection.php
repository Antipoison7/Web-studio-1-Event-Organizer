<?php
  session_start();
  include_once('./Resources/Helper/headers.php');
  include_once('./Resources/Helper/sanitization.php');
  include_once('./Resources/Helper/loginHelper.php');
  include_once('./Resources/Helper/commentfunctions.php');
  
  $isAdmin = false;

  if(isset($_SESSION["loginDetails"]["username"])&&isset($_SESSION["loginDetails"]["password"]))
  {
      $isAdmin = isValidAdminLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]);
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Discussion Forum</title>
    
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="stylesheet" href="./Resources/Style/forum.css">
    <link rel="stylesheet" href="./Resources/Style/commentsection.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    
      <?php headerNoLogin("Discussion Board") ?>
      <div class="BannerFlex">
      <div class="container">
        <div class="row">
                <div class="col-md-6 col-md-offset-3 post">
                        <h2><?php echo $post['eventName'] ?></h2>
                        <p><?php echo $post['eventDesc']; ?></p>
                </div>
                <div class="col-md-6 col-md-offset-3 comments-section">
                        
                        <?php if (isset($user_id)): ?>
                                <form class="clearfix" action="post_details.php" method="post" id="comment_form">
                                        <textarea name="comment_text" id="comment_text" class="form-control" cols="30" rows="3"></textarea>
                                        <button class="btn btn-primary btn-sm pull-right" id="submit_comment">Submit comment</button>
                                </form>
                        <?php else: ?>
                                <div class="well" style="margin-top: 20px;">
                                        <h4 class="text-center"><a href="#">Sign in</a> to post a comment</h4>
                                </div>
                        <?php endif ?>
                        <!-- Display total number of comments on this post  -->
                        <h2><span id="comments_count"><?php echo count($comments) ?></span> Comment(s)</h2>
                        <hr>
                        
                        <div id="comments-wrapper">
                        <?php if (isset($comments)): ?>
                                <!-- Display comments -->
                                <?php foreach ($comments as $comment): ?>
                                
                                <div class="comment clearfix">
                                        <img src="profile.png" alt="" class="profile_pic">
                                        <div class="comment-details">
                                                <span class="comment-name"><?php echo getUsernameById($comment['user_id']) ?></span>
                                                <span class="comment-date"><?php echo date("F j, Y ", strtotime($comment["created_at"])); ?></span>
                                                <p><?php echo $comment['body']; ?></p>
                                                <a class="reply-btn" href="#" data-id="<?php echo $comment['id']; ?>">reply</a>
                                        </div>
                                        
                                        <form action="post_details.php" class="reply_form clearfix" id="comment_reply_form_<?php echo $comment['id'] ?>" data-id="<?php echo $comment['id']; ?>">
                                                <textarea class="form-control" name="reply_text" id="reply_text" cols="30" rows="2"></textarea>
                                                <button class="btn btn-primary btn-xs pull-right submit-reply">Submit reply</button>
                                        </form>

                                        <!-- GET ALL REPLIES -->
                                        <?php $replies = getRepliesByCommentId($comment['id']) ?>
                                        <div class="replies_wrapper_<?php echo $comment['id']; ?>">
                                                <?php if (isset($replies)): ?>
                                                        <?php foreach ($replies as $reply): ?>
                                                                
                                                                <div class="comment reply clearfix">
                                                                        <img src="profile.png" alt="" class="profile_pic">
                                                                        <div class="comment-details">
                                                                                <span class="comment-name"><?php echo getUsernameById($reply['user_id']) ?></span>
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

 <script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>

  <script src=\"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js\"></script>




<script>
  $(document).ready(function(){
        // When user clicks on submit comment to add comment under post
        $(document).on('click', '#submit_comment', function(e) {
                e.preventDefault();
                var comment_text = $('#comment_text').val();
                var url = $('#comment_form').attr('action');
                // Stop executing if not value is entered
                if (comment_text === "" ) return;
                $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                                comment_text: comment_text,
                                comment_posted: 1
                        },
                        success: function(data){
                                var response = JSON.parse(data);
                                if (data === "error") {
                                        alert('There was an error adding comment. Please try again');
                                } else {
                                        $('#comments-wrapper').prepend(response.comment)
                                        $('#comments_count').text(response.comments_count); 
                                        $('#comment_text').val('');
                                }
                        }
                });
        });
        // When user clicks on submit reply to add reply under comment
        $(document).on('click', '.reply-btn', function(e){
                e.preventDefault();
                // Get the comment id from the reply button's data-id attribute
                var comment_id = $(this).data('id');
                // show/hide the appropriate reply form (from the reply-btn (this), go to the parent element (comment-details)
                // and then its siblings which is a form element with id comment_reply_form_ + comment_id)
                $(this).parent().siblings('form#comment_reply_form_' + comment_id).toggle(500);
                $(document).on('click', '.submit-reply', function(e){
                        e.preventDefault();
                        // elements
                        var reply_textarea = $(this).siblings('textarea'); // reply textarea element
                        var reply_text = $(this).siblings('textarea').val();
                        var url = $(this).parent().attr('action');
                        $.ajax({
                                url: url,
                                type: "POST",
                                data: {
                                        comment_id: comment_id,
                                        reply_text: reply_text,
                                        reply_posted: 1
                                },
                                success: function(data){
                                        if (data === "error") {
                                                alert('There was an error adding reply. Please try again');
                                        } else {
                                                $('.replies_wrapper_' + comment_id).append(data);
                                                reply_textarea.val('');
                                        }
                                }
                        });
                });
        });
});
</script>

    </div>
    <?php
      makeFooter();
    ?>
  </body>

  <script>
    function toggleDeleteMenu(eventName)
    {
      let deleteMenuBox = document.getElementById("deleteBox"+eventName);
      deleteMenuBox.classList.toggle("hiddenClass");
    }

    function tryArchivePost(eventName)
    {
      let archiveValue = document.getElementById("post"+eventName).value;

      if(archiveValue == "Delete") //Replace with actual word
      {
        //This represents an api call that passes the admins credentials through, but I need to do that later
        document.getElementById("bigPost"+eventName).remove();
      }
    }
  </script>
</html>
