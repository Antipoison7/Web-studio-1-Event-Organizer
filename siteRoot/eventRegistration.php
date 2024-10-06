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
  <body style="background-color: lightgray;">
    <?php headerNoLogin("Event Registration") ?>
      <form class="regBlock">
        <div>

          <label for="etitle">Whats the title of your event?</label><br>
            <input type="text" id="eventTitle" name="eventTitle" placeholder="Day in the Park etc." size="50" maxlength="25"><br><br>
        
          <label for="eventDescription">Whats your event about?</label><br>
            <input type="text" id="eventDescription" name="eventDescription" placeholder="Come spend a day in the park etc." size="50" maxlength="250"><br><br>

          <label for="eLink">Link to purchase page/website?</label><br>
            <input type="text" id="eLink" name="eLink" placeholder="               https://www.youtube.com/watch?v=dQw4w9WgXcQ?autoplay=1" size="50" maxlength="25"><br><br>
        
          <label for="eimg">What image would you like displayed? </label><br>
            <input type="file" id="eimg" name="eimg" accept="image/*\" placeholder="Image of Park"><br>
        </div>
      </form>
    
    <?php
      makeFooter();
    ?>
  </body>
</html>
