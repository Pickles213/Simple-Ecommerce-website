<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "infostorage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all products
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Store</title>
    <link rel="stylesheet" href="css/style1.css">
</head>
<body>
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
                        <li><a href="home.php">HOME</a></l>
                        <li><a href="store.php">SHOP</a></li>
                    </ul>
                    <div class="cart">
                        <a href="signin.php">
                        <img src="pics/icon-basket.png" alt="" >
                        </a>
                        <a href="signin.php">
                        <button class="sign-in">Sign In</button>
                        </a>
                    </div>
                </nav>
            </div>
    <h1>Product Store</h1>
    <div class="store-container">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="store-product">
            <a href="signin.php">
            <img src="pics/<?php echo $row['image']; ?>" alt="Product Image">
            <h2><?php echo $row['name']; ?></h2>
            <p>Price: ₱<?php echo $row['price']; ?></p>
            <p>Color: <?php echo $row['color']; ?></p>
            </a>
        </div>
        <?php endwhile; ?>
    </div>
    <?php require 'footer.php';?>
</body>
</html>

<?php
$conn->close();
?>
