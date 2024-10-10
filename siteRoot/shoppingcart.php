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
                    </select>
                </div>
            </div>
            <span class="item-total" id="item-total<?= $index ?>">$<?= $itemTotal ?></span>
            <button class="remove-btn" onclick="removeItem(<?= $index ?>)">&#128465;</button>
        </div>
        <?php } ?>

        <div class="cart-summary">
            <h2>Total: <span id="cart-total">$<?= $total ?></span></h2>
            <button class="checkout-btn">Checkout</button>
        </div>
    </div>

    <!-- Footer -->
    <?php makeFooter(); ?>


