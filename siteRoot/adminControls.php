<?php
  session_start();
  include_once('./Resources/Helper/headers.php');
  include_once('./Resources/Helper/loginHelper.php');
  if(isset($_SESSION["loginDetails"]["username"])&&isset($_SESSION["loginDetails"]["password"]))
  {
      $isAdmin = isValidAdminLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]);
  }
  else
  {
    $isAdmin = false;
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Moderator Portal</title>
    
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="stylesheet" href="./Resources/Style/admin.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <?php headerNoLogin("Moderator Portal"); 
     if($isAdmin == true){?>
        <div class="admin">
            <h2>User management</h2>
            <ul>
                <li><a href="./Admin/archiveAccount.php">Archive Accounts</a></li>
                <li><a href="./Admin/resetCooldown.php">Reset Cooldowns</a></li>
                <li><a href="./Admin/setCooldowns.php">Set Cooldowns</a></li>
            </ul>
            <h2>Post management</h2>
            <ul>
                <li><a href="./Admin/unarchivePosts.php">Unarchive Posts</a></li>
                <li><a href="./Admin/unarchiveEvents.php">Unarchive Events</a></li>
            </ul>
        </div>
    <?php
     }
     else
     {?>
      <div class="failedLogin">
      <h1>You need to log in / have insufficient clearance</h2>
      <h2><a href="./login.php">Log in with an admin account</a></h2>
    </div>
    <?php
     }
      makeFooter();
    ?>
  </body>
</html>
