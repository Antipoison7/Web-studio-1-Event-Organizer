<?php
include_once('./Resources/Helper/headers.php');
session_start();

if(!isset($_SESSION["resetPassword"]["resetCode"]) && !isset($_SESSION["resetPassword"]["email"]))
{
    $_SESSION["resetPassword"]["toggle"] = "";
}

if(isset($_SESSION["resetPassword"]["toggle"]))
{
    if($_SESSION["resetPassword"]["toggle"] == true)
    {
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
    <?php headerNoLogin("Reset Your Password") ?>

<form action="./forgot_reset.php" method="post">
    <div class="login">
        <label for="emailCode">Code recieved in email</label>
        <input type="text" id="emailCode" name="emailCode" autocomplete="off">
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
        
        <button class="smallButtonWide" type="submit">Reset Password</button>
    </div>
</form>

<?php
      makeFooter();
    ?>
  </body>
</html>

<?php
    }
    else
    {
        header("Location: ./forgot_password.php");
    }
}
else
{
    header("Location: ./forgot_password.php");
}
?>