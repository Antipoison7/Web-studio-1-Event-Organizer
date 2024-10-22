<?php 
        
        $user_id = 1;
        
        $db = mysqli_connect("talsprddb02.int.its.rmit.edu.au", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA", "COSC3046_2402_UGRD_1479_G4");
        
        $post_query_result = mysqli_query($db, "SELECT * FROM EventList WHERE id=1");
        $post = mysqli_fetch_assoc($post_query_result);

        
        $comments_query_result = mysqli_query($db, "SELECT * FROM comments WHERE post_id=" . $post['id'] . " ORDER BY created_at DESC");
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
        ?>