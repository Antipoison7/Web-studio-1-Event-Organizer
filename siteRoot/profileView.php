<?php
  session_start();
  include_once('./Resources/Helper/headers.php');
  include_once('./Resources/Helper/loginHelper.php');
  include_once('./Resources/Helper/userDetailsHelper.php');

  $selectedUser = "Antipoison";

  if(isset($_GET["userLookup"]))
  {
    $userVal = isUserReal($_GET["userLookup"]);

    if($userVal != false)
    {
      $selectedUser = $userVal;
    }
  }

  $userResults = getPublic($selectedUser);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo($userResults["username"]); ?></title>
    
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="stylesheet" href="./Resources/Style/userProfile.css">
    <link rel="stylesheet" href="./Resources<?php echo($userResults["theme_name"]) ?>">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body class="crunch">
  <?php headerNoLogin("Discussion Board") ?>
    <div class="profileContainer">
      <div class="profileFlex">
        <div class="profilePictureContainer">
          <img src=".<?php echo($userResults["profile_picture"]); ?>" alt="Profile Picture" class="profileImage">
        </div>
        <div class="mainInfo">
          <h2><?php echo(htmlspecialchars($userResults["display_name"])); ?></h2>
          <h3><?php echo(htmlspecialchars($userResults["real_name"])); ?></h3>
        </div>
      </div>
      <p><?php echo(htmlspecialchars($userResults["profile_description"])); ?></p>
    </div>

    <?php makeFooter(); ?>
  </body>
</html>
