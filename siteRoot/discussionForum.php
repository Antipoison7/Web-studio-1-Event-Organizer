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
        echo "<div class='discussionBoard'>";
        echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";

        class TableRows extends RecursiveIteratorIterator {
          function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
          }

        function current() {
            return "<div class='DiscussionPost'>" . parent::current(). "</div>";
        }

        function beginChildren() {
            echo "<br>";
        }

        function endChildren() {
            echo "<br>" . "\n";
        }
        }

        $servername = "talsprddb02.int.its.rmit.edu.au:3306";
        $username = "COSC3046_2402_UGRD_1479_G4";
        $password = "GYS3sfUkzIqA";
        $dbname = "COSC3046_2402_UGRD_1479_G4";

        try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT eventName, eventDesc, priceURL, imageLink, Region FROM EventList");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
        } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        }
        $conn = null;
        echo "</div>";
        ?>





      
    </div>
    <?php
      makeFooter();
    ?>
  </body>
</html>
