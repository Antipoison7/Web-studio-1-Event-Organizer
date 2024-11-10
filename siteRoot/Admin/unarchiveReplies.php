<?php
  session_start();
  include_once('./Resources/Helper/headers.php');
  include_once('./Resources/Helper/loginHelper.php');
  if(isset($_SESSION["loginDetails"]["username"])&&isset($_SESSION["loginDetails"]["password"]))
  {
      $isAdmin = isValidAdminLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]);
  }
  else
  {
    $isAdmin = false;
  }

  function makeUserResults()
  {
    $db = new PDO("mysql:host=talsprddb02.int.its.rmit.edu.au;dbname=COSC3046_2402_UGRD_1479_G4", "COSC3046_2402_UGRD_1479_G4", "GYS3sfUkzIqA");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("SELECT replies.id, replies.discussion_id, replies.user_id, replies.reply_text, replies.archived, discussions.title FROM replies JOIN discussions ON replies.discussion_id = discussions.id WHERE replies.archived = 1 ORDER BY replies.discussion_id;");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $db = null;
        $stmt = null;

        foreach($result as $x)
        {
    echo("<input type=\"radio\" name=\"deleteRadio\" id=\"event" . $x["id"] . "\" value=\"" . $x["id"] . "\" class=\"hideRadioButton\">
        <label for=\"event" . $x["id"] . "\" class=\"userBox\">
          <div class=\"highlightBox\">
            <h3>ID: " . htmlspecialchars($x["discussion_id"]) . " | " . htmlspecialchars($x["title"]) . "</h3>
            <h3>Username: " . htmlspecialchars($x["user_id"]) . "</h3>
            <h4>Content Id =" . htmlspecialchars($x["id"]) . ": " . htmlspecialchars($x["reply_text"]) . "</h4>
          </div>
        </label>");
        }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Moderator Portal</title>
    
    <span style="word-break: keep-all;"></span>

    <?php createMeta() ?>
    <link rel="stylesheet" href="../Resources/Style/base.css">
    <link rel="stylesheet" href="../Resources/Style/admin.css">
    <link rel="icon" type="image/x-icon" href="../Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <?php headerNoLogin("Moderator Portal - Unarchive Replies"); 
     if($isAdmin == true){?>
        <div class="admin">
          <form action="./unarchiveRepliesIntermediate.php" method="post">
            <div class="submitHeaderDiv">
              <h2><a class="back" href="../adminControls.php">Back</a></h2>
              <button class="button" type="submit" style="width: 13em;">Unarchive Reply</button>
            </div>
            <?php
              if(isset($_SESSION["issues"]["adminStuff"]))
              {
                if($_SESSION["issues"]["adminStuff"] == "Changed")
                {
                  echo("<h2>Reply Restored</h2>");
                }
                if($_SESSION["issues"]["adminStuff"] == "What happened?")
                {
                  echo("<h2 class=\"darkRedColor\">Reply Not Found</h2>");
                }
                if($_SESSION["issues"]["adminStuff"] == "NotSet")
                {
                  echo("<h2 class=\"darkRedColor\">Pick a reply please</h2>");
                }
              }
              
            ?>
              <div class="userDetails">
                <?php
                  makeUserResults();
                ?>
              </div>
            </form>
        </div>
    <?php
     }
     else
     {?>
      <div class="failedLogin">
      <h1>You need to log in / have insufficient clearance</h2>
      <h2><a href="../login.php">Log in with an admin account</a></h2>
    </div>
    <?php
     }
      makeFooter();
    ?>
  </body>

  <script>
        let element = document.getElementsByClassName("hideRadioButton");

        for (i of element)
        {
            i.addEventListener("click", highlightSelected);
        }

        function highlightSelected(event)
        {
            let restOf = document.getElementsByClassName("highlightBox");
            for (i of restOf)
            {
                i.style.boxShadow = "0px 0px 0px 3px #000000";
            }
            console.log(this.nextSibling.nextSibling.childNodes[0].nextElementSibling.style.boxShadow = "0px 0px 13px 2px #00E06C");
        }
    </script>
</html>
<?php
$_SESSION["issues"]["adminStuff"] = null;
?>
