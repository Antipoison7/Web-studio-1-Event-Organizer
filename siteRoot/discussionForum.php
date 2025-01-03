<?php
session_start();
include_once('./Resources/Helper/headers.php');
include_once('./Resources/Helper/sanitization.php');
include_once('./Resources/Helper/loginHelper.php');

$isAdmin = false;

if (isset($_SESSION["loginDetails"]["username"]) && isset($_SESSION["loginDetails"]["password"])) {
  $isAdmin = isValidAdminLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Discussion Forum</title>


  <?php createMeta() ?>
  <link rel="stylesheet" href="./Resources/Style/base.css">
  <link rel="stylesheet" href="./Resources/Style/forum.css">
  <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
</head>

<body>

  <?php headerNoLogin("Discussion Board") ?>
  <div class="BannerFlex">
    <?php
    $servername = "talsprddb02.int.its.rmit.edu.au:3306";
    $username = "COSC3046_2402_UGRD_1479_G4";
    $password = "GYS3sfUkzIqA";
    $dbname = "COSC3046_2402_UGRD_1479_G4";


    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT EventID, eventName, eventDesc, priceCost FROM EventList WHERE NOT archived = 1;";
    $result = mysqli_query($conn, $sql);
    echo "<div class='DiscussionBlock'>";

    if (mysqli_num_rows($result) > 0) {

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='DiscussionPost' id=\"bigPost" . $row["EventID"] . "\">
                        <div id='discussionpost_layout'>
                          <div id='Event_Title'>
                            <h1>" . cleanTextHTML($row["eventName"]) . "</h1>
                          </div>
                          <div id='Event_Description'> " . cleanTextHTML($row["eventDesc"]) . "</div>
                          <div id='Event_Image'> 
                            <img id=\"discussionImage\" src=\"./Resources/Images/Events/thumbnails/day in the park example.jpg\" alt=\"day in the park image\">
                          </div>
                          <element id='Price_Amount'>
                          $<a href='#' onclick=\"addToCart(" . $row["EventID"] . ", '" . addslashes($row["eventName"]) . "', " . $row["priceCost"] . ")\">" . cleanTextHTML($row["priceCost"]) . "</a>
                            <div id=\"popup-ticket\">Ticket added to Cart <a href=\"#\"> Close the Popup</a></div>";
        if ($isAdmin == true) {
          echo ("<a href=\"#\" onclick=\"toggleDeleteMenu(" . $row["EventID"] . ")\" tabindex=\"0\"><img src=\"./Resources/Images/Resources/delete.png\" alt=\"Delete Post\" class=\"discussionDeleteImage\"></a>
                          </element>

                          <div class=\"discussionDeleteDiv hiddenClass\" id=\"deleteBox" . $row["EventID"] . "\">
                            <h2>Are you sure you want to archive post:</h2>
                            <p>Copy this word to confirm: <span class=\"darkRedColor\">Delete</span></p>
                            <div class=\"flex\" style=\"align-items:center; gap: 5px;\">
                              <input type=\"text\" id=\"post" . $row["EventID"] . "\">
                              <a href=\"#\" onclick=\"tryArchivePost(" . $row["EventID"] . ")\" tabindex=\"0\"><div class=\"smallButtonWarn\">Archive</div></a>
                            </div>
                          </div>");
        } else {
          echo ("</element>");
        }
        echo "
                        </div>
                      </div>";
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

<script>
  <?php if ($isAdmin == true) { ?>
  function toggleDeleteMenu(eventName) {
    let deleteMenuBox = document.getElementById("deleteBox" + eventName);
    deleteMenuBox.classList.toggle("hiddenClass");
  }

  function tryArchivePost(eventName) {
    let archiveValue = document.getElementById("post" + eventName).value;

    if (archiveValue == "Delete") //Replace with actual word
    {
      fetch("../APIs/api.php", {
        method: "POST",
        body: JSON.stringify({
          function: "archiveEvent",
          Username: "<?php echo($_SESSION["loginDetails"]["username"]); ?>",
          Password: "<?php echo($_SESSION["loginDetails"]["password"]); ?>",
          varA: eventName
        }),
        headers: {
          "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
        }
      }).then((response) => response.json()).then((json) => { if(typeof json.status !== 'undefined'){document.getElementById("bigPost" + eventName).remove();}}) ;

      ;
    }
  }
  <?php } ?>

  function addToCart(eventID, eventName, price) {
    fetch('./addToCart.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        id: eventID,
        title: eventName,
        price: price,
        date: new Date().toLocaleDateString()
      })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Ticket added to cart!');
      } else {
        alert('Error adding to cart.');
      }
    })
    .catch(error => console.error('Error:', error));
  }
  </script>

</html>