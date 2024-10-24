<?php 
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM `product` WHERE `id` = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: seller.php');
    } else {
        die("Query failed: " . $stmt->error);
    }

    $stmt->close();
} else {
    die("ID not set.");
}

$conn->close();
?>
