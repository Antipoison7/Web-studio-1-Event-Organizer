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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Username Goes Here</title>
    
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="stylesheet" href="./Resources/Style/userProfile.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body class="crunch">
  <?php headerNoLogin("Discussion Board") ?>
    <div class="profileContainer">
      <div class="profileFlex">
        <div class="profilePictureContainer">
          <img src="./Resources/Images/userPfp/connorPfp.jpg" alt="Profile Picture" class="profileImage">
        </div>
        <div class="mainInfo">
          <h2>Antipoison</h2>
          <h3>Connor Orders</h3>
        </div>
      </div>
      <p>Haha, someone please remind me to remove this cat, it is absolutely just something I stole of google images</p>
    </div>

    <?php makeFooter(); ?>
  </body>
</html>
