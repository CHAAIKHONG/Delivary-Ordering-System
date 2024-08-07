<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "moonbeedb");

    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $userPhoto = null;
    $userName = 'user';

    
    $user_id = $_SESSION['user_id'];

    if (isset($_SESSION['photo'])) {
        $userPhoto = $_SESSION['photo'];
    }

    if (isset($_SESSION['fullname'])) {
        $userName = $_SESSION['fullname'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="head_footer.css">
    <link rel="icon" href="image/burger-removebg-preview.png">
    <title>MoonBees | About Us</title>
</head>

<body>
    <div class="body">
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

        <div class="background1">
        <header class="title"><h1>ABOUT US</h1></header>

        <main>
        <section class="vision_mission">
            <h2 style="font-size: 33px;">Vision and Mission</h2>
                <div class="vi_mi_de">
                    <div class="vision">
                        <h3 style="font-size: 25px;">Vision Statement</h3>
                        <p class="vision_infor">To revolutionize the ordering process by providing the fastest, most reliable, and user-friendly platform, connecting customers with their favorite products seamlessly and efficiently.</p>
                    </div>
                    <div class="misssion"></div>
                    <div class="mission">
                        <h3 style="font-size: 25px;">Mission Statement</h3>
                        <p class="mission_infor">Our mission is to streamline the ordering experience for both businesses and consumers by offering an intuitive, high-speed platform that ensures accuracy, convenience, and satisfaction. We are committed to leveraging cutting-edge technology to meet the evolving needs of our users, fostering a culture of innovation, and maintaining the highest standards of service.</p>
                    </div>
                </div>
        </section>
        <br>
        </div>

        <section class="our-team-section">
            <div class="ourteamback" style="background-image: url('team photo/ourteamback.png');">
                <h2 style="font-size: 35px;" >Our Team</h2>   
                <div class="teampic"> <img src="team photo/team1.jpg" width="1485" alt="professional team" title="our team"></div>
                <div class="meetthemoonbeeteam">
                    <h3 style="font-size: 25px;">Meet the MoonBee Team</h3>
                    <div class="meetteam"><p>At MoonBees, our dynamic team is dedicated to transforming the fast food ordering experience. Comprising talented developers, designers, and customer service experts, we bring a passion for innovation and excellence to everything we do. Our mission is to create a seamless, high-speed platform that connects customers with their favorite meals effortlessly. We pride ourselves on our commitment to quality, reliability, and user satisfaction, ensuring every interaction with our system is quick, intuitive, and enjoyable. Join us as we revolutionize the way you order fast food, one click at a time.</p></div>  
                </div>
                <br><br><br>
            </div>

        <div class="background2">
            <div class="Member">
                <h3 style="font-size: 25px;">The People Behind</h3>
                
                <div class="member_pic"> 
                    <div class="aikhong">
                        <img src="team photo/aikhong.jpg" height="300" width="230" alt="aikhong handsome boy" title="Cha Aik Hong">
                        <div class="picdetail"><h4>Cha Aik Hong</h4>
                            <div class="icon">
                            </div>
                        </div>
                    </div>
                    <div class="wenjie">
                        <img src="image/sing.png" height="300" width="230" alt="wenjie pretty girl" title="Sing Wen Jie">
                        <div class="picdetail"><h4>Sing Wen Jie</h4>
                            <div class="icon">
                            </div>
                        </div>
                    </div>
                    <div class="yiming">
                        <img src="image/yiming.png" height="300" width="230" alt="what you expect" title="Khong Yi Ming">
                        <div class="picdetail"><h4>Khong Yi Ming</h4>
                            <div class="icon">
                            </div>
                        </div>
                    </div>
                    <div class="yuthee">
                        <img src="image/self.jpg" height="300" alt="yuthee so sleepy" title="Tang Yut Hee">
                        <div class="picdetail"><h4>Tang Yut Hee</h4>
                        </div>
                    </div>

                </div>
            </div>

        </section>
        </main>

        <br><br><br><br>
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
                        <li><a href="#"></i>Facebook</a></li>
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
        </div>
    </div>
</body>

</html>