<?php
include_once('./Resources/Helper/headers.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Change Password</title>
    
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="stylesheet" href="./Resources/Style/loginRegister.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <?php headerNoLogin("Change Your Password") ?>

    <?php if(isset($_SESSION["loginDetails"]["username"])&&isset($_SESSION["loginDetails"]["password"])){if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"])){?>

<form action="./changePasswordIntermediate.php" method="post">
    <div class="login">
        <label for="oldPassword">Current Password</label>
        <input type="password" id="oldPassword" name="oldPassword" autocomplete="off">
        <label for="passwordUser">New Password</label>
        <input type="password" id="passwordUser" name="passwordUser" autocomplete="off">

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
        
        <button class="smallButtonWide" type="submit">Change Password</button>
    </div>
</form>

<?php }
    else
    {
      failedLogin();
    } }
    else
    {
      failedLogin();
    } ?>

<?php
      makeFooter();
      $_SESSION["issues"]["password"] = "";
    ?>
  </body>
</html>