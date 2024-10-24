<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Management</title>
    <link rel="stylesheet" href="seller.css">
</head>
<body>

<div class="container1">
    <h2>Admin</h2>
    <a href="add.php" class="button" role="button">Add</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Color</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once 'db.php';

                $sql  = "SELECT * FROM product";
                $result = $conn -> query($sql);

                if(!$result){
                    die("Invalid query: " . $conn -> error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['color']}</td>
                        <td><img src='pics/{$row['image']}' alt='Product Image' ></td>
                        <td>
                            <a href='update.php?id={$row['id']}' class='editbtn'>Edit</a>
                            <a href='delete.php?id={$row['id']}' class='deletebtn'>Delete</a>
                        </td>
                    </tr>";
                }
                
                $conn->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
