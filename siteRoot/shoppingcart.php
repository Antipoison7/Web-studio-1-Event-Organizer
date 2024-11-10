<?php
session_start();
include_once('./Resources/Helper/headers.php');

if (!isset($_SESSION['cartItems'])) {
    $_SESSION['cartItems'] = [];
}

// If an item was added via the discussion forum
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['id'], $input['title'], $input['price'], $input['date'])) {
        $_SESSION['cartItems'][] = [
            'title' => $input['title'],
            'price' => $input['price'],
            'img' => './Resources/Images/default.jpg', // Default image, or you can modify this to pass a specific image
            'date' => $input['date']
        ];
        echo json_encode(['success' => true]);
        exit;
    }
}

// Fetch cart items from session
$cartItems = $_SESSION['cartItems'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="./Resources/Style/shoppingcart.css">
    <link rel="stylesheet" href="./Resources/Style/base.css">
    <link rel="icon" type="image/x-icon" href="./Resources/Images/Resources/favicon.png">
</head>
<body>

    <?php headerNoLogin("Shopping Cart") ?>

    <!-- Shopping Cart Section -->
    <div class="cart-container">
        <?php
        $total = 0;
        foreach ($cartItems as $index => $item) {
            $quantity = 1; // Default quantity
            $itemTotal = $item['price'] * $quantity;
            $total += $itemTotal;
        ?>
        <div class="cart-item" id="cart-item<?= $index ?>">
            <img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>">
            <div class="item-details">
                <h3><?= $item['title'] ?></h3>
                <p><?= $item['date'] ?></p>
                <span>$<?= $item['price'] ?></span>
                <div class="quantity">
                    <label for="quantity<?= $index ?>">Quantity</label>
                    <select id="quantity<?= $index ?>" class="quantity-dropdown" onchange="updateItemTotal(<?= $index ?>, <?= $item['price'] ?>)">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
                </div>
            </div>
            <span class="item-total" id="item-total<?= $index ?>">$<?= $itemTotal ?></span>
            <button class="remove-btn" onclick="removeItem(<?= $index ?>)">&#128465;</button>
        </div>
        <?php } ?>

        <div class="cart-summary">
            <h2>Total: <span id="cart-total">$<?= $total ?></span></h2>

            <!-- Add a form to send the total, items, and quantities -->
            <form action="checkout.php" method="POST" id="cart-form">
                <!-- Add hidden inputs for each item and its quantity -->
                <?php foreach ($cartItems as $index => $item): ?>
                    <div id="hidden-inputs<?= $index ?>">
                        <input type="hidden" name="items[<?= $index ?>][title]" value="<?= $item['title'] ?>">
                        <input type="hidden" name="items[<?= $index ?>][quantity]" id="hidden-quantity<?= $index ?>" value="1">
                        <input type="hidden" name="items[<?= $index ?>][price]" value="<?= $item['price'] ?>">
                    </div>
                <?php endforeach; ?>

                <!-- Add a hidden input for the total amount -->
                <input type="hidden" name="totalAmount" id="hidden-total" value="<?= $total ?>">

                <button type="submit" class="btn checkout">Continue</button>
            </form>
        </div>
    </div>

    <?php makeFooter(); ?>

    <!-- JavaScript for Quantity and Total Update -->
    <script>
        function updateItemTotal(index, price) {
            var quantity = document.getElementById('quantity' + index).value;
            var itemTotal = quantity * price;
            document.getElementById('item-total' + index).textContent = '$' + itemTotal;
            document.getElementById('hidden-quantity' + index).value = quantity;
            updateCartTotal();
        }

        function updateCartTotal() {
            var cartTotal = 0;
            var itemTotals = document.querySelectorAll('.item-total');
            itemTotals.forEach(function(item) {
                cartTotal += parseFloat(item.textContent.replace('$', ''));
            });
            document.getElementById('cart-total').textContent = '$' + cartTotal;
            document.getElementById('hidden-total').value = cartTotal;
        }

        function removeItem(index) {
            var cartItem = document.getElementById('cart-item' + index);
            if (cartItem) {
                cartItem.remove();
            }
            var hiddenInputs = document.getElementById('hidden-inputs' + index);
            if (hiddenInputs) {
                hiddenInputs.remove();
            }
            updateCartTotal();
        }

        document.getElementById('cart-form').onsubmit = function() {
            var formData = new FormData(this);
            console.log("Form submission data:", formData);
            for (var pair of formData.entries()) {
                console.log(pair[0]+ ': ' + pair[1]);
            }
        }
    </script>
</body>
</html>
