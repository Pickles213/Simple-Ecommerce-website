<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.footer {
    background: #333;
    color: #fff;
    padding: 20px 0;
    bottom: 0;
    width: 100%;
    height:14rem;
    display:flex;
    flex-direction:column;
    justify-content:space-around;
}

.footer-content {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    width: 90%;
    margin: 0 auto;
    padding: 20px;
}

.footer-section {
    flex: 1;
    margin: 10px;
}

.footer-section h2 {
    margin-bottom: 10px;
}

.footer-section p,
.footer-section ul,
.footer-section li,
.footer-section a {
    color: #bbb;
    font-size: 14px;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 10px;
}

.footer-section ul li a {
    text-decoration: none;
    color: #bbb;
}

.footer-section ul li a:hover {
    color: #fff;
}

.footer-bottom {
    background: #222;
    color: #bbb;
    text-align: center;
    padding: 10px;
    font-size: 14px;
    height:40px;
}

    </style>
</head>
<body>
    <!-- Main content of the page -->
    
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section about">
                <h2>About Us</h2>
                <p>We are a company dedicated to providing the<br> best services to our customers.</p>
            </div>
            <div class="footer-section links">
                <h2>Members</h2>
                <ul>
                    <li>John Michael Serdon</li>
                    <li>Jann Dale Andes</li>
                    <li>Brent Timothy Cruspe</li>
                    
                </ul>
            </div>
            <div class="footer-section contact">
                <h2>Contact Us</h2>
                <p>Email: Johnmicahel.serdon@cvsu.edu.ph</p>
                <p>Email: janndale.andes@cvsu.edu.ph</p>
                <p>Email: brenttimothy.cruspe@cvsu.edu.ph</p>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2024 ITEC50 | FINALS
        </div>
    </footer>
</body>
</html>
