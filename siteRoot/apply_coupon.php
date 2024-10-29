<?php
session_start();
include_once('./Resources/Helper/headers.php');

$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);
$couponCode = $conn->real_escape_string($data['couponCode']);
$response = ['success' => false];

if ($couponCode) {
    $query = "SELECT discount FROM coupons WHERE code = '$couponCode' AND expires_at > NOW()";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $coupon = $result->fetch_assoc();
        $response = [
            'success' => true,
            'discount' => $coupon['discount']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
?>
