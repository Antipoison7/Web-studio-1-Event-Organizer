<?php
  include_once('./Resources/Helper/headers.php');
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Discussion Forum</title>
    
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <?php headerNoLogin("Discussion Board") ?>
    
        <?php
            $servername = "talsprddb02.int.its.rmit.edu.au:3306";
            $username = "COSC3046_2402_UGRD_1479_G4";
            $password = "GYS3sfUkzIqA";
            $dbname = "COSC3046_2402_UGRD_1479_G4";

                  
            $conn = mysqli_connect($servername, $username, $password, $dbname);
                  
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT eventName, eventDesc, priceCost FROM EventList";
            $result = mysqli_query($conn, $sql);
            echo "<div class='DiscussionBlock'>";

            if (mysqli_num_rows($result) > 0) {
                    
              while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='DiscussionPost'><div id='discussionpost_layout'><div id='Event_Title'>" . $row["eventName"]. "</div><div id='Event_Description'> " . $row["eventDesc"]. "</div><div id='Event_Image'> <img id=\"discussionImage\" src=\"./Resources/Images/Resources/day in the park example.jpg\" alt=\"day in the park image\"></div><element id='Price_Amount'>" . $row["priceCost"]. "</div></div>";
              }
            } else {
              echo "0 results";
            }
            echo "</div>";

            mysqli_close($conn);
        ?>





      
    </div>
    <?php
      makeFooter();
    ?>
  </body>
</html>
