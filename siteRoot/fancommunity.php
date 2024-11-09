<?php
include 'fetchgeolocation.php'; // Include the file
session_start();

// Function to get the user's real IP address
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

$ip = getUserIP(); // Get the user's IP address
$geolocationData = getUserGeolocation($ip); // Pass the IP address to fetch geolocation data
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Linking CSS files -->
    <link rel="stylesheet" href="./Resources/Style/base.css"> <!-- Shared styles -->
    <link rel="stylesheet" href="./Resources/Style/fancommunity.css"> <!-- Fan community specific styles -->
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
    
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
                    <li><a href="HomePage.php"><img src="./Resources/Images/fancommunity/emojis/home.png" alt="Home"></a></li>
                    <li><a href="fancommunity.php"><img src="./Resources/Images/fancommunity/emojis/people.png" alt="Fancommunity"></a></li>
                    <li><a href="favorites.php"><img src="./Resources/Images/fancommunity/emojis/heart.png" alt="Favorites"></a></li>
                    <li><a href="profileView.php"><img src="./Resources/Images/fancommunity/emojis/profile.png" alt="Profile"></a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

    <!-- Trending Discussions Section -->
    <section class="trending-discussions">
    <div class="trending-heading">
        <img src="./Resources/Images/fancommunity/Headers/discussions.png" alt="Trending Discussions">
    </div>
    <div class="discussion-container combined-background">
        <div class="discussion-item">
            <img src="./Resources/Images/fancommunity/discussions/discussion1.png" alt="Trending Discussions">
        </div>
        <div class="discussion-item">
            <img src="./Resources/Images/fancommunity/discussions/discussion2.png" alt="Trending Discussions">
        </div>
        <div class="arrow-navigation">
            <a href="discussions.php">
                <img src="./Resources/Images/fancommunity/emojis/arrow.png" alt="Go to Discussions" style="width: 50px; height: auto;">
            </a>
        </div>
    </div>
</section>


    <!-- Community Clubs Section -->
    <section class="community-clubs">
        <div class="clubs-heading">
            <img src="./Resources/Images/fancommunity/Headers/communityheading.png" alt="Community Clubs">
        </div>
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
    <a href="clubsAvailable.php" class="summary-link">
        <div class="summary-box">
            <span>+57.4k</span>
            <p>Clubs Available</p>
        </div>
    </a>
</div>

        </div>
    </section>

    <!-- Fan Gallery Section -->
    <section class="fan-gallery">
        <div class="gallery-heading">
            <img src="./Resources/Images/fancommunity/Headers/fangallery.png" alt="Fan Gallery">
        </div>
        <div class="gallery-container">
            <div class="gallery-item">
                <div class="gallery-collage">
                    <img src="./Resources/Images/fancommunity/Fangallery/E1P1.jpg" alt="Event 1 Image 1">
                    <img src="./Resources/Images/fancommunity/Fangallery/E1P2.jpg" alt="Event 1 Image 2">
                    <img src="./Resources/Images/fancommunity/Fangallery/E1P3.jpg" alt="Event 1 Image 3">
                    <img src="./Resources/Images/fancommunity/Fangallery/E1P4.jpg" alt="Event 1 Image 4">
                    <a href="event_gallery.php">
                    <div class="image-overlay">+10</div>
                    </a>
                </div>
                <p>Basketball League</p>
                <p>John Cain Arena</p> <!-- Event Location -->
    <a href="https://www.google.com/maps/place/John+Cain+Arena/@-37.8227725,144.9793938,17z/data=!3m1!4b1!4m6!3m5!1s0x6ad642be136568a7:0x38c0a17f8edfa003!8m2!3d-37.8227725!4d144.9819687!16zL20vMGIzMTd5?entry=ttu&g_ep=EgoyMDI0MTAxNi4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer">View on Map</a> 
    <!-- Ensure to replace with the actual coordinates -->
            </div>

            <div class="gallery-item">
                <div class="gallery-collage">
                    <img src="./Resources/Images/fancommunity/Fangallery/E2P1.jpg" alt="Event 2 Image 1">
                    <img src="./Resources/Images/fancommunity/Fangallery/E2P2.jpg" alt="Event 2 Image 2">
                    <img src="./Resources/Images/fancommunity/Fangallery/E2P3.jpg" alt="Event 2 Image 3">
                    <img src="./Resources/Images/fancommunity/Fangallery/E2P4.jpg" alt="Event 2 Image 4">
                    <a href="event_gallery.php?event_id=2">
                    <div class="image-overlay">+10</div>
                    </a>
                </div>
                <p>Basketball Pros</p>
                <p>Margaret Court Arena</p> <!-- Event Location -->
    <a href="https://www.google.com/maps/place/Margaret+Court+Arena/@-37.8211276,144.9750615,17z/data=!3m1!4b1!4m6!3m5!1s0x6ad642b94abc8457:0x606c4133f1ce2040!8m2!3d-37.8211276!4d144.9776364!16zL20vMGNtZ2p6?entry=ttu&g_ep=EgoyMDI0MTAxNi4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer">View on Map</a> 
    <!-- Ensure to replace with the actual coordinates -->
            </div>

            <div class="gallery-item">
                <div class="gallery-collage">
                    <img src="./Resources/Images/fancommunity/Fangallery/E1P1.jpg" alt="Event 1 Image 1">
                    <img src="./Resources/Images/fancommunity/Fangallery/E1P2.jpg" alt="Event 1 Image 2">
                    <img src="./Resources/Images/fancommunity/Fangallery/E1P3.jpg" alt="Event 1 Image 3">
                    <img src="./Resources/Images/fancommunity/Fangallery/E1P4.jpg" alt="Event 1 Image 4">
                    <a href="event_gallery.php?event_id=3">
                    <div class="image-overlay">+10</div>
                    </a>
                </div>
                <p>FIBA Basketball World Cup</p>
                <p>Docklands</p> <!-- Event Location -->
    <a href="https://www.google.com/maps/search/?api=1&query=-37.81363,144.96306" target="_blank" rel="noopener noreferrer">View on Map</a> 
    <!-- Ensure to replace with the actual coordinates -->
            </div>

            <div class="gallery-item">
                <div class="gallery-collage">
                    <img src="./Resources/Images/fancommunity/Fangallery/E3P1.jpg" alt="Event 3 Image 1">
                    <img src="./Resources/Images/fancommunity/Fangallery/E3P2.jpg" alt="Event 3 Image 2">
                    <img src="./Resources/Images/fancommunity/Fangallery/E3P3.jpg" alt="Event 3 Image 3">
                    <img src="./Resources/Images/fancommunity/Fangallery/E3P4.jpg" alt="Event 3 Image 4">
                    <a href="event_gallery.php?event_id=4">
                    <div class="image-overlay">+10</div>
                    </a>
                </div>
                <p>Cricket World Cup</p>
                <p>Melbourne Cricket Ground</p> <!-- Event Location -->
    <a href="https://www.google.com/maps/place/Melbourne+Cricket+Ground/@-37.8198747,144.9795207,16.37z/data=!4m6!3m5!1s0x6ad64295571a6281:0x63575fd647a0b2f9!8m2!3d-37.8199669!4d144.9834493!16zL20vMDRfMW0?entry=ttu&g_ep=EgoyMDI0MTAxNi4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer">View on Map</a> 
    <!-- Ensure to replace with the actual coordinates -->
            </div>

            <div class="gallery-item">
                <div class="gallery-collage">
                    <img src="./Resources/Images/fancommunity/Fangallery/E4P1.jpg" alt="Event 4 Image 1">
                    <img src="./Resources/Images/fancommunity/Fangallery/E4P2.jpg" alt="Event 4 Image 2">
                    <img src="./Resources/Images/fancommunity/Fangallery/E4P3.jpg" alt="Event 4 Image 3">
                    <img src="./Resources/Images/fancommunity/Fangallery/E4P4.jpg" alt="Event 4 Image 4">
                    <a href="event_gallery.php?event_id=5">
                    <div class="image-overlay">+10</div>
                    </a>
                </div>
                <p>BCM Women</p>
                <p>State Sport Centres</p> <!-- Event Location -->
    <a href="https://www.google.com/maps/place/State+Sport+Centres+-+MSAC/@-37.843442,144.9592874,17z/data=!3m2!4b1!5s0x6ad6674064e9d437:0x476bccb16c8b7538!4m6!3m5!1s0x6ad667e27fe5b65b:0x7da260ae352a6392!8m2!3d-37.843442!4d144.9618623!16zL20vMGMzX3pm?entry=ttu&g_ep=EgoyMDI0MTAxNi4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer">View on Map</a> 
    <!-- Ensure to replace with the actual coordinates -->
     
            </div>
            
            <div class="gallery-summary">
        <a href="eventGallery.php" class="summary-link">
            <div class="summary-box">
                <span>+22.5k</span>
                <p>Events Photos</p>
            </div>
        </a>
    </div>
        </div>
    </section>

    <!-- Geolocation Section -->
    <?php if ($geolocationData): ?>
    <div>
        <h3>User Location:</h3>
        <p>Latitude: <?= $geolocationData['latitude'] ?></p>
        <p>Longitude: <?= $geolocationData['longitude'] ?></p>
        <!-- Add a link to the location, if applicable -->
        <a href="https://www.google.com/maps/search/?api=1&query=<?= $geolocationData['latitude'] ?>,<?= $geolocationData['longitude'] ?>">View on Map</a>
    </div>
    <?php else: ?>
    <p>Unable to retrieve geolocation data.</p>
    <?php endif; ?>

    <!-- Footer Section -->
    <footer>
        <div class="footer-links">
            <a href="#">Privacy</a>
            <a href="#">Terms and Conditions</a>
            <a href="#">FAQ</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="social-media">
            <a href="#"><img src="./Resources/Images/fancommunity/social/instagram.png" alt="Instagram"></a>
            <a href="#"><img src="./Resources/Images/fancommunity/social/facebook.png" alt="Facebook"></a>
            <a href="#"><img src="./Resources/Images/fancommunity/social/youtube.png" alt="YouTube"></a>
        </div>
    </footer>
    <div>
    <input type="text" id="discussionContent" placeholder="Enter your discussion">
    <button onclick="submitDiscussion()">Add Discussion</button>
</div>

<script>
   function submitDiscussion() {
       const content = document.getElementById('discussionContent').value;
       addDiscussion(content);
   }
</script>


</body>
</html>
<script>
    function addDiscussion(content) {
        fetch('api.php?action=addDiscussion', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `content=${encodeURIComponent(content)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                // Optionally reload or update discussions here
            } else {
                alert(data.message);
            }
        });
    }
</script>
