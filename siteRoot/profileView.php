<?php
  include_once('./Resources/Helper/headers.php');
  include_once('./Resources/Helper/loginHelper.php');
  include_once('./Resources/Helper/userDetailsHelper.php');
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Username Goes Here</title>
    
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body class="crunch">
    <?php makeFooter(); ?>
  </body>

  <script>
    let imageObj = document.getElementById("profilePictureIcon");
    let imageOvl = document.getElementById("profilePictureOverlay");
    imageObj.addEventListener("mouseover", dimImmadome);
    imageObj.addEventListener("mouseout", brightImmadome);
    imageOvl.addEventListener("mouseover", dimImmadome);
    imageOvl.addEventListener("mouseout", brightImmadome);

    function dimImmadome()
    {
      imageObj.style.filter = "brightness(75%)";
      imageOvl.hidden = false;
    }
    
    function brightImmadome()
    {
      imageObj.style.filter = "brightness(100%)";
      imageOvl.hidden = true;
    }
  </script>
</html>
