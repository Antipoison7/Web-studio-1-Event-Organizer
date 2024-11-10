<?php
session_start();
include_once('./Resources/Helper/headers.php');

// Database connection details
$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get coupon code from AJAX request
$data = json_decode(file_get_contents("php://input"), true);
$couponCode = isset($data['couponCode']) ? $conn->real_escape_string($data['couponCode']) : '';

$response = ['success' => false, 'message' => 'Invalid coupon code.'];

if ($couponCode) {
    // Prepare the query using a prepared statement to prevent SQL injection
    $query = "SELECT discount FROM coupons WHERE code = ? AND expires_at > NOW()";
    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("s", $couponCode);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a valid coupon exists
        if ($result && $result->num_rows > 0) {
            $coupon = $result->fetch_assoc();
            $response = [
                'success' => true,
                'discount' => $coupon['discount']
            ];
        } else {
            // No valid coupon found
            $response['message'] = 'Coupon not found or expired.';
        }

        $stmt->close();
    } else {
        $response['message'] = 'Failed to prepare the SQL statement.';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
?>
