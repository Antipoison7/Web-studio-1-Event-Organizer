<?php
session_start();
$orderNumber = strtoupper(uniqid('ORD')); // Generate unique order number

// Retrieve submitted data
$items = json_decode($_POST['items'], true);
$totalAmount = $_POST['discountedTotal'] ?? $_POST['totalAmount'];
$cardType = htmlspecialchars($_POST['cardType']);
$address = htmlspecialchars($_POST['address']);
$suburb = htmlspecialchars($_POST['suburb']);
$state = htmlspecialchars($_POST['state']);
$postcode = htmlspecialchars($_POST['postcode']);
$fname = htmlspecialchars($_POST['fname']);
$lname = htmlspecialchars($_POST['lname']);
$phone = htmlspecialchars($_POST['phone']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="stylesheet" href="./Resources/Style/order_confirmation.css">
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
