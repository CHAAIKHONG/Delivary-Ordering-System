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
$userAddress = '';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if (isset($_SESSION['photo'])) {
        $userPhoto = $_SESSION['photo'];
    }

    if (isset($_SESSION['fullname'])) {
        $userName = $_SESSION['fullname'];
    }

    // 获取用户地址
    $query = "SELECT address, email, phone_number FROM user WHERE user_id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userAddress = $row['address'];
        $userEmail = $row['email'];
        $userPhoneNumber = $row['phone_number'];
    }

    $stmt->close();

    // 获取用户的订单项
    $query = "SELECT cartitem.product_id, product.product_name, product.price, product.photo, cartitem.quantity 
            FROM cartitem 
            INNER JOIN product ON cartitem.product_id = product.product_id 
            WHERE cartitem.user_id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $orderItemsResult = $stmt->get_result();

    $orderItems = [];
    while ($row = $orderItemsResult->fetch_assoc()) {
        $orderItems[] = $row;
    }
    

    $stmt->close();
} else {
    // 用户未登录，重定向到登录页面
    header("Location: login.php");
    exit();
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
                                <i class="ri-home-8-line"></i>
                                <p><?php echo $userAddress ? $userAddress : "No address found"; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="date_time">
                    <div class="popup_container">
                        <div class="detail_2">
                            <h4>Delivery Time</h4>
                            <div class="icon_address">
                                <i class="ri-time-line"></i>
                                <p>It will be delivered within 30 minutes.</p>
                            </div>
                        </div> 
                    </div>
                </div>
                <hr>
                <ul class="frm">
                    <div class="detailfrm">
                        <h2>Add Your Details</h2>
                        <form>
                            <div class="container">
                                <p>Full Name: <?php echo htmlspecialchars($userName); ?></p>
                                <p>Email: <?php echo htmlspecialchars($userEmail); ?></p>
                                <p>Phone Number: <?php echo htmlspecialchars($userPhoneNumber); ?></p>
                            </div>
                        </form>
                    </div>
                </ul>
                <!-- <hr> -->
                <!-- <div class="order_requests">
                    <h2>Order Requests (Optional)</h2>
                    <textarea name="requests" id="requests" placeholder="Example: give me 2 set of spoon and fork" style="width: 568px; height: 100px; resize: vertical; min-height: 40px;"></textarea>
                </div>
                <br> -->
                <hr>
                <br>
                <div class="payment_method">
                    <h2>Payment Method</h2>
                    <div class="option_method">
                    <input type="radio" id="choose_btm" name="payment_method" value="Cash On Delivery">
                        <p id="cach_delivery">Cach On Delivery</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="price_detail">
            <?php
            $subtotal = array_reduce($orderItems, function($sum, $item) {
                return $sum + ($item['price'] * $item['quantity']);
            }, 0);
            $delivery_fee = 5.00;
            $service_tax = 0.06 * $subtotal;
            $total = $subtotal + $delivery_fee + $service_tax;
            ?>
            <div class="Subtotal">
                <p>Subtotal (include SST)</p>
                <span class="subtotal_price">RM <?php echo number_format($subtotal, 2); ?></span>
            </div>
            <div class="Delivery">
                <p>Delivery & Processing Fee</p>
                <span class="delivery_price">RM <?php echo number_format($delivery_fee, 2); ?></span>
            </div>
            <div class="ServiceTax">
                <p>Service Tax (6%)</p>
                <span class="servicetax_price">RM <?php echo number_format($service_tax, 2); ?></span>
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
                <p>Total (include SST)</p>
                <span class="total_price">RM <?php echo number_format($total, 2); ?></span>
            </div>
            <button class="confirm_payment">Payment</button>
            <form id="paymentForm" action="process_payment.php" method="post" style="display: none;">
                <input type="hidden" name="total" value="<?php echo number_format($total, 2); ?>">
                <input type="hidden" name="order_items" value='<?php echo json_encode($orderItems); ?>'>
                <input type="hidden" name="payment_method" id="paymentMethod">
            </form>
            <!-- <button class="confirm_payment">Payment</button> -->
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
        document.querySelector('.confirm_payment').addEventListener('click', function() {
            var paymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethod) {
                alert('Please select a payment method.');
                return;
            }

            document.getElementById('paymentMethod').value = paymentMethod.value;
            document.getElementById('paymentForm').submit();
        });
    </script>
</body>
</html>