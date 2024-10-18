<?php
header('Content-Type: application/json');

// Simulated data (Replace with real data as needed)
$locations = [
    ["id" => 1, "event" => "Event A", "latitude" => -37.8136, "longitude" => 144.9631],
    ["id" => 2, "event" => "Event B", "latitude" => -37.814, "longitude" => 144.963],
    // Add more events here...
];

echo json_encode($locations);
?>
