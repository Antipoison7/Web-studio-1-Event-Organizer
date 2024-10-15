<?php
session_start();
include_once('./Resources/Helper/headers.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Resources/Style/checkoutpage.css">
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <title>Checkout</title>
</head>
<body>
    <?php headerNoLogin("Checkout"); ?>

    <main class="checkout-container">
        <!-- Payment Form Section -->
        <div class="payment-section">
            <h2>Payment</h2>

            <!-- Credit/Debit Card Section -->
<div class="payment-method">
    <h3>Credit / Debit Card</h3>

    <div class="card-info-container">
        <div class="card-info">
            <label for="card-number">Card Number *</label>
            <input type="text" id="card-number" placeholder="Enter Card Number" required>
        </div>

        <div class="card-info">
            <label for="card-type">Card Type *</label>
            <select id="card-type" required>
                <option value="">Select Card Type</option>
                <option value="MasterCard">MasterCard</option>
                <option value="Visa">Visa</option>
                <option value="Amex">American Express</option>
            </select>
        </div>
    </div>

    <div class="expiry-container">
        <div class="expiry">
            <label for="exp-month">Exp Month *</label>
            <select id="exp-month" required>
                <?php for ($i = 1; $i <= 12; $i++) {
                    printf('<option value="%02d">%02d</option>', $i, $i);
                } ?>
            </select>
        </div>
        <div class="expiry">
            <label for="exp-year">Exp Year *</label>
            <select id="exp-year" required>
                <?php for ($year = date('Y'); $year <= date('Y') + 11; $year++) {
                    echo "<option value='$year'>$year</option>";
                } ?>
            </select>
        </div>
    </div>

    <label for="security-code">Security Code *</label>
    <input type="password" id="security-code" placeholder="Enter Security Code" required>
</div>


            <!-- Billing Address Section -->
            <div class="billing-address">
                <h3>Billing Address</h3>
                <label for="card-holder-fname">Card Holder First Name *</label>
                <input type="text" id="card-holder-fname" placeholder="Enter First Name" required>

                <label for="card-holder-lname">Card Holder Last Name *</label>
                <input type="text" id="card-holder-lname" placeholder="Enter Last Name" required>

                <label for="address">Address *</label>
                <input type="text" id="address" placeholder="Enter Address" required>

                <div class="address-info">
                    <label for="suburb">Suburb *</label>
                    <input type="text" id="suburb" placeholder="Enter Suburb" required>
                    <label for="state">State *</label>
                    <input type="text" id="state" placeholder="Enter State" required>
                    <label for="postcode">Postcode *</label>
                    <input type="text" id="postcode" placeholder="Enter Postcode" required>
                </div>

                <label for="phone">Mobile Phone *</label>
                <input type="text" id="phone" placeholder="Enter Mobile Phone" required>
            </div>

            <!-- Checkout Button -->
            <button class="checkout-btn">Checkout</button>
        </div>

        <!-- Order Summary Section -->
        <div class="order-summary-section">
            <h3>Order Details</h3>
            <?php
            if (isset($_POST['items']) && isset($_POST['totalAmount'])) {
                $items = $_POST['items'];
                $totalAmount = $_POST['totalAmount'];

                echo "<ul>";
                foreach ($items as $item) {
                    $title = htmlspecialchars($item['title']);
                    $quantity = htmlspecialchars($item['quantity']);
                    $price = htmlspecialchars($item['price']);
                    echo "<li>$title - Quantity: $quantity - Price: $$price</li>";
                }
                echo "</ul>";
                echo "<p><strong>Total: $" . htmlspecialchars($totalAmount) . "</strong></p>";
            } else {
                echo "No items found in the cart.";
            }
            ?>
            <a href="#" class="cancel-order">Cancel Order</a>
        </div>
    </main>

</body>
</html>
