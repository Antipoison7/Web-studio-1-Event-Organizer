<?php
  include_once('./Resources/Helper/headers.php');

  $cartItems = [
    ['title' => 'Soccer Game 7v7', 'price' => 0, 'img' => './Resources/Images/soccer.jpg', 'date' => '26/11/2024'],
    ['title' => 'Tennis Tournament', 'price' => 20, 'img' => './Resources/Images/tennis.jpg', 'date' => '20/12 - 22/12']
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="./Resources/Style/shoppingcart.css">
    <link rel="stylesheet" href="./Resources/Style/base.css">
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
        <div class="cart-item">
            <img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>">
            <div class="item-details">
                <h3><?= $item['title'] ?></h3>
                <p><?= $item['date'] ?></p>
                <span>$<?= $item['price'] ?></span>
                <div class="quantity">
                    <label for="quantity<?= $index ?>">Quantity</label>
                    <select id="quantity<?= $index ?>" class="quantity-dropdown" onchange="updateTotal(<?= $index ?>, <?= $item['price'] ?>)">
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
            <form action="checkout.php" method="POST">
            <!-- Add hidden inputs for each item and its quantity -->
        <?php foreach ($cartItems as $index => $item): ?>
            <input type="hidden" name="items[<?= $index ?>][title]" value="<?= $item['title'] ?>">
            <input type="hidden" name="items[<?= $index ?>][quantity]" id="hidden-quantity<?= $index ?>" value="1">
            <input type="hidden" name="items[<?= $index ?>][price]" value="<?= $item['price'] ?>">
        <?php endforeach; ?>

            <!-- Add a hidden input for the total amount -->
            <input type="hidden" name="totalAmount" id="hidden-total" value="<?= $total ?>">

            <button type="submit" class="btn checkout">Checkout</button>
            </form>
        </div>


    </div>

    
    <?php makeFooter(); ?>
    
 <!-- JavaScript for Quantity and Total Update -->
 <script>
        function updateTotal(index, price) {
            var quantity = document.getElementById('quantity' + index).value;
            var itemTotal = quantity * price;
            document.getElementById('item-total' + index).textContent = '$' + itemTotal;

            // Update the cart total
            var cartTotal = 0;
            var items = document.querySelectorAll('.item-total');
            items.forEach(function(item) {
                cartTotal += parseFloat(item.textContent.replace('$', ''));
            });
            document.getElementById('cart-total').textContent = '$' + cartTotal;

            document.getElementById('hidden-total').value = cartTotal;

            document.getElementById('hidden-quantity' + index).value = quantity;
}

        }

        function removeItem(index) {
            document.querySelectorAll('.cart-item')[index].remove();
            updateTotal(0, 0); // Recalculate total after item removal
        }
    </script>
</body>
</html>

