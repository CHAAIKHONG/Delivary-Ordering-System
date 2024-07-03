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
    $query = "SELECT address FROM user WHERE user_id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userAddress = $row['address'];
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
    <title>MoonBees | Shopping Cart</title>
    <link rel="icon" href="image/burger-removebg-preview.png">
    <link rel="stylesheet" href="shopping_cart.css">
    <link rel="stylesheet" href="head_footer.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
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
            <h1 id="Cart">My Cart</h1>
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
                        <button onclick="document.getElementById('addressModal').style.display='block'">Change Address</button>
                    </div>
                    <div id="addressModal" class="modal" style="display: none;">
                        <div class="modal-content">
                            <h4>Change Address</h4>
                            <form id="changeAddressForm">
                                <label for="newAddress">New Address:</label>
                                <input type="text" id="newAddress" name="newAddress" required>
                                <button type="submit">Save Address</button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="date_time">
                    <div class="popup_container">
                        <div class="detail_2">
                            <h4>Date and Time</h4>
                            <div class="icon_address">
                                <i class="ri-time-line"></i>
                                <p id="selectedDateTime">Select date and time</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="items_detail">
                    <div class="items_detail_container">
                        <div class="order_add">
                            <h2>Order Item</h2>
                            <a href="menu.php"><p>Add Items</p></a>
                        </div>
                        <ul class="check_items">
                            <?php if (count($orderItems) > 0) : ?>
                            <?php foreach ($orderItems as $item) : ?>
                            <li class="items_quantity" data-product-id="<?php echo $item['product_id']; ?>">
                                <div class="name_price">
                                    <div>
                                        <img src="image/food/<?php echo $item['photo']; ?>" alt="Product Photo" style="width: 50px; height: 50px; margin-right: 10px;">
                                        <div class="items_name"><h4><?php echo $item['product_name']; ?></h4></div>
                                    </div>
                                    <div class="items_price">
                                        <span id="items_price"><h4>RM <?php echo number_format($item['price'], 2); ?></h4></span>
                                    </div>
                                </div>
                                <div class="remove_add">
                                    <div class="items_remove">
                                        <span id="items_remove" class="remove-btn">Remove</span>
                                    </div>
                                    <div class="add_quantity_1">
                                        <form class="add_quantity">
                                            <button type="button" class="quantity_reduce">-</button>
                                            <div id="items_quantity"><?php echo $item['quantity']; ?></div>
                                            <button type="button" class="quantity_increase">+</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
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
            </form>
            <!-- <button class="confirm_payment">Payment</button> -->
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
    // 自动设置并显示当前日期和时间
    window.onload = function() {
        var currentDateTime = new Date();
        var formattedDateTime = currentDateTime.toLocaleString('en-GB', { year: 'numeric', month: 'numeric', day: 'numeric', hour: '2-digit', minute: '2-digit' });
        document.getElementById('selectedDateTime').innerText = formattedDateTime;

        document.getElementById('selectedDateTime').innerText = formattedDateTime;

        // 设置隐藏的表单字段值
        // document.getElementById('hiddenDate').value = formattedDate;
        // document.getElementById('hiddenTime').value = formattedTime;
    };

    // Add event listener for the address change form
    const addressForm = document.getElementById('changeAddressForm');
    addressForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const newAddress = document.getElementById('newAddress').value;
        fetch('update_address.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `newAddress=${newAddress}`
        })
        .then(response => response.text())
        .then(data => {
            document.querySelector('.icon_address p').innerText = newAddress;
            document.getElementById('addressModal').style.display = 'none';
        })
        .catch(error => console.error('Error:', error));
    });

    $(document).ready(function() {
        // Remove item
        $('.remove-btn').click(function() {
            var productId = $(this).closest('.items_quantity').data('product-id');
            $.ajax({
                url: 'update_cart.php',
                method: 'POST',
                data: { action: 'remove', product_id: productId },
                success: function(response) {
                    location.reload();
                }
            });
        });

        // Increase quantity
        $('.quantity_increase').click(function() {
            var productId = $(this).closest('.items_quantity').data('product-id');
            $.ajax({
                url: 'update_cart.php',
                method: 'POST',
                data: { action: 'increase', product_id: productId },
                success: function(response) {
                    location.reload();
                }
            });
        });

        // Decrease quantity
        $('.quantity_reduce').click(function() {
            var productId = $(this).closest('.items_quantity').data('product-id');
            $.ajax({
                url: 'update_cart.php',
                method: 'POST',
                data: { action: 'decrease', product_id: productId },
                success: function(response) {
                    location.reload();
                }
            });
        });
    });

    document.querySelector('.confirm_payment').addEventListener('click', function() {
        document.getElementById('paymentForm').submit();
    });
</script>
</body>
</html>
