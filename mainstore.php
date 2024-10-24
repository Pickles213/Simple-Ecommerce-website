<?php
require_once 'db.php';

$sql = "SELECT id, name, price, color, image FROM product";
$result = $conn->query($sql);

$products = []; 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="css/main.css">
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
                        <a href="customer.php">
                        <h1>LO.GO</h1>
                        </a>
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
            <h1>Product List</h1>
            <div id="product">
                <?php foreach ($products as $product): ?>
                    <div class="product">
                        <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>">
                            <img src="pics/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
                            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                            <p>Price: ₱<?php echo htmlspecialchars($product['price']); ?></p>
                            <p>Color: <?php echo htmlspecialchars($product['color']); ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php require 'footer.php';?>
</body>
</html>
