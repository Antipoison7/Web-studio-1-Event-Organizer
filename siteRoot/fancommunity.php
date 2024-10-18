<?php
session_start(); //Start the session like on every other page or else login stuff wont work - Connor
include('/home/sh8/S4055688/public_html/web-studio-project-group_01_wps_2024/siteRoot/Resources/Helper/headers.php'); // Including the header
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Linking CSS files -->
    <link rel="stylesheet" href="./Resources/Style/base.css"> <!-- Shared styles -->
    <link rel="stylesheet" href="./Resources/Style/fancommunity.css"> <!-- Fan community specific styles -->
    
    <title>Fan Community</title>
</head>
<body>

    <!-- Fan Community Header -->
    <header>
    <div class="header-background"> <!-- Added background container -->
        <div class="header-container">
            <div class="logo">
                <img src="./Resources/Images/fancommunity/logo.png" alt="Sports Fan Club">
            </div>
            <nav class="nav-icons">
                <ul>
                    <li><a href="fancommunity.php"><img src="./Resources/Images/fancommunity/emojis/people.png" alt="Fan Community"></a></li>
                    <li><a href="search.php"><img src="./Resources/Images/fancommunity/emojis/search.png" alt="Search"></a></li>
                    <li><a href="favorites.php"><img src="./Resources/Images/fancommunity/emojis/heart.png"></a></li>
                    <li><a href="profile.php"><img src="./Resources/Images/fancommunity/emojis/profile.png" alt="Profile"></a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>


    <!-- Trending Discussions Section -->
    <section class="trending-discussions">
        <h2>Trending Discussions</h2>
        <div class="discussion-container combined-background">
            <div class="discussion-item">
                <h3>Discussion 1</h3>
                <p>A short description or snippet of the discussion.</p>
            </div>
            <div class="discussion-item">
                <h3>Discussion 2</h3>
                <p>A short description or snippet of the discussion.</p>
            </div>
            <div class="arrow-navigation">
                <a href="discussions.php"><img src="/path-to-icons/right-arrow.png" alt="Go to Discussions"></a>
            </div>
        </div>
    </section>

    <!-- Community Clubs Section -->
    <section class="community-clubs">
        <h2>Community Clubs</h2>
        <div class="clubs-container">
            <div class="club-item">
                <img src="./Resources/Images/fancommunity/clubs/club1.png" alt="Club 1">
            </div>
            <div class="club-item">
                <img src="./Resources/Images/fancommunity/clubs/club2.png" alt="Club 2">
            </div>
            <div class="club-item">
                <img src="./Resources/Images/fancommunity/clubs/club3.png" alt="Club 3">
            </div>
            <div class="club-item">
                <img src="./Resources/Images/fancommunity/clubs/club4.png" alt="Club 4">
            </div>
            <div class="club-item">
                <img src="./Resources/Images/fancommunity/clubs/club5.png" alt="Club 5">
            </div>
            <div class="club-item">
                <img src="./Resources/Images/fancommunity/clubs/club6.png" alt="Club 6">
            </div>
            <div class="club-summary">
                <div class="summary-box">
                    <span>+57.4k</span>
                    <p>Clubs Available</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Fan Gallery Section -->
    <section class="fan-gallery">
        <h2>Fan Gallery</h2>
        <div class="gallery-container">
            <div class="gallery-item">
                <div class="gallery-collage">
                    <img src="/Resources/Images/event1-1.jpg" alt="Event 1 Image 1">
                    <img src="/Resources/Images/event1-2.jpg" alt="Event 1 Image 2">
                    <img src="/Resources/Images/event1-3.jpg" alt="Event 1 Image 3">
                    <div class="image-overlay">
                        <span>+27</span>
                    </div>
                </div>
                <p>Event 1</p>
            </div>
            <!-- Repeat similar structure for other events -->
            <div class="gallery-summary">
                <div class="summary-box">
                    <span>+22.5k</span>
                    <p>Event Photos</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Fan Community</p>
    </footer>
</body>
</html>
