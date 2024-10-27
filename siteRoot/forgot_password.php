<?php
  session_start();
  include_once('./Resources/Helper/headers.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Reset Password</title>
    
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="stylesheet" href="./Resources/Style/loginRegister.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <?php headerNoLogin("Forgot your password?") ?>
    <form action="./forgot_intermediate.php" method="post">
        <div class="forgot">
            <a href="./login.php" class="button">I remembered it!</a>
            <label for="emailUser">Username / Email</label>
            <input type="text" id="emailUser" name="emailUser" autocomplete="off">
            <button class="smallButtonWide" type="submit">Reset Password</button>
        </div>
    </form>
    <?php
      makeFooter();
    ?>
  </body>
</html>