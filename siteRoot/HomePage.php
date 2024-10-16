<?php
  session_start();
  include_once('./Resources/Helper/headers.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Event Organizer</title>
    
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <?php headerNoLogin("Home Page") ?>
    <div class="BannerFlex">
      <br>
      <img id="WebsiteBanner" src="./Resources/Images/Resources/Website banner_Final.jpg" alt="WebsiteBanner" width=100%>
    </div>
    <div class="HomePageFlex">
      <a href="./register.php"><div class="smallButtonInv">Register</div></a>
      <a href="./eventRegistration.php"><div class="smallButtonHomePage">Create Event</div></a>

    </div>
    <?php
      makeFooter();
    ?>
  </body>
</html>
