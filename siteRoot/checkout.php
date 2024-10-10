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
    if (isset($_POST['totalAmount'])) {
    $totalAmount = $_POST['totalAmount'];
    echo "Total Amount: $" . htmlspecialchars($totalAmount);
        } else {
    echo "No total amount found!";
    }
?>


    </main>


</body>
</html>

