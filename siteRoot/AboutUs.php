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
    <link rel="stylesheet" href="./Resources/Style/legal.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <?php headerNoLogin("Meet the Creators") ?>
    <div class="creatorFlex">
      <?php
        $creatorArray = [
          array("name" => "Josip", "pfp" => "snoop.jpeg"), 
          array("name" => "Declan", "pfp" => "declanPfp.jpg"), 
          array("name" => "Himanth", "pfp" => "rock.jpeg"), 
          array("name" => "Connor", "pfp" => "connorPfp.jpg")
        ];
        foreach($creatorArray as $x)
        {
          echo("<div class=\"creatorBox\">
                <h1>" . $x["name"] . "</h1>
                <img src=\"./Resources/Images/userPfp/" . $x["pfp"] . "\" alt=\"" . $x["name"] . " Profile Picture\">
                </div>");
        }
      ?>
    </div>
    <?php
      makeFooter();
    ?>
  </body>
</html>
