<?php
  include_once('./Resources/Helper/headers.php');
  include_once('./Resources/Helper/validation.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>User Register</title>
    
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <div class="loginHeader">
        <a href="./login.php">
            <div class="button">Back</div>
        </a>
        <h1>User Register</h1>
        <div style="width: 14em; height: 3em;"></div>
    </div>

    <form method="post" action="./intermediateLogin.php">
      <div class="login">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">

        <label for="username">Username: <span class="min">(Cannot contain the '@' symbol)</span></label>
        <input type="text" id="username" name="username">

        <label for="realname">Real Name:</label>
        <input type="text" id="realname" name="realname">

        <label for="password">Password: <a href="./forgot">Forgot password</a></label>
        <input type="password" id="password" name="password">

        <!-- Sets the value passed to the intermediate to Register -->
        <input type="text" id="hiddenType" name="hiddenType" value="Register" hidden>

        <p>Passwords should be:</p>
        <ul>
          <li>At least 8 characters in length</li>
          <li>Contains at least one uppercase Letter</li>
          <li>Contains at least one lowercase Letter</li>
          <li>Contains at least one symbol (!@#$%^&*)</li>
        </ul>

        <div class="flex">
          <button type="submit" class="smallButton" style="margin-right: 5px;">Register</button>          
        </div>
      </div>
    </form>

    <?php makeFooter(); ?>
  </body>
</html>
