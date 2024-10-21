<?php
  session_start();
  include_once('./Resources/Helper/headers.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>User Login</title>
    
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="stylesheet" href="./Resources/Style/loginRegister.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <div class="loginHeader">
      <div id="logo"><a href="./HomePage.php">
        <img  src="./Resources/Images/Resources/WebsiteLogo.webp" alt="WebsiteLogo" width="100" height="100">
      </a></div>
        <h1>User Login</h1>
        <div style="width: 100px; height: 100px;"></div>
    </div>

    <form method="post" action="./intermediateLogin.php">
      <div class="login">
        
        <label for="username">Username / Email:
          <?php
          if(isset($_SESSION["issues"]["accountValidation"]))
          {
            echo("<span class=\"loginErrorSmall\">Invalid username/password</span>");
          }
        ?>
        </label>
        <input type="text" id="username" name="username" autocomplete="username" <?php if(isset($_SESSION["loginDetails"]["username"])){echo("value = \"" . $_SESSION["loginDetails"]["username"] . "\"");}?>>

        <label for="password">Password: <a href="./forgot">Forgot password</a></label>
        <input type="password" id="password" name="password">

        <!-- Sets the value passed to the intermediate to Register -->
        <input type="text" id="hiddenType" name="hiddenType" value="Login" hidden>

        <div class="flex">
          <button type="submit" class="smallButton" style="margin-right: 5px;">Login</button>
          <a href="./register.php"><div class="smallButtonInv">Register</div></a>
        </div>
      </div>
    </form>

    <?php makeFooter(); ?>
  </body>
</html>
