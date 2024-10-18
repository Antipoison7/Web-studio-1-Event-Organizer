<?php
  session_start();
  include_once('./Resources/Helper/headers.php');
  include_once('./Resources/Helper/loginHelper.php');
  include_once('./Resources/Helper/userDetailsHelper.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Customise profile</title>
    
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body class="crunch">
    <div class="profileHeader">
        <a href="./">
            <div class="button">Discard</div>
        </a>
        <h1>Customise profile</h1>
        <div style="width: 14em; height: 3em;"></div>
    </div>

    <?php if(isset($_SESSION["loginDetails"])){if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"])){?>
      <div class="content">
        <form id="customiseForm" class="uncrunch" method="post" action="./IntermediateCustomise.php">
          <div class="flex userInfoContainer">
            <label for="pfp" style="margin-right: 20px;">
              <div class="pfpContainer">
                <img class="customisePfp" alt="Upload Profile Picture" id="profilePictureIcon" src=".<?php echo(getProfilePicture($_SESSION["loginDetails"]["username"])); ?>">
                <img class="customisePfpOverlay" alt="Upload Profile Picture" id="profilePictureOverlay" src="./Resources/Images/Resources/addPhoto.png" hidden>
              </div>
            </label>
            <input type="file" name="pfp" id="pfp" hidden>
            <div class="userInfoBoxR">
              <label for="displayName">Display Name</label>
              <input type="text" name="displayName" id="displayName" value="<?php echo(getDisplayName($_SESSION["loginDetails"]["username"])) ?>" autocomplete="off">
              <label for="realName" >Real Name</label>
              <input type="text" name="realName" id="realName" value="<?php echo(getRealName($_SESSION["loginDetails"]["username"])) ?>" autocomplete="off">
            </div>
          </div>

          <div class="userInfoContainer userInfoBoxR">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" cols="50" form="customiseForm"><?php echo(getDescription($_SESSION["loginDetails"]["username"])) ?></textarea>
          </div>

          <div class="split"></div>

          <div class="userInfoContainer userInfoBoxR">
            <div class="themeBox">
            <label for="theme">Profile theme:&nbsp;</label>
            <a href="https://www.google.com">Custom Themes?</a>
            </div>
            <select name="theme" id="theme">
              <?php
              $themes = getThemes();
              $userTheme = getThemeName($_SESSION["loginDetails"]["username"]);
                foreach($themes as $i)
                {
                  echo("<option value=\"" . $i["theme_url"] . "\"");
                    if($i["theme_url"] == $userTheme)
                    {
                      echo("selected");
                    }
                  echo(">" . $i["theme_name"] . "</option>");
                }
              ?>
            </select>
          </div>
          <div class="userInfoContainer">
            <h2>Change Password?</h2>
            <a href="./" style="display:inline-block;">
              <div class="buttonInv">Change Password</div>
            </a>

            <h2>Archive Account? (Requires Password)</h2>
            <a href="./" style="display:inline-block;">
              <div class="buttonWarn">Archive</div>
            </a>
          </div>
          <div>
          </div>

          <div class="finishCustomise">
            <a href="./">
              <div class="button">Discard</div>
            </a>
            <button class="button save" type="submit">Save Changes</button>
          </div>
        </form>
      </div>
    <?php }
    else
    {
      failedLogin();
    } }
    else
    {
      failedLogin();
    } ?>
    <?php makeFooter(); ?>
  </body>

  <script>
    let imageObj = document.getElementById("profilePictureIcon");
    let imageOvl = document.getElementById("profilePictureOverlay");
    imageObj.addEventListener("mouseover", dimImmadome);
    imageObj.addEventListener("mouseout", brightImmadome);
    imageOvl.addEventListener("mouseover", dimImmadome);
    imageOvl.addEventListener("mouseout", brightImmadome);

    function dimImmadome()
    {
      imageObj.style.filter = "brightness(75%)";
      imageOvl.hidden = false;
    }
    
    function brightImmadome()
    {
      imageObj.style.filter = "brightness(100%)";
      imageOvl.hidden = true;
    }
  </script>
</html>
