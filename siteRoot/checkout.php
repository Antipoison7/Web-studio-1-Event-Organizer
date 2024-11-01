<?php
session_start();
include_once('./Resources/Helper/headers.php');

$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_UGRD_1479_G4";
$password = "GYS3sfUkzIqA";
$dbname = "COSC3046_2402_UGRD_1479_G4";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Resources/Style/checkoutpage.css">
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
            <!-- Credit/Debit Card Section -->
            <div class="payment-method">
                <h3>Credit / Debit Card</h3>
                <div class="card-info-container">
                    <div class="card-info">
                        <label for="card-number">Card Number *</label>
                        <input type="text" id="card-number" placeholder="Enter Card Number" maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)" required>
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
                <input type="password" id="security-code" placeholder="Enter Security Code" maxlength="3" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3)" required>
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
                    <select id="state" required>
                        <option value="">Select State</option>
                        <option value="ACT">ACT</option>
                        <option value="NSW">NSW</option>
                        <option value="NT">NT</option>
                        <option value="QLD">QLD</option>
                        <option value="SA">SA</option>
                        <option value="VIC">VIC</option>
                        <option value="WA">WA</option>
                    </select>
                    <label for="postcode">Postcode *</label>
                    <input type="text" id="postcode" placeholder="Enter Postcode" required>
                </div>

                <label for="phone">Mobile Phone *</label>
                <input type="text" id="phone" placeholder="Enter Mobile Phone" required>
            </div>
            
            <!-- Checkout Button -->
            <form action="order_confirmation.php" method="POST" id="checkout-form">
                <input type="hidden" name="items" value='<?php echo json_encode($items); ?>'>
                <input type="hidden" name="totalAmount" value="<?php echo htmlspecialchars($totalAmount); ?>">
                <input type="hidden" name="discountedTotal" value="">
                <input type="hidden" name="cardType" id="hidden-card-type" value="">
                <input type="hidden" name="address" value="">
                <input type="hidden" name="suburb" value="">
                <input type="hidden" name="state" value="">
                <input type="hidden" name="postcode" value="">
                <input type="hidden" name="fname" value="">
                <input type="hidden" name="lname" value="">
                <input type="hidden" name="phone" value="">

                <button type="submit" class="checkout-btn">Checkout</button>
            </form>
        </div>

        <!-- Order Summary Section -->
        <div class="order-summary-section">
            <h3>Order Details</h3>
            <?php
            if (isset($_POST['items']) && isset($_POST['totalAmount'])) {
                $items = $_POST['items'];
                $totalAmount = $_POST['totalAmount'];
                
                // Check if the discount was applied
                if (isset($_POST['discountedTotal'])) {
                    $totalAmount = $_POST['discountedTotal'];
                }
                
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
        
            <!-- Coupon Code Section -->
            <div class="coupon-section">
                <h3>Coupon Code</h3>
                <label for="coupon-code">Enter Coupon Code</label>
                <input type="text" id="coupon-code" placeholder="Enter Coupon Code">
                <button class="apply-coupon-btn">Apply Coupon</button>
            </div>
        </div>
    </main>
    
    <script>
    document.querySelector('.apply-coupon-btn').addEventListener('click', function() {
        const couponCode = document.getElementById('coupon-code').value;

        fetch('apply_coupon.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ couponCode })
        })
        .then(response => response.json())
        .then(data => {
            const totalElement = document.querySelector('.order-summary-section p strong');
            let totalAmount = parseFloat(totalElement.textContent.replace('$', ''));

            if (data.success) {
                const discount = totalAmount * (data.discount / 100);
                const discountedTotal = (totalAmount - discount).toFixed(2);

                totalElement.textContent = `$${discountedTotal}`;
                document.querySelector('input[name="discountedTotal"]').value = discountedTotal;
                
                alert(`Coupon applied! ${data.discount}% discount has been applied.`);
            } else {
                alert('Invalid or expired coupon code.');
            }
        })
        .catch(error => console.error('Error:', error));
    });

    // Fill in form data on checkout click
    document.querySelector('.checkout-btn').addEventListener('click', function(e) {
        document.getElementById('hidden-card-type').value = document.getElementById('card-type').value;
        document.querySelector('input[name="address"]').value = document.getElementById('address').value;
        document.querySelector('input[name="suburb"]').value = document.getElementById('suburb').value;
        document.querySelector('input[name="state"]').value = document.getElementById('state').value;
        document.querySelector('input[name="postcode"]').value = document.getElementById('postcode').value;
        document.querySelector('input[name="fname"]').value = document.getElementById('card-holder-fname').value;
        document.querySelector('input[name="lname"]').value = document.getElementById('card-holder-lname').value;
        document.querySelector('input[name="phone"]').value = document.getElementById('phone').value;
    });
    </script>
</body>
</html>
