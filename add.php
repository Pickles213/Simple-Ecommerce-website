<?php
include('db.php');
session_start();

$name = $price = $color = "";
$errors = [
    'name' => '',
    'price' => '',
    'color' => '',
    'image' => ''
];

if(isset($_POST['submit'])) {
    $price = $_POST['price'];
    $name = $_POST['name'];
    $color = $_POST['color'];
    
    $image = $_FILES['image']['name'];
    $temp_prod_img = $_FILES['image']['tmp_name'];

  
    move_uploaded_file($temp_prod_img, "./uploads/$image");

   
    $sql = "INSERT INTO product (price, name, color, image) VALUES ('$price', '$name', '$color', '$image')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Item added successfully')</script>";
        echo "<script>window.location.href = 'seller.php'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Product</title>
    <link rel="stylesheet" href="css/add.css">
</head>
<body>
    <h1>Add New Product</h1>
    <?php
    if (isset($success)) {
        echo "<p>$success</p>";
    } elseif (isset($error)) {
        echo "<p>Error: $error</p>";
    }
    ?>
    <form action="add.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="price">Price:</label>
        <input type="number" step="0.01" id="price" name="price" required><br><br>
        
        <label for="color">Color:</label>
        <input type="text" id="color" name="color" required><br><br>
        
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required><br><br>
        
        <input type="submit" name="submit" value="Add Product">
    </form>
</body>
</html>
