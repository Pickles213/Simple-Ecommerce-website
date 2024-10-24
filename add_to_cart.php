<?php
require_once 'config.php';
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "infostorage";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $productId = intval($_POST['id']);
        
    
        $sql = "SELECT id, name, price, color, image FROM product WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            
         
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            $_SESSION['cart'][$productId] = $product;
            $message = "Product added to cart successfully!";
        } else {
            $message = "Product not found!";
        }
        $stmt->close();
    } else {
        $message = "Invalid product ID!";
    }
}

if (isset($_GET['remove'])) {
    $removeId = intval($_GET['remove']);
    if (isset($_SESSION['cart'][$removeId])) {
        unset($_SESSION['cart'][$removeId]);
        $message = "Product removed from cart successfully!";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/add-cart.css">
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
                        <img src="pics/icon-basket.png" alt="" >
                        </a>
                        <a href="acc.php">
                        <img src="pics/user.png" alt="">
                        </a>
                    </div>
                </nav>
            </div>
    <div class="container-all">
    <h1 class="text">Cart</h1>
    <?php if (isset($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <div id="cart" class="container">
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $product): ?>
                <div class="product">
                    <img src="pics/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p>Price: ₱<?php echo htmlspecialchars($product['price']); ?></p>
                    <p>Color: <?php echo htmlspecialchars($product['color']); ?></p>
                    <a href="add_to_cart.php?remove=<?php echo htmlspecialchars($product['id']); ?>"><button class="removebtn">Remove</button></a>
                </div>
            <?php endforeach; ?>
            <form action="place_order.php" method="post">
                <button type="submit">Place Order</button>
            </form>
        <?php else: ?>
            <p>Your cart is empty!</p>
        <?php endif; ?>
    </div>
    <a href="mainstore.php" class="prod-list">Back to Product List</a>
    </div>
</body>
</html>
