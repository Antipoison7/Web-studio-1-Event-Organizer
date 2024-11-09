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

        $stmt = $db->prepare("SELECT accounts.cooldown, users.profile_picture, users.username, users.display_name, users.real_name, users.archived, users.profile_description FROM accounts JOIN users ON accounts.login_name = users.username WHERE accounts.login_name NOT IN (SELECT DISTINCT login_username FROM achievementLink WHERE achieved_id <= 3);");

        $stmt->bindParam(':name', $username, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $db = null;
        $stmt = null;

        foreach($result as $x)
        {
          if($x["archived"] == 1)
          {
            $archiveVal = "True - Archived";
          }
          else
          {
            $archiveVal = "False - Not Archived";
          }

    echo("<input type=\"radio\" name=\"deleteRadio\" id=\"" . $x["username"] . "\" value=\"" . $x["username"] . "\" class=\"hideRadioButton\">
        <label for=\"" . $x["username"] . "\" class=\"userBox\">
          <div class=\"highlightBox\">
            <img src=\".." . $x["profile_picture"] . "\">
            <h3>Username: " . htmlspecialchars($x["username"]) . "</h3>
            <h4>Display Name: " . htmlspecialchars($x["display_name"]) . "</h4>
            <h4>Real Name: " . htmlspecialchars($x["real_name"]) . "</h4>
            <p>Description: " . htmlspecialchars($x["profile_description"]) . "</p>
            <p>Archived: " . $archiveVal . "</p>
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
    <?php headerNoLogin("Moderator Portal - Archive Account"); 
     if($isAdmin == true){?>
        <div class="admin">
          <form action="./archiveAccountIntermediate.php" method="post">
            <div class="submitHeaderDiv">
              <h2><a class="back" href="../adminControls.php">Back</a></h2>
              <button class="button" type="submit" style="width: 13em;">Change Archive Status</button>
            </div>
            <?php
              if(isset($_SESSION["issues"]["adminStuff"]))
              {
                if($_SESSION["issues"]["adminStuff"] == "Changed")
                {
                  echo("<h2>User Archived / Unarchived</h2>");
                }
                if($_SESSION["issues"]["adminStuff"] == "What happened?")
                {
                  echo("<h2 class=\"darkRedColor\">User Not Found</h2>");
                }
                if($_SESSION["issues"]["adminStuff"] == "NotSet")
                {
                  echo("<h2 class=\"darkRedColor\">Pick a user please</h2>");
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
