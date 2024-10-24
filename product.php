<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "infostorage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT id, name, price, color, image FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    }
    $stmt->close();
}

$conn->close();

if (!$product) {
    echo "Product not found!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <style>
        /* Reset default margin and padding */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .view {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 23rem;
            width: 100%;
            text-align: center;
            
        }

        .product img {
            width: 20rem;
            height: 20rem;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        h2 {
            margin-bottom: 10px;
            color: #333;
        }
        p {
            margin: 5px 0;
            color: #666;
        }
        form {
            margin-top: 20px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            color: #fff;
            background-color: #333;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        a:hover {
            color: #555;
        }
    </style>
</head>
<body>
    <div class="view">
        <div class="product">
            <img src="pics/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <p>Price: ₱<?php echo htmlspecialchars($product['price']); ?></p>
            <p>Color: <?php echo htmlspecialchars($product['color']); ?></p>
            <form action="add_to_cart.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                <input type="submit" value="Add to Cart">
            </form>
        </div>
        <a href="index.php">Back to Product List</a>
    </div>
</body>
</html>
