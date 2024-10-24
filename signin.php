<?php
require_once 'config.php';
session_start();
if (isset($_POST['registerbtn'])) {
    $Fname =  $_POST['Fname'];
    $adress =  $_POST['adress'];
    $email = $_POST['signin-email'];
    $password =  $_POST['pass'];
    $Cpass = $_POST['Cpass'];
    $phoneNum =  $_POST['phoneNum'];
    $user_type =  $_POST['user'];
    
    $select = "SELECT * FROM accounts WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $select);

    if (!$result) {
        
        die("ERROR: Could not execute query: " . mysqli_error($conn));
    }
    
    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } 
    else {
        if ($password != $Cpass) {
            $error[] = 'Passwords do not match!';
        } else {
            $insert = $conn->prepare("INSERT INTO accounts (Fname, adress, email, password, phoneNum, user_type) VALUES (?, ?, ?, ?, ?, ?)");
            
            if ($insert === false) {
                die("ERROR: Could not prepare statement: " . $conn->error);
            }
            
            $insert->bind_param("ssssss", $Fname, $adress, $email, $password, $phoneNum, $user_type);
            
            if ($insert->execute()) {
                
                header('Location: signin.php'); 
            } else {
                echo "ERROR: " . $insert->error;
            }
            
            $insert->close();
        }
    }
}
if (isset($_POST['loginbtn'])) {
    
    $email =  $_POST['login-email'];
    $password =  $_POST['login-pass'];

    $emailCheck = "SELECT * FROM accounts WHERE email = '$email'";
    $emailResult = mysqli_query($conn, $emailCheck);

    if (mysqli_num_rows($emailResult) > 0) {
        $row = mysqli_fetch_array($emailResult);

        if ($row['password'] === $password) {

            if ($row['user_type'] == 'seller') {
                $_SESSION['seller_name'] = $row['Fname'];
                header('location:seller.php');
                exit();
            } else if ($row['user_type'] == 'customer') {
                $_SESSION['customer_name'] = $row['Fname']; 
                header('location:customer.php');
                exit();
            } else {
                $errors[] = 'Choose what user type you want!';
            }
        } else {
            $errors[] = 'Wrong password!';
        }
    } else {
        $errors[] = 'No user found!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/signin.css">
</head>
<body>
    <div class="all">
        <div class="container">
            <div class="login">
                <form action="" method="POST">
                    <h1>LOG IN</h1>
                    <?php 
                    if (!empty($errors)) {
                        foreach ($errors as $errs) {
                            echo "<p>$errs</p>";
                        }
                    } 
                    
                    ?>
                    <div class="Login-email">
                        <input type="email" id="login-email" name="login-email" placeholder="Email*" required>
                    </div>
                    <div class="password">
                        <input type="password" id="login-pass" name="login-pass" placeholder="Password*" required>
                    </div>
                    <button id="loginbtn" class="loginbtn" name="loginbtn" type="submit" value="submit">LOGIN</button>
                    <button type="button" class="toggle-link" onclick="toggleForm()">Sign Up</button>
                </form>
                <h2></h2>
            </div>
            <div class="signin">
                <form action="" method="POST">
                <h1>SIGN IN</h1>
                    <?php 
                    if (!empty($error)) {
                        foreach ($error as $err) {
                            echo "<p>$err</p>";
                        }
                    }
                    else{
                        
                    }
                    
                    ?>
                    <input type="text" id="Fname" name="Fname" class="Fname" placeholder="Complete Name*" required>
                
                    <input type="text" id="adress" name="adress" class="adress" placeholder="Adress*" required>
                
                    <input type="email" id="signin-email" name="signin-email" class="signin-email" placeholder="Email*" required>
                
                    <input type="password" id="pass" name="pass"  placeholder="Password*" required>
                
                    <input type="password" id="Cpass" name="Cpass" placeholder="Confirm Password*" required>

                    <input type="tel" id="phoneNum" name="phoneNum" placeholder="Phone Number*" required>

                    <div class="user">
                        <select name="user" id="user">
                            <option value="customer" id="customer" name="customer">Customer</option>
                            
                
                        </select>
                    </div>
                    <div class="btn">
                    <button id="registerbtn" class="registerbtn" name="registerbtn" type="submit" value="submit">Register</button>
                    <button id="resetbtn" class="resetbtn" name="resetbtn" type="reset" value="reset">Reset</button><br>
                    
                    </div>
                    <button type="button" class="toggle-link" onclick="toggleForm()">Log In</button>
                    
                    </form>
            </div>        
        </div>
    </div>
    <script>
        function toggleForm() {
            const signinForm = document.querySelector('.signin');
            signinForm.classList.toggle('show');
        }

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-pass').value;
            let errors = [];

            if (!email) {
                errors.push('Email is required.');
            }
            if (!password) {
                errors.push('Password is required.');
            }

            if (errors.length > 0) {
                event.preventDefault();
                document.getElementById('loginErrors').innerHTML = errors.join('<br>');
            }
        });

        document.getElementById('signinForm').addEventListener('submit', function(event) {
            const name = document.getElementById('Fname').value;
            const address = document.getElementById('adress').value;
            const email = document.getElementById('signin-email').value;
            const password = document.getElementById('pass').value;
            const confirmPassword = document.getElementById('Cpass').value;
            const phoneNum = document.getElementById('phoneNum').value;
            let errors = [];

            if (!name) {
                errors.push('Complete name is required.');
            }
            
            if (!address) {
                errors.push('Address is required.');
            }
            if (!email) {
                errors.push('Email is required.');
            }
            if (!password) {
                errors.push('Password is required.');
            }
            if (!confirmPassword) {
                errors.push('Confirm password is required.');
            }
            if (password && confirmPassword && password !== confirmPassword) {
                errors.push('Passwords do not match.');
            }
            if (!phoneNum) {
                errors.push('Phone number is required.');
            }

            if (errors.length > 0) {
                event.preventDefault();
                document.getElementById('signinErrors').innerHTML = errors.join('<br>');
            }
        });
    </script>
</body>
</html>