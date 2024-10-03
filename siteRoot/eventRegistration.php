<?php
  include_once('./Resources/Helper/headers.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Event Registration</title>
    
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <?php makeHeader("Event Registraion") ?>
      <form>
        <label for="etitle">Whats the title of your event?</label><br>
        <input type="text" id="eventTitle" name="eventTitle"><br>
        <label for="eventDescription">Whats your event about?</label><br>
        <input type="text" id="eventDescription" name="eventDescription"><br>
        <label for="eimg">What image would you like displayed? </label><br>
        <input type="file" id="eimg" name="eimg" accept="image/*\">
      </form>
    
    <?php
      makeFooter();
    ?>
  </body>
</html>
