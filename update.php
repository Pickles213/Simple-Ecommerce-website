<?php require_once 'db.php'; ?>

<?php 
if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    error_log("ID: $id");

    $query = "SELECT * FROM `product` WHERE `id` = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("No record found.");
    }

    $stmt->close();
} else {
    die("ID not set.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
    <link rel="stylesheet" href="css/update.css">
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" placeholder="Name">
        <input type="text" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" placeholder="Price">
        <input type="text" name="color" value="<?php echo htmlspecialchars($row['color']); ?>" placeholder="Color">
        <input type="file" name="image">
        <button type="submit" name="updatebtn">Update</button>
    </form>


    <?php if (isset($row['image']) && !empty($row['image'])): ?>
        <img src="./pics/<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image">
    <?php endif; ?>
</body>
</html>

<?php 
if (isset($_POST['updatebtn'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    
    $image = $_FILES['image']['name'];
    $temp_prod_img = $_FILES['image']['tmp_name'];

    error_log("Name: $name, Price: $price, Color: $color, Image: $image");

    if (!empty($temp_prod_img)) {
        $target_dir = "./pics/";
        $target_file = $target_dir . basename($image);


        if (move_uploaded_file($temp_prod_img, $target_file)) {
            error_log("File is valid, and was successfully uploaded.\n");
        } else {
            error_log("File upload failed.\n");
            $image = $row['image']; 
        }
    } else {
       
        $image = $row['image'];
    }

    $query = "UPDATE `product` SET `name` = ?, `price` = ?, `color` = ?, `image` = ? WHERE `id` = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sdssi", $name, $price, $color, $image, $id);

    if ($stmt->execute()) {
        header('Location: seller.php');
        exit(); 
    } else {
        die("Query failed: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>


<?php if (isset($row['image']) && !empty($row['image'])): ?>
    <img src="./pics/<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image">
<?php endif; ?>
