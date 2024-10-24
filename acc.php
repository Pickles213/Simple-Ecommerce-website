<?php
require_once 'config.php';
session_start();
$name = $_SESSION['customer_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
                        <img src="pics/icon-basket.png" alt="" >
                        </a>
                        <a href="acc.php">
                        <img src="pics/user.png" alt="">
                        </a>
                    </div>
                </nav>
            </div>
    <div class="profile-container">
    <div class="log-out">
            <a href="logout.php">
            <button>Log Out</button>
            </a>
    </div>
        <div class="profile-header">
            <img src="pics/girl2.jpg" alt="Profile Picture" class="profile-pic">
            <div class="profile-info">
                <h1><?php echo $name; ?></h1>
                <p>Member since October 2021</p>
            </div>
        </div>

        <div class="profile-content">
            <h2>Interests</h2>
            <div class="interests-tabs">
                <button class="tab-button active" onclick="showTab('all')">All</button>
                <button class="tab-button" onclick="showTab('sports')">Sports</button>
                <button class="tab-button" onclick="showTab('products')">Products</button>
                <button class="tab-button" onclick="showTab('teams')">Teams</button>
                <button class="tab-button" onclick="showTab('athletes')">Athletes</button>
                <button class="tab-button" onclick="showTab('cities')">Cities</button>
            </div>
            <div class="tab-content" id="all">
                <p>Add your interests to shop a collection of products that are based on what you're into.</p>
            </div>
            <div class="tab-content" id="sports" style="display: none;">
                <p>Sports related content.</p>
            </div>
            <div class="tab-content" id="products" style="display: none;">
                <p>Products related content.</p>
            </div>
            <div class="tab-content" id="teams" style="display: none;">
                <p>Teams related content.</p>
            </div>
            <div class="tab-content" id="athletes" style="display: none;">
                <p>Athletes related content.</p>
            </div>
            <div class="tab-content" id="cities" style="display: none;">
                <p>Cities related content.</p>
            </div>
        </div>
    </div>

    <script src="index.js"></script>
    
    
</body>
</html>