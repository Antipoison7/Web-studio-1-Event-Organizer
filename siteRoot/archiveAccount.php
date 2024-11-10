<?php
include_once('./Resources/Helper/headers.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Archive Account</title>
    
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="stylesheet" href="./Resources/Style/loginRegister.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <?php headerNoLogin("ARCHIVE YOUR ACCOUNT?") ?>

    <?php if(isset($_SESSION["loginDetails"]["username"])&&isset($_SESSION["loginDetails"]["password"])){if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"])){?>

<form action="./archiveAccountIntermediate.php" method="post">
    <div class="login">
        <label for="loginName">Username / Email</label>
        <input type="text" id="loginName" name="loginName" autocomplete="off">
        <label for="passwordUser">Password</label>
        <input type="password" id="passwordUser" name="passwordUser" autocomplete="off">
        <label for="confirmationText" class="disableCopy">Repeat this: <span class="darkRedColor disableCopy">I Wish To Delete My Account Forever</span></label>
        <input type="text" id="confirmationText" name="confirmationText" autocomplete="off">

        <div class="flex" style="gap:10px;">
        <button class="buttonWarn" type="submit" style="width:30em">Archive Account (Almost Permanent)</button>
        <a href="./profileCustomise.php"><div class="button" style="width:12em">No, I want to go back</div></a>
        </div>
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