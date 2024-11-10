<?php
session_start();
header('Content-Type: application/json');

// Get the request body data
$data = json_decode(file_get_contents('php://input'), true);

// Check if cart session variable exists, if not initialize it
if (!isset($_SESSION['cartItems'])) {
    $_SESSION['cartItems'] = [];
}

// Add new item to cart session
$_SESSION['cartItems'][] = [
    'title' => $data['title'],
    'price' => $data['price'],
    'date' => $data['date'],
    'id' => $data['id']
];

echo json_encode(['success' => true]);
?>
