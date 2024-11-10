<?php
  session_start();
  include_once('./Resources/Helper/headers.php');
  include_once('./Resources/Helper/imageHelper.php');
  updateCache();

  $displayRegister = true;

  if(isset($_SESSION["loginDetails"]["username"])&&isset($_SESSION["loginDetails"]["password"]))
  {
    if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]))
    {
      $displayRegister = false;
    }
  }
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
      <img id="WebsiteBanner" src=".<?php echo getImg("site_resources","site_banner");?>" alt="WebsiteBanner" width="100%">
    </div>
    <div class="HomePageFlex">
      <?php if($displayRegister){?>
      <a href="./register.php"><div class="smallButtonInv">Register</div></a>
      <?php }?>
      <a href="./eventRegistration.php"><div class="smallButtonHomePage">Create Event</div></a>
    </div>
    <?php
      makeFooter();
    ?>
  </body>
</html>
