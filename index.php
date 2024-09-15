<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Event Organizer</title>
    
    <meta charset="UTF-8">
  </head>
  <body>
    <h1>Sample Title</h1>

    <?php
      $creatorArray = ["Josip", "Declan", "Himanth", "Connor"];
      foreach($creatorArray as $x)
      {
        echo("<p>" . $x . "</p>");
      }
    ?>
  </body>
</html>
