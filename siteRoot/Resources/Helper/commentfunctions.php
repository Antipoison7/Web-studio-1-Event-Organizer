<?php 

        $servername = "talsprddb02.int.its.rmit.edu.au:3306";
        $username = "COSC3046_2402_UGRD_1479_G4";
        $password = "GYS3sfUkzIqA";
        $dbname = "COSC3046_2402_UGRD_1479_G4";
        
        $user_id = 1;
        
        $db = mysqli_connect($servername, $username, $password, $dbname);
        
        $post_query_result = mysqli_query($db, "SELECT * FROM EventList WHERE EventID = 1");
        $post = mysqli_fetch_assoc($post_query_result);

        
        $comments_query_result = mysqli_query($db, "SELECT * FROM comments WHERE Event_ID=" . $post['EventID'] . " ORDER BY created_at DESC");
        $comments = mysqli_fetch_all($comments_query_result, MYSQLI_ASSOC);

        
        function getUsernameById($id)
        {
                global $db;
                $result = mysqli_query($db, "SELECT username FROM users WHERE id=" . $id . " LIMIT 1");
                
                return mysqli_fetch_assoc($result)['username'];
        }
        
        function getRepliesByCommentId($id)
        {
                global $db;
                $result = mysqli_query($db, "SELECT * FROM replies WHERE comment_id=$id");
                $replies = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return $replies;
        }
        
        function getCommentsCountByPostId($post_id)
        {
                global $db;
                $result = mysqli_query($db, "SELECT COUNT(*) AS total FROM comments");
                $data = mysqli_fetch_assoc($result);
                return $data['total'];
        }
        if (isset($_POST['comment_posted'])) {
                global $db;
                
                $comment_text = $_POST['comment_text'];
                
                $sql = "INSERT INTO comments (post_id, user_id, body, created_at, updated_at) VALUES (1, " . $user_id . ", '$comment_text', now(), null)";
                $result = mysqli_query($db, $sql);
                
                $inserted_id = $db->insert_id;
                $res = mysqli_query($db, "SELECT * FROM comments WHERE id=$inserted_id");
                $inserted_comment = mysqli_fetch_assoc($res);
                
                if ($result) {
                        $comment = "<div class='comment clearfix'>
                                                <img src='profile.png' alt='' class='profile_pic'>
                                                <div class='comment-details'>
                                                        <span class='comment-name'>" . getUsernameById($inserted_comment['user_id']) . "</span>
                                                        <span class='comment-date'>" . date('F j, Y ', strtotime($inserted_comment['created_at'])) . "</span>
                                                        <p>" . $inserted_comment['body'] . "</p>
                                                        <a class='reply-btn' href='#' data-id='" . $inserted_comment['id'] . "'>reply</a>
                                                </div>
                                                <!-- reply form -->
                                                <form action='commentSection.php' class='reply_form clearfix' id='comment_reply_form_" . $inserted_comment['id'] . "' data-id='" . $inserted_comment['id'] . "'>
                                                        <textarea class='form-control' name='reply_text' id='reply_text' cols='30' rows='2'></textarea>
                                                        <button class='btn btn-primary btn-xs pull-right submit-reply'>Submit reply</button>
                                                </form>
                                        </div>";
                        $comment_info = array(
                                'comment' => $comment,
                                'comments_count' => getCommentsCountByPostId(1)
                        );
                        echo json_encode($comment_info);
                        exit();
                } else {
                        echo "error";
                        exit();
                }
        }
        
        if (isset($_POST['reply_posted'])) {
                global $db;
                
                $reply_text = $_POST['reply_text']; 
                $comment_id = $_POST['comment_id']; 
                
                $sql = "INSERT INTO replies (user_id, comment_id, body, created_at, updated_at) VALUES (" . $user_id . ", $comment_id, '$reply_text', now(), null)";
                $result = mysqli_query($db, $sql);
                $inserted_id = $db->insert_id;
                $res = mysqli_query($db, "SELECT * FROM replies WHERE id=$inserted_id");
                $inserted_reply = mysqli_fetch_assoc($res);
                
                if ($result) {
                        $reply = "<div class='comment reply clearfix'>
                                                <img src='profile.png' alt='' class='profile_pic'>
                                                <div class='comment-details'>
                                                        <span class='comment-name'>" . getUsernameById($inserted_reply['user_id']) . "</span>
                                                        <span class='comment-date'>" . date('F j, Y ', strtotime($inserted_reply['created_at'])) . "</span>
                                                        <p>" . $inserted_reply['body'] . "</p>
                                                        <a class='reply-btn' href='#'>reply</a>
                                                </div>
                                        </div>";
                        echo $reply;
                        exit();
                } else {
                        echo "error";
                        exit();
                }
        }
        ?>