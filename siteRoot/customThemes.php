<?php
  session_start();
  include_once('./Resources/Helper/headers.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Event Organizer</title>
    
    <style>
        h2{font-size: 1.8em;}
        h3{font-size: 1.8em;}
    </style>
    
    <?php createMeta() ?>
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="stylesheet" href="./Resources/Style/userProfile.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
  </head>
  <body>
    <?php headerNoLogin("How To Make A Custom Theme") ?>
    <div class="profileContainer">
        <h2>How to make a custom theme and submit it</h2>
        <h3>Step 1: Copy the template</h3>
        <p><a target="_blank" href="./Resources/Style/darkTheme.css">Copy the template here</a></p>
        <h3>Step 2: Download Stylus</h3>
        <p><a target="_blank" href="https://addons.mozilla.org/en-US/firefox/addon/styl-us/">Firefox</a></p>
        <p><a target="_blank" href="https://chromewebstore.google.com/detail/stylus/clngdbkpkpeebahjckkjfobafhncgmne">Chrome</a></p>
        <h3>Step 3: Creating a theme</h3>
        <p><a target="_blank" href="./profileView.php?userLookup=Antipoison_7">Navigate to the individual profile page here</a></p>
        <p>And open the extension from your toolbar, clicking 'Write new style for "link to profile"'</p>
        <h3>Step 4: Paste the template you copied before and edit it</h3>
        <h3>step 5: Send it to the email listed in Contact Us</h3>
    </div>
    <?php
      makeFooter();
    ?>
  </body>
</html>
