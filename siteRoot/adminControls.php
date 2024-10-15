<?php
  include_once('./Resources/Helper/headers.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Moderator Portal</title>
    
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <?php headerNoLogin("Moderator Portal") ?>
        <div>
            <h2>User management</h2>
            <ul>
                <li><a href="./">Archive Accounts</a></li>
                <li><a href="./">Reset Cooldowns</a></li>
                <li><a href="./">Set Cooldowns</a></li>
            </ul>
            <h2>Post management</h2>
            <ul>
                <li><a href="./">Unarchive Posts</a></li>
                <li><a href="./">Unarchive Events</a></li>
            </ul>
        </div>
    <?php
      makeFooter();
    ?>
  </body>
</html>
