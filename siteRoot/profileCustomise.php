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
  <body class="crunch">
    <div class="profileHeader">
        <a href="./">
            <div class="button">Home</div>
        </a>
        <h1>Customise profile</h1>
        <div style="width: 14em; height: 3em;"></div>
    </div>

    <?php if(isset($_SESSION["loginDetails"])){if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"])){?>
      <div class="content">
        <form class="uncrunch">
          <div>
            <input type="file" name="pfp" id="pfp">
            <div>
              <label for="displayName">Display Name</label>
              <input type="text" name="displayName" id="displayName">
              <label for="realName">Real Name</label>
              <input type="text" name="realName" id="realName">
            </div>
          </div>
          <label for="description">Description</label>
          <textarea id="description" name="description" rows="4" cols="50">
          </textarea>

          <!-- <div class="split"></div> -->

          <label for="theme">Profile theme: <a>Custom Themes?</a></label>
          <select name="theme" id="theme">
            <option value="lightMode.css">Light mode</option>
            <option value="darkMode.css">Dark mode</option>
          </select>
        </form>
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
