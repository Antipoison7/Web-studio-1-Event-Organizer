<?php
header('Content-Type: application/json');

// Include your geolocation function
include 'fetchgeolocation.php'; // Include geolocation code

// Function to get the user's IP address
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
$geolocationData = getUserGeolocation($ip); // Fetch geolocation data using the IP

// Generate dynamic location data based on the user's geolocation
$locations = [
    [
        "id" => 1, 
        "event" => "Your Current Location", 
        "latitude" => $geolocationData['latitude'], 
        "longitude" => $geolocationData['longitude']
    ],
    ["id" => 2, "event" => "Event A", "latitude" => -37.8136, "longitude" => 144.9631],
    ["id" => 3, "event" => "Event B", "latitude" => -37.814, "longitude" => 144.963],
    // Add more events here...
];

// Return the dynamic JSON response
echo json_encode($locations);
?>
