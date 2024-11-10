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
  <div class="mainHeaderLogout">
    <div id="logo"><a href="./HomePage.php">
        <img  src="./Resources/Images/Resources/WebsiteLogo.webp" alt="Home Link" width="100" height="100">
    </a></div>

    <h1>User Login</h1>
  </div>

    <form method="post" action="./intermediateLogin.php">
      <div class="login">
        
        <label for="username">Username / Email:
          <?php
          if(isset($_SESSION["issues"]["accountValidation"]))
          {
            echo("<span class=\"loginErrorSmall\">" . $_SESSION["issues"]["accountValidation"] . "</span>");
          }
        ?>
        </label>
        <input type="text" id="username" name="username" autocomplete="username" <?php if(isset($_SESSION["loginDetails"]["username"])){echo("value = \"" . $_SESSION["loginDetails"]["username"] . "\"");}?>>

        <label for="password">Password: <a href="./forgot_password.php">Forgot password</a></label>
        <input type="password" id="password" name="password">

        <!-- Sets the value passed to the intermediate to Register -->
        <input type="text" id="hiddenType" name="hiddenType" value="Login" hidden>

        <div class="flex">
          <button type="submit" class="smallButton" style="margin-right: 5px;">Login</button>
          <a href="./register.php"><div class="smallButtonInv">Register</div></a>
        </div>
      </div>
    </form>

    <?php makeFooter(); 
    $_SESSION["issues"]["accountValidation"] = null;
    ?>
  </body>
</html>
