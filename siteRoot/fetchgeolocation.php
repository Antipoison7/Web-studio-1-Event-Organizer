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

    // Log the raw response for debugging
    file_put_contents('geolocation_debug.log', print_r($data, true), FILE_APPEND);
    
    return $data;
}

// Example usage
$ip = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
$geolocationData = getUserGeolocation($ip);
?>

