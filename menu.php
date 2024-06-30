<?php 
$connect = mysqli_connect("localhost","root","","moonbeedb"); 

$query = "SELECT p.*, c.category_name FROM product p JOIN category c ON p.category_id = c.category_id";
$result = mysqli_query($connect, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonBees | Menu</title>
    <link rel="icon" type="image" href="image/burger-removebg-preview.png">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="head_footer.css">
    <script src="menu.js" type="text/javascript"></script> 
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
    <ul class="head">
        <li class="topleft"><a href="" class="head_title">MoonBees</a></li>
        <div class="all_topcenter">
            <li class="topcenter"><a href="menu.php" class="head_title">Menu</a></li>
            <li class="topcenter"><a href="ContactUs.html" class="head_title">Contact Us</a></li>
            <li class="topcenter"><a href="aboutus.html" class="head_title">About Us</a></li>
        </div>
        <div class="all_topright">
            <li class="shopping_card"><a href="shopping_cart.html"><i class="ri-shopping-cart-fill" style="color: white; display: block; margin-top: 20px;"></i></a></li>
            <li class="help"><i class="ri-question-line" style="color: white; display: block; margin-top: 20px; padding: 0px 15px;"> Help</i></li>
            <li class="user"><a href="login.php" style="font-size: 15px; text-decoration: none;"><i class="ri-user-5-line" style="color: white; display: block; margin-top: 20px;"> Login</a></i></li>
        </div>
    </ul>

    <div class="container">
        <div class="category">
            <ul class="category_menu">
                <li class="Meal" onclick="filterProducts('meal')">Meal</li>
                <li class="Burger" onclick="filterProducts('burger')">Burger</li>
                <li class="Fried_Chicken" onclick="filterProducts('fried_chicken')">Fried Chicken</li>
                <li class="Drinks" onclick="filterProducts('drinks')">Drinks</li>
                <li class="Dessert_Sides" onclick="filterProducts('dessert_sides')">Dessert & Sides</li>
            </ul>
        </div>

        <div class="product_list">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="product_container '.strtolower(str_replace(' ', '_', $row['category_name'])).'">
                        <div class="product_body">
                            <div class="product_image_detail">
                                <div class="product_image">
                                    <img src="image/food/'.$row['photo'].'" alt="'.$row['product_name'].'">
                                    <p>'.$row['product_name'].'</p>
                                </div>
                                <div class="product_content">
                                    <h2>Detail</h2>
                                    <p>'.$row['description'].'</p>
                                </div>
                            </div>
                        </div>
                        <div class="product_footer">
                            <div class="product_price">
                                <span class="ste_price">RM'.$row['price'].'</span>
                            </div>
                            <div class="orderbtm">
                                <a href="#" onclick="">Order</a>
                            </div>
                        </div>
                    </div>';
                }
            }

            mysqli_close($connect);
            ?>
        </div>
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


