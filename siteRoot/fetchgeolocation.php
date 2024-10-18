<?php
function getUserGeolocation($ip) {
    // Your external API URL for geolocation
    $apiKey = '7aa7c69d766e4451a1167a42eaee936c'; // Your actual API key
    $url = 'https://api.ipgeolocation.io/ipgeo?apiKey=' . $apiKey . '&ip=' . $ip;

    // Use file_get_contents to fetch data from the API
    $response = file_get_contents($url);

    if ($response === FALSE) {
        // Handle error
        return null;
    }

    // Decode the JSON response
    return json_decode($response, true);
}

// Example usage
$ip = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
$geolocationData = getUserGeolocation($ip);
?>

<?php if ($geolocationData): ?>
    <div>
        <h3>User Location:</h3>
        <p>Latitude: <?= $geolocationData['latitude'] ?></p>
        <p>Longitude: <?= $geolocationData['longitude'] ?></p>
        <!-- Add a link to the location, if applicable -->
        <a href="https://www.google.com/maps/search/?api=1&query=<?= $geolocationData['latitude'] ?>,<?= $geolocationData['longitude'] ?>">View on Map</a>
    </div>
<?php else: ?>
    <p>Unable to fetch location data.</p>
<?php endif; ?>
