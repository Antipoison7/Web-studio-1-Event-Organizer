<?php
session_start();
include_once('./Resources/Helper/headers.php');
include_once('./Resources/Helper/validation.php');
include_once('./Resources/Helper/loginHelper.php');
makeCaptcha();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>User Register</title>


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
  <div class="toRight" style="margin-right: 15px;">
    <a href="./login.php">
      <div class="button">Back / Login</div>
    </a>
  </div>
  </div>

  <form method="post" action="./intermediateLogin.php">
    <div class="login">
      <label for="email">Email:
        <?php
        if (isset($_SESSION["issues"]["email"])) 
        {
          if ($_SESSION["issues"]["email"] == "unset") 
          {
            echo ("<span class=\"loginFontError\">Please enter an email</span>");
          } 
          else if (isset($_SESSION["issues"]) && ($_SESSION["issues"]["email"] == "Email Already In Use")) 
          {
            echo ("<span class=\"loginFontError\">Email Already In Use</span>");
          } 
          else if (isset($_SESSION["issues"]) && ($_SESSION["issues"]["email"] == "Invalid Email")) 
          {
            echo ("<span class=\"loginFontError\">Invalid Email</span>");
          }
        } ?></label>
      <input type="email" id="email" name="email"
        <?php
        if (isset($_SESSION["issues"]["email"])) 
        {
          if ($_SESSION["issues"]["email"] == "unset") 
          {
            echo ("class = \"loginError\"");
          } 
          else if (isset($_SESSION["issues"]) && ($_SESSION["issues"]["email"] == "Email Already In Use")) 
          {
            echo ("class = \"loginError\"");
          } 
          else if (isset($_SESSION["issues"]) && ($_SESSION["issues"]["email"] == "Invalid Email")) 
          {
            echo ("class = \"loginError\"");
          }
        }

        if (isset($_SESSION["registryDetails"]["email"])) 
        {
          echo ("value = \"" . $_SESSION["registryDetails"]["email"] . "\"");
        } ?>>

      <label for="username">Username: <span class="min 
      <?php if ((isset($_SESSION["issues"])) && (substr($_SESSION["issues"]["username"], 0, 8) == "Contains")) 
      {
        echo ("loginFontError");
      } ?>">(Cannot contain the '@','&' or ' '(space) symbols)</span>
        <?php
        if (isset($_SESSION["issues"]["username"])) 
        {
          if ($_SESSION["issues"]["username"] == "unset") 
          {
            echo ("<span class=\"loginFontError\"> Please enter a username</span>");
          }
        } ?></label>
      <input type="text" id="username" name="username"
        <?php if (isset($_SESSION["issues"]) && ($_SESSION["issues"]["username"] == "unset")) 
        {
          echo ("class = \"loginError\"");
        } 
        else if ((isset($_SESSION["issues"])) && (substr($_SESSION["issues"]["username"], 0, 8) == "Contains")) 
        {
          echo ("class = \"loginError\"");
        }
        if (isset($_SESSION["registryDetails"]["username"])) 
        {
          echo ("value = \"" . $_SESSION["registryDetails"]["username"] . "\"");
        } ?>autocomplete="off">

      <label for="realname">Real Name:
        <?php
        if (isset($_SESSION["issues"]["realName"])) 
        {
          if ($_SESSION["issues"]["realName"] == "unset") 
          {
            echo ("<span class=\"loginFontError\"> Please enter a name</span>");
          }
        } ?></label>
      <input type="text" id="realname" name="realname"
        <?php
        if (isset($_SESSION["issues"]["realName"])) 
        {
          if ($_SESSION["issues"]["realName"] == "unset") 
          {
            echo ("class = \"loginError\"");
          }
        }

        if (isset($_SESSION["registryDetails"]["realname"])) 
        {
          echo ("value = \"" . $_SESSION["registryDetails"]["realname"] . "\"");
        } ?>>

      <label for="password">Password:
        <?php
        if (isset($_SESSION["issues"]["password"])) {
          if (gettype($_SESSION["issues"]["password"]) == "string") {
            echo ("<span class=\"loginFontError\">Please enter a password</span>");
          } else {
            if(count($_SESSION["issues"]["password"]) > 0){
            echo ("<span class=\"loginFontError\">Invalid Password</span>");
            }
          }
        } ?></label>
      <input type="password" id="password" name="password"
        <?php
        if (isset($_SESSION["issues"]["password"])) 
        {
          if (gettype($_SESSION["issues"]["password"]) == "string") 
          {
            echo ("class = \"loginError\"");
          } 
          else 
          {
            if(count($_SESSION["issues"]["password"]) > 0){
            echo ("class = \"loginError\"");
            }
          }
        }

        if (isset($_SESSION["registryDetails"]["password"])) 
        {
          echo ("value = \"" . $_SESSION["registryDetails"]["password"] . "\"");
        } ?> autocomplete="off">

      <!-- Sets the value passed to the intermediate to Register -->
      <input type="text" id="hiddenType" name="hiddenType" value="Register" hidden>

      <p>Passwords should be:</p>
      <ul>
        <li <?php if (isset($_SESSION["issues"]) && (isset($_SESSION["issues"]["password"]["length"]))) 
        {
              echo ("class = \"loginFontErrorColor\"");
            } ?>>At least 8 characters in length</li>
        <li <?php if (isset($_SESSION["issues"]) && (isset($_SESSION["issues"]["password"]["upper"]))) 
        {
              echo ("class = \"loginFontErrorColor\"");
            } ?>>Contains at least one uppercase Letter</li>
        <li <?php if (isset($_SESSION["issues"]) && (isset($_SESSION["issues"]["password"]["lower"]))) 
        {
              echo ("class = \"loginFontErrorColor\"");
            } ?>>Contains at least one lowercase Letter</li>
        <li <?php if (isset($_SESSION["issues"]) && (isset($_SESSION["issues"]["password"]["symbol"]))) 
        {
              echo ("class = \"loginFontErrorColor\"");
            } ?>>Contains at least one symbol (!@#$%^&*)</li>
      </ul>

      <div class="captcha">
        <div>
          <?php
          if (isset($_SESSION["issues"]["captcha"])) 
          {
            if($_SESSION["issues"]["captcha"] == "failed")
            {
              echo("<span class=\"loginFontErrorColor\">Are you a robot? (Captcha Failed)</span>");
            }
          }
          ?>
          <label for="captchaText" class="disableCopy"><h1 class="disableCopy">Captcha Code:&nbsp;</h1>
          <?php echo("<h2>" . $_SESSION["captcha"] . "</h2>"); ?></label>
          <input type="text" id="captchaText" name="captchaText">
        </div>
      </div>

      <div class="flex">
        <button type="submit" class="smallButton" style="margin-right: 5px;">Register</button>
      </div>
    </div>
  </form>
  <?php makeFooter();
  unset($_SESSION["issues"]);
  unset($_SESSION["registryDetails"]); ?>
</body>

</html>