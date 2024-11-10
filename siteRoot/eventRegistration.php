<?php
  session_start();
  include_once('./Resources/Helper/headers.php');
  include_once('./Resources/Helper/eventregister.php');
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
      <form class="regBlock" action="./Resources/Helper/eventregister.php" method="post">
        <div>

          <label for="etitle">Whats the title of your event?</label><br>
            <input type="text" id="eventTitle" name="eventTitle" placeholder="Day in the Park etc." size="50" maxlength="25"><br><br>
        
          <label for="eventDescription">Whats your event about?</label><br>
            <input type="text" id="eventDescription" name="eventDescription" placeholder="Come spend a day in the park etc." size="50" maxlength="500"><br><br>

          <label for="eLink">Price of ticket</label><br>
            <input type="text" id="priceCost" name="priceCost" placeholder="80.00 Dont include $ Symbols" size="50" maxlength="50"><br><br>

          <label for="eventRegion">Where is your event located?</label><br>
            <input type="text" id="eventRegion" name="eventRegion" placeholder="Victoria, Australia..." size="50" maxlength="50"><br><br>

        
          <label for="eimg">What image would you like displayed? </label><br>
            <input type="file" id="eimg" name="eimg" accept="image/*\" placeholder="Image of Park"><br>

            <input type="submit" value="Submit"> <br>
        </div>
          
      </form>
    
    <?php
      makeFooter();
    ?>
  </body>
</html>
