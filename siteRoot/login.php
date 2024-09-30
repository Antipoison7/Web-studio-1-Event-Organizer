<?php
  include_once('./Resources/Helper/headers.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Event Organizer</title>
    
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Resources/Style/base.css">
  </head>
  <body>
    <div class="loginHeader">
        <a href="./">
            <div class="button"><p>Home</p></div>
        </a>
        <h1>User Login</h1>
        <div style="width: 14em; height: 3em;"></div>
    </div>

    <form method="post" action="./intermediateLogin">
        <label for="username">Username / Email:</label>
        <input type="text" id="username" name="username">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
    </form>

    <?php makeFooter(); ?>
  </body>
</html>
