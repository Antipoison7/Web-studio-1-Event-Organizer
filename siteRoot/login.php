<?php
  include_once('./Resources/Helper/headers.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>User Login</title>
    
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <div class="loginHeader">
        <a href="./">
            <div class="button">Home</div>
        </a>
        <h1>User Login</h1>
        <div style="width: 14em; height: 3em;"></div>
    </div>

    <form method="post" action="./intermediateLogin">
      <div class="login">
        <label for="username">Username / Email:</label>
        <input type="text" id="username" name="username">

        <label for="password">Password: <a href="./forgot">Forgot password</a></label>
        <input type="password" id="password" name="password">

        <div class="flex">
          <button type="submit" class="smallButton" style="margin-right: 5px;">Login</button>
          <a href="./register.php"><div class="smallButtonInv">Register</div></a>
          
        </div>
      </div>
    </form>

    <?php makeFooter(); ?>
  </body>
</html>
