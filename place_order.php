<?php
session_start();

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    
    $_SESSION['cart'] = [];
    $message = "Order placed successfully!";
} else {
    $message = "Your cart is empty!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="css/acc.css">
</head>
<body>
    <div class="container-seller1">
        <div class="top-seller">
            <h4>GET READY FOR BIG SALE THIS 7.7</h4>
        </div>
        <div class="top-container-seller">
            <div class="navbar-seller">
                <nav>
                    <div class="logo">
                        <h1>LO.GO</h1>
                    </div>
                    <ul>
                        <li><a href="customer.php">HOME</a></li>
                        <li><a href="mainstore.php">SHOP</a></li>
                    </ul>
                    <div class="cart">
                        <a href="add_to_cart.php">
                        <img src="pics/icon-basket.png" alt="">
                        </a>
                        <a href="acc.php">
                        <img src="pics/user.png" alt="">
                        </a>
                    </div>
                </nav>
            </div>
            <div class="all">
            <div class="place_order_container">
                <div class="place_order">
                    <h1>Order Confirmation</h1>
                    <p class="message"><?php echo htmlspecialchars($message); ?></p>
                    <a href="mainstore.php"> <button class="backbtn">Back to shop</button></a>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
