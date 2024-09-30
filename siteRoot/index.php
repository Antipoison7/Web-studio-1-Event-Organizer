<?php
  include_once('./Resources/Helper/headers.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Event Organizer</title>
    
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Resources/Style/base.css">
  </head>
  <body>
    <?php makeHeader("Sample Title") ?>
    <div class="creatorFlex">
      <?php
        $creatorArray = [
          array("name" => "Josip", "pfp" => ""), 
          array("name" => "Declan", "pfp" => "declanPfp.jpg"), 
          array("name" => "Himanth", "pfp" => ""), 
          array("name" => "Connor", "pfp" => "connorPfp.jpg")
        ];
        foreach($creatorArray as $x)
        {
          echo("<div class=\"creatorBox\">
                <p>" . $x["name"] . "</p>
                <img src=\"./Resources/Images/Pfp/" . $x["pfp"] . "\" alt=\"" . $x["name"] . " Profile Picture\">
                </div>");
        }
      ?>
    </div>
    <?php
      makeFooter();
    ?>
  </body>
</html>
