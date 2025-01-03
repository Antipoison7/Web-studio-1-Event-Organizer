<?php
// Database connection details
$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
include 'fetchgeolocation.php'; // Include the file
include_once('./Resources/Helper/userDetailsHelper.php');
include_once('./Resources/Helper/loginHelper.php');
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

$profilePictureVal = "/Resources/Images/fancommunity/emojis/profile.png";

if(isset($_SESSION["loginDetails"]["username"])&&isset($_SESSION["loginDetails"]["password"]))
{
    if(isValidLogin($_SESSION["loginDetails"]["username"], $_SESSION["loginDetails"]["password"]))
    {
        $profilePictureVal = getProfilePicture($_SESSION["loginDetails"]["username"]);
        $profileLookup = $_SESSION["loginDetails"]["username"];
    }
}
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
                    <li><a href="profileView.php?userLookup=<?php echo($profileLookup); ?>"><img src=".<?php echo($profilePictureVal); ?>" alt="Profile" class="profileFanCommunity"></a></li>
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

        <?php
    // Function to get image count for each event
    function getImageCounts($conn, $event_id) {
        $sql = "SELECT COUNT(*) AS image_count FROM event_photos WHERE event_id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $event_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row['image_count'] ?? 0;
        } else {
            die("SQL Error: " . $conn->error); // Optional: Handle SQL preparation errors
        }
    }
    ?>

            <!-- Gallery Item for Event 1 -->
        <div class="gallery-item">
            <div class="gallery-collage">
                <img src="./Resources/Images/fancommunity/Fangallery/E1P1.jpg" alt="Event 1 Image 1">
                <img src="./Resources/Images/fancommunity/Fangallery/E1P2.jpg" alt="Event 1 Image 2">
                <img src="./Resources/Images/fancommunity/Fangallery/E1P3.jpg" alt="Event 1 Image 3">
                <img src="./Resources/Images/fancommunity/Fangallery/E3P2.jpg" alt="Event 1 Image 4">
                <a href="event_gallery.php?event_id=1">
                <div class="image-overlay">+<?php echo getImageCounts($conn, 1); ?></div>
                </a>
            </div>
            <p>Basketball League</p>
            <p>John Cain Arena</p>
            <a href="https://www.google.com/maps/place/John+Cain+Arena/@-37.8227725,144.9793938,17z/data=!3m1!4b1!4m6!3m5!1s0x6ad642be136568a7:0x38c0a17f8edfa003!8m2!3d-37.8227725!4d144.9819687!16zL20vMGIzMTd5?entry=ttu&g_ep=EgoyMDI0MTAxNi4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer">View on Map</a>
        </div>

        <!-- Gallery Item for Event 2 -->
        <div class="gallery-item">
            <div class="gallery-collage">
                <img src="./Resources/Images/fancommunity/Fangallery/E2P1.jpg" alt="Event 2 Image 1">
                <img src="./Resources/Images/fancommunity/Fangallery/E2P2.jpg" alt="Event 2 Image 2">
                <img src="./Resources/Images/fancommunity/Fangallery/E2P3.jpg" alt="Event 2 Image 3">
                <img src="./Resources/Images/fancommunity/Fangallery/E1P1.jpg" alt="Event 2 Image 4">
                <a href="event_gallery.php?event_id=2">
                <div class="image-overlay">+<?php echo getImageCounts($conn, 2); ?></div>
                </a>
            </div>
            <p>Basketball Pros</p>
            <p>Margaret Court Arena</p>
            <a href="https://www.google.com/maps/place/Margaret+Court+Arena/@-37.8211276,144.9750615,17z/data=!3m1!4b1!4m6!3m5!1s0x6ad642b94abc8457:0x606c4133f1ce2040!8m2!3d-37.8211276!4d144.9776364!16zL20vMGNtZ2p6?entry=ttu&g_ep=EgoyMDI0MTAxNi4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer">View on Map</a>
        </div>

            <!-- Gallery Item for Event 3 -->
        <div class="gallery-item">
            <div class="gallery-collage">
                <img src="./Resources/Images/fancommunity/Fangallery/E1P1.jpg" alt="Event 1 Image 1">
                <img src="./Resources/Images/fancommunity/Fangallery/E1P2.jpg" alt="Event 1 Image 2">
                <img src="./Resources/Images/fancommunity/Fangallery/E1P3.jpg" alt="Event 1 Image 3">
                <img src="./Resources/Images/fancommunity/Fangallery/image.png" alt="Event 1 Image 4">
                <a href="event_gallery.php?event_id=3">
                <div class="image-overlay">+<?php echo getImageCounts($conn, 3); ?></div>
                </a>
            </div>
            <p>FIBA Basketball World Cup</p>
            <p>Docklands</p>
            <a href="https://www.google.com/maps/search/?api=1&query=-37.81363,144.96306" target="_blank" rel="noopener noreferrer">View on Map</a>
        </div>

            <!-- Gallery Item for Event 4 -->
            <div class="gallery-item">
                <div class="gallery-collage">
                    <img src="./Resources/Images/fancommunity/Fangallery/E3P1.jpg" alt="Event 3 Image 1">
                    <img src="./Resources/Images/fancommunity/Fangallery/E3P2.jpg" alt="Event 3 Image 2">
                    <img src="./Resources/Images/fancommunity/Fangallery/E3P3.jpg" alt="Event 3 Image 3">
                    <img src="./Resources/Images/fancommunity/Fangallery/E1P1.jpg" alt="Event 3 Image 4">
                    <a href="event_gallery.php?event_id=4">
                    <div class="image-overlay">+<?php echo getImageCounts($conn, 4); ?></div>
                    </a>
                </div>
                <p>Cricket World Cup</p>
                <p>Melbourne Cricket Ground</p> <!-- Event Location -->
    <a href="https://www.google.com/maps/place/Melbourne+Cricket+Ground/@-37.8198747,144.9795207,16.37z/data=!4m6!3m5!1s0x6ad64295571a6281:0x63575fd647a0b2f9!8m2!3d-37.8199669!4d144.9834493!16zL20vMDRfMW0?entry=ttu&g_ep=EgoyMDI0MTAxNi4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer">View on Map</a> 
    <!-- Ensure to replace with the actual coordinates -->
            </div>

              <!-- Gallery Item for Event 5 -->
            <div class="gallery-item">
                <div class="gallery-collage">
                    <img src="./Resources/Images/fancommunity/Fangallery/E4P1.jpg" alt="Event 4 Image 1">
                    <img src="./Resources/Images/fancommunity/Fangallery/E4P2.jpg" alt="Event 4 Image 2">
                    <img src="./Resources/Images/fancommunity/Fangallery/E4P3.jpg" alt="Event 4 Image 3">
                    <img src="./Resources/Images/fancommunity/Fangallery/image copy.png" alt="Event 4 Image 4">
                    <a href="event_gallery.php?event_id=5">
                    <div class="image-overlay">+<?php echo getImageCounts($conn, 5); ?></div>
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
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<!-- Coordinates Display Section -->
<div id="coordinates" style="font-size: 16px; margin-bottom: 10px;">
    <strong>User Location:</strong>
    <p>Latitude: <span id="latitude"><?= $geolocationData['latitude'] ?? 'Unavailable' ?></span></p>
    <p>Longitude: <span id="longitude"><?= $geolocationData['longitude'] ?? 'Unavailable' ?></span></p>
    <!-- Google Maps Link -->
    <a id="googleMapLink" href="#" target="_blank">View on Google Maps</a>
</div>

<!-- Map Section -->
<div id="map" style="height: 400px; width: 100%;"></div>

<script>
// Make sure the PHP geolocation data is available in JavaScript
let userLatitude = <?= json_encode($geolocationData['latitude'] ?? null); ?>;
let userLongitude = <?= json_encode($geolocationData['longitude'] ?? null); ?>;

// Function to initialize the map with provided coordinates
function initializeMap(lat, lng) {
    console.log("Initializing map with coordinates:", lat, lng); // Debugging

    // Initialize the map centered on the provided coordinates
    const map = L.map('map').setView([lat, lng], 13);

    // Add the base map tiles (using OpenStreetMap here)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Add a marker at the user's location
    L.marker([lat, lng])
        .addTo(map)
        .bindPopup('You are here!')
        .openPopup();

    // Add additional event markers (optional)
    const events = [
        { latitude: -37.8136, longitude: 144.9631, event: "Event A" },
        { latitude: -37.814, longitude: 144.963, event: "Event B" }
        // Add more events as needed
    ];

    events.forEach(event => {
        L.marker([event.latitude, event.longitude])
            .addTo(map)
            .bindPopup(event.event);
    });
}

// Function to update the displayed coordinates and Google Maps link
function updateCoordinates(lat, lng) {
    document.getElementById("latitude").textContent = lat;
    document.getElementById("longitude").textContent = lng;

    // Update the Google Maps link with the new coordinates
    const googleMapLink = `https://www.google.com/maps/search/?api=1&query=${lat},${lng}`;
    document.getElementById("googleMapLink").href = googleMapLink;
}

// Use HTML5 Geolocation if available, overriding the PHP coordinates if necessary
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
        (position) => {
            // Use precise HTML5 geolocation coordinates
            userLatitude = position.coords.latitude;
            userLongitude = position.coords.longitude;
            console.log("HTML5 geolocation successful:", userLatitude, userLongitude); // Debugging

            // Update displayed coordinates and initialize map
            updateCoordinates(userLatitude, userLongitude);
            initializeMap(userLatitude, userLongitude);
        },
        (error) => {
            console.error("Error obtaining HTML5 geolocation:", error);
            if (userLatitude && userLongitude) {
                // Fallback to PHP-based geolocation if HTML5 fails
                console.log("Falling back to PHP-based geolocation.");
                updateCoordinates(userLatitude, userLongitude);
                initializeMap(userLatitude, userLongitude);
            } else {
                alert("Unable to retrieve your location.");
            }
        }
    );
} else {
    console.error("HTML5 Geolocation is not supported.");
    if (userLatitude && userLongitude) {
        updateCoordinates(userLatitude, userLongitude);
        initializeMap(userLatitude, userLongitude);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}
</script>

    <!-- Footer Section -->
    <footer>
    <div class="footer-links">
        <a href="../siteRoot/PrivacyPolicy.php">Privacy</a>
        <a href="../siteRoot/TermsOfService.php">Terms and Conditions</a>
        <a href="../siteRoot/FAQSite.php">FAQ</a>
        <a href="">Contact Us</a>
    </div>
        <div class="social-media">
            <a href="#"><img src="../siteRoot/Resources/Images/fancommunity/instagram.jpg" alt="Instagram"></a>
            <a href="#"><img src="../siteRoot/Resources/Images/fancommunity/facebook.png" alt="Facebook"></a>
            <a href="#"><img src="../siteRoot/Resources/Images/fancommunity/youtube.png" alt="YouTube"></a>
        </div>
    </footer>


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
