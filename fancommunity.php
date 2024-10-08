<?php
include('/home/sh8/S4055688/public_html/web-studio-project-group_01_wps_2024/siteRoot/Resources/Helper/headers.php'); // Including the header
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Corrected paths to CSS files -->
    <link rel="stylesheet" href="/siteRoot/Resources/Style/base.css"> <!-- Assuming this is my base CSS file -->
    <link rel="stylesheet" type="text/css" href="/siteRoot/Resources/Style/fancommunity.css"> <!-- Fan Community CSS -->
    
    <title>Fan Community</title>
</head>
<body>
    <!-- If this causes a merge error, you need to pull more often -->
    <header>
        <h1>Welcome to the Fan Community!</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="fancommunity.php">Community</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Fan Gallery</h2>
            <div class="gallery">
                <!-- I will add images dynamically here -->
                <img src="/home/sh8/S4055688/public_html/web-studio-project-group_01_wps_2024/siteRoot/Resources/Images/fancommunity/fanimage.jpeg" alt="Fan Image 1">
                <img src="/siteRoot/Resources/Images/example2.jpg" alt="Fan Image 2">
            </div>
        </section>
        <section>
            <h2>Discussions</h2>
            <p>Share your thoughts and connect with fellow fans!</p>
            <!-- I will add a comment section or forum links here soon -->
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Fan Community</p>
    </footer>
</body>
</html>
