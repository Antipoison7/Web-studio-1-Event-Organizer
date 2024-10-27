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

<form action="./forgot_intermediate.php" method="post">
    <div class="forgot">
        <label for="emailUser">Username / Email</label>
        <input type="text" id="emailUser" name="emailUser" autocomplete="off">
        <label for="passwordUser">New Password</label>
        <input type="password" id="passwordUser" name="passwordUser" autocomplete="off">
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
    else if($_SESSION["resetPassword"]["toggle"] == false)
    {
        
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