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
            <h2>Post management</h2>
        </div>
    <?php
      makeFooter();
    ?>
  </body>
</html>
