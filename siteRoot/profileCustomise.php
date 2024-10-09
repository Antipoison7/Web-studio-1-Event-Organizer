<?php
  include_once('./Resources/Helper/headers.php');
  include_once('./Resources/Helper/loginHelper.php');
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Customise profile</title>
    
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <div class="profileHeader">
        <a href="./">
            <div class="button">Home</div>
        </a>
        <h1>Customise profile</h1>
        <div style="width: 14em; height: 3em;"></div>
    </div>

    <?php if(isset($_SESSION["loginDetails"])){if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"])){?>
    <div class="content">
      
    </div>

    <?php }
    else
    {
      failedLogin();
    } }
    else
    {
      failedLogin();
    } ?>
    <?php makeFooter(); ?>
  </body>
</html>
