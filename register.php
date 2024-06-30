<?php
    $connect = mysqli_connect("localhost", "root", "", "moonbeedb");

    // Check connection
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // 处理注册表单提交
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $first_name = mysqli_real_escape_string($connect, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connect, $_POST['last_name']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $phone_num = mysqli_real_escape_string($connect, $_POST['phone_num']);
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $password = mysqli_real_escape_string($connect, $_POST['pass']);

        // 可以添加更多字段，根据你的数据库表格设计

        // 插入用户数据到数据库
        $sql = "INSERT INTO user (username, password, first_name, last_name, address, phone_number, email)
            VALUES ('$username', '$password', '$first_name', '$last_name', '', '$phone_num', '$email')";

        if (mysqli_query($connect, $sql)) {
            echo "New record created successfully";
            // 可以重定向到登录页面或其他操作
            // header("Location: login.php"); // 例如重定向到登录页面
            // exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
    }

    mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonBees | Register</title>
    <link rel="icon" type="image/png" href="image/burger-removebg-preview.png">
    <link rel="stylesheet" href="head_footer.css">
    <link rel="stylesheet" href="register.css">
    <script src="register.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
    <ul class="head">
        <li class="topleft"><a href="#home" class="head_title">MoonBees</a></li>
        <div class="all_topcenter">
            <!-- <li class="topcenter"><a href="menu.html" class="head_title">Menu</a></li> -->
            <!-- <li class="topcenter"><a href="#Contact Us" class="head_title">Contact Us</a></li> -->
            <!-- <li class="topcenter"><a href="#About Us" class="head_title">About Us</a></li> -->
        </div>
        <div class="all_topright">
            <li class="help"><i class="ri-question-line" style="color: white; display: block; margin-top: 20px; padding-right: 15px;"> Help</i></li>
            <li class="user"><a href="login.php" style="font-size: 15px; text-decoration: none;"><i class="ri-user-5-line" style="color: white; display: block; margin-top: 20px;"> Login</a></i></li>
        </div>
    </ul>
    <div class="background_creatacc">
        <div class="createacc">
            <h1 class="title_frm">Join Our Member</h1>
            <div class="frm">
                <form method="post" action="register.php">
                    <h3>Register</h3>
                    <div class="container">
                        <div class="all_name"> 
                            <input type="text" placeholder="First Name" name="first_name" required>
                            <input type="text" placeholder="Last Name" name="last_name" required>
                        </div>
                        <input type="text" placeholder="Username" name="username" required>
                        <input type="email" placeholder="Email" name="email" required>
                        <input type="number" placeholder="Phone number" name="phone_num" required>
                        <div class="kuang">
                            <input type="password" placeholder="Password" name="pass" required>
                            <div class="concel" id="concel"></div>
                        </div>
                        <div class="confirm_kuang">
                            <input type="password" placeholder="Confirm Password" name="confirm_pass" required>
                            <div class="confirm_concel" id="confirm_concel"></div>
                        </div>
                        <input type="date" name="date" required>
                    </div>
                    <button type="submit">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
    
    <br><br>
    <hr style="margin: 0px 300px; border: 1px solid black;">

    <footer class="footer">
        <div id="footer-section">
            <ul>
                <li><h2><a href="">Track My Order</a></h2></li>
            </ul>
        </div>
        <div id="footer-section">
            <h2>Service</h2>
            <ul>
                <li><a href="#">Gift Vouchers</a></li>
                <li><a href="#">Party</a></li>
                <li><a href="#">Delivery</a></li>
            </ul>
        </div>
        <div id="footer-section">
            <h2>FOLLOW US</h2>
            <ul>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Instagram</a></li>
                <li><a href="#">Tiktokv</a></li>
            </ul>
        </div>
        <div id="footer-section">
            <h2>Help & Support</h2>
            <ul>
                <li><a href="ContactUs.html">Share Your Feedback</a></li>
                <li><a href="#">Terms & Conditions</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>