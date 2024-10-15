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
    
    <main class="checkout-container">
        <!-- Payment Form Section -->
        <div class="payment-section">
            <h2>Payment</h2>

            <!-- Add Coupon Section -->
            <div class="coupon-section">
                <h3>Add Promo Codes / Gift Cards</h3>
                <form method="POST" action="apply_coupon.php">
                    <input type="text" name="coupon_code" placeholder="Enter Coupon Code">
                    <button type="submit">Apply Coupon</button>
                </form>
            </div>

            <!-- Credit/Debit Card Section -->
            <div class="payment-method">
                <h3>Credit / Debit Card</h3>
                <label for="card-number">Card Number *</label>
                <input type="text" id="card-number" placeholder="Enter Card Number" required>

                <label for="card-type">Card Type *</label>
                <select id="exp-month" required>
                    <option value=""></option>
                    <option value="01">MasterCard</option>
                    <option value="02">Visa</option>
                    <option value="03">American Express</option>
                </select>

                <label for="exp-month">Exp Month *</label>
                <select id="exp-month" required>
                    <option value=""></option>
                    <option value="01">1</option>
                    <option value="02">2</option>
                    <option value="03">3</option>
                    <option value="04">4</option>
                    <option value="05">5</option>
                    <option value="06">6</option>
                    <option value="07">7</option>
                    <option value="08">8</option>
                    <option value="09">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>

                <label for="exp-year">Exp Year *</label>
                <select id="exp-month" required>
                    <option value=""></option>
                    <option value="01">2024</option>
                    <option value="02">2025</option>
                    <option value="03">2026</option>
                    <option value="04">2027</option>
                    <option value="05">2028</option>
                    <option value="06">2029</option>
                    <option value="07">2030</option>
                    <option value="08">2031</option>
                    <option value="09">2032</option>
                    <option value="10">2033</option>
                    <option value="11">2034</option>
                </select>

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

                <label for="suburb">Suburb *</label>
                <input type="text" id="suburb" placeholder="Enter Suburb" required>

                <label for="state">State *</label>
                <input type="text" id="state" placeholder="Enter State" required>

                <label for="postcode">Postcode *</label>
                <input type="text" id="postcode" placeholder="Enter Postcode" required>

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
            <a href="#" style="color: #007bff; text-decoration: underline;">Cancel Order</a>
        </div>
    </main>
</body>
</html>
