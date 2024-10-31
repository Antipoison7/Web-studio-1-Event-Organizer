<?php
$servername = "talsprddb02.int.its.rmit.edu.au:3306";
$username = "COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  If($_POST){       
              $event_name =  $_REQUEST['eventTitle'];
              $event_desc = $_REQUEST['eventDescription'];
              $event_cost =  $_REQUEST['priceCost'];
              $event_region = $_REQUEST['eventRegion'];
              $event_image = $_REQUEST['eimg'];
    
    

            $stmt = $conn->prepare("INSERT INTO EventList (eventName, eventDesc, priceCost, imageLink, Region) VALUES (:name, :description, :price, :img, :Region);");

            $stmt->bindParam(':name', $event_name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $event_desc, PDO::PARAM_STR);
            $stmt->bindParam(':price', $event_cost, PDO::PARAM_STR);
            $stmt->bindParam(':Region', $event_region, PDO::PARAM_STR);
            $stmt->bindParam(':img', $event_image, PDO::PARAM_STR);

            $stmt->execute();
    
              


              //$sql = "INSERT INTO EventList (eventName, eventDescription, priceURL, imageLink, Region)
              //VALUES ($event_name, $event_desc, $event_link, $event_image, $event_region)";

              //$conn->exec($sql);
              echo "New record created successfully";
              echo "<br><a href=\"../../HomePage.php\">Back Home</a>";
              echo "<br><a href=\"../../discussionForum.php\">View Events</a>";
            }


  
  
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();

  $conn = null;
}
?>