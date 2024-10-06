<?php
$servername = "talsprddb02.int.its.rmit.edu.au:3306";
$username = "COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";

function createEvent( $name, $desc, $url, $link, $region ) {
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO EventList (eventName, eventDescription, priceURL, imageLink, Region)
  VALUES ($name, $desc, $url, $link, $region)";
  
  $conn->exec($sql);
  echo "New record created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
}
?>