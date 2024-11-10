<?php
session_start();
require_once 'db_connection.php'; // Ensure you have a file for your DB connection

$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$orderNumber = strtoupper(uniqid('ORD')); // Generate unique order number

// Retrieve submitted data
$items = json_decode($_POST['items'], true);
$totalAmount = ($_POST['totalAmount'] ?? $_POST['totalAmount']);
$cardType = htmlspecialchars($_POST['cardType']);
$address = htmlspecialchars($_POST['address']);
$suburb = htmlspecialchars($_POST['suburb']);
$state = htmlspecialchars($_POST['state']);
$postcode = htmlspecialchars($_POST['postcode']);
$fname = htmlspecialchars($_POST['fname']);
$lname = htmlspecialchars($_POST['lname']);
$phone = htmlspecialchars($_POST['phone']);

// Insert data into orders table
$stmt = $pdo->prepare("INSERT INTO orders (order_number, first_name, last_name, address, suburb, state, postcode, phone, total_amount) 
                        VALUES (:orderNumber, :fname, :lname, :address, :suburb, :state, :postcode, :phone, :totalAmount)");
$stmt->execute([
    ':orderNumber' => $orderNumber,
    ':fname' => $fname,
    ':lname' => $lname,
    ':address' => $address,
    ':suburb' => $suburb,
    ':state' => $state,
    ':postcode' => $postcode,
    ':phone' => $phone,
    ':totalAmount' => $totalAmount
]);

// Get the order ID of the newly inserted order
$orderId = $pdo->lastInsertId();

// Insert items into order_items table
foreach ($items as $item) {
    $title = htmlspecialchars($item['title']);
    $quantity = htmlspecialchars($item['quantity']);
    $price = htmlspecialchars($item['price']);

    $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_title, quantity, price) 
                            VALUES (:orderId, :title, :quantity, :price)");
    $stmt->execute([
        ':orderId' => $orderId,
        ':title' => $title,
        ':quantity' => $quantity,
        ':price' => $price
    ]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="stylesheet" href="./Resources/Style/order_confirmation.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
    <title>Order Confirmation</title>
</head>
<body>
    <main class="confirmation-container">
        <h1>Order Confirmation</h1>

        <div class="order-details">
            <h3>Thank you for your order, <?php echo $fname . ' ' . $lname; ?>!</h3>
            <p>Your order number is <strong><?php echo $orderNumber; ?></strong>.</p>
        </div>

        <div class="products-ordered">
            <h3>Products Ordered</h3>
            <ul>
                <?php foreach ($items as $item) {
                    $title = htmlspecialchars($item['title']);
                    $quantity = htmlspecialchars($item['quantity']);
                    $price = htmlspecialchars($item['price']);
                    echo "<li>$title - Quantity: $quantity - Price: $$price</li>";
                } ?>
            </ul>
            <p><strong>Total: $<?php echo htmlspecialchars($totalAmount); ?></strong></p>
        </div>

        <div class="customer-details">
            <h3>Customer Details</h3>
            <p><strong>Address:</strong> <?php echo "$address, $suburb, $state, $postcode"; ?></p>
            <p><strong>Phone:</strong> <?php echo $phone; ?></p>
        </div>

        <div class="payment-details">
            <h3>Payment Method</h3>
            <p><strong>Card Type:</strong> <?php echo $cardType; ?></p>
        </div>

        <!-- Back to Home Button -->
        <div class="confirmation-actions">
            <a href="index.php" class="back-to-home">Back to Home</a>
        </div>
    </main>
</body>
</html>
