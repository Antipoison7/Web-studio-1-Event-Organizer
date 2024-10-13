<?php
session_start();
include_once('./Resources/Helper/headers.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
    <title>Checkout</title>

</head>
<body>
    <?php headerNoLogin("Checkout"); ?>
    
    <main>
    <?php
    if (isset($_POST['items']) && isset($_POST['totalAmount'])) {
    $items = $_POST['items'];
    $totalAmount = $_POST['totalAmount'];

    echo "<h2>Order Summary</h2>";
    echo "<ul>";
    foreach ($items as $item) {
        $title = htmlspecialchars($item['title']);
        $quantity = htmlspecialchars($item['quantity']);
        $price = htmlspecialchars($item['price']);
        echo "<li>$title - Quantity: $quantity - Price: $$price</li>";
    }
    echo "</ul>";
    echo "<p>Total Amount: $" . htmlspecialchars($totalAmount) . "</p>";
    } else {
    echo "No items found in the cart.";
}
?>



    </main>


</body>
</html>