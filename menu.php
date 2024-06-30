<?php $connect = mysqli_connect("localhost","root","","moonbeedb"); ?>

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
            <li class="user"><a href="login.html" style="font-size: 15px; text-decoration: none;"><i class="ri-user-5-line" style="color: white; display: block; margin-top: 20px;"> Login</a></i></li>
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
            <!-- Meal -->
            <div class="product_container meal">
                <div class="product_body">
                    <div class="product_image_detail">
                        <div class="product_image">
                            <img src="image/food/1.png" alt="food_set_1">
                            <p>Chicken Patty Combo</p>
                        </div>
                        <div class="product_content">
                            <h2>Detail</h2>
                            <p>Burger Chicken Patty</p>
                            <p>French fries</p>
                            <p>Coca-cola</p>
                        </div>
                    </div>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container meal">
                <div class="product_body">
                    <div class="product_image_detail">
                        <div class="product_image">
                            <img src="image/food/2.png" alt="food_set_2">
                            <p>Chicken Crispy Combo</p>
                        </div>
                        <div class="product_content">
                            <h2>Detail</h2>
                            <p>Burger Chicken Crispy</p>
                            <p>French fries</p>
                            <p>Coca-cola</p>
                        </div>
                    </div>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container meal">
                <div class="product_body">
                    <div class="product_image_detail">
                        <div class="product_image">
                            <img src="image/food/3.png" alt="food_set_2">
                            <p>Chicken Grill Combo</p>
                        </div>
                        <div class="product_content">
                            <h2>Detail</h2>
                            <p>Burger Chicken Grill</p>
                            <p>French fries</p>
                            <p>Coca-cola</p>
                        </div>
                    </div>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container meal">
                <div class="product_body">
                    <div class="product_image_detail">
                        <div class="product_image">
                            <img src="image/food/4.png" alt="food_set_2">
                            <p>Beef Grill Combo</p>
                        </div>
                        <div class="product_content">
                            <h2>Detail</h2>
                            <p>Burger Beef Grill</p>
                            <p>French fries</p>
                            <p>Coca-cola</p>
                        </div>
                    </div>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container meal">
                <div class="product_body">
                    <div class="product_image_detail">
                        <div class="product_image">
                            <img src="image/food/5.png" alt="food_set_2">
                            <p>Special Beef Combo</p>
                        </div>
                        <div class="product_content">
                            <h2>Detail</h2>
                            <p>Burger Special Beef</p>
                            <p>French fries</p>
                            <p>Coca-cola</p>
                        </div>
                    </div>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container meal">
                <div class="product_body">
                    <div class="product_image_detail">
                        <div class="product_image">
                            <img src="image/food/6.png" alt="food_set_2">
                            <p>Fries Chicken Regular Combo</p>
                        </div>
                        <div class="product_content">
                            <h2>Detail</h2>
                            <p>Fries Chicken Regular(2pc)</p>
                            <p>French fries</p>
                            <p>Coca-cola</p>
                        </div>
                    </div>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container meal">
                <div class="product_body">
                    <div class="product_image_detail">
                        <div class="product_image">
                            <img src="image/food/7.png" alt="food_set_2">
                            <p>Fries Chicken Spicy Combo</p>
                        </div>
                        <div class="product_content">
                            <h2>Detail</h2>
                            <p>Fries Chicken Spicy(2pc)</p>
                            <p>French fries</p>
                            <p>Coca-cola</p>
                        </div>
                    </div>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>
            
            <!-- Burger -->
            <div class="product_container burger">
                <div class="product_body">
                    <div class="product_image_detail">
                        <div class="product_image">
                            <img src="image/food/8.png" alt="Burger_1">
                            <p>Burger Chicken Patty</p>
                        </div>
                        <div class="product_content">
                            <h2>Detail</h2>
                            <p>Burger Chicken Patty</p>
                            <p>French fries</p>
                            <p>Coca-cola</p>
                        </div>
                    </div>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container burger">
                <div class="product_body">
                    <div class="product_image_detail">
                        <div class="product_image">
                            <img src="image/food/9.png" alt="Burger_2">
                            <p>Burger Chicken Crispy</p>
                        </div>
                        <div class="product_content">
                            <h2>Detail</h2>
                            <p>Burger Chicken Patty</p>
                            <p>French fries</p>
                            <p>Coca-cola</p>
                        </div>
                    </div>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container burger">
                <div class="product_body">
                    <div class="product_image_detail">
                        <div class="product_image">
                            <img src="image/food/10.png" alt="Burger_3">
                            <p>Burger Beef Grill</p>
                        </div>
                        <div class="product_content">
                            <h2>Detail</h2>
                            <p>Burger Chicken Patty</p>
                            <p>French fries</p>
                            <p>Coca-cola</p>
                        </div>
                    </div>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container burger">
                <div class="product_body">
                    <div class="product_image_detail">
                        <div class="product_image">
                            <img src="image/food/11.png" alt="Burger_3">
                            <p>Burger Special Beef</p>
                        </div>
                        <div class="product_content">
                            <h2>Detail</h2>
                            <p>Burger Chicken Patty</p>
                            <p>French fries</p>
                            <p>Coca-cola</p>
                        </div>
                    </div>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container burger">
                <div class="product_body">
                    <div class="product_image_detail">
                        <div class="product_image">
                            <img src="image/food/12.png" alt="Burger_3">
                            <p>Burger Chicken Grill</p>
                        </div>
                        <div class="product_content">
                            <h2>Detail</h2>
                            <p>Burger Chicken Patty</p>
                            <p>French fries</p>
                            <p>Coca-cola</p>
                        </div>
                    </div>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <!-- Chicken -->
            <div class="product_container fried_chicken">
                <div class="product_body">
                    <img src="image/food/13.png" alt="normal">
                    <p>Fries Chicken Regular(2pc)</p>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container fried_chicken">
                <div class="product_body">
                    <img src="image/food/14.png" alt="spicial">
                    <p>Fries Chicken Spicy(2pc)</p>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>
             <!-- Drinks -->
            <div class="product_container drinks">
                <div class="product_body">
                    <img src="image/food/15.png" alt="Cola">
                    <p>Coca-cola</p>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container drinks">
                <div class="product_body">
                    <img src="image/food/16.png" alt="Teh O">
                    <p>Teh O</p>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container drinks">
                <div class="product_body">
                    <img src="image/food/17.png" alt="Teh">
                    <p>Teh</p>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container drinks">
                <div class="product_body">
                    <img src="image/food/18.png" alt="Coffee">
                    <p>Coffee</p>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>
            <!-- Dessert_Sides -->
            <div class="product_container dessert_sides">
                <div class="product_body">
                    <img src="image/food/20.png" alt="Salad">
                    <p>Salad</p>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container dessert_sides">
                <div class="product_body">
                    <img src="image/food/21.png" alt="Nuggets">
                    <p>Nuggets(6pc)</p>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>

            <div class="product_container dessert_sides">
                <div class="product_body">
                    <img src="image/food/22.png" alt="Onion Ring">
                    <p>Onion Ring</p>
                </div>
                <div class="product_footer">
                    <div class="product_price">
                        <span class="ste_price">RM9.90</span>
                    </div>
                    <div class="orderbtm">
                        <a href="#" onclick="">Order</a>
                    </div>
                </div>
            </div>
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
