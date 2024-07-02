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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonBees | Payment</title>
    <link rel="icon" href="image/burger-removebg-preview.png">
    <link rel="stylesheet" href="shopping_cart.css">
    <link rel="stylesheet" href="head_footer.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <script src="shopping_cart.js"></script>
</head>
<body>
    <ul class="head">
        <li class="topleft"><a href="" class="head_title">MoonBees</a></li>
        <div class="all_topcenter">
            <li class="topcenter"><a href="menu.php" class="head_title">Menu</a></li>
            <li class="topcenter"><a href="ContactUs.php" class="head_title">Contact Us</a></li>
            <li class="topcenter"><a href="aboutus.php" class="head_title">About Us</a></li>
        </div>
        <div class="all_topright">
            <li class="shopping_card"><a href="shopping_cart.php"><i class="ri-shopping-cart-fill" style="color: white; display: block; margin-top: 20px;"></i></a></li>
            <li class="help"><i class="ri-question-line" style="color: white; display: block; margin-top: 20px; padding: 0px 15px;"> Help</i></li>
            <li class="user">
                <a href="profile.html" style="font-size: 15px; text-decoration: none;">
                <?php if ($userPhoto) : ?>
                    <img src="image/user/<?php echo $userPhoto; ?>" alt="User Photo" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;"><?php echo $userName; ?>
                <?php else : ?>
                    <i class="ri-user-5-line" style="color: white; display: block; margin-top: 20px;"><?php echo $userName; ?></i>
                <?php endif; ?>
                </a>
            </li>
        </div>
    </ul>

    <div class="body">
        <div class="detail">
            <h1 id="Cart">Payment</h1>
            <div class="cart_detail">
                
                <div class="address_detail_1">
                    <div class="popup_container">
                        <div class="detail_2">
                            <h4>Deliver to</h4>
                            <div class="icon_address">
                                <!-- <span class="icon"> -->
                                    <i class="ri-home-8-line"></i>
                                <!-- </span> -->
                                <!-- <div> -->
                                    <p>house</p>
                                    <p>address</p>
                                <!-- </div> -->
                            </div>
                        </div>
                        <i class="ri-arrow-right-s-line"></i>
                    </div>
                </div>
                <hr>
                <div class="date_time">
                    <div class="popup_container">
                        <div class="detail_2">
                            <h4>Date and Time</h4>
                            <div class="icon_address">
                                <i class="ri-time-line"></i>
                                <p>date and time</p>
                            </div>
                        </div>
                        <i class="ri-arrow-right-s-line"></i>
                    </div>
                </div>
                <hr>
                <ul class="frm">
                    <div class="detailfrm">
                        <h2>Add Your Details</h2>
                        <form>
                            <div class="container">
                                <div class="all_name"> 
                                    <input type="text" placeholder="First Name" name="first_name" required>
                                    <input type="text" placeholder="Last Name" name="last_name" required>
                                </div>
                                <input type="email" placeholder="Email" name="email" required>
                                <input type="number" placeholder="Phone number" name="phone_num" required>
                            </div>
                        </form>
                    </div>
                </ul>
                <hr>
                <div class="order_requests">
                    <h2>Order Requests (Optional)</h2>
                    <textarea name="requests" id="requests" placeholder="Example: give me 2 set of spoon and fork" style="width: 568px; height: 100px; resize: vertical; min-height: 40px;"></textarea>
                </div>
                <br>
                <hr>
                <br>
                <div class="payment_method">
                    <h2>Payment Method</h2>
                    <div class="option_method">
                        <input type="radio" id="choose_btm">
                        <p id="cach_delivery">Cach On Delivery</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="price_detail">
            <div class="Subtotal">
                <p>Subtotal (include SST)</p>
                <span class="subtotal_price">RM 9.90</span>
            </div>
            <div class="Delivery">
                <p>Delivery & Processing Fee</p>
                <span class="delivery_price">RM 5.00</span>
            </div>
            <div class="ServiceTax">
                <p>Service Tax (6%)</p>
                <span class="servicetax_price">RM 0.60</span>
            </div>
            <br>
            <hr>
            <div class="date_time">
                <div class="popup_container">
                    <div class="detail_2">
                        <h4>Voucher / Rewards</h4>
                        <div class="icon_address">
                            <i class="ri-discount-percent-fill"></i>
                            <p>Save more money with Voucher or Rewards</p>
                        </div>
                    </div>
                    <i class="ri-arrow-right-s-line"></i>
                </div>
            </div>
            <br>
            <hr>
            <div>
                <p>total(include SST)</p>
                <span class="total_price">RM 15.5</span>
            </div>

            <button class="confirm_payment">Payment</button>
        </div>
    </div>

    <br> <br><hr style="margin: 0px 300px; border: 1px solid black;"><br><br>

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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const reduceBtns = document.querySelectorAll('.quantity_reduce');
            const increaseBtns = document.querySelectorAll('.quantity_increase');
            const quantities = document.querySelectorAll('#items_quantity');

            reduceBtns.forEach((btn, index) => {
                btn.addEventListener('click', () => {
                    event.preventDefault();
                    let quantity = parseInt(quantities[index].textContent);
                    if (quantity > 1) {
                        quantity--;
                        quantities[index].textContent = quantity;
                    }
                });
            });

            increaseBtns.forEach((btn, index) => {
                btn.addEventListener('click', () => {
                    event.preventDefault();
                    let quantity = parseInt(quantities[index].textContent);
                    quantity++;
                    quantities[index].textContent = quantity;
                });
            });
        });
    </script>
</body>
</html>