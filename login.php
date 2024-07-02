<?php
    session_start();

    // 连接到数据库
    $connect = mysqli_connect("localhost", "root", "", "moonbeedb");

    // 处理登录表单提交
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = mysqli_real_escape_string($connect, $_POST['username']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);
        $remember = isset($_POST['remember']); // 是否选择了Remember Me

        // 查询数据库检查email和password
        $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            // 登录成功，设置会话
            $_SESSION['username'] = $email;

            // 如果选择了Remember Me，设置Cookie
            if ($remember) {
                $cookie_name = 'user_cookie';
                $cookie_value = $email;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 30天有效期的Cookie
            }

            // 重定向到其他页面，例如主页
            header('Location: menu.php'); // 替换成你的主页地址
            exit;
        } else {
            // 登录失败，可以添加错误提示
            echo '<script>alert("Invalid email or password")</script>';
        }
    }

    // 检查是否存在持久性Cookie，如果存在且没有会话则自动登录
    if (!isset($_SESSION['username']) && isset($_COOKIE['user_cookie'])) {
        $_SESSION['username'] = $_COOKIE['user_cookie'];
    }

    mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonBees | Login</title>
    <link rel="icon" type="image/png" href="image/burger-removebg-preview.png">
    <link rel="stylesheet" href="head_footer.css">
    <link rel="stylesheet" href="login.css">
    <script src="login.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
    <ul class="head">
        <li class="topleft"><a href="#home" class="head_title">MoonBees</a></li>
        <div class="all_topcenter">
            <!-- <li class="topcenter"><a href="menu.html" class="head_title">Menu</a></li> -->
            <!-- <li class="topcenter"><a href="#Contact Us" class="head_title">Contact Us</a></li>
            <li class="topcenter"><a href="#About Us" class="head_title">About Us</a></li> -->
        </div>
        <div class="all_topright">
            <li class="help"><i class="ri-question-line" style="color: white; display: block; margin-top: 20px; padding-right: 15px;"> Help</i></li>
            <?php if (!isset($_SESSION['username'])) : ?>
                <li class="user"><a href="login.php" style="font-size: 15px; text-decoration: none;"><i class="ri-user-5-line" style="color: white; display: block; margin-top: 20px;"> Login</a></i></li>
            <?php else : ?>
                <li class="user"><a href="login.php" style="font-size: 15px; text-decoration: none;"><i class="ri-user-5-line" style="color: white; display: block; margin-top: 20px;"> Logout</a></i></li>
            <?php endif; ?>
        </div>
    </ul>
        
    <main class="abc">
        <div class="video_container">
            <video autoplay muted loop src="video/11805691-hd_2048_1024_24fps.mp4" id="background_video"></video>
        </div>
        <div class="form_container">
            <form method="post" action="login.php">
                <div class="container">
                    <h1>Login</h1>
                    <input type="text" placeholder="Enter Email" name="username" required>
                    <div class="kuang">
                        <input type="password" id="password" placeholder="Enter Password" name="password" required>
                        <div class="concel" id="concel"></div>
                    </div>
                    <button type="submit">Login</button>
                    <input type="checkbox" name="remember">Remember Me
                    <a href="#" class="forgetpass">Forget password</a>
                    <hr>
                    <p>New to our shop? <a href="register.php">Sign Up</a></p>
                </div>
            </form>
        </div>
    </main>

    <br><br>
    <hr style="border: 1px solid rgb(255, 255, 255); margin: 0 300px;">

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
