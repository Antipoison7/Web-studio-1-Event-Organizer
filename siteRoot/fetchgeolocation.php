<?php
function getUserGeolocation($ip) {
    $apiKey = '7aa7c69d766e4451a1167a42eaee936c';
    $url = 'https://api.ipgeolocation.io/ipgeo?apiKey=' . $apiKey . '&ip=' . $ip;

    $response = @file_get_contents($url);

    // Log the raw response
    file_put_contents('geolocation_debug.log', $response . PHP_EOL, FILE_APPEND);

    if ($response === FALSE) {
        error_log("Error fetching geolocation: " . print_r(error_get_last(), true));
        return null;
    }

    $data = json_decode($response, true);
    
    // Check if decoding was successful
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON Decode Error: " . json_last_error_msg());
        return null;
    }

    return $data;
}



// Example usage
$ip = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
$geolocationData = getUserGeolocation($ip);
?>

