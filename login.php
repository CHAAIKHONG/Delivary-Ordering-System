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
            <li class="user"><a href="login.html" style="font-size: 15px; text-decoration: none;"><i class="ri-user-5-line" style="color: white; display: block; margin-top: 20px;"> Login</a></i></li>
        </div>
    </ul>
        
    <main class="abc" >
        <div class="video_container">
            <video autoplay muted loop id="background_video">
                <source src="/video/11805691-hd_2048_1024_24fps.mp4" type="/video/mp4">
            </video>
        </div>
        <div class="form_container">
            <form>
                <div class="container">
                    <h1>Login</h1>
                    <!-- <label>Username</label> -->
                    <input type="text" placeholder="Enter Username" name="username" required>
                    <!-- <label>Password</label> -->
                    <div class="kuang">
                        <input type="password" id="password" placeholder="Enter Password" name="password" required>
                        <div class="concel" id="concel"></div>
                    </div>
                    <button type="submit">Login</button>
                    <input type="checkbox">Remember Me
                    <a href="#" class="forgetpass">Forget password</a>
                    <hr>
                    <p>New to our shop? <a href="register.html">Sign Up</a></p>
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