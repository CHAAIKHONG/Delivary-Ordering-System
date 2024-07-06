<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "moonbeedb");

    // 检查数据库连接
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // 检查用户登录状态和获取用户信息
    $userPhoto = null;
    $userName = 'user';

    $user_id = $_SESSION['user_id'];

    if (isset($_SESSION['photo'])) {
        $userPhoto = $_SESSION['photo'];
    }

    if (isset($_SESSION['fullname'])) {
        $userName = $_SESSION['fullname'];
    }

    if (isset($_POST['submit_feedback'])) {
        // $topic = mysqli_real_escape_string($connect, $_POST['topic_selection']);
        $comment = mysqli_real_escape_string($connect, $_POST['comment']);
    
        $sql = "INSERT INTO contactus (user_id, message) VALUES ('$user_id', '$comment')";
    
        if (mysqli_query($connect, $sql)) {
            echo '<script>alert("New record created successfully")</script>';
        } else {
            echo '<script>alert("Error: " . $sql . "<br>" . mysqli_error($connect))</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonBees | Contact</title>
    <link rel="icon" type="image" href="image/burger-removebg-preview.png">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="head_footer.css">
    <script src="ContactUs.js" type="javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
<ul class="head">
        <li class="topleft"><a href="#home" class="head_title">MoonBees</a></li>
        <div class="all_topcenter">
            <li class="topcenter"><a href="menu.php" class="head_title">Menu</a></li>
            <li class="topcenter"><a href="ContactUs.php" class="head_title">Contact Us</a></li>
            <li class="topcenter"><a href="aboutus.php" class="head_title">About Us</a></li>
        </div>
        <div class="all_topright">
            <li class="shopping_card"><a href="shopping_cart.php"><i class="ri-shopping-cart-fill" style="color: white; display: block; margin-top: 20px; padding-right: 15px"></i></a></li>
            <li class="help"><i class="ri-question-line" style="color: white; display: block; margin-top: 20px; padding-right: 15px;"> Help</i></li>
            <li class="dropdown">
                <a href="profile.php" style="font-size: 15px; text-decoration: none;">
                    <?php if ($userPhoto) : ?>
                        <img src="image/user/<?php echo $userPhoto; ?>" alt="User Photo" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;"><?php echo $userName; ?>
                    <?php else : ?>
                        <i class="ri-user-5-line" style="color: white; display: block; margin-top: 20px;"><?php echo $userName; ?></i>
                    <?php endif; ?>
                </a>
            </li>
            <li class="logout"><a href="logout.php" style="color: white; display: block; margin-top: 20px; padding-left: 15px; text-decoration: none">Logout</a></li>
        </div>
    </ul>

    
    <img src="image/contact us.png" alt="Contect Us" class="contactus_image">
    
    <div class="contactus_body">
        <form class="feedbackfrm" method="post">
            <div class="fb_sgt">
                <label><p>Feed Back / Suggestion</p></label>
                <textarea name="comment" id="comment" style="width: 500px; height: 320px; resize: none;"></textarea>
                </div>

            <div class="submit_btn">
                <button type="submit" name="submit_feedback" style="text-align: center; border: 1px solid black; background-color: yellow; border-radius: 10px; width: 70px;">Submit</button>
            </div>
        </form>
            
        
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2449.718088386932!2d102.25115649935964!3d2.2223818231622383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1f028a6dec9ab%3A0xbcefbe90f37590e1!2sR1%2C%20Jalan%20Tun%20Razak%2C%20Plaza%20Melaka%20Sentral%2C%2075400%20Melaka!5e0!3m2!1szh-CN!2smy!4v1717865441281!5m2!1szh-CN!2smy" width="600" height="450" style="border:0; margin-right: auto; display: block; padding: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade " class="map"></iframe>
    
    </div>

    <br>
    <br>
    <hr style="margin: 0px 300px; border: 1px solid black;">
    <br><br>
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
                <li><a href="#">Tiktok</a></li>
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
